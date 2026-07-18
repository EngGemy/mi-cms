<x-filament-widgets::widget>
    <div class="fi-wi-widget overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5">
        <div class="flex items-center justify-between border-b border-gray-100 px-5 py-4">
            <div>
                <h3 class="text-base font-bold text-gray-950">إجراءات سريعة</h3>
                <p class="mt-0.5 text-xs text-gray-500">اختصارات للمهام الأكثر تكراراً</p>
            </div>
            <a
                href="{{ url('/') }}"
                target="_blank"
                rel="noopener"
                class="inline-flex items-center gap-1.5 rounded-lg px-3 py-1.5 text-xs font-semibold text-primary-600 transition hover:bg-primary-50"
            >
                @svg('heroicon-m-arrow-top-right-on-square', 'h-3.5 w-3.5')
                عرض الموقع
            </a>
        </div>

        <div class="grid grid-cols-2 gap-px bg-gray-100 sm:grid-cols-3 lg:grid-cols-6">
            @foreach ($actions as $action)
                <a
                    href="{{ $action['url'] }}"
                    class="group relative flex flex-col gap-3 bg-white px-4 py-5 transition hover:bg-primary-50/60"
                >
                    <div class="flex items-start justify-between">
                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-primary-50 text-primary-600 ring-1 ring-primary-100 transition group-hover:bg-primary-600 group-hover:text-white group-hover:ring-primary-600">
                            @svg($action['icon'], 'h-4.5 w-4.5')
                        </div>
                        @if (! empty($action['badge']) && $action['badge'] > 0)
                            <span class="flex h-5 min-w-[1.25rem] items-center justify-center rounded-full bg-warning-500 px-1.5 text-[10px] font-bold text-white">
                                {{ $action['badge'] }}
                            </span>
                        @endif
                    </div>
                    <div>
                        <div class="text-sm font-semibold text-gray-900 group-hover:text-primary-700">
                            {{ $action['label'] }}
                        </div>
                        @if (! empty($action['hint']))
                            <div class="mt-0.5 text-[11px] text-gray-400">
                                {{ $action['hint'] }}
                            </div>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-filament-widgets::widget>
