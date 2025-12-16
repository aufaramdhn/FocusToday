<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100 admin">
    <header
        class="fixed top-0 left-0 right-0 h-20
               bg-white shadow-md shadow-gray-200
               z-30 flex items-center px-6">
        <div class="flex justify-between items-center w-full">
            <h1 class="text-2xl font-bold text-blue-600">
                FocusToday
            </h1>
            <div class="flex items-center gap-4">
                <span class="text-gray-700 font-medium">
                    Selamat datang, <strong>Aufa Ramadhan</strong>
                </span>

                <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center">
                    <span class="text-sm font-bold">AR</span>
                </div>
            </div>
        </div>
    </header>

    <main class="flex pt-20 h-screen overflow-hidden">
        <aside
            class="fixed left-0 top-20
                   w-60 h-[calc(100vh-80px)]
                   bg-white shadow-md shadow-gray-200
                   flex flex-col justify-between z-20">
            <nav class="mt-6">
                <ul>
                    <li class="mb-2 mr-8">
                        <a href="/dashboard"
                            class="{{ request()->is('dashboard') ? 'bg-blue-500 text-white' : '' }} block py-2 pl-6 rounded-tr-xl rounded-br-xl
                                   hover:bg-blue-500/75 hover:text-white transition">
                            Dashboard
                        </a>
                    </li>
                    <li class="mb-2 mr-8">
                        <a href="/dashboard/artikel"
                            class="{{ request()->is('dashboard/artikel') ? 'bg-blue-500 text-white' : '' }} block py-2 pl-6 rounded-tr-xl rounded-br-xl
                                   hover:bg-blue-500/75 hover:text-white transition">
                            Artikel
                        </a>
                    </li>
                    <li class="mb-2 mr-8">
                        <a href="#"
                            class="block py-2 pl-6 rounded-tr-xl rounded-br-xl
                                   hover:bg-blue-500/75 hover:text-white transition">
                            Kategori
                        </a>
                    </li>
                    <li class="mb-2 mr-8">
                        <a href="/dashboard/user"
                            class="{{ request()->is('dashboard/user') ? 'bg-blue-500 text-white' : '' }} block py-2 pl-6 rounded-tr-xl rounded-br-xl
                                   hover:bg-blue-500/75 hover:text-white transition">
                            Pengguna
                        </a>
                    </li>
                </ul>
            </nav>
            <a href="#"
                class="flex pl-6 py-3 items-center rounded-xl mb-6 mx-3
                           bg-red-500 hover:bg-red-500/85 text-white transition text-xl">
                <x-ri-logout-box-line class="w-6 h-6 inline-block mr-2" />
                Keluar
            </a>
        </aside>

        <section class="ml-60 w-full p-6 bg-[#f9fbfc]
                   overflow-y-auto overflow-x-hidden">

            {{ $slot }}

        </section>
    </main>

</body>

</html>
