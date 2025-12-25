<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FocusToday</title>
  @vite('resources/css/app.css')
</head>

<body class="bg-white">

<header class="border-b bg-white">

  <div class="px-4 md:px-44 py-4 flex justify-between items-center">

    <h1 class="text-xl md:text-4xl font-bold text-gray-900">
      FocusToday
    </h1>

    <div class="hidden md:flex items-center gap-4">

      <div class="flex gap-2">
        <input
          type="text"
          class="bg-gray-200 rounded-md px-3 py-1 w-48"
          placeholder="Search..."
        >
        <button class="bg-blue-500 text-white rounded-md px-3 py-1">
          Search
        </button>
      </div>

      <button class="bg-white hover:bg-gray-200 text-slate-900 rounded-md px-3 py-1 border border-slate-900">
        Masuk
      </button>
      <button class="bg-white hover:bg-gray-200 text-slate-900 rounded-md px-3 py-1 border border-slate-900">
        Daftar
      </button>
    </div>

    <div class="flex items-center gap-2 md:hidden bg-gray-900 text-white px-3 py-2 rounded">
      <span class="text-sm">Masuk</span>
      <span>|</span>
      <span class="text-sm">Daftar</span> 

      <button id="menuBtn" class="ml-2">
        <svg xmlns="http://www.w3.org/2000/svg"
          class="h-7 w-7"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
          stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </div>

  </div> 

  <nav id="mobileMenu" class="hidden md:block bg-gray-900">
    <div class="px-4 md:px-44 py-3">
      <div class="fpx-44 flex justify-between bg-gray-900  gap-7 text-white">
        <a href="">Home</a>
        <a href="">Terbaru</a>
        <a href="">Bisnis</a>
        <a href="">Keuangan</a>
        <a href="">Teknologi</a>
        <a href="">Olahraga</a>
        <a href="">Hiburan</a>
        <a href="">Gaya Hidup</a>
      </div>
    </div>
  </nav>

</header>

<main class="px-4 md:px-44 py-10 min-h-screen">
  {{ $slot }}
</main>

<footer class="bg-gray-900 text-white">
  <div class="px-4 md:px-44 py-10 flex flex-col items-center gap-6 text-center">

    <h1 class="text-3xl md:text-4xl font-bold">FocusToday</h1>

    <div class="flex gap-4 flex-wrap justify-center">
      <div class="bg-amber-50 px-4 py-3 rounded-full text-black">IG</div>
      <div class="bg-amber-50 px-4 py-3 rounded-full text-black">FB</div>
      <div class="bg-amber-50 px-4 py-3 rounded-full text-black">X</div>
    </div>

    <div class="flex gap-4 flex-wrap justify-center text-sm">
      <a href="">About</a>
      <a href="">Terms of Services</a>
      <a href="">Privacy Policy</a>
      <a href="">Advertising</a>
      <a href="">Accessibility</a>
    </div>

    <p class="text-xs opacity-70">
      © FokusToday Media Network. All Right Reserved.
    </p>

  </div>
</footer>

<script>
  const btn = document.getElementById('menuBtn');
  const menu = document.getElementById('mobileMenu');

  btn.addEventListener('click', () => {
    menu.classList.toggle('hidden');
  });
</script>

</body>
</html>
