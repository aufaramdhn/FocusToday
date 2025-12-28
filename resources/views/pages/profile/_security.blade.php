<x-sidebar-profile>
    <x-slot:title>
        Profil - FokusToday
    </x-slot:title>
    <x-slot:headerProfile>
        Ganti Password
    </x-slot:headerProfile>

    <div class="">
        <form action="#" method="POST" class="flex flex-col gap-4" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col gap-2">
                <label for="password" class="font-medium">Password</label>
                <input type="password" id="password" name="password"
                    class="border rounded-md border-gray-300/90 shadow-xs px-3 py-2" placeholder="Masukkan password">
            </div>
            @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            <div class="flex flex-col gap-2">
                <label for="password_confirmation" class="font-medium">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="border rounded-md border-gray-300/90 shadow-xs px-3 py-2"
                    placeholder="Enter password confirmation">
            </div>
            @error('password_confirmation')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            <div class="flex justify-end mt-4">
                <a href="/dashboard/user"
                    class="mr-4 bg-red-500 text-white rounded-md px-6 py-2 hover:bg-red-600 transition duration-300 text-sm">Cancel</a>
                <button type="submit"
                    class="bg-blue-500 text-white rounded-md px-6 py-2 hover:bg-blue-600 transition duration-300 text-sm">Save</button>
            </div>
        </form>
    </div>
</x-sidebar-profile>
