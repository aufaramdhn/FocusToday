<x-layout-admin>
    <x-slot:title>
        Admin Tambah Pengguna
    </x-slot:title>

    <div class="">
        <h1 class="text-3xl font-bold mb-3">Add User</h1>

        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => '/dashboard'],
            ['label' => 'User', 'url' => '/dashboard/user'],
            ['label' => 'Add User', 'url' => '/dashboard/user/tambah'],
        ]" />

        <div class="bg-white rounded-lg shadow-md w-full p-6 mt-6">
            <form action="{{ route('admin.user.store') }}" method="POST" class="flex flex-col gap-4"
                enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col gap-2">
                    <label for="name" class="font-medium">Full Name</label>
                    <input type="text" id="name" name="name"
                        class="border rounded-md border-gray-300/90 shadow-xs px-3 py-2" placeholder="Enter full name">
                </div>
                <div class="flex flex-col gap-2">
                    <label for="email" class="font-medium">Email</label>
                    <input type="email" id="email" name="email"
                        class="border rounded-md border-gray-300/90 shadow-xs px-3 py-2"
                        placeholder="Enter email address">
                </div>
                <div class="flex flex-col gap-2">
                    <label for="role" class="font-medium">Role</label>
                    <select id="role" name="role"
                        class="border rounded-md border-gray-300/90 shadow-xs px-3 py-2">
                        <option value="">Select Role</option>
                        <option value="admin">Admin</option>
                        <option value="editor">Editor</option>
                        <option value="user">Viewer</option>
                    </select>
                </div>
                @error('role')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <div class="flex flex-col gap-2">
                    <label for="password" class="font-medium">Password</label>
                    <input type="password" id="password" name="password"
                        class="border rounded-md border-gray-300/90 shadow-xs px-3 py-2"
                        placeholder="Masukkan password">
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
                {{-- <div class="flex flex-col gap-2">
                    <label for="password" class="font-medium">Unggah Foto</label>
                    <input type="file" id="foto" name="foto"
                        class="border rounded-md border-gray-300/90 shadow-xs px-3 py-2 cursor-pointer"
                        placeholder="Pilih file foto">
                </div> --}}
                <div class="flex justify-end mt-4">
                    <a href="/dashboard/user"
                        class="mr-4 bg-red-500 text-white rounded-md px-6 py-2 hover:bg-red-600 transition duration-300 text-sm">Cancel</a>
                    <button type="submit"
                        class="bg-blue-500 text-white rounded-md px-6 py-2 hover:bg-blue-600 transition duration-300 text-sm">Save</button>
                </div>
            </form>
        </div>
</x-layout-admin>
