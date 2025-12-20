<x-layout-admin>
    <x-slot:title>
        Admin Kategori
    </x-slot:title>

    <div class="">
        <div class="flex justify-between items-center mb-6">
            <div class="">
                <h1 class="text-3xl font-bold mb-3">Daftar Kategori</h1>
                <x-breadcrumb :items="[
                    ['label' => 'Dashboard', 'url' => '/dashboard'],
                    ['label' => 'Kategori', 'url' => '/dashboard/kategori'],
                ]" />
            </div>
            <a href="/dashboard/kategori/tambah"
                class="bg-blue-500 text-white rounded-md px-6 py-2 hover:bg-blue-600 transition duration-300">Tambah
                Kategori</a>
        </div>

        <div class="bg-white rounded-lg shadow-md w-full">
            <form action="" class="p-4 border-b-2 border-gray-300">
                <div class="flex items-center justify-between gap-4 flex-wrap">
                    <div class="flex flex-row-reverse items-center gap-2 md:w-[500px] w-full">
                        <input type="text" placeholder="Cari kategori..."
                            class="w-full focus:outline-none rounded-md px-3">
                        <button type="submit" class=""><x-ri-search-line
                                class="w-6 h-6 cursor-pointer" /></button>
                    </div>
                    <div class="flex items-center gap-4 flex-wrap">
                        <div class="flex items-center gap-2">
                            <input type="date" class="border rounded-md border-gray-300/90 shadow-xs">
                            <span>—</span>
                            <input type="date" class="border rounded-md border-gray-300/90 shadow-xs">
                        </div>
                        <select class="border rounded-md border-gray-300/90 shadow-xs" name="" id="">
                            <option value="">Pilih Peran</option>
                            <option value="admin">Admin</option>
                            <option value="editor">Editor</option>
                            <option value="user">User</option>
                        </select>
                        <select class="border rounded-md border-gray-300/90 shadow-xs" name="" id="">
                            <option value="">Urutkan Berdasarkan</option>
                            <option value="nama_asc">Nama (A-Z)</option>
                            <option value="nama_desc">Nama (Z-A)</option>
                            <option value="tanggal_asc">Tanggal Bergabung (Terlama)</option>
                            <option value="tanggal_desc">Tanggal Bergabung (Terbaru)</option>
                        </select>
                    </div>
                </div>
            </form>
            <table class="w-full table-auto">
                <thead class="bg-slate-200">
                    <tr class="text-left border-b-2 border-gray-300 ">
                        <th class="py-2 px-6">ID</th>
                        <th class="py-2 px-6">Nama</th>
                        <th class="py-2 px-6">Email</th>
                        <th class="py-2 px-6">Peran</th>
                        <th class="py-2 px-6">Aksi</th>
                    </tr>
                </thead>
                <tbody class="">
                    <tr class="border-b-2 hover:bg-gray-200/40 hover:shadow-xs border-gray-300 transition duration-500">
                        <td class="py-2 px-6">1</td>
                        <td class="py-2 px-6">Aufa Ramadhan</td>
                        <td class="py-2 px-6">aufa@example.com</td>
                        <td class="py-2 px-6">Admin</td>
                        <td class="py-2 px-6">
                            <a href="/dashboard/kategori/edit" class="">Edit</a>
                            <button class="">Hapus</button>
                        </td>
                    </tr>
                    <tr class="border-b-2 hover:bg-gray-200/40 hover:shadow-xs border-gray-300 transition duration-500">
                        <td class="py-2 px-6">1</td>
                        <td class="py-2 px-6">Aufa Ramadhan</td>
                        <td class="py-2 px-6">aufa@example.com</td>
                        <td class="py-2 px-6">Admin</td>
                        <td class="py-2 px-6">
                            <button class="">Edit</button>
                            <button class="">Hapus</button>
                        </td>
                    </tr>
                    <tr class="border-b-2 hover:bg-gray-200/40 hover:shadow-xs border-gray-300 transition duration-500">
                        <td class="py-2 px-6">1</td>
                        <td class="py-2 px-6">Aufa Ramadhan</td>
                        <td class="py-2 px-6">aufa@example.com</td>
                        <td class="py-2 px-6">Admin</td>
                        <td class="py-2 px-6">
                            <button class="">Edit</button>
                            <button class="">Hapus</button>
                        </td>
                    </tr>
                    <tr class="border-b-2 hover:bg-gray-200/40 hover:shadow-xs border-gray-300 transition duration-500">
                        <td class="py-2 px-6">1</td>
                        <td class="py-2 px-6">Aufa Ramadhan</td>
                        <td class="py-2 px-6">aufa@example.com</td>
                        <td class="py-2 px-6">Admin</td>
                        <td class="py-2 px-6">
                            <button class="">Edit</button>
                            <button class="">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="border-gray-300 flex justify-between items-center px-6 py-4 text-sm">
                <div class="">
                    <p class="">Showing 1 to 10 of 50 results</p>
                </div>
                <div class="">
                    <nav>
                        <ul class="inline-flex items-center gap-2">
                            <li>
                                <button
                                    class="px-3 py-1 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition duration-300 cursor-pointer">Previous</button>
                            </li>
                            <li>
                                <button
                                    class="px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-300 cursor-pointer">1</button>
                            </li>
                            <li>
                                <button
                                    class="px-3 py-1 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition duration-300 cursor-pointer">...</button>
                            </li>
                            <li>
                                <button
                                    class="px-3 py-1 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition duration-300 cursor-pointer">2</button>
                            <li>
                                <button
                                    class="px-3 py-1 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition duration-300 cursor-pointer">3</button>
                            </li>
                            <li>
                                <button
                                    class="px-3 py-1 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition duration-300 cursor-pointer">Next</button>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</x-layout-admin>
