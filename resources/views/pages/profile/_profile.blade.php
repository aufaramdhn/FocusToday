<x-sidebar-profile>
    <x-slot:title>
        Profil - FokusToday
    </x-slot:title>
    <x-slot:headerProfile>
        Profil Saya
    </x-slot:headerProfile>

    <div x-data="{
        isEditing: false,
    
        previewUrl: '{{ Auth::user()->avatar_url }}',
        originalUrl: '{{ Auth::user()->avatar_url }}',
    
        toggleEdit() {
            this.isEditing = !this.isEditing;
            if (!this.isEditing) this.previewUrl = this.originalUrl;
        },
        cancelEdit() {
            this.isEditing = false;
            this.previewUrl = this.originalUrl;
            if (document.getElementById('avatar-input')) document.getElementById('avatar-input').value = '';
        },
        updatePreview(event) {
            const file = event.target.files[0];
            if (file) {
                this.previewUrl = URL.createObjectURL(file);
            }
        },
        removePreview() {
            this.previewUrl = 'https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random';
            if (document.getElementById('avatar-input')) document.getElementById('avatar-input').value = '';
        }
    }" class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">

        @if (!Auth::user()->hasVerifiedEmail())
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700">
                            Email Anda belum diverifikasi.
                        </p>
                        <div class="mt-2">
                            <form method="POST" action="{{ route('user.verification.send') }}">
                                @csrf
                                <button type="submit"
                                    class="font-medium text-yellow-700 underline hover:text-yellow-600 transition">
                                    Klik di sini untuk kirim ulang link verifikasi.
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <p class="italic mb-4">Note: Ganti role menjadi editor jika ingin mengunggah artikel dengan catatan harus sudah
            verifikasi email terlebih dahulu.</p>

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-gray-800">Edit Profil</h2>

            <button x-show="!isEditing" @click="toggleEdit()" type="button"
                class="flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium transition cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                Edit Profile
            </button>
        </div>

        <form id="profile-form" action="{{ route('profile.update') }}" method="POST" class="flex flex-col gap-4"
            enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="flex flex-col gap-2">
                <label for="name" class="font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}"
                    :disabled="!isEditing"
                    class="border rounded-md border-gray-300 shadow-sm px-3 py-2 disabled:bg-gray-100 disabled:text-gray-500 disabled:border-gray-200 transition-colors"
                    placeholder="Masukkan nama lengkap">
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="email" class="font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                    :disabled="!isEditing"
                    class="border rounded-md border-gray-300 shadow-sm px-3 py-2 disabled:bg-gray-100 disabled:text-gray-500 disabled:border-gray-200 transition-colors"
                    placeholder="Masukkan alamat email">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="role" class="font-medium text-gray-700">Role</label>

                <select id="role" name="role"
                    :disabled="{{ Auth::user()->role === 'admin' ? 'true' : '!isEditing' }}"
                    class="border rounded-md border-gray-300 shadow-sm px-3 py-2 disabled:bg-gray-100 disabled:text-gray-500 disabled:border-gray-200 transition-colors">

                    <option value="">Pilih Role</option>

                    @if (Auth::user()->role === 'admin')
                        <option value="admin" {{ old('role', Auth::user()->role) == 'admin' ? 'selected' : '' }}>Admin
                        </option>
                    @endif

                    <option value="editor" {{ old('role', Auth::user()->role) == 'editor' ? 'selected' : '' }}>Editor
                    </option>
                    <option value="user" {{ old('role', Auth::user()->role) == 'user' ? 'selected' : '' }}>Viewer
                    </option>
                </select>

                @if (Auth::user()->role === 'admin')
                    <input type="hidden" name="role" value="admin">
                @endif

                @error('role')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-2" x-data="avatarPreview(
                '{{ Auth::user()->avatar_url }}',
                'https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=7F9CF5&background=EBF4FF'
            )">

                <input type="hidden" name="delete_avatar" :value="isDelete ? 1 : 0">

                <label class="font-medium text-gray-700">Foto Profil</label>

                <div class="relative w-fit group">
                    <img :src="previewUrl"
                        class="h-48 w-48 object-cover rounded-md border border-gray-300 shadow-sm" alt="Avatar Preview">

                    <button type="button" @click="removePreview()" x-show="hasImage()"
                        class="absolute top-2 right-2 bg-red-500 text-white p-1 rounded-full opacity-0 group-hover:opacity-100 transition shadow-md hover:bg-red-600"
                        title="Hapus Foto Profil">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div>
                    <input type="file" name="avatar" accept="image/*" id="avatar-input" :disabled="!isEditing"
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

            <div class="flex justify-end mt-4 pt-4 border-t border-gray-100" x-show="isEditing" x-transition>
                <button type="button" @click="cancelEdit()"
                    class="mr-4 bg-white text-gray-700 border border-gray-300 rounded-md px-6 py-2 hover:bg-gray-50 transition duration-300 text-sm font-medium">
                    Batal
                </button>
                <button type="submit"
                    class="bg-blue-600 text-white rounded-md px-6 py-2 hover:bg-blue-700 transition duration-300 text-sm font-medium shadow-sm">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</x-sidebar-profile>
