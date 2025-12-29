<x-layout-base :title="$title">

    <header class="bg-white shadow-md shadow-gray-200 fixed top-0 left-0 right-0 z-30" x-data="{ open: false }"
        @click.outside="open = false" @scroll.window="open = false">

        <div class="px-8 md:px-22 lg:px-44 py-6 flex justify-between items-center bg-white relative z-40">

            <div class="">
                <h1 class="text-xl md:text-4xl font-bold text-blue-950">FocusToday</h1>
            </div>

            <div class="flex items-center md:gap-2">
                <div class="hidden md:block mr-0 md:mr-4 text-sm">
                    <input type="text"
                        class="bg-gray-200 rounded-md px-3 py-1 border border-slate-200 focus:outline-none focus:ring-1 focus:ring-blue-500"
                        placeholder="Search...">
                    <button
                        class="bg-blue-500 text-white rounded-md px-3 py-1 hover:bg-blue-600 transition">Search</button>
                </div>

                @guest
                    <a href="{{ route('login') }}"
                        class="text-gray-700 font-medium text-sm bg-gray-300 hover:bg-gray-400 hover:text-white px-3 py-1 rounded transition">Masuk</a>
                    <div class="h-7 w-[1px] bg-gray-600 mx-4 md:mx-1"></div>
                    <a href="{{ route('register') }}"
                        class="text-gray-700 font-medium text-sm hover:text-gray-400 transition">Daftar</a>
                @endguest

                @auth
                    <div class="relative" x-data="{ profileOpen: false }">
                        <button @click="profileOpen = !profileOpen"
                            class="cursor-pointer flex items-center focus:outline-none">
                            <x-ri-user-line class="w-6 h-6 text-gray-700" />
                            <x-ri-arrow-up-s-line
                                class="w-5 h-5 text-gray-700 inline-block ml-1 transition-transform duration-200"
                                x-bind:class="profileOpen ? 'rotate-180' : ''" />
                        </button>

                        <div x-show="profileOpen" @click.outside="profileOpen = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            class="absolute right-0 mt-2 w-56 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-100 origin-top-right"
                            style="display: none;">

                            <div class="px-4 py-2 border-b border-gray-100 mb-1 bg-gray-50">
                                <p class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                            </div>
                            <a href="{{ route('profile.index') ?? '#' }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition">Profile</a>
                            @if (Auth::user()->role === 'admin')
                                <a href="/dashboard"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition">Dashboard
                                    Admin</a>
                            @endif
                            <div class="border-t border-gray-100 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" onclick="return confirm('Yakin ingin keluar?')"
                                    class="block w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-50 hover:text-red-700 transition cursor-pointer">Logout</button>
                            </form>
                        </div>
                    </div>
                @endauth

                <button class="cursor-pointer ml-5 md:hidden" @click="open = !open">
                    <x-ri-menu-3-line class="w-6 h-6 text-gray-700" x-show="!open" />
                    <x-ri-close-line class="w-6 h-6 text-gray-700" x-show="open" style="display: none;" />
                </button>
            </div>
        </div>

        <nav :class="open ? 'max-h-[600px] opacity-100 py-6' : 'max-h-0 opacity-0 py-0 md:max-h-full md:opacity-100 md:py-3'"
            class="bg-gray-900 text-white transition-all duration-500 ease-in-out overflow-hidden md:overflow-visible relative z-30">

            <div
                class="px-8 md:px-22 lg:px-44 flex flex-col md:flex-row md:items-center w-full md:justify-between gap-4">

                <div class="md:hidden flex gap-2 mb-2">
                    <input type="text"
                        class="bg-gray-100 text-black w-full rounded-md px-3 py-1 border border-gray-300 focus:outline-none"
                        placeholder="Search...">
                    <button class="bg-blue-500 text-white rounded-md px-3 py-1">Go</button>
                </div>

                <a href="/"
                    class="hover:text-blue-400 font-medium {{ request()->is('/') ? 'text-blue-400' : '' }}">HOME</a>
                <a href="{{ route('articles.latest') }}"
                    class="hover:text-blue-400 font-medium {{ request()->routeIs('articles.latest') ? 'text-blue-400' : '' }}">TERBARU</a>

                @if (isset($priority_categories))
                    @foreach ($priority_categories as $cat)
                        <a href="{{ route('categories.show', $cat->slug) }}"
                            class="hover:text-blue-400 font-medium uppercase {{ request()->is('kategori/' . $cat->slug) ? 'text-blue-400' : '' }}">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                @endif

                @if (isset($other_categories) && $other_categories->count() > 0)
                    <div class="relative group py-2 md:py-0" x-data="{ dropdownOpen: false }">
                        <button @click="dropdownOpen = !dropdownOpen" @click.away="dropdownOpen = false"
                            class="flex items-center gap-1 hover:text-blue-400 uppercase w-full justify-between md:justify-start font-medium cursor-pointer">
                            Lainnya
                            <x-ri-arrow-down-s-fill class="w-4 h-4 transition-transform duration-200"
                                x-bind:class="dropdownOpen ? 'rotate-180' : ''" />
                        </button>

                        <div x-show="dropdownOpen" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            class="md:absolute md:top-full md:right-0 origin-top-right mt-2 md:mt-4 w-full md:w-[450px] bg-gray-800 rounded-md shadow-xl z-50 p-4 border border-gray-700"
                            style="display: none;">

                            <div class="grid grid-cols-2 gap-x-4 gap-y-2">
                                @foreach ($other_categories as $cat)
                                    <a href="{{ route('categories.show', $cat->slug) }}"
                                        class="block px-3 py-2 text-sm text-gray-300 hover:text-white hover:bg-gray-700 rounded transition uppercase">
                                        {{ $cat->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </nav>
    </header>

    <main class="px-8 md:px-22 lg:px-44 py-10 min-h-screen mt-15 md:mt-30">
        <x-toast />

        {{ $slot }}
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const showToast = (message, type = 'success') => {
                setTimeout(() => {
                    window.dispatchEvent(new CustomEvent('notify', {
                        detail: {
                            message: message,
                            type: type
                        }
                    }));
                }, 500);
            };

            @if (session('success'))
                showToast("{{ session('success') }}", 'success');
            @endif

            @if (session('error'))
                showToast("{{ session('error') }}", 'error');
            @endif

            @if (session('status'))
                showToast("{{ session('status') }}", 'info');
            @endif

            @if ($errors->any())
                showToast("{{ $errors->first() }}", 'error');
            @endif
        });
    </script>

    <footer class="px-8 md:px-22 lg:px-44 bg-gray-900 text-white">
        <div class="flex flex-col items-center py-10 gap-6">
            <h1 class="text-4xl font-bold">FocusToday</h1>
            <div class="flex gap-4">
                <a href="" class="bg-amber-50 px-3 py-3 rounded-full text-black text">
                    <x-ri-facebook-line class="w-6 h-6" />
                </a>
                <a href="" class="bg-amber-50 px-3 py-3 rounded-full text-black text">
                    <x-ri-instagram-line class="w-6 h-6" />
                </a>
                <a href="" class="bg-amber-50 px-3 py-3 rounded-full text-black text">
                    <x-ri-youtube-line class="w-6 h-6" />
                </a>
            </div>
            <div class="flex flex-col md:flex-row gap-6 text-center">
                <a href="" class="">About</a>
                <a href="" class="">Terms of Services</a>
                <a href="" class="">Privacy Policy</a>
                <a href="" class="">Advertising</a>
                <a href="" class="">Accessibility</a>
            </div>
            <p class="">© FokusToday Media Network. All Right Reserved.</p>
        </div>
    </footer>
</x-layout-base>
