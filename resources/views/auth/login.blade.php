<x-layout-auth>
    <x-slot:title>Login - FokusToday</x-slot:title>

    <h1 class="text-2xl font-extrabold mb-2 text-black">
        FokusToday
    </h1>

    <h2 class="text-sm font-semibold mb-1 text-black">
        Selamat Datang
    </h2>

    <p class="text-[11px] text-gray-600 mb-6 leading-snug">
        Login ke FokusToday untuk melihat berita yang menarik
    </p>

    <form method="POST" action="{{ route('auth.authenticate') }}" class="space-y-3">
        @csrf

        <input type="email" name="email" placeholder="Email"
            class="w-full h-11 px-4 rounded-xl text-sm border border-gray-400 focus:outline-none focus:border-gray-600"
            value="{{ old('email') }}" autofocus>
        @error('email')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
        @enderror

        <div class="relative">
            <input id="password" name="password" type="password" placeholder="Password"
                class="w-full h-11 px-4 pr-12 rounded-xl border border-gray-400 text-sm focus:outline-none focus:border-gray-600">

            <button type="button" onclick="togglePassword()"
                class="absolute inset-y-0 right-4 flex items-center text-gray-600">

                <x-ri-eye-line class="w-6 h-6" />
            </button>
        </div>
        @error('password')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
        @enderror

        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2 text-[11px] text-black">
                <input type="checkbox" name="remember" class="w-4 h-4" id="remember_me"
                    {{ old('remember') ? 'checked' : '' }}>
                <label for="remember_me">Biarkan saya tetap masuk</label>
            </div>
            <div class="">
                <a href="{{ route('password.request') }}" class="text-blue-500 font-medium text-sm hover:underline">
                    Lupa Password?
                </a>
            </div>
        </div>

        <button type="submit"
            class="w-full h-10 rounded-xl bg-gray-300 text-sm font-medium
               hover:bg-gray-400 transition">
            Masuk
        </button>

    </form>

    <div class="flex items-center my-5">
        <div class="flex-1 h-px bg-gray-400"></div>
        <span class="px-3 text-[10px] text-black">OR</span>
        <div class="flex-1 h-px bg-gray-400"></div>
    </div>

    <a href="{{ route('google.redirect') }}"
        class="w-full h-11 rounded-xl bg-gray-200
             flex items-center justify-center gap-2 text-sm font-medium
             hover:bg-gray-300 transition">
        <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" class="w-4 h-4" alt="Google">
        Lanjutkan dengan Google
    </a>

    <p class="text-[11px] mt-5 text-black">
        Belum punya akun?
        <a href="/register" class="text-blue-500 font-medium hover:underline">
            Daftar di sini
        </a>
    </p>

</x-layout-auth>
