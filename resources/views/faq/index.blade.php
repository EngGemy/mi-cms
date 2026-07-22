<x-layouts.public :seo="$seo">
  @include('partials.breadcrumbs', ['items' => $breadcrumbs ?? []])

  <section class="page-hero">
    <div class="section-inner">
      <span class="eyebrow" data-reveal>{{ __('messages.faq_eyebrow') }}</span>
      <h1 class="display-2 mt-3" data-reveal="title">{{ __('messages.faq_page_title') }}</h1>
      <p class="lead mt-4" data-reveal>{{ __('messages.faq_page_blurb') }}</p>

      <form method="GET" action="{{ route('faq.index', app()->getLocale()) }}" class="listing-toolbar mt-8" data-reveal>
        @if($categories->isNotEmpty())
          <div class="listing-filters">
            <a href="{{ route('faq.index', array_filter([app()->getLocale(), 'q' => $searchQuery ?: null])) }}"
               class="pd-cat-btn {{ !$activeCategory ? 'is-active' : '' }}">{{ __('messages.filter_all') }}</a>
            @foreach($categories as $cat)
              <a href="{{ route('faq.index', array_filter([app()->getLocale(), 'category' => $cat, 'q' => $searchQuery ?: null])) }}"
                 class="pd-cat-btn {{ $activeCategory === $cat ? 'is-active' : '' }}">{{ $cat }}</a>
            @endforeach
          </div>
        @endif
        <div class="listing-search">
          <input type="search" name="q" value="{{ $searchQuery }}" placeholder="{{ __('messages.faq_search') }}" aria-label="{{ __('messages.faq_search') }}"/>
          @if($activeCategory)
            <input type="hidden" name="category" value="{{ $activeCategory }}"/>
          @endif
          <button type="submit" class="btn btn-dark btn-sm">{{ __('messages.search') }}</button>
        </div>
      </form>
    </div>
  </section>

  <section class="py-16 lg:py-24">
    <div class="section-inner max-w-3xl">
      @forelse($grouped as $group => $items)
        <div class="faq-group" data-reveal>
          <h2 class="faq-group-title">{{ $group }}</h2>
          @foreach($items as $faq)
            <div class="faq-item">
              <button type="button" class="faq-q" aria-expanded="false">
                <span>{{ $faq->question }}</span>
                <span class="faq-icon"><i data-lucide="plus" class="w-5 h-5"></i></span>
              </button>
              <div class="faq-a"><div class="faq-a-inner">{{ $faq->answer }}</div></div>
            </div>
          @endforeach
        </div>
      @empty
        <p class="lead" style="color:var(--ink-500)">{{ __('messages.faq_empty') }}</p>
      @endforelse
    </div>
  </section>

  <section class="page-bottom-cta" data-reveal>
    <div class="section-inner page-bottom-cta-inner">
      <h2 class="display-3">{{ __('messages.faq_cta_title') }}</h2>
      <p class="lead">{{ __('messages.faq_cta_blurb') }}</p>
      <a href="{{ route('home', app()->getLocale()) }}#contact" class="btn btn-primary">{{ __('messages.nav_contact') }}</a>
    </div>
  </section>
</x-layouts.public>
