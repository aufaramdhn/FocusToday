<x-layout-base>
    <x-slot:title>Sesi Berakhir</x-slot:title>

    <div class="min-h-[80vh] flex items-center justify-center px-4">
        <div class="text-center max-w-lg">
            <div class="mb-6 flex justify-center">
                <div class="bg-gray-100 p-6 rounded-full">
                    <svg class="w-20 h-20 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Sesi Kedaluwarsa</h1>
            <p class="text-gray-600 mb-8">Halaman sudah tidak aktif karena didiamkan terlalu lama. Silakan muat ulang.
            </p>
            <a href="{{ url()->current() }}"
                class="px-6 py-3 bg-gray-700 text-white rounded-lg hover:bg-gray-800 transition">Refresh Halaman</a>
        </div>
    </div>
</x-layout-base>
