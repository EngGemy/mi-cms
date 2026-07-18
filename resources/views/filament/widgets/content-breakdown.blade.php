<x-filament-widgets::widget>
    <div class="fi-wi-widget overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5">
        <div class="border-b border-gray-100 px-5 py-4">
            <h3 class="text-base font-bold text-gray-950">محتوى الموقع</h3>
            <p class="mt-0.5 text-xs text-gray-500">حالة الأقسام المنشورة مقابل الإجمالي</p>
        </div>

        <div class="grid grid-cols-1 gap-px bg-gray-100 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($items as $item)
                <a
                    href="{{ $item['route'] }}"
                    class="group flex items-center gap-3 bg-white px-4 py-3.5 transition hover:bg-primary-50/50"
                >
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-primary-50 text-primary-600 ring-1 ring-primary-100">
                        @svg($item['icon'], 'h-4 w-4')
                    </div>

                    <div class="flex flex-1 items-center justify-between gap-3">
                        <span class="text-sm font-semibold text-gray-800 group-hover:text-primary-700">
                            {{ $item['label'] }}
                        </span>

                        <div class="flex items-center gap-2">
                            @if ($item['active'] !== null && $item['active'] !== $item['count'])
                                <span class="text-xs text-gray-400">
                                    <span class="font-bold text-success-600">{{ $item['active'] }}</span>
                                    / {{ $item['count'] }}
                                </span>
                            @else
                                <span class="text-xs font-bold text-gray-700">
                                    {{ $item['count'] }}
                                </span>
                            @endif

                            @svg('heroicon-m-chevron-left', 'h-4 w-4 text-gray-300 group-hover:text-primary-500')
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-filament-widgets::widget>
