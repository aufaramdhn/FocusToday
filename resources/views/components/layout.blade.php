<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header class="bg-white shadow-md shadow-gray-200 fixed top-0 left-0 right-0 z-30" x-data="{ open: false }"
        @click.outside="open = false" @scroll.window="open = false">

        <div class="px-8 md:px-22 lg:px-44 py-6 flex justify-between items-center">
            <div class="">
                <h1 class="text-xl md:text-4xl font-bold to-blue-950 ">FocusToday</h1>
            </div>

            <div class="flex items-center md:gap-2">
                <div class="hidden md:block mr-0 md:mr-4 text-sm">
                    <input type="text" class="bg-gray-200 rounded-md px-3 py-1 border border-slate-"
                        placeholder="Search...">
                    <button class="bg-blue-500 text-white rounded-md px-3 py-1">Search</button>
                </div>

                <a href=""
                    class="text-gray-700 font-medium text-sm bg-gray-300 hover:bg-gray-400 hover:text-white px-3 py-1 rounded transition">
                    Masuk
                </a>

                <div class="h-7 w-[2px] bg-gray-600 mx-4 md:mx-1"></div>

                <a href="" class="text-gray-700 font-medium text-sm hover:text-gray-400 transition">
                    Daftar
                </a>

                <div class="relative" x-data="{ profileOpen: false }">
                    <button @click="profileOpen = !profileOpen"
                        class="cursor-pointer flex items-center focus:outline-none">
                        <x-ri-user-line class="w-6 h-6 text-gray-700 ml-5" />
                        <x-ri-arrow-up-s-line
                            class="w-5 h-5 text-gray-700 inline-block ml-1 transition-transform duration-200"
                            x-bind:class="profileOpen ? 'rotate-180' : ''" />
                    </button>
                    <div x-show="profileOpen" @click.outside="profileOpen = false"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-100 origin-top-right"
                        style="display: none;">
                        <div class="px-4 py-2 border-b border-gray-100 mb-1">
                            <p class="text-sm font-semibold text-gray-900 truncate">
                                Aufa Ramadhan
                            </p>
                            <p class="text-xs text-gray-500 truncate">
                                email@email.com
                            </p>
                        </div>

                        <a href="#"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition">
                            Profile
                        </a>
                        <a href=""
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition">
                            Dashboard Admin
                        </a>
                        <div class="border-t border-gray-100 my-1"></div>
                        <form method="POST" action="">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-50 hover:text-red-700 transition cursor-pointer">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>

                <button class="cursor-pointer ml-5" @click="open = !open">
                    <x-ri-menu-3-line class="w-6 h-6 text-gray-700 md:hidden" />
                </button>
            </div>
        </div>

        <nav :class="open ? 'max-h-[500px] opacity-100 py-6' : 'max-h-0 opacity-0 py-0 md:max-h-full md:opacity-100 md:py-3'"
            class="flex flex-col md:flex-row justify-between px-8 md:px-22 lg:px-44 bg-gray-900 gap-4 text-white transition-all duration-500 ease-in-out overflow-hidden">

            <div class="md:hidden flex gap-1">
                <input type="text" class="bg-gray-200 text-black w-full rounded-md px-3 py-1 border border-slate-"
                    placeholder="Search...">
                <button class="bg-blue-500 text-white rounded-md px-3 py-1 cursor-pointer">Search</button>
            </div>

            <a href="">Home</a>
            <a href="">Terbaru</a>
            <a href="">Bisnis</a>
            <a href="">Keuangan</a>
            <a href="">Teknologi</a>
            <a href="">Olahraga</a>
            <a href="">Hiburan</a>
            <a href="">Gaya Hidup</a>
        </nav>
    </header>

    <main class="px-8 md:px-22 lg:px-44 py-10 min-h-screen mt-15 md:mt-30">
        {{ $slot }}
    </main>

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
</body>
</html>
