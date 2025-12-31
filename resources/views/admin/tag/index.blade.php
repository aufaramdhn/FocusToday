<x-layout-admin>
    <x-slot:title>
        Admin Tag
    </x-slot:title>

    <div class="">
        <div class="flex justify-between items-center mb-6">
            <div class="">
                <h1 class="text-3xl font-bold mb-3">Tag List</h1>
                <x-breadcrumb :items="[
                    ['label' => 'Dashboard', 'url' => '/dashboard'],
                    ['label' => 'Tag', 'url' => '/dashboard/tag'],
                ]" />
            </div>
            <a href="/dashboard/tag/tambah"
                class="bg-blue-500 text-white rounded-md px-6 py-2 hover:bg-blue-600 transition duration-300 text-sm">Add
                Tag</a>
        </div>

        <x-card :action="route('admin.tag.index')" :data="$tags" :paginator="$tags->appends(request()->query())">
            <div class="w-full overflow-x-scroll">
                <table class="w-full table-auto table-responsive">
                    <thead class="bg-slate-200">
                        <tr class="text-left border-b-2 border-gray-300 ">
                            <th class="py-2 px-6">ID</th>
                            <th class="py-2 px-6">Tag Name</th>
                            <th class="py-2 px-6">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @if ($tags->isEmpty())
                            <tr
                                class="border-b-2 hover:bg-gray-200/40 hover:shadow-xs border-gray-300 transition duration-500 text-sm">
                                <td colspan="3" class="text-center py-4">No tags found.</td>
                            </tr>
                        @endif
                        @foreach ($tags as $tag)
                            <tr
                                class="border-b-2 hover:bg-gray-200/40 hover:shadow-xs border-gray-300 transition duration-500 text-sm">
                                <td class="py-2 px-6">{{ $tag->id }}</td>
                                <td class="py-2 px-6">{{ $tag->name }}</td>
                                <td class="py-2 px-6 whitespace-nowrap items-center">
                                    <x-table-action>
                                        <a href="{{ route('admin.tag.edit', $tag->id) }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition text-left">Edit</a>
                                        <button
                                            @click="open = false; confirmAction(
                                            '{{ route('admin.tag.destroy', $tag->id) }}',
                                            'DELETE',
                                            'Delete Tag',
                                            'Are you sure you want to delete the tag \'{{ $tag->name }}\'? This action cannot be undone.',
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
            </div>
        </x-card>
    </div>
</x-layout-admin>
