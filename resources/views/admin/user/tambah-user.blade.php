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
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="border rounded-md border-gray-300/90 shadow-xs px-3 py-2 @error('name') border-red-500 @enderror"
                        placeholder="Enter full name">
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label for="email" class="font-medium">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="border rounded-md border-gray-300/90 shadow-xs px-3 py-2 @error('email') border-red-500 @enderror"
                        placeholder="Enter email address">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label for="role" class="font-medium">Role</label>
                    <select id="role" name="role"
                        class="border rounded-md border-gray-300/90 shadow-xs px-3 py-2 @error('role') border-red-500 @enderror">
                        <option value="">Select Role</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="editor" {{ old('role') == 'editor' ? 'selected' : '' }}>Editor</option>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Viewer</option>
                    </select>
                    @error('role')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label for="password" class="font-medium">Password</label>
                    <input type="password" id="password" name="password"
                        class="border rounded-md border-gray-300/90 shadow-xs px-3 py-2 @error('password') border-red-500 @enderror"
                        placeholder="Masukkan password">
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label for="password_confirmation" class="font-medium">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="border rounded-md border-gray-300/90 shadow-xs px-3 py-2"
                        placeholder="Enter password confirmation">
                </div>

                <div class="flex flex-col gap-2" x-data="{
                    photoName: null,
                    photoPreview: null,
                    updatePreview() {
                        const file = this.$refs.photo.files[0];
                        if (!file) return;
                
                        this.photoName = file.name;
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.photoPreview = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    },
                    removePreview() {
                        this.photoPreview = null;
                        this.photoName = null;
                        this.$refs.photo.value = null;
                    }
                }">
                    <label class="font-medium text-gray-700" for="avatar">Foto Profil (Opsional)</label>

                    <div class="relative w-fit group">

                        <div x-show="!photoPreview"
                            class="h-48 w-48 rounded-md border-2 border-dashed border-gray-300 bg-gray-50 flex flex-col items-center justify-center text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mb-2 opacity-50" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-xs font-medium">Belum ada foto</span>
                        </div>

                        <img x-show="photoPreview" :src="photoPreview"
                            class="h-48 w-48 object-cover rounded-md border border-gray-300 shadow-sm"
                            style="display: none;" alt="Avatar Preview">

                        <button type="button" @click="removePreview()" x-show="photoPreview"
                            class="absolute top-2 right-2 bg-red-500 text-white p-1 rounded-full opacity-0 group-hover:opacity-100 transition shadow-md hover:bg-red-600"
                            title="Hapus Foto" style="display: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div>
                        <input type="file" name="avatar" id="avatar" accept="image/*" x-ref="photo"
                            @change="updatePreview($event)"
                            class="border border-gray-300 rounded-md mt-2 block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border
                                    file:text-sm file:font-semibold
                                    file:bg-blue-50 file:text-blue-700
                                    hover:file:bg-blue-100 cursor-pointer">

                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF (Max. 2MB)</p>
                    </div>

                    @error('avatar')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end mt-4">
                    <a href="/dashboard/user"
                        class="mr-4 bg-red-500 text-white rounded-md px-6 py-2 hover:bg-red-600 transition duration-300 text-sm">Cancel</a>
                    <button type="submit"
                        class="bg-blue-500 text-white rounded-md px-6 py-2 hover:bg-blue-600 transition duration-300 text-sm">Save</button>
                </div>
            </form>
        </div>
    </div>

</x-layout-admin>
