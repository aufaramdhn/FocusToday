<x-layout-base :title="$title">

    <header class="bg-white shadow-md shadow-gray-200 fixed top-0 left-0 right-0 z-[9999]"
        style="overflow: visible !important;" x-data="{ mobileOpen: false }" @click.outside="mobileOpen = false">

        <div class="bg-white relative z-[10000] border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">

                <div class="flex-shrink-0">
                    <h1 class="text-xl lg:text-3xl font-bold text-blue-950 tracking-tight">FocusToday</h1>
                </div>

                <div class="flex items-center gap-3">

                    <div class="hidden lg:block text-sm mr-2">
                        <form action="{{ route('home.search') }}" method="GET" class="flex items-center gap-2">
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="bg-gray-100 rounded-full px-4 py-2 border border-transparent focus:bg-white focus:border-blue-500 focus:outline-none focus:ring-0 w-64 transition-all text-sm"
                                placeholder="Cari berita...">
                            <button type="submit"
                                class="bg-blue-600 text-white rounded-full p-2 hover:bg-blue-700 transition shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </form>
                    </div>

                    @guest
                        <div class="hidden lg:flex items-center gap-3">
                            <a href="{{ route('login') }}"
                                class="text-gray-600 font-medium text-sm hover:text-blue-600 transition">Masuk</a>
                            <span class="h-4 w-[1px] bg-gray-300"></span>
                            <a href="{{ route('register') }}"
                                class="bg-blue-600 text-white text-sm font-medium px-4 py-2 rounded-full hover:bg-blue-700 transition shadow-sm">Daftar</a>
                        </div>
                    @endguest

                    @auth
                        <div class="relative" x-data="{ profileOpen: false }">
                            <button @click="profileOpen = !profileOpen"
                                class="cursor-pointer flex items-center focus:outline-none hover:bg-gray-50 p-1 rounded-full transition">
                                <img src="{{ Auth::user()->avatar_url }}" alt="User Avatar"
                                    class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                                </img>
                                <x-ri-arrow-down-s-line class="w-4 h-4 text-gray-500 ml-1 transition-transform duration-200"
                                    x-bind:class="profileOpen ? 'rotate-180' : ''" />
                            </button>

                            <div x-show="profileOpen" @click.outside="profileOpen = false"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                                class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl py-2 z-[1000] border border-gray-100 origin-top-right"
                                style="display: none;">

                                <div class="px-4 py-2 border-b border-gray-100 mb-1 bg-gray-50/50">
                                    <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                                </div>
                                <a href="{{ route('profile.index') ?? '#' }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">Profile</a>
                                @if (Auth::user()->role === 'admin')
                                    <a href="/dashboard"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">Dashboard
                                        Admin</a>
                                @endif
                                <div class="border-t border-gray-100 my-1"></div>
                                <button
                                    @click="profileOpen = false; confirmAction(
                                            '{{ route('logout') }}', 
                                            'POST', 
                                            'Yakin ingin keluar?', 
                                            'Sesi Anda akan diakhiri dan Anda harus login ulang.', 
                                            'warning', 
                                            'Ya, Keluar'
                                        )"
                                    class="block w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-50 hover:text-red-700 transition cursor-pointer font-medium">Logout</button>
                            </div>
                        </div>
                    @endauth

                    <button class="cursor-pointer lg:hidden p-2 hover:bg-gray-100 rounded-md transition"
                        @click="mobileOpen = !mobileOpen">
                        <x-ri-menu-3-line class="w-6 h-6 text-gray-700" x-show="!mobileOpen" />
                        <x-ri-close-line class="w-6 h-6 text-gray-700" x-show="mobileOpen" style="display: none;" />
                    </button>
                </div>
            </div>
        </div>

        <div class="hidden lg:block bg-gray-900 text-white relative z-[999]" style="overflow: visible !important;">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <div class="flex items-center justify-between w-full h-12">

                    <div class="flex items-center gap-8 text-sm font-semibold tracking-wide flex-1">
                        <a href="/"
                            class="hover:text-blue-400 py-3 border-b-2 border-transparent hover:border-blue-400 transition {{ request()->is('/') ? 'text-blue-400 border-blue-400' : '' }}">HOME</a>
                        <a href="{{ route('articles.latest') }}"
                            class="hover:text-blue-400 py-3 border-b-2 border-transparent hover:border-blue-400 transition {{ request()->routeIs('articles.latest') ? 'text-blue-400 border-blue-400' : '' }}">TERBARU</a>

                        @if (isset($priority_categories))
                            @foreach ($priority_categories as $cat)
                                <a href="{{ route('categories.show', $cat->slug) }}"
                                    class="hover:text-blue-400 uppercase py-3 border-b-2 border-transparent hover:border-blue-400 transition {{ request()->is('kategori/' . $cat->slug) ? 'text-blue-400 border-blue-400' : '' }}">
                                    {{ $cat->name }}
                                </a>
                            @endforeach
                        @endif
                    </div>

                    @if (isset($other_categories) && $other_categories->count() > 0)
                        <div class="relative group h-full flex items-center" x-data="{ dropdownOpen: false }">
                            <button @click="dropdownOpen = !dropdownOpen" @click.outside="dropdownOpen = false"
                                class="flex items-center gap-1 hover:text-blue-400 uppercase font-semibold text-sm cursor-pointer h-full border-b-2 border-transparent">
                                Lainnya
                                <x-ri-arrow-down-s-fill class="w-4 h-4 transition-transform duration-200"
                                    x-bind:class="dropdownOpen ? 'rotate-180' : ''" />
                            </button>

                            <div x-show="dropdownOpen" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                class="absolute top-full right-0 mt-0 w-[450px] bg-gray-800 rounded-b-md shadow-2xl z-[10002] border border-gray-700 max-h-[70vh] overflow-y-auto"
                                style="display: none;">

                                <div class="grid grid-cols-2 gap-x-4 gap-y-2 p-5">
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
            </div>
        </div>

        <div x-show="mobileOpen" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="lg:hidden fixed inset-0 z-[9998] bg-gray-900 text-white pt-24 pb-10 overflow-y-auto"
            style="display: none;">

            <div class="px-6 flex flex-col gap-6 min-h-full">

                <div class="flex gap-2">
                    <input type="text"
                        class="bg-gray-800 text-white w-full rounded-md px-4 py-3 border border-gray-700 focus:outline-none focus:border-blue-500"
                        placeholder="Cari berita...">
                    <button class="bg-blue-600 text-white rounded-md px-4 py-3 font-semibold">Cari</button>
                </div>

                <div class="flex flex-col gap-4 text-lg">
                    <a href="/"
                        class="hover:text-blue-400 font-medium border-b border-gray-800 pb-2 {{ request()->is('/') ? 'text-blue-400' : '' }}">HOME</a>
                    <a href="{{ route('articles.latest') }}"
                        class="hover:text-blue-400 font-medium border-b border-gray-800 pb-2 {{ request()->routeIs('articles.latest') ? 'text-blue-400' : '' }}">TERBARU</a>

                    @if (isset($priority_categories))
                        @foreach ($priority_categories as $cat)
                            <a href="{{ route('categories.show', $cat->slug) }}"
                                class="hover:text-blue-400 font-medium uppercase border-b border-gray-800 pb-2 {{ request()->is('kategori/' . $cat->slug) ? 'text-blue-400' : '' }}">
                                {{ $cat->name }}
                            </a>
                        @endforeach
                    @endif

                    @if (isset($other_categories) && $other_categories->count() > 0)
                        <div x-data="{ mobileDrop: false }" class="border-b border-gray-800 pb-2">
                            <button @click="mobileDrop = !mobileDrop"
                                class="flex items-center justify-between w-full hover:text-blue-400 uppercase font-medium cursor-pointer py-1">
                                Lainnya
                                <x-ri-arrow-down-s-fill class="w-6 h-6 transition-transform duration-200"
                                    x-bind:class="mobileDrop ? 'rotate-180' : ''" />
                            </button>

                            <div x-show="mobileDrop"
                                class="pl-4 mt-2 grid grid-cols-1 gap-3 border-l-2 border-gray-700 my-2">
                                @foreach ($other_categories as $cat)
                                    <a href="{{ route('categories.show', $cat->slug) }}"
                                        class="block text-base text-gray-400 hover:text-white uppercase py-1">
                                        {{ $cat->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @guest
                        <div class="mt-4 flex flex-col gap-3">
                            <a href="{{ route('login') }}"
                                class="text-center w-full bg-gray-800 py-3 rounded text-white font-semibold">Masuk</a>
                            <a href="{{ route('register') }}"
                                class="text-center w-full bg-blue-600 py-3 rounded text-white font-semibold">Daftar</a>
                        </div>
                    @endguest
                </div>

                <div class="h-10"></div>
            </div>
        </div>

    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 min-h-screen mt-14 lg:mt-28 relative z-0">

        @if (!request()->routeIs('home'))
            <a href="{{ route('home') }}" class="text-sm text-blue-500 hover:underline mb-6 inline-block">
                Back to Home
            </a>
        @endif

        {{ $slot }}
    </main>

    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center py-10 gap-6">
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
            <div class="flex flex-col md:flex-row gap-6 text-center font-medium text-sm md:text-base">
                <a href="/"
                    class="hover:text-blue-400 transition duration-300 {{ request()->is('/') ? 'text-blue-400' : '' }}">
                    HOME
                </a>

                <a href="{{ route('articles.latest') }}"
                    class="hover:text-blue-400 transition duration-300 {{ request()->routeIs('articles.latest') ? 'text-blue-400' : '' }}">
                    TERBARU
                </a>

                @if (isset($footer_categories))
                    @foreach ($footer_categories as $cat)
                        <a href="{{ route('categories.show', $cat->slug) }}"
                            class="hover:text-blue-400 transition duration-300 uppercase {{ request()->is('kategori/' . $cat->slug) ? 'text-blue-400' : '' }}">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                @endif
            </div>
            <p class="">© FokusToday Media Network. All Right Reserved.</p>
        </div>
    </footer>
</x-layout-base>
