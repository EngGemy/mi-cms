<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Services\Contracts\SeoServiceInterface;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request, SeoServiceInterface $seo)
    {
        $seo->setTitle(__('messages.projects_index_title'));

        $category = $request->query('category');

        $query = Project::active()->with('media');
        if ($category && array_key_exists($category, Project::CATEGORIES)) {
            $query->ofCategory($category);
        }

        return view('projects.index', [
            'projects'   => $query->get(),
            'categories' => Project::CATEGORIES,
            'active_cat' => $category,
            'seo'        => $seo->toArray(),
        ]);
    }

    public function show(string $locale, Project $project, SeoServiceInterface $seo)
    {
        abort_unless($project->is_active, 404);

        $project->load(['media','phases.media']);

        $seo->setTitle($project->title)
            ->setDescription($project->summary ?? $project->description)
            ->setImage($project->getCoverUrl('hero') ?? $project->getCoverUrl('card'))
            ->setType('article');

        $galleryImages   = $project->getGalleryUrls();
        $blueprintImages = $project->getBlueprintUrls();
        $projectCatalogue = $this->buildCatalogueItems($project, $galleryImages, $blueprintImages, $locale);
        $related         = $project->related(3);

        $jsonLd = json_encode([
            '@context'    => 'https://schema.org',
            '@type'       => 'CreativeWork',
            'name'        => $project->title,
            'description' => $project->description,
            'image'       => $project->getCoverUrl('hero'),
            'dateCreated' => $project->completion_date?->toIso8601String() ?? ($project->year ? $project->year . '-01-01' : null),
            'creator'     => ['@type' => 'Organization', 'name' => 'MI Metal Industries', 'url' => url('/')],
            'locationCreated' => $project->location_code ? ['@type' => 'Place', 'name' => $project->location_code] : null,
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        return view('projects.show', [
            'project'         => $project,
            'galleryImages'   => $galleryImages,
            'blueprintImages' => $blueprintImages,
            'projectCatalogue'=> $projectCatalogue,
            'related'         => $related,
            'jsonLd'          => $jsonLd,
            'seo'             => $seo->toArray(),
        ]);
    }

    private function buildCatalogueItems(Project $project, array $galleryImages, array $blueprintImages, string $locale): array
    {
        $items = [];
        $poster = $project->getCoverUrl('card') ?? $project->getCoverUrl('hero');

        if ($project->getCoverUrl('hero')) {
            $items[] = [
                'type' => 'image',
                'badge' => __('messages.project_catalogue_cover'),
                'title' => $project->title,
                'full' => $project->getCoverUrl('hero'),
                'thumb' => $project->getCoverUrl('thumb') ?? $project->getCoverUrl('card'),
            ];
        }

        foreach ($galleryImages as $index => $image) {
            $items[] = [
                'type' => 'image',
                'badge' => __('messages.project_gallery'),
                'title' => $image['alt'] . ' ' . ($index + 1),
                'full' => $image['full'],
                'thumb' => $image['thumb'],
            ];
        }

        foreach ($blueprintImages as $index => $image) {
            $items[] = [
                'type' => 'image',
                'badge' => __('messages.project_blueprint'),
                'title' => $image['alt'] . ' ' . ($index + 1),
                'full' => $image['full'],
                'thumb' => $image['thumb'],
            ];
        }

        foreach ($project->phases as $phase) {
            if ($phaseImage = $phase->getImageUrl('card')) {
                $items[] = [
                    'type' => 'image',
                    'badge' => __('messages.project_phases_title'),
                    'title' => $phase->title,
                    'full' => $phaseImage,
                    'thumb' => $phase->getImageUrl('thumb') ?? $phaseImage,
                ];
            }

            if ($phase->hasVideo()) {
                $embed = $phase->getVideoEmbed();
                $items[] = $embed
                    ? [
                        'type' => 'embed_video',
                        'badge' => __('messages.project_video'),
                        'title' => $phase->title,
                        'embed' => $embed,
                        'thumb' => $phaseImage ?? $poster,
                        'poster' => $phaseImage ?? $poster,
                    ]
                    : [
                        'type' => 'file_video',
                        'badge' => __('messages.project_video'),
                        'title' => $phase->title,
                        'src' => $phase->getVideoUrl(),
                        'thumb' => $phaseImage ?? $poster,
                        'poster' => $phaseImage ?? $poster,
                    ];
            }
        }

        foreach ($project->getParsedVideos() as $index => $video) {
            $title = $locale === 'ar'
                ? ($video['title_ar'] ?: __('messages.project_video') . ' ' . ($index + 1))
                : ($video['title_en'] ?: __('messages.project_video') . ' ' . ($index + 1));

            if ($video['youtube_id']) {
                $items[] = [
                    'type' => 'embed_video',
                    'badge' => __('messages.project_video'),
                    'title' => $title,
                    'embed' => 'https://www.youtube.com/embed/' . $video['youtube_id'] . '?rel=0',
                    'thumb' => $poster,
                    'poster' => $poster,
                ];
            } elseif ($video['vimeo_id']) {
                $items[] = [
                    'type' => 'embed_video',
                    'badge' => __('messages.project_video'),
                    'title' => $title,
                    'embed' => 'https://player.vimeo.com/video/' . $video['vimeo_id'],
                    'thumb' => $poster,
                    'poster' => $poster,
                ];
            }
        }

        if ($project->video_url) {
            $items[] = $this->videoUrlCatalogueItem($project->video_url, __('messages.project_video'), $poster);
        }

        if ($videoMedia = $project->getFirstMedia('video')) {
            $items[] = [
                'type' => 'file_video',
                'badge' => __('messages.project_video'),
                'title' => __('messages.project_video'),
                'src' => $videoMedia->getUrl(),
                'thumb' => $poster,
                'poster' => $poster,
            ];
        }

        return array_values(array_filter($items));
    }

    private function videoUrlCatalogueItem(string $url, string $title, ?string $poster): ?array
    {
        preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $yt);
        preg_match('/vimeo\.com\/(\d+)/', $url, $vi);

        if (!empty($yt[1])) {
            return [
                'type' => 'embed_video',
                'badge' => __('messages.project_video'),
                'title' => $title,
                'embed' => 'https://www.youtube.com/embed/' . $yt[1] . '?rel=0',
                'thumb' => $poster,
                'poster' => $poster,
            ];
        }

        if (!empty($vi[1])) {
            return [
                'type' => 'embed_video',
                'badge' => __('messages.project_video'),
                'title' => $title,
                'embed' => 'https://player.vimeo.com/video/' . $vi[1],
                'thumb' => $poster,
                'poster' => $poster,
            ];
        }

        return [
            'type' => 'file_video',
            'badge' => __('messages.project_video'),
            'title' => $title,
            'src' => $url,
            'thumb' => $poster,
            'poster' => $poster,
        ];
    }
}
