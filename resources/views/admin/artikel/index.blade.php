<x-layout-admin>
    <x-slot:title>
        Admin Artikel
    </x-slot:title>

    <div class="">
        <div class="flex justify-between items-center mb-6">
            <div class="">
                <h1 class="text-3xl font-bold mb-3">Daftar Artikel</h1>
                <x-breadcrumb :items="[
                    ['label' => 'Dashboard', 'url' => '/dashboard'],
                    ['label' => 'Artikel', 'url' => '/dashboard/artikel'],
                ]" />
            </div>
            <a href="/dashboard/artikel/tambah"
                class="bg-blue-500 text-white rounded-md px-6 py-2 hover:bg-blue-600 transition duration-300 text-sm">Tambah
                Artikel</a>
        </div>

        <div class="bg-white rounded-lg shadow-md w-full">
            <div class="flex flex-wrap md:grid md:grid-cols-3 gap-4 p-6">
                <div
                    class="rounded-lg border border-gray-300 p-4 flex flex-col gap-4 hover:shadow-md transition duration-300">
                    <div class="relative">
                        <img class="rounded-md shadow-xs"
                            src="https://images.unsplash.com/photo-1761839257789-20147513121a?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="" srcset="">
                        <div class="">
                            <span
                                class="absolute top-2 left-2 bg-white text-black text-xs px-2 py-1 rounded-xs">Published</span>
                            <span
                                class="absolute text-xs px-2 py-1 bottom-0 right-0 bg-white rounded-tl-md rounded-br-md">0
                                Views</span>
                        </div>
                    </div>
                    <div class="">
                        <h2 class="font-bold text-lg">Judul Artikel</h2>
                        <p class="text-gray-600">Ringkasan artikel atau deskripsi singkat tentang isi artikel.</p>
                        <ul class="flex gap-2 mt-2">
                            <li class="border text-xs text-gray-500 rounded-lg px-1 py-0.5">Sport</li>
                            <li class="border text-xs text-gray-500 rounded-lg px-1 py-0.5">Sport</li>
                            <li class="border text-xs text-gray-500 rounded-lg px-1 py-0.5">Sport</li>
                        </ul>
                        <div class="flex justify-end mt-4">
                            <a href="/dashboard/artikel/edit"
                                class="bg-blue-500 text-xs text-white rounded-md px-2 py-1 hover:bg-blue-600 transition duration-300 cursor-pointer">Edit</a>
                            <button
                                class="bg-red-500 text-xs text-white rounded-md px-2 py-1 hover:bg-red-600 transition duration-300 ml-2 cursor-pointer">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="border-t border-gray-300 mt-6 flex flex-col md:flex-row justify-between items-center px-6 py-4 text-sm gap-4">
                <div class="">
                    <p class="">Showing 1 to 10 of 50 results</p>
                </div>
                <div class="">
                    <nav>
                        <ul class="inline-flex flex-wrap items-center gap-2">
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
</x-layout-admin>
