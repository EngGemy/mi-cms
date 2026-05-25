<x-layouts.public>
<article class="py-24 lg:py-32">
  <div class="section-inner max-w-3xl">
    @if($post->category)
      <span class="eyebrow">{{ $post->category->name }}</span>
    @endif
    <h1 class="display-2 mt-4">{{ $post->title }}</h1>
    <div class="flex items-center gap-4 mt-6 text-sm" style="color:var(--ink-500)">
      <span>{{ $post->published_at?->translatedFormat('d F Y') }}</span>
      <span>·</span>
      <span>{{ $post->reading_time }} {{ __('messages.min_read') }}</span>
      @if($post->author)
        <span>·</span>
        <span>{{ $post->author->name }}</span>
      @endif
    </div>

    @if($post->getFeaturedImageUrl('hero'))
      <div class="mt-10 rounded-3xl overflow-hidden">
        <img src="{{ $post->getFeaturedImageUrl('hero') }}" alt="{{ $post->title }}"
             style="width:100%;height:auto;display:block"/>
      </div>
    @endif

    <div class="prose prose-lg max-w-none mt-10" style="font-family:'Cairo',sans-serif;color:var(--ink-800);line-height:1.85">
      {!! $post->content !!}
    </div>
  </div>

  {{-- Related posts --}}
  @if($related->count())
    <div class="section-inner max-w-6xl mt-24">
      <h2 class="display-3 mb-8">{{ __('messages.related_posts') }}</h2>
      <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-6">
        @foreach($related as $r)
          <a href="{{ route('blog.show', [app()->getLocale(), $r->slug]) }}" class="product-card">
            <div class="product-card-image">
              <img src="{{ $r->getFeaturedImageUrl('card') }}" alt="{{ $r->title }}" loading="lazy"/>
            </div>
            <div class="product-card-body">
              <h3 class="product-card-title">{{ $r->title }}</h3>
              <p class="product-card-desc">{{ $r->excerpt }}</p>
            </div>
          </a>
        @endforeach
      </div>
    </div>
  @endif

  {{-- Comments --}}
  @if($post->comments_enabled)
    <div class="section-inner max-w-3xl mt-16">
      <h2 class="display-3 mb-8">{{ __('messages.comments') }} ({{ $post->approvedComments->count() }})</h2>

      @foreach($post->approvedComments as $comment)
        <div class="bg-paper rounded-2xl p-6 mb-4">
          <div class="flex items-center justify-between mb-3">
            <div style="font-weight:700">{{ $comment->author_name }}</div>
            <div class="label-mono" style="color:var(--ink-500)">{{ $comment->created_at->translatedFormat('d F Y') }}</div>
          </div>
          <p style="line-height:1.75">{{ $comment->body }}</p>
          @foreach($comment->replies as $reply)
            <div class="mt-4 pr-6 border-r-2" style="border-color:var(--mi-red)">
              <div style="font-weight:700;font-size:13px">{{ $reply->author_name }}</div>
              <p class="text-sm mt-2">{{ $reply->body }}</p>
            </div>
          @endforeach
        </div>
      @endforeach

      <form method="POST" action="{{ route('blog.comment', [app()->getLocale(), $post->slug]) }}"
            class="mt-10 bg-paper rounded-2xl p-8">
        @csrf
        <h3 class="display-3 mb-6">{{ __('messages.leave_comment') }}</h3>
        <div class="grid md:grid-cols-2 gap-4 mb-4">
          <input type="text" name="author_name" required placeholder="{{ __('messages.field_name') }}"
                 class="px-4 py-3 rounded-xl border bg-white" style="border-color:rgba(26,22,17,.1)"/>
          <input type="email" name="author_email" required placeholder="{{ __('messages.field_email') }}"
                 class="px-4 py-3 rounded-xl border bg-white" style="border-color:rgba(26,22,17,.1)"/>
        </div>
        <textarea name="body" required rows="5" placeholder="{{ __('messages.comment_placeholder') }}"
                  class="w-full px-4 py-3 rounded-xl border bg-white mb-4" style="border-color:rgba(26,22,17,.1)"></textarea>
        <button type="submit" class="btn btn-primary">{{ __('messages.submit_comment') }}</button>
        @if(session('comment_ok'))
          <p class="text-sm mt-4" style="color:var(--mi-red)">✔ {{ session('comment_ok') }}</p>
        @endif
      </form>
    </div>
  @endif
</article>
</x-layouts.public>
