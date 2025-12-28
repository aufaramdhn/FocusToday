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

        <x-card :action="route('admin.categories.index')" :data="$categories" :paginator="$categories->appends(request()->query())">
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
        </x-card>
    </div>
</x-layout-admin>
