<x-layout-base>
    <x-slot:title>Akses Ditolak</x-slot:title>

    <div class="min-h-[80vh] flex items-center justify-center px-4">
        <div class="text-center max-w-lg">
            <div class="mb-6 flex justify-center">
                <div class="bg-red-50 p-6 rounded-full">
                    <svg class="w-20 h-20 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                        </path>
                    </svg>
                </div>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Akses Ditolak</h1>
            <p class="text-gray-600 mb-8">
                {{ $exception->getMessage() ?: 'Kamu tidak memiliki izin untuk mengakses halaman ini atau akun dibekukan.' }}
            </p>
            <a href="{{ route('home') }}"
                class="px-6 py-3 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition">Kembali ke Beranda</a>
        </div>
    </div>
</x-layout-base>
