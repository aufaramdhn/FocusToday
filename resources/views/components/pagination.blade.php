@props(['paginator'])

<div
    class="border-gray-300 border-t flex justify-between items-center px-6 py-4 text-sm flex-col md:flex-row gap-4 md:gap-0">

    <div class="">
        <p class="">
            Showing
            <span class="font-bold">{{ $paginator->firstItem() }}</span>
            to
            <span class="font-bold">{{ $paginator->lastItem() }}</span>
            of
            <span class="font-bold">{{ $paginator->total() }}</span>
            results
        </p>
    </div>

    <div class="">
        @if ($paginator->hasPages())
            <nav>
                <ul class="inline-flex flex-wrap items-center gap-2">

                    <li>
                        @if ($paginator->onFirstPage())
                            <button disabled
                                class="px-3 py-1 bg-gray-200 text-gray-400 rounded-md cursor-not-allowed">Previous</button>
                        @else
                            <a href="{{ $paginator->previousPageUrl() }}"
                                class="px-3 py-1 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition duration-300 cursor-pointer">Previous</a>
                        @endif
                    </li>

                    @foreach (range(1, $paginator->lastPage()) as $page)
                        @if (
                            $page == 1 ||
                                $page == $paginator->lastPage() ||
                                ($page >= $paginator->currentPage() - 1 && $page <= $paginator->currentPage() + 1))
                            <li>
                                @if ($page == $paginator->currentPage())
                                    <span class="px-3 py-1 bg-blue-500 text-white rounded-md">{{ $page }}</span>
                                @else
                                    <a href="{{ $paginator->url($page) }}"
                                        class="px-3 py-1 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition duration-300 cursor-pointer">{{ $page }}</a>
                                @endif
                            </li>
                        @elseif ($page == $paginator->currentPage() - 2 || $page == $paginator->currentPage() + 2)
                            <li>
                                <span class="px-3 py-1 text-gray-500">...</span>
                            </li>
                        @endif
                    @endforeach

                    <li>
                        @if ($paginator->hasMorePages())
                            <a href="{{ $paginator->nextPageUrl() }}"
                                class="px-3 py-1 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition duration-300 cursor-pointer">Next</a>
                        @else
                            <button disabled
                                class="px-3 py-1 bg-gray-200 text-gray-400 rounded-md cursor-not-allowed">Next</button>
                        @endif
                    </li>

                </ul>
            </nav>
        @endif
    </div>
</div>
