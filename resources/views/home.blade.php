<x-layouts.public :seo="$seo ?? []">
{{-- Homepage narrative (UX): Hero → Proof → Story → Systems → Projects → Calc → Contact --}}
@include('sections.hero', ['slides' => $heroSlides])
@include('sections.home-proof')
@include('sections.home-story')
@include('sections.home-systems', ['products' => $featuredProducts])
@include('sections.projects', ['projects' => $projects])
@include('sections.calc-gateway')
@include('sections.home-cta')
</x-layouts.public>
