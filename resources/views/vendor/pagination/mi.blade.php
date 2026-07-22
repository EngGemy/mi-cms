@if ($paginator->hasPages())
  @php
    $locale = app()->getLocale();
    $isRtl = $locale === 'ar';
  @endphp
  <nav class="mi-pagination" role="navigation" aria-label="{{ __('messages.pagination_label') }}">
    {{-- Mobile compact --}}
    <div class="mi-pagination-mobile">
      @if ($paginator->onFirstPage())
        <span class="mi-page-btn is-disabled" aria-disabled="true">
          <span aria-hidden="true">{{ $isRtl ? '›' : '‹' }}</span>
        </span>
      @else
        <a class="mi-page-btn" href="{{ $paginator->previousPageUrl() }}"
           wire:navigate.hover
           rel="prev"
           aria-label="{{ __('messages.pagination_prev') }}">
          <span aria-hidden="true">{{ $isRtl ? '›' : '‹' }}</span>
        </a>
      @endif

      <span class="mi-page-status" aria-current="page">
        {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}
      </span>

      @if ($paginator->hasMorePages())
        <a class="mi-page-btn" href="{{ $paginator->nextPageUrl() }}"
           wire:navigate.hover
           rel="next"
           aria-label="{{ __('messages.pagination_next') }}">
          <span aria-hidden="true">{{ $isRtl ? '‹' : '›' }}</span>
        </a>
      @else
        <span class="mi-page-btn is-disabled" aria-disabled="true">
          <span aria-hidden="true">{{ $isRtl ? '‹' : '›' }}</span>
        </span>
      @endif
    </div>

    {{-- Desktop full --}}
    <ul class="mi-pagination-desktop">
      <li>
        @if ($paginator->onFirstPage())
          <span class="mi-page-btn is-disabled">{{ __('messages.pagination_prev') }}</span>
        @else
          <a class="mi-page-btn" href="{{ $paginator->previousPageUrl() }}" wire:navigate.hover rel="prev">
            {{ __('messages.pagination_prev') }}
          </a>
        @endif
      </li>

      @foreach ($elements as $element)
        @if (is_string($element))
          <li><span class="mi-page-ellipsis">{{ $element }}</span></li>
        @endif

        @if (is_array($element))
          @foreach ($element as $page => $url)
            <li>
              @if ($page == $paginator->currentPage())
                <span class="mi-page-btn is-active" aria-current="page">{{ $page }}</span>
              @else
                <a class="mi-page-btn" href="{{ $url }}" wire:navigate.hover>{{ $page }}</a>
              @endif
            </li>
          @endforeach
        @endif
      @endforeach

      <li>
        @if ($paginator->hasMorePages())
          <a class="mi-page-btn" href="{{ $paginator->nextPageUrl() }}" wire:navigate.hover rel="next">
            {{ __('messages.pagination_next') }}
          </a>
        @else
          <span class="mi-page-btn is-disabled">{{ __('messages.pagination_next') }}</span>
        @endif
      </li>
    </ul>
  </nav>
@endif
