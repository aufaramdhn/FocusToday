@props([
    'action' => '#',
    'data' => [],
    'paginator' => null,
    'showRole' => false,
])

<div class="bg-white rounded-lg shadow-md w-full overflow-hidden">

    <x-filter-bar :action="$action" :showRole="$showRole" :showSearch="true" :showDate="true" :showSort="true">
        @if (isset($filters))
            {{ $filters }}
        @endif
    </x-filter-bar>

    @if ($data->isEmpty())
        <div class="flex flex-col items-center justify-center py-12 text-gray-500">
            <svg class="w-12 h-12 mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p>Data not found.</p>
        </div>
    @else
        {{ $slot }}
    @endif

    @if (!$data->isEmpty() && $paginator)
        <div class="border-t border-gray-100">
            <x-pagination :paginator="$paginator" />
        </div>
    @endif
</div>
