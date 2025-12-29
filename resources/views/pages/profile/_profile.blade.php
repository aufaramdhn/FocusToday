<x-sidebar-profile>
    <x-slot:title>
        Profil - FokusToday
    </x-slot:title>
    <x-slot:headerProfile>
        Profil Saya
    </x-slot:headerProfile>

    <div x-data="{
        isEditing: false,
        toggleEdit() {
            this.isEditing = !this.isEditing;
        },
        cancelEdit() {
            this.isEditing = false;
        }
    }" class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">

        <div class="flex flex-col gap-2 mb-4">
            <label class="font-medium">Status Email</label>
            @if (Auth::user()->hasVerifiedEmail())
                <span class="text-green-600 text-sm font-bold flex items-center gap-1">
                    ✅ Terverifikasi
                </span>
            @else
                <div class="flex items-center gap-2">
                    <span class="text-yellow-600 text-sm font-bold">⚠️ Belum Verifikasi</span>

                    <form method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="text-blue-600 text-sm hover:underline">
                            Kirim Ulang Link
                        </button>
                    </form>
                </div>
            @endif
        </div>

        <p class="italic mb-4">Ganti role menjadi editor jika ingin mengunggah artikel dengan catatan harus sudah
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
                <select id="role" name="role" :disabled="!isEditing"
                    class="border rounded-md border-gray-300 shadow-sm px-3 py-2 disabled:bg-gray-100 disabled:text-gray-500 disabled:border-gray-200 transition-colors">
                    <option value="">Pilih Role</option>
                    <option value="admin" {{ old('role', Auth::user()->role) == 'admin' ? 'selected' : '' }}>Admin
                    </option>
                    <option value="editor" {{ old('role', Auth::user()->role) == 'editor' ? 'selected' : '' }}>Editor
                    </option>
                    <option value="user" {{ old('role', Auth::user()->role) == 'user' ? 'selected' : '' }}>Viewer
                    </option>
                </select>
                @error('role')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-2" x-data="avatarPreview('{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : '' }}')">
                <label class="font-medium text-gray-700">Foto Profil</label>

                <div x-show="previewUrl" class="relative w-fit group">
                    <img :src="previewUrl"
                        class="h-48 w-auto object-cover rounded-md border border-gray-300 shadow-sm"
                        :class="!isEditing ? 'opacity-80' : ''" alt="Avatar Preview">

                    <button type="button" @click="removePreview()" x-show="isEditing"
                        class="absolute top-2 right-2 bg-red-500 text-white p-1 rounded-full opacity-0 group-hover:opacity-100 transition shadow-md hover:bg-red-600"
                        title="Hapus Preview">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div x-show="isEditing" x-transition>
                    <input type="file" name="avatar" accept="image/*" id="avatar-input"
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
