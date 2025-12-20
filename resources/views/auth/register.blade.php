<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>FokusToday - Daftar</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-gray-100">

  <!-- Card -->
  <div class="bg-white w-[360px] rounded-xl shadow-lg px-8 py-7 text-center">

    <!-- Logo -->
    <h1 class="text-2xl font-bold mb-2 text-gray-900">
      FokusToday
    </h1>

    <!-- Title -->
    <h2 class="text-sm font-semibold mb-1  text-gray-900">
      Buat akun Anda
    </h2>

    <!-- Subtitle -->
    <p class="text-[11px] text-gray-600 mb-5 leading-snug text-black">
      Daftar ke FokusToday untuk melihat berita yang menarik
    </p>

    <!-- Form -->
    <form class="space-y-3">
      <input
        type="text"
        placeholder="Nama"
        class="w-full h-11 px-4 rounded-xl border border-gray-400 text-sm focus:outline-none focus:border-gray-600">

      <input
        type="email"
        placeholder="Email" 
        class="w-full h-11 px-4 rounded-xl border border-gray-400 text-sm focus:outline-none focus:border-gray-600">

      <div class="relative">
        <input
          id="password"
          type="password"
          placeholder="Password"
          class="w-full h-11 px-4 pr-12 rounded-xl border border-gray-400 text-sm focus:outline-none focus:border-gray-600">

        <button
          type="button"
          onclick="togglePassword()"
          class="absolute inset-y-0 right-4 flex items-center text-gray-600"
        >
          <!-- EYE ICON -->
          <svg xmlns="http://www.w3.org/2000/svg"
            class="w-5 h-5" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
              stroke-width="2"
              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round"
              stroke-width="2"
              d="M2.458 12C3.732 7.943 7.523 5 12 5
                c4.478 0 8.268 2.943 9.542 7
                -1.274 4.057-5.064 7-9.542 7
                -4.477 0-8.268-2.943-9.542-7z"/>
          </svg>
        </button>
      </div>

      <button
        type="submit"
        class="w-full h-9 rounded-lg bg-gray-300 text-sm font-medium"
      >
        Daftar
      </button>
    </form>

    <!-- OR Divider -->
    <div class="flex items-center my-4">
      <div class="flex-1 h-px bg-gray-400"></div>
      <span class="px-3 text-[10px] text-black">OR</span>
      <div class="flex-1 h-px bg-gray-400"></div>
    </div>

    <!-- Google Button -->
    <button
      class="w-full h-11 rounded-xl border border-gray-400 bg-white flex items-center justify-center gap-2 text-sm text-black hover:bg-gray-50
         focus:outline-none focus:border-gray-600"
      >
      <img
        src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg"
        class="w-4 h-4"
        alt="Google"
      >

      Daftar dengan Google
    </button>

    <!-- Login -->
    <p class="text-[10px] mt-4 text-black">
      Belum punya akun?
      <a href="#" class="text-blue-500">Login Disini</a>
    </p>

  </div>

</body>
</html>
