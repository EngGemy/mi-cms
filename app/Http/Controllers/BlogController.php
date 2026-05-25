<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\BlogPost;
use App\Services\Contracts\SeoServiceInterface;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(SeoServiceInterface $seo)
    {
        $seo->setTitle(__('messages.blog_index_title'))
            ->setDescription(__('messages.blog_index_description'));

        return view('blog.index', [
            'posts'      => BlogPost::published()->with(['author', 'category'])->paginate(9),
            'categories' => BlogCategory::orderBy('position')->get(),
            'seo'        => $seo->toArray(),
        ]);
    }

    public function category(string $locale, BlogCategory $category, SeoServiceInterface $seo)
    {
        $name = $category->getTranslation('name', app()->getLocale());
        $seo->setTitle($name);

        return view('blog.index', [
            'posts'      => $category->publishedPosts()->with(['author'])->paginate(9),
            'categories' => BlogCategory::orderBy('position')->get(),
            'activeCategory' => $category,
            'seo'        => $seo->toArray(),
        ]);
    }

    public function show(string $locale, BlogPost $post, SeoServiceInterface $seo)
    {
        abort_if($post->published_at === null || $post->published_at->isFuture(), 404);

        $post->increment('views_count');

        $seo->setTitle($post->seoTitle())
            ->setDescription($post->seoDescription())
            ->setImage($post->getFeaturedImageUrl('hero'))
            ->setType('article');

        return view('blog.show', [
            'post'     => $post->load(['author', 'category', 'approvedComments.replies']),
            'related'  => BlogPost::published()
                ->where('id', '!=', $post->id)
                ->where('blog_category_id', $post->blog_category_id)
                ->take(3)
                ->get(),
            'seo' => $seo->toArray(),
        ]);
    }

    public function comment(string $locale, BlogPost $post, CommentRequest $request)
    {
        abort_unless($post->comments_enabled, 403);

        BlogComment::create([
            ...$request->validated(),
            'blog_post_id' => $post->id,
            'ip_address'   => $request->ip(),
            'status'       => 'pending',   // Comments need admin approval
        ]);

        return back()->with('comment_ok', __('messages.comment_submitted'));
    }
}
