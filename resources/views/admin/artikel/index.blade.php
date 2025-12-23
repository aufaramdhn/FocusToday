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
            <form action="{{ route('admin.artikel.index') }}" method="GET" class="p-4 border-b border-gray-300">
                <div class="flex items-center justify-between gap-4 flex-wrap">
                    <div class="flex flex-row-reverse items-center gap-2 md:w-[300px] w-full">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search articles..." class="w-full focus:outline-none rounded-md px-3">

                        <button type="submit" class="">
                            <x-ri-search-line class="w-6 h-6 cursor-pointer" />
                        </button>
                    </div>
                    <div class="flex items-center gap-4 flex-wrap">
                        <div class="flex flex-wrap items-center gap-2">
                            <input type="date" name="start_date" value="{{ request('start_date') }}"
                                onchange="this.form.submit()"
                                class="border rounded-md border-gray-300/90 shadow-xs px-2 py-1">
                            <span>—</span>
                            <input type="date" name="end_date" value="{{ request('end_date') }}"
                                onchange="this.form.submit()"
                                class="border rounded-md border-gray-300/90 shadow-xs px-2 py-1">
                        </div>
                        <select name="sort" onchange="this.form.submit()"
                            class="border rounded-md border-gray-300/90 shadow-xs px-2 py-1">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Sort
                                By</option>
                            <option value="nama_asc" {{ request('sort') == 'nama_asc' ? 'selected' : '' }}>Name (A-Z)
                            </option>
                            <option value="nama_desc" {{ request('sort') == 'nama_desc' ? 'selected' : '' }}>Name (Z-A)
                            </option>
                            <option value="tanggal_asc" {{ request('sort') == 'tanggal_asc' ? 'selected' : '' }}>
                                Create Date (Oldest)</option>
                            <option value="tanggal_desc" {{ request('sort') == 'tanggal_desc' ? 'selected' : '' }}>
                                Create Date (Newest)</option>
                        </select>
                        @if (request()->hasAny(['search', 'role', 'start_date', 'end_date', 'sort']))
                            <a href="{{ route('admin.artikel.index') }}" class="text-red-500 text-sm hover:underline">
                                Reset Filter
                            </a>
                        @endif
                    </div>
                </div>
            </form>
            @if ($articles->isEmpty())
                <p class="text-center pt-10">No articles found.</p>
            @endif
            <div class="flex flex-wrap md:grid md:grid-cols-3 gap-4 p-6">
                @foreach ($articles as $article)
                    <div
                        class="rounded-lg border border-gray-300 p-4 flex flex-col gap-4 hover:shadow-md transition duration-300">
                        <div class="relative">
                            <img class="rounded-md shadow-xs w-200 h-60 object-cover"
                                src="{{ $article->thumbnail ? asset('storage/' . $article->thumbnail) : 'https://via.placeholder.com/400x200?text=No+Image' }}"
                                alt="Article Image" />
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
                                @foreach ($article->tags as $tag)
                                    <li class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-md inline-block">
                                        {{ $tag->name }}</li>
                                @endforeach
                            </ul>
                            <div class="flex justify-end mt-4">
                                <a href="/dashboard/artikel/{{ $article->slug }}"
                                    class="bg-yellow-500 text-xs text-white rounded-md px-2 py-1 hover:bg-yellow-600 transition duration-300">Preview</a>
                                @if ($article->status !== 'archived')
                                    <form action="{{ route('admin.artikel.archive', $article->id) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Arsipkan artikel ini? Artikel akan disembunyikan dari publik.');">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="bg-green-500 text-xs text-white rounded-md px-2 py-1 hover:bg-green-600 transition duration-300 ml-2 cursor-pointer">
                                            Archive
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.artikel.restore', $article->id) }}" method="POST"
                                        class="inline-block" onsubmit="return confirm('Publish ulang artikel ini?');">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="bg-green-500 text-xs text-white rounded-md px-2 py-1 hover:bg-green-600 transition duration-300 ml-2 cursor-pointer">
                                            Publish
                                        </button>
                                    </form>
                                @endif
                                <a href="/dashboard/artikel/edit/{{ $article->id }}"
                                    class="bg-blue-500 text-xs text-white rounded-md px-2 py-1 hover:bg-blue-600 transition duration-300 ml-2 cursor-pointer">Edit</a>
                                <form action="{{ route('admin.artikel.destroy', $article->id) }}" method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('Yakin ingin menghapus artikel ini? Data yang dihapus tidak bisa dikembalikan.');">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="bg-red-500 text-xs text-white rounded-md px-2 py-1 hover:bg-red-600 transition duration-300 ml-2 cursor-pointer">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div
                class="border-gray-300 border-t flex justify-between items-center px-6 py-4 text-sm flex-col md:flex-row gap-4 md:gap-0">
                <div class="">
                    <p class="">
                        Showing
                        <span class="font-bold">{{ $articles->firstItem() }}</span>
                        to
                        <span class="font-bold">{{ $articles->lastItem() }}</span>
                        of
                        <span class="font-bold">{{ $articles->total() }}</span>
                        results
                    </p>
                </div>
                <div class="">
                    @if ($articles->hasPages())
                        <nav>
                            <ul class="inline-flex flex-wrap items-center gap-2">
                                <li>
                                    @if ($articles->onFirstPage())
                                        <button disabled
                                            class="px-3 py-1 bg-gray-200 text-gray-400 rounded-md cursor-not-allowed">Previous</button>
                                    @else
                                        <a href="{{ $articles->previousPageUrl() }}"
                                            class="px-3 py-1 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition duration-300 cursor-pointer">Previous</a>
                                    @endif
                                </li>
                                @foreach (range(1, $articles->lastPage()) as $page)
                                    <li>
                                        @if ($page == $articles->currentPage())
                                            <span
                                                class="px-3 py-1 bg-blue-500 text-white rounded-md">{{ $page }}</span>
                                        @else
                                            <a href="{{ $articles->url($page) }}"
                                                class="px-3 py-1 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition duration-300 cursor-pointer">{{ $page }}</a>
                                        @endif
                                    </li>
                                @endforeach
                                <li>
                                    @if ($articles->hasMorePages())
                                        <a href="{{ $articles->nextPageUrl() }}"
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
        </div>
</x-layout-admin>
