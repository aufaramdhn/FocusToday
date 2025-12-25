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
        </div>

</x-layout-admin>
