<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>

<body>
    <header class="bg-gray-300">
        <div class="px-46 py-6 flex justify-between items-center">
            <div class="">
                <h1 class="text-4xl font-bold">FocusToday</h1>
            </div>
            <div class="flex items-center gap-4">
                <div class="">
                    <input type="text" class="bg-blue-300 rounded-md px-2 py-1" placeholder="Search...">
                    <button class="bg-blue-500 text-white rounded-md px-3 py-1">Search</button>
                </div>
                <div class="">
                    <button class="">Masuk</button>
                </div>
                <div class="">
                    <button class="">Daftar</button>
                </div>
            </div>
        </div>
        <nav class="px-44 flex justify-between bg-gray-400 py-3 gap-7">
            <a href="">Home</a>
            <a href="">Terbaru</a>
            <a href="">Bisnis</a>
            <a href="">Keuangan</a>
            <a href="">Teknologi</a>
            <a href="">Olahraga</a>
            <a href="">Hiburan</a>
            <a href="">Gaya Hidup</a>
            </ul>
        </nav>
    </header>

    <main class="px-44 py-10 min-h-screen">
        {{ $slot }}
    </main>

    <footer class="bg-gray-900 text-white">
        <div class="flex flex-col items-center px-44 py-10 gap-6">
            <h1 class="text-4xl font-bold">FocusToday</h1>
            <div class=" flex gap-4">
                <div class="bg-amber-50 px-4 py-3 rounded-full text-black text">
                    <a href="" class="">IG</a>
                </div>
                <div class="bg-amber-50 px-4 py-3 rounded-full text-black text">
                    <a href="" class="">FB</a>
                </div>
                <div class="bg-amber-50 px-4 py-3 rounded-full text-black text">
                    <a href="" class="">X</a>
                </div>
                <div class="bg-amber-50 px-4 py-3 rounded-full text-black text">
                    <a href="" class="">IG</a>
                </div>
                <div class="bg-amber-50 px-4 py-3 rounded-full text-black text">
                    <a href="" class="">IG</a>
                </div>
            </div>
            <div class="flex gap-6">
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
