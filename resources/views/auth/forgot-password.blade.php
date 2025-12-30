<x-layout-auth>
    <x-slot:title>Lupa Password - FokusToday</x-slot:title>

    <h1 class="text-2xl font-extrabold mb-2 text-black">Lupa Password?</h1>
    <p class="text-[11px] text-gray-600 mb-6 leading-snug">
        Masukkan email akun Anda. Kami akan mengirimkan link untuk mereset password.
    </p>

    @if (session('status'))
        <div class="mb-4 text-xs font-medium text-green-600 bg-green-50 p-3 rounded-xl border border-green-200">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <div>
            <input type="email" name="email" placeholder="Masukkan Email Anda"
                class="w-full h-11 px-4 rounded-xl text-sm border border-gray-400 focus:outline-none focus:border-gray-600"
                value="{{ old('email') }}" required autofocus>
            @error('email')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="w-full h-10 rounded-xl bg-gray-800 text-white text-sm font-medium hover:bg-black transition">
            Kirim Link Reset
        </button>
    </form>

    <p class="text-[11px] mt-5 text-black text-center">
        Ingat password Anda?
        <a href="{{ route('login') }}" class="text-blue-500 font-medium hover:underline">Masuk disini</a>
    </p>
</x-layout-auth>
