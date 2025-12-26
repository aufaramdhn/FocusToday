<x-layout-admin>
    <x-slot:title>
        Admin Tambah artikel
    </x-slot:title>

    <div class="">
        <h1 class="text-3xl font-bold mb-3">Add Article</h1>

        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => '/dashboard'],
            ['label' => 'Articles', 'url' => '/dashboard/artikel'],
            ['label' => 'Detail Article', 'url' => '/dashboard/artikel/' . $article->slug],
        ]" />

        <div class="bg-white rounded-lg shadow-md w-full p-6 mt-6">
            <h2 class="text-2xl font-semibold mb-2">{{ $article->title }}</h2>
            <p class="text-gray-600 mb-4">By: {{ $article->author->name }} | Category: {{ $article->category->name }} |
                Published at: {{ $article->created_at->format('d M Y - H:i') }}</p>
            @foreach ($article->tags as $tag)
                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-md inline-block mb-4">
                    {{ $tag->name }}</span>
            @endforeach
            <img class="rounded-md shadow-xs w-[65%] object-cover mx-auto mb-4"
                src="{{ $article->thumbnail ? asset('storage/' . $article->thumbnail) : 'https://via.placeholder.com/400x200?text=No+Image' }}"
                alt="Article Image" />
            <div class="prose max-w-none text-gray-800 leading-relaxed">
                @foreach ($article->blocks as $block)
                    @if ($block->type === 'text')
                        <div class="mb-4">
                            {!! $block->content !!}
                        </div>
                    @elseif ($block->type === 'image' && $block->media_path)
                        <figure class="my-8">
                            <img src="{{ asset('storage/' . $block->media_path) }}"
                                class="w-[40%] h-auto rounded-lg shadow-sm mx-auto" alt="Gambar Pendukung">
                        </figure>
                    @endif
                @endforeach
            </div>
            <div class="border-t border-gray-200 pt-8 mt-4">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Komentar</h3>

                <div class="bg-gray-50 p-4 rounded-lg mb-6">
                    <textarea
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                        rows="3" placeholder="Tulis Komentar"></textarea>
                    <div class="flex justify-end mt-3">
                        <button
                            class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                            Kirim
                        </button>
                    </div>
                </div>

                <div class="flex gap-2 mb-6 flex-wrap">
                    <button class="px-4 py-2 bg-blue-600 text-white rounded-full text-sm font-medium">
                        Terbaru
                    </button>
                    <button
                        class="px-4 py-2 bg-white text-gray-700 border border-gray-300 rounded-full text-sm font-medium hover:bg-gray-50">
                        Terpilih
                    </button>
                    <button
                        class="px-4 py-2 bg-white text-gray-700 border border-gray-300 rounded-full text-sm font-medium hover:bg-gray-50">
                        Terpopuler
                    </button>
                </div>
                <div class="text-center py-12">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-200 rounded-full mb-4">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-700 mb-2">Belum ada komentar</h4>
                    <p class="text-sm text-gray-500">Jadilah yang pertama berkomentar di sini</p>
                </div>
            </div>
        </div>
</x-layout-admin>
