<x-layout-base>
    <x-slot:title>Halaman Tidak Ditemukan</x-slot:title>

    <div class="min-h-[80vh] flex items-center justify-center px-4">
        <div class="text-center max-w-lg">
            <div class="mb-6 flex justify-center">
                <div class="bg-blue-50 p-6 rounded-full">
                    <svg class="w-20 h-20 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Halaman Nyasar?</h1>
            <p class="text-gray-600 mb-8">Halaman yang kamu cari tidak ditemukan atau sudah dihapus.</p>
            <a href="{{ route('home') }}"
                class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Kembali ke Beranda</a>
        </div>
    </div>
</x-layout-base>
