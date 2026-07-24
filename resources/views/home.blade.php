<x-layouts.public :seo="$seo ?? []">
@include('sections.hero', ['slides' => $heroSlides])
@include('sections.calc-gateway')
@include('sections.products', ['products' => $featuredProducts])
@include('sections.features', ['features' => $features])
@include('sections.projects', ['projects' => $projects])
@include('sections.calculator')
@include('sections.home-cta')
</x-layouts.public>
