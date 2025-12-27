<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>FokusToday - Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gray-100 flex items-center justify-center px-4">

  <!-- CARD -->
  <div class="
    bg-white
    w-full max-w-[380px]
    rounded-2xl
    shadow-xl
    px-7 py-8
    text-center
  ">

    <!-- TITLE -->
    <h1 class="text-2xl font-extrabold mb-2 text-black">
      FokusToday
    </h1>

    <h2 class="text-sm font-semibold mb-1 text-black">
      Selamat Datang
    </h2>

    <p class="text-[11px] text-gray-600 mb-6 leading-snug">
      Login ke FokusToday untuk melihat berita yang menarik
    </p>

    <!-- FORM -->
    <form class="space-y-3">

      <input
        type="email"
        placeholder="Email"
        class="w-full h-11 px-4 rounded-xl bg-gray-200 text-sm
               focus:outline-none focus:ring-2 focus:ring-black/30">

      <input
        type="password"
        placeholder="Password"
        class="w-full h-11 px-4 rounded-xl bg-gray-200 text-sm
               focus:outline-none focus:ring-2 focus:ring-black/30">

      <!-- REMEMBER -->
      <div class="flex items-center gap-2 text-[11px] text-black">
        <input type="checkbox" class="w-4 h-4">
        <span>Biarkan saya tetap masuk</span>
      </div>

      <!-- BUTTON -->
      <button
        type="submit"
        class="w-full h-10 rounded-xl bg-gray-300 text-sm font-medium
               hover:bg-gray-400 transition">
        Masuk
      </button>

    </form>

    <!-- DIVIDER -->
    <div class="flex items-center my-5">
      <div class="flex-1 h-px bg-gray-400"></div>
      <span class="px-3 text-[10px] text-black">OR</span>
      <div class="flex-1 h-px bg-gray-400"></div>
    </div>

    <!-- GOOGLE -->
    <button
      class="w-full h-11 rounded-xl bg-gray-200
             flex items-center justify-center gap-2 text-sm font-medium
             hover:bg-gray-300 transition">
      <img
        src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg"
        class="w-4 h-4"
        alt="Google">
      Lanjutkan dengan Google
    </button>

    <!-- REGISTER -->
    <p class="text-[11px] mt-5 text-black">
      Belum punya akun?
      <a href="#" class="text-blue-500 font-medium hover:underline">
        Daftar di sini
      </a>
    </p>

  </div>

</body>
</html>
