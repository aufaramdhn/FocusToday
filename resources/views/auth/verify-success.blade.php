<x-layout-auth>
    <x-slot:title>Berhasil Verifikasi - FokusToday</x-slot:title>

    <h1 class="text-2xl font-extrabold mb-2 text-black">
        FokusToday
    </h1>

    <div class="flex justify-center my-6">
        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center animate-bounce-slow">
            <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
    </div>

    <h2 class="text-sm font-semibold mb-1 text-black">
        Email Berhasil Diverifikasi!
    </h2>

    <p class="text-[11px] text-gray-600 mb-8 leading-snug px-4">
        Terima kasih telah memverifikasi email kamu. Akun FokusToday kamu sekarang sudah aktif sepenuhnya.
    </p>

    <a href="{{ route('profile.index') }}"
        class="flex items-center justify-center w-full h-10 rounded-xl bg-gray-800 text-white text-sm font-medium hover:bg-gray-700 transition shadow-lg shadow-gray-200">
        Halaman Selanjutnya
    </a>

    <div class="mt-6">
        <p class="text-[10px] text-gray-500">
            Bukan akun kamu?
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="text-blue-500 hover:underline font-medium">
                Keluar
            </button>
        </form>
        </p>
    </div>

</x-layout-auth>
