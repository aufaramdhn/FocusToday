<x-layout-user>
    <x-slot:title>Home - FokusToday</x-slot:title>
    <div class="px-4 lg:px-0">
        <div class="grid grid-cols-1 lg:grid-cols-[2fr_1fr] gap-6">
            <div class="flex flex-col gap-6">
                @if ($heroArticle)
                    <div>
                        <a href="{{ route('articles.show', $heroArticle->slug) }}">
                            <img src="{{ $heroArticle->thumbnail_url }}" alt="{{ $heroArticle->title }}"
                                class="w-full h-[620px] object-cover rounded hover:opacity-90 transition">
                        </a>
                        <div class="mt-4">
                            <a href="{{ route('articles.show', $heroArticle->slug) }}">
                                <h1 class="font-semibold text-lg hover:text-blue-600 transition">
                                    {{ $heroArticle->title }}
                                </h1>
                            </a>
                            <p class="text-sm mt-1 text-gray-600">
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
                                <span class="text-gray-500 text-xs block mt-1">
                                    {{ $heroArticle->published_at->diffForHumans() }}
                                </span>
                            </p>
                        </div>
                    </div>
                @endif

                <div>
                    <h3 class="mb-3 font-bold text-lg">Latest</h3>
                    <div>
                        <div class="hidden lg:flex flex-col gap-3">
                            @foreach ($latestArticles->take(3) as $article)
                                <div class="flex gap-3">
                                    <img src="{{ $article->thumbnail_url }}" alt="{{ $article->title }}"
                                        class="h-[140px] w-[240px] object-cover rounded flex-shrink-0">
                                    <div>
                                        <a href="{{ route('articles.show', $article->slug) }}">
                                            <h4 class="font-semibold text-sm hover:text-blue-600 leading-snug">
                                                {{ $article->title }}
                                            </h4>
                                        </a>
                                        @php
                                            $firstTextBlock = $heroArticle->blocks->firstWhere('type', 'text');
                                        @endphp
                                        @if ($firstTextBlock)
                                            <p class="text-sm text-gray-700 mb-2">
                                                {{ Str::limit(strip_tags($firstTextBlock->content), 300, '...') }}
                                            </p>
                                        @else
                                            <p class="text-sm text-gray-500 mb-2">Tidak ada ringkasan.</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="mb-3 font-bold text-lg">Populer</h3>
                    <div>
                        <div class="hidden lg:flex flex-col gap-3">
                            @foreach ($popularArticles->take(3) as $article)
                                <div class="flex gap-3">
                                    <img src="{{ $article->thumbnail_url }}" alt="{{ $article->title }}"
                                        class="h-[140px] w-[240px] object-cover rounded flex-shrink-0">
                                    <div>
                                        <a href="{{ route('articles.show', $article->slug) }}">
                                            <h4 class="font-semibold text-sm hover:text-blue-600 leading-snug">
                                                {{ $article->title }}
                                            </h4>
                                        </a>
                                        @php
                                            $firstTextBlock = $heroArticle->blocks->firstWhere('type', 'text');
                                        @endphp
                                        @if ($firstTextBlock)
                                            <p class="text-sm text-gray-700 mb-2">
                                                {{ Str::limit(strip_tags($firstTextBlock->content), 300, '...') }}
                                            </p>
                                        @else
                                            <p class="text-sm text-gray-500 mb-2">Tidak ada ringkasan.</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="hidden lg:flex flex-col gap-6">

                <div class="flex flex-col gap-3">

                    @if ($readMoreHero = $latestArticles->skip(3)->first())
                        <div class="mb-2">
                            <a href="{{ route('articles.show', $readMoreHero->slug) }}">
                                <img src="{{ $readMoreHero->thumbnail_url }}" alt="{{ $readMoreHero->title }}"
                                    class="h-[270px] w-full object-cover rounded hover:opacity-90 transition">
                            </a>
                            <div class="mt-2">
                                <h4 class="font-semibold text-sm">Read More</h4>
                                <a href="{{ route('articles.show', $readMoreHero->slug) }}">
                                    <p class="text-xs text-gray-600 hover:text-blue-600 transition">
                                        {{ Str::limit($readMoreHero->title, 100) }}
                                    </p>
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="grid grid-cols-2 gap-3">
                        @foreach ($sidebarCategories as $category)
                            @php
                                $article = $category->articles->first();
                            @endphp

                            @if ($article)
                                <div class="flex flex-col gap-2">
                                    <a href="{{ route('articles.show', $article->slug) }}">
                                        <img src="{{ $article->thumbnail_url }}" alt="{{ $article->title }}"
                                            class="h-[140px] w-full object-cover rounded hover:opacity-90 transition">
                                    </a>
                                    <div class="">
                                        <h4 class="text-sm font-semibold mt-1">
                                            <a href="{{ route('categories.show', $category->slug) }}"
                                                class="hover:text-blue-600">
                                                {{ $category->name }}
                                            </a>
                                        </h4>

                                        <a href="{{ route('articles.show', $article->slug) }}">
                                            <p class="text-xs text-gray-500 hover:text-blue-600 line-clamp-2">
                                                {{ $article->title }}
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>


                <div>
                    <h3 class="mb-3 font-bold text-lg">Watch</h3>

                    @if ($mainVideo)
                        @php
                            $videoId = data_get($mainVideo, 'id.videoId');
                            $title = data_get($mainVideo, 'snippet.title');
                            $thumb =
                                data_get($mainVideo, 'snippet.thumbnails.maxres.url') ??
                                (data_get($mainVideo, 'snippet.thumbnails.high.url') ??
                                    data_get($mainVideo, 'snippet.thumbnails.medium.url'));
                        @endphp
                        <a href="https://www.youtube.com/watch?v={{ $videoId }}" target="_blank"
                            class="group block">
                            <div class="relative">
                                <img src="{{ $thumb ?? 'https://via.placeholder.com/640x360?text=No+Thumbnail' }}"
                                    class="h-[260px] w-full object-cover rounded mb-2 group-hover:opacity-90 transition"
                                    alt="{{ $title }}">

                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="bg-black/50 rounded-full p-2 hover:text-blue-600/80 transition">
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8 5v14l11-7z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <h4 class="font-semibold text-sm hover:text-blue-600 transition">
                                    {!! $title !!}
                                </h4>
                                <p class="text-xs text-gray-500">Latest Update</p>
                            </div>
                        </a>
                    @else
                        <p class="text-xs text-gray-500">Video tidak tersedia.</p>
                    @endif

                    <div class="flex flex-col gap-3 mt-4">
                        @foreach ($sideVideos as $video)
                            @php
                                $sideId = data_get($video, 'id.videoId');
                                $sideTitle = data_get($video, 'snippet.title');
                                $sideThumb =
                                    data_get($video, 'snippet.thumbnails.medium.url') ??
                                    data_get($video, 'snippet.thumbnails.default.url');
                            @endphp

                            <a href="https://www.youtube.com/watch?v={{ $sideId }}" target="_blank"
                                class="flex gap-3 group">

                                <div class="w-[230px] flex-shrink-0 relative">
                                    <img src="{{ $sideThumb ?? 'https://via.placeholder.com/120x90' }}"
                                        class="h-[130px] w-full object-cover rounded group-hover:opacity-90 transition">

                                    <div
                                        class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                        <div class="bg-black/50 rounded-full p-1">
                                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8 5v14l11-7z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex flex-col justify-center">
                                    <h4
                                        class="font-semibold text-sm line-clamp-2 leading-snug group-hover:text-blue-600 transition">
                                        {!! $sideTitle !!}
                                    </h4>
                                    <p class="text-xs text-gray-500 mt-1">YouTube</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-6 grid grid-cols-1 lg:grid-cols-4 gap-4">

            @forelse($bottomCategories as $category)
                <div>
                    <h4 class="font-semibold mb-2">
                        <a href="{{ route('categories.show', $category->slug) }}" class="hover:text-blue-600">
                            {{ $category->name }}
                        </a>
                    </h4>

                    <div class="flex flex-col gap-3 lg:hidden">
                        @foreach ($category->articles->take(2) as $article)
                            <div class="h-[140px]">
                                <a href="{{ route('articles.show', $article->slug) }}">
                                    <h4 class="font-semibold text-sm line-clamp-2">{{ $article->title }}</h4>
                                    <p class="text-xs text-gray-500">{{ $article->published_at->diffForHumans() }}</p>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <div class="hidden lg:block space-y-3">
                        @foreach ($category->articles->take(4) as $article)
                            <a href="{{ route('articles.show', $article->slug) }}" class="block group">
                                {{-- Thumbnail --}}
                                <img src="{{ $article->thumbnail_url }}" alt="{{ $article->title }}"
                                    class="h-[180px] w-full object-cover rounded mb-2 group-hover:opacity-90 transition">

                                <h4 class="font-semibold text-sm group-hover:text-blue-600 line-clamp-2">
                                    {{ $article->title }}
                                </h4>
                            </a>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center text-gray-400 py-10">
                    <p>Belum ada kategori dengan artikel yang cukup untuk ditampilkan.</p>
                </div>
            @endforelse

        </div>
    </div>
</x-layout-user>
