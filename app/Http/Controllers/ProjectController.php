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
            'related'         => $related,
            'jsonLd'          => $jsonLd,
            'seo'             => $seo->toArray(),
        ]);
    }
}
