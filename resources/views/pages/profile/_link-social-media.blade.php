<x-sidebar-profile>
    <x-slot:title>
        Profil - FokusToday
    </x-slot:title>
    <x-slot:headerProfile>
        Link Media Sosial
    </x-slot:headerProfile>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 mt-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Social Accounts</h3>

        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M23.52 12.32C23.52 11.32 23.44 10.74 23.24 10H12V14.53H18.56C18.26 16.03 17.27 17.58 15.65 18.66V22.06H19.53C21.78 19.96 23.52 16.63 23.52 12.32Z"
                        fill="#4285F4" />
                    <path
                        d="M12 24C15.24 24 17.96 22.92 19.94 21.09L16.06 17.69C15 18.42 13.62 18.84 12 18.84C8.85 18.84 6.18 16.71 5.22 13.84H1.21V16.94C3.21 20.92 7.34 24 12 24Z"
                        fill="#34A853" />
                    <path
                        d="M5.22 13.84C4.97 13.09 4.83 12.3 4.83 11.5C4.83 10.7 4.97 9.91 5.22 9.16V6.06H1.21C0.44 7.6 0 9.24 0 11.5C0 13.76 0.44 15.4 1.21 16.94L5.22 13.84Z"
                        fill="#FBBC05" />
                    <path
                        d="M12 4.16C14.07 4.16 15.63 5.06 16.36 5.76L19.64 2.48C17.63 0.61 15.24 0 12 0C7.34 0 3.21 3.08 1.21 7.06L5.22 10.16C6.18 7.29 8.85 4.16 12 4.16Z"
                        fill="#EA4335" />
                </svg>
                <div>
                    <p class="font-medium text-gray-800">Google</p>
                    @if (Auth::user()->google_id)
                        <p class="text-xs text-green-600">Terhubung</p>
                    @else
                        <p class="text-xs text-gray-500">Belum terhubung</p>
                    @endif
                </div>
            </div>

            @if (Auth::user()->google_id)
                <form action="#" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-3 py-1 text-sm text-red-600 border border-red-200 rounded hover:bg-red-50 transition">
                        Putuskan
                    </button>
                </form>
            @else
                <a href="#"
                    class="px-3 py-1 text-sm text-gray-700 border border-gray-300 rounded hover:bg-gray-50 transition">
                    Hubungkan
                </a>
            @endif
        </div>
    </div>

</x-sidebar-profile>
