<x-layout-auth>
    <x-slot:title>Setup Profil - FokusToday</x-slot:title>

    <h1 class="text-2xl font-extrabold mb-2 text-black">
        Selamat Datang!
    </h1>

    <h2 class="text-sm font-semibold mb-1 text-black">
        Mari atur profil Anda
    </h2>

    <p class="text-[11px] text-gray-600 mb-6 leading-snug">
        Lengkapi data berikut untuk pengalaman yang lebih personal.
    </p>

    <form method="POST" action="{{ route('onboarding.store') }}" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <div class="flex flex-col items-center gap-3">
            <div class="relative w-24 h-24">
                <img id="avatar-preview"
                    src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=random"
                    class="w-full h-full rounded-full object-cover border-2 border-gray-300 shadow-sm">

                <input type="file" name="avatar" id="avatar" class="hidden" accept="image/*"
                    onchange="previewImage(event)">

                <label for="avatar"
                    class="absolute bottom-0 right-0 bg-gray-800 text-white p-1.5 rounded-full cursor-pointer hover:bg-black transition border-2 border-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M20 5h-3.17L15 3H9L7.17 5H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zm0 14H4V7h16v12zM12 9c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4z" />
                    </svg>
                </label>
            </div>
            <span class="text-[10px] text-gray-500">Ketuk ikon kamera untuk ubah foto</span>
            @error('avatar')
                <p class="text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="text-xs font-semibold text-black mb-2 block">Pilih Peran Anda</label>
            <div class="grid grid-cols-2 gap-3">

                <label class="cursor-pointer relative">
                    <input type="radio" name="role" value="viewer" class="peer sr-only" checked>
                    <div
                        class="p-3 rounded-xl border border-gray-400 peer-checked:border-gray-800 peer-checked:bg-gray-100 hover:bg-gray-50 transition text-center h-full flex flex-col items-center justify-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600 peer-checked:text-black"
                            viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z" />
                        </svg>
                        <span class="text-xs font-medium text-black">Pembaca</span>
                    </div>
                </label>

                <label class="cursor-pointer relative">
                    <input type="radio" name="role" value="editor" class="peer sr-only">
                    <div
                        class="p-3 rounded-xl border border-gray-400 peer-checked:border-gray-800 peer-checked:bg-gray-100 hover:bg-gray-50 transition text-center h-full flex flex-col items-center justify-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600 peer-checked:text-black"
                            viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                        </svg>
                        <span class="text-xs font-medium text-black">Penulis</span>
                    </div>
                </label>
            </div>
            @error('role')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="w-full h-10 rounded-xl bg-gray-300 text-sm font-medium
                   hover:bg-gray-400 transition mt-4">
            Selesai & Masuk
        </button>
    </form>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('avatar-preview');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

</x-layout-auth>
