@props(['items'])

<nav class="text-sm text-gray-500" aria-label="Breadcrumb">
    <ol class="flex items-center">
        <li></li>
        @foreach ($items as $item)
            <li class="flex items-center">
                @if (!$loop->last)
                    @if ($item['url'] === '/dashboard')
                        <a href="{{ $item['url'] }}" class="hover:text-blue-600 font-medium flex items-center gap-1">
                            <x-ri-home-2-line class="w-4 h-4" />
                            {{ $item['label'] }}
                        </a>
                        <span class="ml-1.5">/</span>
                    @else
                        <a href="{{ $item['url'] }}" class="hover:text-blue-600 font-medium ml-1.5">
                            {{ $item['label'] }}
                        </a>
                        <span class="ml-1.5">/</span>
                    @endif
                @else
                    @if ($item['url'] === '/dashboard')
                        <span class="flex items-center gap-1 text-gray-800 font-semibold">
                            <x-ri-home-2-line class="w-4 h-4" />
                            {{ $item['label'] }}
                        </span>
                    @else
                        <span class="text-gray-800 font-semibold ml-1.5">
                            {{ $item['label'] }}
                        </span>
                    @endif
                @endif
            </li>
        @endforeach
    </ol>
</nav>
