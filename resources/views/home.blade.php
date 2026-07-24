<x-layouts.public :seo="$seo ?? []">
{{-- Hero → Calculator (priority) → Proof → Story → Systems → Projects → Contact --}}
@include('sections.hero', ['slides' => $heroSlides])
@include('sections.calc-gateway')
@include('sections.home-proof')
@include('sections.home-story')
@include('sections.home-systems', ['products' => $featuredProducts])
@include('sections.projects', ['projects' => $projects])
@include('sections.home-cta')
</x-layouts.public>
