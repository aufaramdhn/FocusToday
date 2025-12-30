<x-layout-admin>
    <x-slot:title>
        Admin Dashboard
    </x-slot:title>

    <div class="">
        <div class="">

            <h1 class="text-3xl font-bold mb-3">Dashboard Statistics</h1>

            <x-breadcrumb :items="[['label' => 'Dashboard', 'url' => '/dashboard']]" />

            <div class="flex flex-wrap gap-6 justify-between mt-4">
                <div class="bg-white p-6 rounded-lg shadow-md w-72 flex items-center gap-4">
                    <div class="w-14 h-14 mb-4 text-white bg-gray-400 p-2 rounded-full">
                        <x-ri-file-list-3-line />
                    </div>
                    <div class="">
                        <h2 class="text-xl font-semibold mb-4">Total Articles</h2>
                        <p class="text-3xl font-bold">{{ $totalArticles }}</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md w-72 flex items-center gap-4">
                    <div class="w-14 h-14 mb-4 text-white bg-gray-400 p-2 rounded-full">
                        <x-ri-eye-line />
                    </div>
                    <div class="">
                        <h2 class="text-xl font-semibold mb-4">Total Views</h2>
                        <p class="text-3xl font-bold">{{ $totalViews }}</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md w-72 flex items-center gap-4">
                    <div class="w-14 h-14 mb-4 text-white bg-gray-400 p-2 rounded-full">
                        <x-ri-user-line />
                    </div>
                    <div class="">
                        <h2 class="text-xl font-semibold mb-4">Total Users</h2>
                        <p class="text-3xl font-bold">{{ $totalUsers }}</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md w-72 flex items-center gap-4">
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

            <div class="grid lg:grid-cols-2 gap-3 p-4 bg-white rounded-lg shadow-md">
                @foreach ($popularArticles as $article)
                    <div class="mb-6 lg:mb-0">
                        <div class="">
                            <img src="{{ $article->thumbnail }}" alt="{{ $article->title }}">
                        </div>
                        <div class="mt-2">
                            <h2 class="font-bold text-xl">{{ $article->title }}</h2>
                            <p class="text-gray-700 line-clamp-3">
                                {{ Str::limit(strip_tags($article->blocks->pluck('content')->join(' ')), 150, '...') }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layout-admin>
