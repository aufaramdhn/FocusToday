<x-layout-admin>
    <x-slot:title>
        Admin Edit Tag
    </x-slot:title>

    <div class="">
        <h1 class="text-3xl font-bold mb-3">Edit Tag</h1>
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => '/dashboard'],
            ['label' => 'Tag', 'url' => '/dashboard/tag'],
            ['label' => 'Edit Tag', 'url' => '/dashboard/tag/edit'],
        ]" />

        <div class="bg-white rounded-lg shadow-md w-full p-6 mt-6">
            <form action="" class="flex flex-col gap-4">
                <div class="flex flex-col gap-2">
                    <label for="nama" class="font-medium">Tag Name</label>
                    <input type="text" id="nama" name="nama"
                        class="border rounded-md border-gray-300/90 shadow-xs px-3 py-2" placeholder="Enter tag name"
                        value="{{ $tag->name }}">
                </div>
                <div class="flex justify-end mt-4">
                    <a href="/dashboard/tag"
                        class="mr-4 bg-red-500 text-white rounded-md px-6 py-2 hover:bg-red-600 transition duration-300 text-sm">Cancel</a>
                    <button type="submit"
                        class="bg-blue-500 text-white rounded-md px-6 py-2 hover:bg-blue-600 transition duration-300 text-sm">Save</button>
                </div>
            </form>
        </div>
</x-layout-admin>
