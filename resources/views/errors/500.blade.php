<x-layout-base>
    <x-slot:title>Terjadi Kesalahan</x-slot:title>

    <div class="min-h-[80vh] flex items-center justify-center px-4">
        <div class="text-center max-w-lg">
            <div class="mb-6 flex justify-center">
                <div class="bg-orange-50 p-6 rounded-full">
                    <svg class="w-20 h-20 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Server Bermasalah</h1>
            <p class="text-gray-600 mb-8">Ada kesalahan teknis di sisi kami. Silakan coba beberapa saat lagi.</p>
            <a href="{{ url()->current() }}"
                class="px-6 py-3 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition">Refresh Halaman</a>
        </div>
    </div>
</x-layout-base>
