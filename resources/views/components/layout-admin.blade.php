<x-layout-base :title="$title">
    <header
        class="fixed top-0 left-0 right-0 h-20
               bg-white shadow-md shadow-gray-200
               z-30 flex items-center px-6 print:hidden">
        <div class="flex justify-between items-center w-full">
            <h1 class="text-lg md:text-2xl font-bold text-black">
                FocusToday
            </h1>
            <div class="flex items-center gap-4">
                <span class="text-gray-700 font-medium hidden md:inline-block">
                    Welcome, <strong>{{ Auth::user()->name }}</strong>
                </span>

                <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center">
                    <img class="text-sm font-bold rounded-full" src="{{ Auth::user()->avatar_url }}"
                        alt="{{ Auth::user()->name }}" />
                </div>

                <button @click="sidebarOpen = !sidebarOpen" aria-expanded="true" aria-haspopup="true"
                    class="w-5 h-5 text-gray-600 md:hidden">
                    <x-ri-align-right class="" />
                </button>
            </div>
        </div>
    </header>

    <main class="block md:flex pt-20 h-screen overflow-auto md:overflow-hidden">
        <aside x-show="sidebarOpen || isDesktop" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="fixed left-0 top-20
            w-60 h-[calc(100vh-80px)]
            bg-white shadow-md shadow-gray-200
            flex flex-col z-20 print:hidden">
            <nav class="mt-6">
                <ul>
                    <li class="mb-2 mr-8">
                        <a href="/dashboard"
                            class="{{ request()->is('dashboard') ? 'bg-blue-500 text-white' : '' }} block py-2 pl-6 rounded-tr-xl rounded-br-xl
                                   hover:bg-blue-500/75 hover:text-white transition items-center">
                            <x-ri-dashboard-line class="w-5 h-5 inline-block mr-2" />
                            Dashboard
                        </a>
                    </li>
                    @php
                        $isActiveArtikel = request()->is('dashboard/artikel*');
                    @endphp
                    <li class="mb-2 mr-8" x-data="{ open: {{ $isActiveArtikel ? 'true' : 'false' }} }">
                        <button @click="open = !open"
                            class="{{ $isActiveArtikel ? 'bg-blue-500 text-white' : '' }}
                                flex w-full items-center justify-between py-2 pl-6 pr-4 rounded-tr-xl rounded-br-xl
                                hover:bg-blue-500/75 hover:text-white transition cursor-pointer">
                            <span class="font-medium">
                                <x-ri-file-list-3-line class="w-5 h-5 inline-block mr-2" />
                                Articles
                            </span>
                            <x-ri-arrow-up-wide-line class="w-4 h-4 transition-transform duration-200"
                                x-bind:class="!open ? 'rotate-180' : ''" />
                        </button>
                        <ul x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-2" class="mt-2 space-y-1">
                            <li>
                                <a href="/dashboard/artikel"
                                    class="{{ request()->fullUrlIs(url('/dashboard/artikel')) ? 'text-blue-600 font-bold bg-blue-50' : 'text-gray-600' }}
                                    block py-2 pl-12 rounded-tr-xl rounded-br-xl hover:text-blue-500 transition text-sm">
                                    All Articles
                                </a>
                            </li>
                            <li>
                                <a href="/dashboard/artikel?status=archived"
                                    class="{{ request()->fullUrlIs(url('/dashboard/artikel?status=archived')) ? 'text-blue-600 font-bold bg-blue-50' : 'text-gray-600' }}
                                    block py-2 pl-12 rounded-tr-xl rounded-br-xl hover:text-blue-500 transition text-sm">
                                    Archived
                                </a>
                            </li>
                            <li>
                                <a href="/dashboard/artikel?status=published"
                                    class="{{ request()->fullUrlIs(url('/dashboard/artikel?status=published')) ? 'text-blue-600 font-bold bg-blue-50' : 'text-gray-600' }}
                                    block py-2 pl-12 rounded-tr-xl rounded-br-xl hover:text-blue-500 transition text-sm">
                                    Published
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="mb-2 mr-8">
                        <a href="/dashboard/kategori"
                            class="{{ request()->is('dashboard/kategori') || request()->is('dashboard/kategori/*') ? 'bg-blue-500 text-white' : '' }} block py-2 pl-6 rounded-tr-xl rounded-br-xl
                                   hover:bg-blue-500/75 hover:text-white transition">
                            <x-ri-bookmark-line class="w-5 h-5 inline-block mr-2" />
                            Categories
                        </a>
                    </li>
                    <li class="mb-2 mr-8">
                        <a href="/dashboard/tag"
                            class="{{ request()->is('dashboard/tag') || request()->is('dashboard/tag/*') ? 'bg-blue-500 text-white' : '' }} block py-2 pl-6 rounded-tr-xl rounded-br-xl
                                   hover:bg-blue-500/75 hover:text-white transition">
                            <x-ri-price-tag-3-line class="w-5 h-5 inline-block mr-2" />
                            Tags
                        </a>
                    </li>
                    <li class="mb-2 mr-8">
                        <a href="/dashboard/user"
                            class="{{ request()->is('dashboard/user') || request()->is('dashboard/user/*') ? 'bg-blue-500 text-white' : '' }} block py-2 pl-6 rounded-tr-xl rounded-br-xl
                                   hover:bg-blue-500/75 hover:text-white transition">
                            <x-ri-user-line class="w-5 h-5 inline-block mr-2" />
                            Users
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="flex flex-col justify-end h-full px-3 py-4">
                <div class="flex-1">
                    <a href="/"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors
                  bg-gray-100 text-gray-700 hover:bg-gray-200 hover:text-gray-900">
                        <x-ri-home-2-line class="w-5 h-5" />
                        Home
                    </a>
                </div>

                <div class="mt-auto">
                    <button
                        @click="confirmAction(
                        '{{ route('logout') }}', 
                        'POST', 
                        'Yakin ingin keluar?', 
                        'Sesi Anda akan diakhiri dan Anda harus login ulang.', 
                        'warning', 
                        'Ya, Keluar'
                    )"
                        class="w-full flex items-center justify-center gap-2 px-4 py-3 rounded-xl text-sm font-medium transition-colors shadow-sm
                   bg-red-600 text-white hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:ring-offset-1">

                        <x-ri-logout-box-line class="w-5 h-5" />

                        <span>Sign Out</span>
                    </button>
                </div>

            </div>
        </aside>

        <section class="ml-0 md:ml-60 w-full p-6 bg-[#f9fbfc]
                   overflow-y-auto overflow-x-hidden">

            @if (session('success'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition.duration.500ms
                    class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6"
                    role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition.duration.500ms
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6"
                    role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            {{ $slot }}

        </section>
        <x-confirm-modal />
    </main>
</x-layout-base>
