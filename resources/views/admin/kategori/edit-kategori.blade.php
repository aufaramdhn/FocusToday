<x-layout-admin>
    <x-slot:title>
        Admin Edit Kategori
    </x-slot:title>

    <div class="">
        <h1 class="text-3xl font-bold mb-3">Edit Category</h1>
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => '/dashboard'],
            ['label' => 'Categories', 'url' => '/dashboard/kategori'],
            ['label' => 'Edit Category', 'url' => '/dashboard/kategori/edit'],
        ]" />

        <div class="bg-white rounded-lg shadow-md w-full p-6 mt-6">
            <form action="" class="flex flex-col gap-4">
                <div class="flex flex-col gap-2">
                    <label for="name" class="font-medium">Category Name</label>
                    <input type="text" id="name" name="name"
                        class="border rounded-md border-gray-300/90 shadow-xs px-3 py-2"
                        placeholder="Enter category name" value="{{ $category->name }}">
                </div>
                <div class="flex justify-end mt-4">
                    <a href="/dashboard/kategori"
                        class="mr-4 bg-red-500 text-white rounded-md px-6 py-2 hover:bg-red-600 transition duration-300 text-sm">Cancel</a>
                    <button type="submit"
                        class="bg-blue-500 text-white rounded-md px-6 py-2 hover:bg-blue-600 transition duration-300 text-sm">Save</button>
                </div>
            </form>
        </div>
</x-layout-admin>
