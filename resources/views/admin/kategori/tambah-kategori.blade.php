<x-layout-admin>
    <x-slot:title>
        Admin Tambah Kategori
    </x-slot:title>

    <div class="">
        <h1 class="text-3xl font-bold mb-3">Tambah Kategori</h1>

        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => '/dashboard'],
            ['label' => 'Kategori', 'url' => '/dashboard/kategori'],
            ['label' => 'Tambah Kategori', 'url' => '/dashboard/kategori/tambah'],
        ]" />

        <div class="bg-white rounded-lg shadow-md w-full p-6 mt-6">
            <form action="" class="flex flex-col gap-4">
                <div class="flex flex-col gap-2">
                    <label for="nama" class="font-medium">Nama Kategori</label>
                    <input type="text" id="nama" name="nama"
                        class="border rounded-md border-gray-300/90 shadow-xs px-3 py-2"
                        placeholder="Masukkan nama kategori">
                </div>
                <div class="flex justify-end mt-4">
                    <a href="/dashboard/kategori"
                        class="mr-4 bg-red-500 text-white rounded-md px-6 py-2 hover:bg-red-600 transition duration-300">Batal</a>
                    <button type="submit"
                        class="bg-blue-500 text-white rounded-md px-6 py-2 hover:bg-blue-600 transition duration-300">Simpan</button>
                </div>
            </form>
        </div>
</x-layout-admin>
