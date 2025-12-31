<x-layout-auth>
    <x-slot:title>Verifikasi Email - FokusToday</x-slot:title>

    <h1 class="text-2xl font-extrabold mb-2 text-black">
        Verifikasi Email
    </h1>

    <h2 class="text-sm font-semibold mb-1 text-black">
        Satu langkah lagi
    </h2>

    <p class="text-[11px] text-gray-600 mb-6 leading-snug">
        Kami telah mengirimkan link verifikasi ke email <strong>{{ auth()->user()->email }}</strong>.
        Silakan cek kotak masuk atau folder spam Anda.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 p-3 rounded-xl bg-green-50 border border-green-200 text-[11px] text-green-700">
            Link verifikasi baru telah dikirim ke alamat email Anda.
        </div>
    @endif

    <div class="space-y-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit"
                class="w-full h-10 rounded-xl bg-gray-800 text-white text-sm font-medium
                       hover:bg-black transition shadow-md">
                Kirim Ulang Email
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full h-10 rounded-xl bg-transparent border border-gray-400 text-black text-sm font-medium
                       hover:bg-gray-100 transition">
                Keluar
            </button>
        </form>
    </div>

    <p class="text-[10px] mt-6 text-center text-gray-500">
        Tidak menerima email? Pastikan cek folder spam.
    </p>

    <script>
        \
        setInterval(function() {

            fetch('/check-verification-status')
                .then(response => response.json())
                .then(data => {

                    if (data.verified) {

                        if (!data.onboarded) {
                            window.location.href = "{{ route('onboarding.index') }}";
                        } else {
                            window.location.href = "{{ route('home') }}";
                        }
                    }
                })
                .catch(error => console.error('Error checking status:', error));

        }, 3000);
    </script>
</x-layout-auth>
