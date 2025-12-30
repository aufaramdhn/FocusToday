@props([
    'headerProfile' => 'Profil Saya',
    'headerProfileButton' => null,
])

<x-layout-user>
    <x-slot:title>
        Profil Saya - FocusToday
    </x-slot:title>

    <div
        class="mx-auto px-4 md:grid md:grid-cols-[1.2fr_1.8fr] lg:grid-cols-[0.8fr_2.2fr] gap-8 bg-white p-6 rounded-lg shadow-md">
        <div class="w-full mb-8 md:mb-0 h-full ">
            <div class="flex flex-col">
                <img src="{{ Auth::user()->avatar_url }}" alt="User Avatar"
                    class="object-cover border-4 border-white shadow-md w-full h-[320px] md:h-[280px]" />
                <div class="flex flex-col gap-1 md:gap-2 mt-2">
                    <a href="/profile"
                        class="md:text-base text-gray-600 text-lg hover:text-white transition text-center hover:bg-blue-700 rounded-md py-2 {{ request()->is('profile') ? 'bg-blue-600 text-white' : '' }}">Profil</a>


                    @if (Auth::user()->role === 'editor' || Auth::user()->role === 'admin')
                        <a href="{{ route('profile.artikel.index') }}"
                            class="md:text-base text-gray-600 text-lg hover:text-white transition text-center hover:bg-blue-700 rounded-md py-2 
                                {{ request()->is('profile/artikel') || request()->is('profile/artikel/*') ? 'bg-blue-600 text-white' : '' }}
                                flex items-center justify-center gap-2">
                            Artikel

                            @if (!Auth::user()->hasVerifiedEmail())
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            @endif
                        </a>
                    @endif

                    <a href="/profile/link-social-media"
                        class="md:text-base text-gray-600 text-lg hover:text-white transition text-center hover:bg-blue-700 rounded-md py-2 {{ request()->is('profile/link-social-media') ? 'bg-blue-600 text-white' : '' }}">Link
                        akun sosial</a>

                    <a href="/profile/security"
                        class="md:text-base text-gray-600 text-lg hover:text-white transition text-center hover:bg-blue-700 rounded-md py-2 {{ request()->is('profile/security') ? 'bg-blue-600 text-white' : '' }}">Keamanan</a>
                </div>
            </div>
        </div>
        <div class="w-full">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold mb-4 text-black">
                    {{ $headerProfile }}
                </h1>
                {{ $headerProfileButton }}
            </div>


            {{ $slot }}

        </div>
    </div>

    <script>
        function showNotification() {
            console.log("Fungsi dipanggil!"); // Cek ini dulu di Inspect Element > Console
            toast.success("Berhasil!");
        }
    </script>
</x-layout-user>
