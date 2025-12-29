<x-layout-auth>
    <x-slot:title>Register - FokusToday</x-slot:title>

    <h1 class="text-2xl md:text-3xl font-bold mb-2 text-gray-900">
        FokusToday
    </h1>

    <h2 class="text-sm md:text-base font-semibold mb-1 text-gray-900">
        Buat akun Anda
    </h2>

    <p class="text-[11px] md:text-xs text-gray-600 mb-5 leading-snug">
        Daftar ke FokusToday untuk melihat berita yang menarik
    </p>

    <form class="space-y-3 text-left" action="{{ route('register.submit') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Nama"
            class="w-full h-11 px-4 rounded-xl border border-gray-400 text-sm focus:outline-none focus:border-gray-600">

        <input type="email" name="email" placeholder="Email"
            class="w-full h-11 px-4 rounded-xl border border-gray-400 text-sm focus:outline-none focus:border-gray-600">

        <div class="relative">
            <input id="password" type="password" name="password" placeholder="Password"
                class="w-full h-11 px-4 pr-12 rounded-xl border border-gray-400 text-sm focus:outline-none focus:border-gray-600">

            <button type="button" onclick="togglePassword()"
                class="absolute inset-y-0 right-4 flex items-center text-gray-600">

                <x-ri-eye-line class="w-6 h-6" />
            </button>
        </div>

        <div class="relative">
            <input id="password_confirmation" type="password" name="password_confirmation"
                placeholder="Konfirmasi Password"
                class="w-full h-11 px-4 pr-12 rounded-xl border border-gray-400 text-sm focus:outline-none focus:border-gray-600">

            <button type="button" onclick="togglePasswordConfirmation()"
                class="absolute inset-y-0 right-4 flex items-center text-gray-600">

                <x-ri-eye-line class="w-6 h-6" />
            </button>
        </div>

        <button type="submit"
            class="w-full h-10 rounded-lg bg-gray-300 text-sm font-medium hover:bg-gray-400 transition">
            Daftar
        </button>

    </form>

    <div class="flex items-center my-4">
        <div class="flex-1 h-px bg-gray-400"></div>
        <span class="px-3 text-[10px] md:text-xs text-gray-700">OR</span>
        <div class="flex-1 h-px bg-gray-400"></div>
    </div>

    <a href="{{ route('google.redirect') }}">
        <button
            class="w-full h-11 rounded-xl border border-gray-400 bg-white flex items-center justify-center gap-2 text-sm text-black hover:bg-gray-50
         focus:outline-none focus:border-gray-600">

            <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" class="w-4 h-4"
                alt="Google">


            Daftar dengan Google
        </button>
    </a>

    <p class="text-[10px] md:text-xs mt-4 text-gray-700">
        Sudah punya akun?
        <a href="/login" class="text-blue-500 font-medium">Login di sini</a>
    </p>

</x-layout-auth>
