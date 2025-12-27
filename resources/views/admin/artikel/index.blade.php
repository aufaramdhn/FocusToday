<x-layout-admin>
    <x-slot:title>
        Admin Artikel
    </x-slot:title>

    <div class="">
        <div class="flex justify-between items-center mb-6">
            <div class="">
                <h1 class="text-3xl font-bold mb-3">Articles List</h1>
                <x-breadcrumb :items="[
                    ['label' => 'Dashboard', 'url' => '/dashboard'],
                    ['label' => 'Articles', 'url' => '/dashboard/artikel'],
                ]" />
            </div>
            <a href="/dashboard/artikel/tambah"
                class="bg-blue-500 text-white rounded-md px-6 py-2 hover:bg-blue-600 transition duration-300 text-sm">Add
                Article</a>
        </div>

        <div class="bg-white rounded-lg shadow-md w-full overflow-x-scroll md:overflow-x-hidden">
            <x-filter-bar :action="route('admin.artikel.index')" :showSearch="true" :showDate="true" :showSort="true">
                <select name="category" onchange="this.form.submit()"
                    class="border rounded-md border-gray-300/90 shadow-xs px-2 py-1">
                    <option value="">All Category</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </x-filter-bar>
            @if ($articles->isEmpty())
                <p class="text-center pt-10">No articles found.</p>
            @endif
            <div class="flex flex-wrap md:grid md:grid-cols-3 gap-4 p-6">
                @foreach ($articles as $article)
                    <div
                        class="rounded-lg border border-gray-300 p-4 flex flex-col gap-4 hover:shadow-md transition duration-300">
                        <div class="relative overflow-hidden rounded-md">
                            <img class="rounded-md shadow-xs w-200 h-60 object-cover hover:scale-110 transition-transform duration-300"
                                src="{{ $article->thumbnail_url }}" alt="{{ $article->title }}" />
                            <div class="">
                                @if ($article->status == 'published')
                                    <span
                                        class="absolute top-2 left-2 bg-white text-black text-xs px-2 py-1 rounded-xs">Published</span>
                                @else
                                    <span
                                        class="absolute top-2 left-2 bg-white text-black text-xs px-2 py-1 rounded-xs">Archived</span>
                                @endif
                                <span
                                    class="absolute text-xs px-2 py-1 bottom-0 right-0 bg-white rounded-tl-md rounded-br-md">{{ $article->views }}
                                    Views</span>
                            </div>
                        </div>
                        <div class="">
                            <h2 class="font-bold text-lg">{{ $article->title }}</h2>
                            <span class="text-md text-gray-600 italic">Category: {{ $article->category->name }}</span>
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
                            <ul class="flex flex-wrap gap-2 mt-2">
                                @foreach ($article->tags->take(3) as $tag)
                                    <li class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-md inline-block">
                                        {{ $tag->name }}
                                    </li>
                                @endforeach

                                @if ($article->tags->count() > 3)
                                    <li class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-md inline-block">
                                        ... (+{{ $article->tags->count() - 3 }})
                                    </li>
                                @endif
                            </ul>
                            <div class="flex justify-end mt-4 gap-1 flex-wrap">
                                <a href="/dashboard/artikel/{{ $article->slug }}"
                                    class="bg-gray-500 text-xs text-white rounded-md px-2 py-1 hover:bg-gray-600 transition duration-300 flex items-center">
                                    Preview
                                </a>
                                @if ($article->status !== 'archived')
                                    <button
                                        @click="confirmAction(
                                            '{{ route('admin.artikel.archive', $article->id) }}', 
                                            'PATCH', 
                                            'Arsipkan Artikel?', 
                                            'Artikel ini akan disembunyikan dari publik.', 
                                            'warning', 
                                            'Ya, Arsipkan'
                                        )"
                                        class="bg-yellow-500 text-xs text-white rounded-md px-2 py-1 hover:bg-yellow-600 transition cursor-pointer">
                                        Archive
                                    </button>
                                @else
                                    <button
                                        @click="confirmAction(
                                            '{{ route('admin.artikel.restore', $article->id) }}', 
                                            'PATCH', 
                                            'Publish Kembali?', 
                                            'Artikel akan muncul kembali di halaman publik.', 
                                            'success', 
                                            'Ya, Publish'
                                        )"
                                        class="bg-green-500 text-xs text-white rounded-md px-2 py-1 hover:bg-green-600 transition cursor-pointer">
                                        Publish
                                    </button>
                                @endif
                                <a href="{{ route('admin.artikel.edit', $article->id) }}"
                                    class="bg-blue-500 text-xs text-white rounded-md px-2 py-1 hover:bg-blue-600 transition duration-300 flex items-center">
                                    Edit
                                </a>
                                <button
                                    @click="confirmAction(
                                        '{{ route('admin.artikel.destroy', $article->id) }}', 
                                        'DELETE', 
                                        'Hapus Permanen?', 
                                        'Data yang dihapus tidak bisa dikembalikan lagi!', 
                                        'danger', 
                                        'Ya, Hapus'
                                    )"
                                    class="bg-red-500 text-xs text-white rounded-md px-2 py-1 hover:bg-red-600 transition cursor-pointer">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <x-pagination :paginator="$articles" />
        </div>
</x-layout-admin>
