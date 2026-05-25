<section class="hero" id="home">
  <div class="hero-inner">
    <div>
      <div class="serif-italic mb-3" data-hero-fade style="font-size:18px;color:var(--ink-700)">
        {{ __('messages.hero_kicker') }}
      </div>

      <h1 class="display-1" data-hero-headline>
        <span class="char-reveal"><span class="char-line">{{ __('messages.hero_main_line') }}</span></span>
      </h1>

      <div class="display-1 mt-1" data-hero-headline>
        <div class="rotating-word" id="rotWord">
          @forelse($slides as $i => $slide)
            <span class="rw-item @if($loop->first)is-active @endif">{{ $slide->label }}</span>
          @empty
            <span class="rw-item is-active">{{ __('messages.hero_default_label') }}</span>
          @endforelse
        </div>
      </div>

      <p class="lead mt-7 max-w-xl" data-hero-fade>{{ __('messages.hero_paragraph') }}</p>

      <div class="flex flex-wrap gap-3 mt-8" data-hero-fade>
        <a href="#products" class="btn btn-primary btn-lg" data-magnetic>
          {{ __('messages.hero_cta_primary') }} <i data-lucide="arrow-left" class="w-4 h-4"></i>
        </a>
        <a href="tel:{{ config('mi.phone_primary') }}" class="btn btn-ghost btn-lg" data-magnetic>
          <i data-lucide="phone" class="w-4 h-4"></i>
          <span dir="ltr" class="font-mono">{{ config('mi.phone_primary') }}</span>
        </a>
      </div>

      <div class="hero-stats" data-hero-fade>
        <div><div class="hero-stat-num">+<span data-counter data-target="500">0</span></div>
             <div class="hero-stat-label">{{ __('messages.stat_houses') }}</div></div>
        <div><div class="hero-stat-num"><span data-counter data-target="12">0</span>M+</div>
             <div class="hero-stat-label">{{ __('messages.stat_birds') }}</div></div>
        <div><div class="hero-stat-num"><span data-counter data-target="15">0</span>+</div>
             <div class="hero-stat-label">{{ __('messages.stat_years') }}</div></div>
        <div><div class="hero-stat-num">8</div>
             <div class="hero-stat-label">{{ __('messages.stat_countries') }}</div></div>
      </div>
    </div>

    <div class="relative" data-hero-visual>
      <div class="hero-tag t1" data-hero-tag>
        <div class="flex items-center gap-2">
          <span class="inline-block w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
          <span class="serif-italic" style="font-size:15px;color:var(--ink-900)">live · damietta</span>
        </div>
        <div class="text-[10px] mt-1 font-mono" style="color:var(--ink-500);letter-spacing:.14em">FACTORY · ONLINE</div>
      </div>
      <div class="hero-tag t2" data-hero-tag>
        <div class="flex items-center gap-1" style="color:#D4A968">
          @for($i=0;$i<5;$i++)<i data-lucide="star" class="w-3.5 h-3.5 fill-current"></i>@endfor
          <span class="serif-italic mr-1" style="font-size:15px;color:var(--ink-900)">4.9</span>
        </div>
        <div class="text-[10px] mt-1 font-mono" style="color:var(--ink-500);letter-spacing:.14em">500+ CLIENTS · 8 COUNTRIES</div>
      </div>
      <div class="hero-visual">
        <div class="hero-image-stack">
          @forelse($slides as $i => $slide)
            <div class="hero-image-layer @if($loop->first) is-active @endif"
                 data-img="{{ $i }}"
                 style="background-image:url('{{ $slide->getImageUrl() }}')"></div>
          @empty
            <div class="hero-image-layer is-active"
                 style="background-image:url('https://images.unsplash.com/photo-1569466593977-94ee7ed02ec9?w=1400&q=85&auto=format&fit=crop')"></div>
          @endforelse
        </div>
        @foreach($slides as $i => $slide)
          <div class="hero-layer-label @if($loop->first) is-active @endif" data-img="{{ $i }}">{{ $slide->label }}</div>
        @endforeach
      </div>
    </div>
  </div>
</section>
