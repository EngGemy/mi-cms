@php
  $about = $aboutSettings ?? null;
  $videoSrc = $about?->video_url ?: null;
  $videoPoster = $about?->videoPosterUrl('https://plus.unsplash.com/premium_photo-1661930553507-59420df08d82?w=1600&q=85&auto=format&fit=crop');
  $isEmbed = $videoSrc && (
      str_contains($videoSrc, 'youtube.com') ||
      str_contains($videoSrc, 'youtu.be') ||
      str_contains($videoSrc, 'vimeo.com')
  );
  $embedSrc = null;
  if ($isEmbed && $videoSrc) {
      if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $videoSrc, $m)) {
          $embedSrc = 'https://www.youtube.com/embed/' . $m[1] . '?autoplay=1&mute=1&loop=1&playlist=' . $m[1] . '&rel=0';
      } elseif (preg_match('/vimeo\.com\/(\d+)/', $videoSrc, $m)) {
          $embedSrc = 'https://player.vimeo.com/video/' . $m[1] . '?autoplay=1&muted=1&loop=1&background=1';
      }
  }
@endphp
<section class="py-24 lg:py-32">
  <div class="section-inner">
    <div class="grid lg:grid-cols-12 gap-10 items-end mb-10">
      <div class="lg:col-span-7" data-reveal="left">
        <span class="eyebrow">{{ __('messages.video_eyebrow') }}</span>
        <h2 class="display-2 mt-2" data-reveal="title">{{ __('messages.video_title') }}</h2>
      </div>
      <p class="lead lg:col-span-5" data-reveal="right">{{ __('messages.video_blurb') }}</p>
    </div>
    <div class="video-showcase" data-reveal="scale" data-parallax="0.05">
      @if($embedSrc)
        <iframe
          src="{{ $embedSrc }}"
          title="{{ __('messages.video_title') }}"
          allow="autoplay; encrypted-media; picture-in-picture"
          allowfullscreen
          loading="lazy"
        ></iframe>
      @elseif($videoSrc)
        <video autoplay muted loop playsinline poster="{{ $videoPoster }}">
          <source src="{{ $videoSrc }}" type="video/mp4">
        </video>
      @else
        <img src="{{ $videoPoster }}" alt="{{ __('messages.video_title') }}" class="video-showcase-fallback" loading="lazy"/>
      @endif
      <div class="video-overlay">
        <div class="flex items-center gap-2">
          <span class="inline-block w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
          <span class="label-mono text-white">{{ $about?->video['badge'] ?? 'FACTORY TOUR' }}</span>
        </div>
        <div>
          <div class="serif-italic text-white" style="font-size:18px">{{ $about?->video['caption'] ?? 'made in damietta' }}</div>
          <div class="display-3 text-white mt-1">{{ __('messages.video_headline') }}</div>
          <div class="flex flex-wrap gap-3 mt-6">
            <a href="#contact" class="btn btn-primary">
              {{ __('messages.video_cta') }} <i data-lucide="arrow-left" class="w-4 h-4"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
