<x-sidebar-profile>
    <x-slot:title>
        Profil - FokusToday
    </x-slot:title>
    <x-slot:headerProfile>
        Ganti Password
    </x-slot:headerProfile>

    <div class="">
        <form action="{{ route('profile.security.change-password') }}" method="POST" class="flex flex-col gap-4">
            @csrf
            <div class="flex flex-col gap-2">
                <label for="current_password" class="font-medium">Password Saat Ini</label>
                <input type="password" id="current_password" name="current_password"
                    class="border rounded-md border-gray-300/90 shadow-xs px-3 py-2"
                    placeholder="Masukkan password lama">
                @error('current_password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="new_password" class="font-medium">Password Baru</label>
                <input type="password" id="new_password" name="new_password"
                    class="border rounded-md border-gray-300/90 shadow-xs px-3 py-2"
                    placeholder="Masukkan password baru">
                @error('new_password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="new_password_confirmation" class="font-medium">Konfirmasi Password Baru</label>
                <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                    class="border rounded-md border-gray-300/90 shadow-xs px-3 py-2" placeholder="Ulangi password baru">
                @error('new_password_confirmation')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-end mt-4">
                <a href="/dashboard/user"
                    class="mr-4 bg-red-500 text-white rounded-md px-6 py-2 hover:bg-red-600 transition duration-300 text-sm flex items-center">
                    Batal
                </a>
                <button type="submit"
                    class="bg-blue-500 text-white rounded-md px-6 py-2 hover:bg-blue-600 transition duration-300 text-sm">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</x-sidebar-profile>
