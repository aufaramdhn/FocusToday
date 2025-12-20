<x-layout-admin>
    <x-slot:title>
        Admin Tambah Pengguna
    </x-slot:title>

    <div class="">
        <h1 class="text-3xl font-bold mb-3">Tambah User</h1>

        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => '/dashboard'],
            ['label' => 'Pengguna', 'url' => '/dashboard/user'],
            ['label' => 'Tambah Pengguna', 'url' => '/dashboard/user/tambah'],
        ]" />

        <div class="bg-white rounded-lg shadow-md w-full p-6 mt-6">
            <form action="" class="flex flex-col gap-4">
                <div class="flex flex-col gap-2">
                    <label for="nama" class="font-medium">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama"
                        class="border rounded-md border-gray-300/90 shadow-xs px-3 py-2"
                        placeholder="Masukkan nama lengkap">
                </div>
                <div class="flex flex-col gap-2">
                    <label for="email" class="font-medium">Email</label>
                    <input type="email" id="email" name="email"
                        class="border rounded-md border-gray-300/90 shadow-xs px-3 py-2"
                        placeholder="Masukkan alamat email">
                </div>
                <div class="flex flex-col gap-2">
                    <label for="peran" class="font-medium">Peran</label>
                    <select id="peran" name="peran"
                        class="border rounded-md border-gray-300/90 shadow-xs px-3 py-2">
                        <option value="">Pilih Peran</option>
                        <option value="admin">Admin</option>
                        <option value="editor">Editor</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <div class="flex flex-col gap-2">
                    <label for="password" class="font-medium">Password</label>
                    <input type="password" id="password" name="password"
                        class="border rounded-md border-gray-300/90 shadow-xs px-3 py-2"
                        placeholder="Masukkan password">
                </div>
                <div class="flex flex-col gap-2">
                    <label for="password_confirmation" class="font-medium">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="border rounded-md border-gray-300/90 shadow-xs px-3 py-2"
                        placeholder="Masukkan konfirmasi password">
                </div>
                <div class="flex flex-col gap-2">
                    <label for="password" class="font-medium">Unggah Foto</label>
                    <input type="file" id="foto" name="foto"
                        class="border rounded-md border-gray-300/90 shadow-xs px-3 py-2 cursor-pointer"
                        placeholder="Pilih file foto">
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
