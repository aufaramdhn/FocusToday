<x-sidebar-profile>
    <x-slot:title>
        Profil - FokusToday
    </x-slot:title>
    <x-slot:headerProfile>
        Profil Saya
    </x-slot:headerProfile>

    <div class="">
        <form action="#" method="POST" class="flex flex-col gap-4" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col gap-2">
                <label for="name" class="font-medium">Full Name</label>
                <input type="text" id="name" name="name"
                    class="border rounded-md border-gray-300/90 shadow-xs px-3 py-2" placeholder="Enter full name">
            </div>
            <div class="flex flex-col gap-2">
                <label for="email" class="font-medium">Email</label>
                <input type="email" id="email" name="email"
                    class="border rounded-md border-gray-300/90 shadow-xs px-3 py-2" placeholder="Enter email address">
            </div>
            <div class="flex flex-col gap-2">
                <label for="role" class="font-medium">Role</label>
                <select id="role" name="role" class="border rounded-md border-gray-300/90 shadow-xs px-3 py-2">
                    <option value="">Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="editor">Editor</option>
                    <option value="user">Viewer</option>
                </select>
            </div>
            @error('role')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            <div class="flex flex-col gap-2" x-data="avatarPreview('{{ isset($user) && $user->avatar ? asset('storage/' . $user->avatar) : '' }}')">
                <label class="font-medium">Foto Profil (Avatar)</label>

                <div x-show="previewUrl" class="relative w-fit group">
                    <img :src="previewUrl"
                        class="h-48 w-auto object-cover rounded-md border border-gray-300 shadow-sm"
                        alt="Avatar Preview">

                    <button type="button" @click="removePreview()"
                        class="absolute top-2 right-2 bg-red-500 text-white p-1 rounded-full opacity-0 group-hover:opacity-100 transition shadow-md hover:bg-red-600"
                        title="Hapus Avatar">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <input type="file" name="avatar" accept="image/*" id="avatar-input" @change="updatePreview($event)"
                    class="file:mr-4 file:py-2 file:px-4
                file:rounded-md file:border-0
                file:text-sm file:font-semibold
                file:bg-blue-50 file:text-blue-700
                hover:file:bg-blue-100 cursor-pointer border rounded-md border-gray-300 w-full text-sm text-gray-500">

            </div>
            @error('avatar')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
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
