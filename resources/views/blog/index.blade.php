<x-layouts.public>
<section class="py-24 lg:py-32">
  <div class="section-inner max-w-6xl">
    <div class="mb-12">
      <span class="eyebrow">{{ __('messages.blog_eyebrow') }}</span>
      <h1 class="display-2 mt-2">{{ __('messages.blog_index_title') }}</h1>
    </div>

    <div class="flex flex-wrap gap-2 mb-10">
      <a href="{{ route('blog.index', app()->getLocale()) }}"
         class="filter-pill @if(!isset($activeCategory)) is-active @endif">{{ __('messages.filter_all') }}</a>
      @foreach($categories as $cat)
        <a href="{{ route('blog.category', [app()->getLocale(), $cat->slug]) }}"
           class="filter-pill @if(isset($activeCategory) && $activeCategory->id === $cat->id) is-active @endif">{{ $cat->name }}</a>
      @endforeach
    </div>

    <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-8">
      @forelse($posts as $post)
        <a href="{{ route('blog.show', [app()->getLocale(), $post->slug]) }}" class="product-card">
          <div class="product-card-image">
            @if($post->category)<span class="product-card-badge">{{ $post->category->name }}</span>@endif
            <img src="{{ $post->getFeaturedImageUrl('card') ?? 'https://images.unsplash.com/photo-1569466593977-94ee7ed02ec9?w=900&q=85&auto=format&fit=crop' }}"
                 alt="{{ $post->title }}" loading="lazy"/>
          </div>
          <div class="product-card-body">
            <h3 class="product-card-title">{{ $post->title }}</h3>
            <p class="product-card-desc">{{ $post->excerpt }}</p>
            <div class="product-card-meta">
              <div>{{ $post->published_at?->translatedFormat('d F Y') }}</div>
              <div style="color:var(--ink-300)">·</div>
              <div>{{ $post->reading_time }} {{ __('messages.min_read') }}</div>
            </div>
          </div>
        </a>
      @empty
        <p class="lead">{{ __('messages.no_posts') }}</p>
      @endforelse
    </div>

    <div class="mt-12">{{ $posts->links() }}</div>
  </div>
</section>
</x-layouts.public>
