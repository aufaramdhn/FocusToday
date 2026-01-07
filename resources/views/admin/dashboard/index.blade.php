<x-layout-admin>
    <x-slot:title>
        Admin Dashboard
    </x-slot:title>

    <div class="">
        <div class="">

            <h1 class="text-3xl font-bold mb-3">Dashboard Statistics</h1>

            <x-breadcrumb :items="[['label' => 'Dashboard', 'url' => '/dashboard']]" />

            <div class="flex flex-wrap gap-6 justify-between mt-4">
                <div class="bg-white p-6 rounded-lg shadow-md md:w-72 flex items-center gap-4 w-full">
                    <div class="w-14 h-14 mb-4 text-white bg-gray-400 p-2 rounded-full">
                        <x-ri-file-list-3-line />
                    </div>
                    <div class="">
                        <h2 class="text-xl font-semibold mb-4">Total Articles</h2>
                        <p class="text-3xl font-bold">{{ $totalArticles }}</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md md:w-72 flex items-center gap-4 w-full">
                    <div class="w-14 h-14 mb-4 text-white bg-gray-400 p-2 rounded-full">
                        <x-ri-eye-line />
                    </div>
                    <div class="">
                        <h2 class="text-xl font-semibold mb-4">Total Views</h2>
                        <p class="text-3xl font-bold">{{ $totalViews }}</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md md:w-72 flex items-center gap-4 w-full">
                    <div class="w-14 h-14 mb-4 text-white bg-gray-400 p-2 rounded-full">
                        <x-ri-user-line />
                    </div>
                    <div class="">
                        <h2 class="text-xl font-semibold mb-4">Total Users</h2>
                        <p class="text-3xl font-bold">{{ $totalUsers }}</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md md:w-72 flex items-center gap-4 w-full">
                    <div class="w-14 h-14 mb-4 text-white bg-gray-400 p-2 rounded-full">
                        <x-ri-question-answer-line />
                    </div>
                    <div class="">
                        <h2 class="text-xl font-semibold mb-4">Total Comment</h2>
                        <p class="text-3xl font-bold">{{ $totalComments }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-8">
            <h1 class="text-3xl font-bold mb-6">Popular News</h1>
            <div class="grid lg:grid-cols-2 gap-6 p-4 bg-white rounded-lg shadow-md">
                @foreach ($popularArticles as $article)
                    <a href="{{ route('admin.artikel.show', $article->slug) }}"
                        class="group block mb-6 lg:mb-0 transition-all duration-300 hover:bg-gray-50 p-2 rounded-xl">

                        <div class="overflow-hidden rounded-xl bg-gray-200 aspect-video">
                            <img src="{{ $article->thumbnail }}" alt="{{ $article->title }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        </div>

                        <div class="mt-4">
                            <h2 class="font-bold text-xl transition-colors duration-300 group-hover:text-blue-600">
                                {{ $article->title }}
                            </h2>

                            <p class="text-gray-700 mt-2 text-sm line-clamp-3 leading-relaxed">
                                {{ Str::limit(strip_tags($article->blocks->pluck('content')->join(' ')), 150, '...') }}
                            </p>

                            <div
                                class="mt-3 flex items-center text-blue-600 text-xs font-bold opacity-0 -translate-x-2 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0">
                                Baca Selengkapnya
                                <x-ri-arrow-right-line class="ml-1 w-4 h-4" />
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-layout-admin>
