<x-layout-auth>
    <x-slot:title>Reset Password - FokusToday</x-slot:title>

    <h1 class="text-2xl font-extrabold mb-2 text-black">Password Baru</h1>
    <p class="text-[11px] text-gray-600 mb-6 leading-snug">
        Silakan buat password baru yang aman untuk akun Anda.
    </p>

    <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <label class="text-xs font-semibold ml-1">Email</label>
            <input type="email" name="email"
                class="w-full h-11 px-4 rounded-xl text-sm border border-gray-300 bg-gray-100 text-gray-500 cursor-not-allowed"
                value="{{ old('email', $request->email) }}" readonly>
            @error('email')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <input type="password" name="password" placeholder="Password Baru"
                class="w-full h-11 px-4 rounded-xl text-sm border border-gray-400 focus:outline-none focus:border-gray-600"
                required autofocus>
            @error('password')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password Baru"
                class="w-full h-11 px-4 rounded-xl text-sm border border-gray-400 focus:outline-none focus:border-gray-600"
                required>
        </div>

        <button type="submit"
            class="w-full h-10 rounded-xl bg-gray-800 text-white text-sm font-medium hover:bg-black transition">
            Simpan Password Baru
        </button>
    </form>
</x-layout-auth>
