<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FokusToday - Daftar</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-gray-100 px-4">

  <div
    class="
      bg-white w-full max-w-[360px] md:max-w-[420px] rounded-xl shadow-lg 
      px-6 md:px-8 py-6 md:py-8 text-center">

    <h1 class="text-2xl md:text-3xl font-bold mb-2 text-gray-900">
      FokusToday
    </h1>

    <h2 class="text-sm md:text-base font-semibold mb-1 text-gray-900">
      Buat akun Anda
    </h2>

    <p class="text-[11px] md:text-xs text-gray-600 mb-5 leading-snug">
      Daftar ke FokusToday untuk melihat berita yang menarik
    </p>

    <form class="space-y-3 text-left">

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
          class="absolute inset-y-0 right-4 flex items-center text-gray-600">

          <svg xmlns="http://www.w3.org/2000/svg"
            class="w-5 h-5"
            fill="none"
            viewBox="0 0 24 24"
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
        class="w-full h-10 rounded-lg bg-gray-300 text-sm font-medium hover:bg-gray-400 transition">
        Daftar
      </button>

    </form>

    <div class="flex items-center my-4">
      <div class="flex-1 h-px bg-gray-400"></div>
      <span class="px-3 text-[10px] md:text-xs text-gray-700">OR</span>
      <div class="flex-1 h-px bg-gray-400"></div>
    </div>

    <button
      class="w-full h-11 rounded-xl border border-gray-400 bg-white flex items-center justify-center gap-2
        text-sm hover:bg-gray-50 transition">
      <img
        src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg"
        class="w-4 h-4"
        alt="Google">
      Daftar dengan Google
    </button>

    <p class="text-[10px] md:text-xs mt-4 text-gray-700">
      Sudah punya akun?
      <a href="#" class="text-blue-500 font-medium">Login di sini</a>
    </p>

  </div>

  <script>
    function togglePassword() {
      const password = document.getElementById('password');
      password.type = password.type === 'password' ? 'text' : 'password';
    }
  </script>

</body>
</html>
