@if(!empty($items))
  @php
    $jsonLd = [
      '@context' => 'https://schema.org',
      '@type' => 'BreadcrumbList',
      'itemListElement' => collect($items)->values()->map(fn ($item, $i) => [
        '@type' => 'ListItem',
        'position' => $i + 1,
        'name' => $item['name'],
        'item' => $item['url'] ?? url()->current(),
      ])->all(),
    ];
  @endphp
  <nav class="mi-breadcrumbs" aria-label="breadcrumb">
    <div class="section-inner">
      <ol class="mi-breadcrumbs-list">
        @foreach($items as $i => $item)
          <li>
            @if(!$loop->last && !empty($item['url']))
              <a href="{{ $item['url'] }}">{{ $item['name'] }}</a>
            @else
              <span aria-current="page">{{ $item['name'] }}</span>
            @endif
          </li>
        @endforeach
      </ol>
    </div>
  </nav>
  <script type="application/ld+json">{!! json_encode($jsonLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endif
