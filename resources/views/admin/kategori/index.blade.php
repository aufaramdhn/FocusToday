<x-layout-admin>
    <x-slot:title>
        Admin Kategori
    </x-slot:title>

    <div class="">
        <div class="flex justify-between items-center mb-6">
            <div class="">
                <h1 class="text-3xl font-bold mb-3">Categories List</h1>
                <x-breadcrumb :items="[
                    ['label' => 'Dashboard', 'url' => '/dashboard'],
                    ['label' => 'Categories', 'url' => '/dashboard/kategori'],
                ]" />
            </div>
            <a href="/dashboard/kategori/tambah"
                class="bg-blue-500 text-white rounded-md px-6 py-2 hover:bg-blue-600 transition duration-300 text-sm">Add
                Category</a>
        </div>

        <div x-data="{
            showModal: false,
            modalUrl: '',
            modalMethod: 'DELETE',
            modalTitle: '',
            modalMessage: '',
            modalType: 'danger',
            modalButtonText: 'Ya, Lanjutkan',
        
            confirmAction(url, method, title, message, type, btnText) {
                this.modalUrl = url;
                this.modalMethod = method;
                this.modalTitle = title;
                this.modalMessage = message;
                this.modalType = type;
                this.modalButtonText = btnText;
                this.showModal = true;
            }
        }" class="bg-white rounded-lg shadow-md w-full overflow-x-scroll md:overflow-x-hidden">
            <form action="{{ route('admin.categories.index') }}" method="GET" class="p-4 border-b-2 border-gray-300">
                <div class="flex items-center justify-between gap-4 flex-wrap">
                    <div class="flex flex-row-reverse items-center gap-2 md:w-[300px] w-full">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search categories..." class="w-full focus:outline-none rounded-md px-3">
                        <button type="submit" class="">
                            <x-ri-search-line class="w-6 h-6 cursor-pointer" />
                        </button>
                    </div>
                    <div class="flex items-center gap-4 flex-wrap">
                        <div class="flex items-center gap-2">
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
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Sort By</option>
                            <option value="nama_asc" {{ request('sort') == 'nama_asc' ? 'selected' : '' }}>Name (A-Z)
                            </option>
                            <option value="nama_desc" {{ request('sort') == 'nama_desc' ? 'selected' : '' }}>Name (Z-A)
                            </option>
                            <option value="tanggal_asc" {{ request('sort') == 'tanggal_asc' ? 'selected' : '' }}>
                                Create Date (Oldest)</option>
                            <option value="tanggal_desc" {{ request('sort') == 'tanggal_desc' ? 'selected' : '' }}>
                                Create Date (Newest)</option>
                        </select>
                        @if (request()->hasAny(['search', 'start_date', 'end_date', 'sort']))
                            <a href="{{ route('admin.categories.index') }}"
                                class="text-red-500 text-sm hover:underline">
                                Reset Filter
                            </a>
                        @endif
                    </div>
                </div>
            </form>
            <table class="w-full table-auto table-responsive overflow-x-scroll">
                <thead class="bg-slate-200">
                    <tr class="text-left border-b-2 border-gray-300 ">
                        <th class="py-2 px-6">ID</th>
                        <th class="py-2 px-6">Category Name</th>
                        <th class="py-2 px-6">Actions</th>
                    </tr>
                </thead>
                <tbody class="">
                    @if ($categories->isEmpty())
                        <tr
                            class="border-b-2 hover:bg-gray-200/40 hover:shadow-xs border-gray-300 transition duration-500 text-sm">
                            <td colspan="3" class="text-center py-4">No categories found.</td>
                        </tr>
                    @endif
                    @foreach ($categories as $category)
                        <tr
                            class="border-b-2 hover:bg-gray-200/40 hover:shadow-xs border-gray-300 transition duration-500 text-sm">
                            <td class="py-2 px-6">{{ $category->id }}</td>
                            <td class="py-2 px-6">{{ $category->name }}</td>
                            <td class="py-2 px-6 whitespace-nowrap items-center">
                                <x-table-action>
                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition text-left">Edit</a>
                                    <button
                                        @click="open = false; confirmAction(
                                            '{{ route('admin.categories.destroy', $category->id) }}',
                                            'DELETE',
                                            'Delete Category',
                                            'Are you sure you want to delete the category \'{{ $category->name }}\'? This action cannot be undone.',
                                            'danger',
                                            'Yes, Delete'
                                        )"
                                        class="block w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-50 hover:text-red-700 transition cursor-pointer">
                                        Delete
                                    </button>
                                </x-table-action>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div
                class="border-gray-300 flex justify-between items-center px-6 py-4 text-sm flex-col md:flex-row gap-4 md:gap-0">
                <div class="">
                    <p class="">
                        Showing
                        <span class="font-bold">{{ $categories->firstItem() }}</span>
                        to
                        <span class="font-bold">{{ $categories->lastItem() }}</span>
                        of
                        <span class="font-bold">{{ $categories->total() }}</span>
                        results
                    </p>
                </div>
                <div class="">
                    @if ($categories->hasPages())
                        <nav>
                            <ul class="inline-flex flex-wrap items-center gap-2">
                                <li>
                                    @if ($categories->onFirstPage())
                                        <button disabled
                                            class="px-3 py-1 bg-gray-200 text-gray-400 rounded-md cursor-not-allowed">Previous</button>
                                    @else
                                        <a href="{{ $categories->previousPageUrl() }}"
                                            class="px-3 py-1 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition duration-300 cursor-pointer">Previous</a>
                                    @endif
                                </li>
                                @foreach (range(1, $categories->lastPage()) as $page)
                                    <li>
                                        @if ($page == $categories->currentPage())
                                            <span
                                                class="px-3 py-1 bg-blue-500 text-white rounded-md">{{ $page }}</span>
                                        @else
                                            <a href="{{ $categories->url($page) }}"
                                                class="px-3 py-1 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition duration-300 cursor-pointer">{{ $page }}</a>
                                        @endif
                                    </li>
                                @endforeach
                                <li>
                                    @if ($categories->hasMorePages())
                                        <a href="{{ $categories->nextPageUrl() }}"
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
            <x-confirm-modal />
        </div>
    </div>
</x-layout-admin>
