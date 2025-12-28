<x-layout>
    <x-slot:title>Kategori {{ $category->name }} - FokusToday</x-slot:title>
    
    <div class="-mt-4">

        <h2 class="text-lg font-bold mb-4">{{ $category->name }}</h2>

        @if($heroArticle)
            <a href="{{ route('articles.show', $heroArticle->slug) }}">
                <img src="{{ $heroArticle->thumbnail_url }}"
                    class="w-full h-[200px] md:h-[500px] object-cover mb-4 rounded hover:opacity-90 transition">
            </a>

            <div class="mb-6 text-black md:text-black md:py-2 ">
                <a href="{{ route('articles.show', $heroArticle->slug) }}">
                    <h3 class="font-semibold text-base md:text-lg hover:text-blue-600 transition">
                        {{ $heroArticle->title }}
                    </h3>
                </a>
                @php
                    $firstTextBlock = $heroArticle->blocks->firstWhere('type', 'text');
                @endphp
                @if ($firstTextBlock)
                    <p class="text-sm text-gray-700 mb-2">
                        {{ Str::limit(strip_tags($firstTextBlock->content), 200, '...') }}
                    </p>
                @else
                    <p class="text-sm text-gray-500 mb-2">Tidak ada ringkasan.</p>
                @endif
            </div>
        @else
            <p class="text-gray-500 mb-6">Belum ada artikel.</p>
        @endif

        @if($gridArticles->count() > 0)
        <div class="hidden md:grid grid-cols-2 gap-4 mb-10">
            @foreach($gridArticles as $article)
            <div>
                <a href="{{ route('articles.show', $article->slug) }}">
                    <img src="{{ $article->thumbnail_url }}"
                        class="h-[350px] w-full object-cover mb-2 rounded hover:opacity-90 transition">
                </a>
                <div class="flex flex-col py-2">
                    <a href="{{ route('articles.show', $article->slug) }}" class="font-semibold text-black text-sm hover:text-blue-600 line-clamp-2 mb-1">
                        {{ $article->title }}
                    </a>
                    @php
                        $firstTextBlock = $article->blocks->firstWhere('type', 'text');
                    @endphp
                    @if ($firstTextBlock)
                        <p class="text-sm text-gray-700 mb-2">
                            {{ Str::limit(strip_tags($firstTextBlock->content), 200, '...') }}
                        </p>
                    @else
                        <p class="text-sm text-gray-500 mb-2">Tidak ada ringkasan.</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <div class="flex flex-col gap-4">
            @foreach($listArticles as $article)
            <div class="flex gap-3 md:gap-4">
                <a href="{{ route('articles.show', $article->slug) }}" class="flex-shrink-0">
                    <img src="{{ $article->thumbnail_url }}"
                        class="w-[100px] h-[100px] md:w-[200px] md:h-[200px] object-cover rounded hover:opacity-90 transition">
                </a>

                <div class="flex-1 flex flex-col justify-center">
                    <div class="mb-1 md:mb-2 px-2 md:px-4">
                        <a href="{{ route('articles.show', $article->slug) }}" class="text-xs md:text-sm font-semibold text-black hover:text-blue-600 line-clamp-2">
                            {{ $article->title }}
                        </a>
                    </div>

                    <div class="px-2 md:py-4">
                        @php
                            $firstTextBlock = $article->blocks->firstWhere('type', 'text');
                        @endphp
                        @if ($firstTextBlock)
                            <p class="text-sm text-gray-700 mb-2">
                                {{ Str::limit(strip_tags($firstTextBlock->content), 100, '...') }}
                            </p>
                        @else
                            <p class="text-sm text-gray-500 mb-2">Tidak ada ringkasan.</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</x-layout>