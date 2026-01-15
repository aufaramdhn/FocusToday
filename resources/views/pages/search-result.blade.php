<x-layout-user title="Pencarian: {{ $keyword }}">

    <div class="mb-10 border-b border-gray-200 pb-8">
        <span class="text-gray-500 font-medium text-sm uppercase tracking-wider">Hasil Pencarian</span>

        <h1 class="text-2xl md:text-4xl font-bold text-gray-900 mt-2">
            "{{ $keyword }}"
        </h1>

        <p class="text-gray-600 mt-2">
            Ditemukan <span class="font-bold text-blue-600">{{ $articles->total() }}</span> artikel yang cocok.
        </p>
    </div>

    @if ($articles->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($articles as $article)
                <article
                    class="flex flex-col h-full bg-white border border-gray-100 rounded-lg shadow-sm hover:shadow-md transition overflow-hidden">

                    <a href="{{ route('articles.show', $article->slug) }}" class="block overflow-hidden h-48 group">
                        @if ($article->thumbnail)
                            <img src="{{ $article->thumbnail_url }}" alt="{{ $article->title }}"
                                class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">
                                <x-ri-image-line class="w-10 h-10" />
                            </div>
                        @endif
                    </a>

                    <div class="p-5 flex flex-col flex-1">
                        <div class="flex items-center gap-2 text-xs text-gray-500 mb-3">
                            <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded font-medium">
                                {{ $article->category->name }}
                            </span>
                            <span>•</span>
                            <span>{{ $article->created_at->format('d M Y') }}</span>
                        </div>

                        <h2 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2 hover:text-blue-600 transition">
                            <a href="{{ route('articles.show', $article->slug) }}">
                                {{ $article->title }}
                            </a>
                        </h2>

                        <div class="flex flex-wrap mb-3">
                            @foreach ($article->tags as $tag)
                                <span
                                    class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full mr-1 mb-2">
                                    #{{ $tag->name }}
                                </span>
                            @endforeach
                        </div>

                        <p class="text-gray-600 text-sm line-clamp-3 mb-4 flex-1">
                            {{ Str::limit(strip_tags($article->blocks->first()->content), 120) }}
                        </p>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-10 ">
            {{ $articles->links() }}
        </div>
    @else
        <div class="flex flex-col items-center justify-center py-20 text-center">
            <div class="bg-gray-100 p-6 rounded-full mb-4">
                <x-ri-search-eye-line class="w-12 h-12 text-gray-400" />
            </div>
            <h3 class="text-xl font-bold text-gray-900">Tidak ditemukan</h3>
            <p class="text-gray-500 max-w-md mt-2">
                Kami tidak dapat menemukan artikel dengan kata kunci <span
                    class="font-semibold text-gray-800">"{{ $keyword }}"</span>.
            </p>

            <div class="mt-8">
                <p class="text-sm text-gray-400 mb-4">Coba cari dengan kata kunci lain:</p>
                <form action="{{ route('home.search') }}" method="GET" class="flex gap-2 justify-center">
                    <input type="text" name="search"
                        class="border border-gray-300 rounded-md px-4 py-2 w-64 focus:outline-none focus:ring-1 focus:ring-blue-500"
                        placeholder="Ketik sesuatu...">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Cari</button>
                </form>
            </div>
        </div>
    @endif

</x-layout-user>
