<x-layout-base :title="$title">

    <div class="min-h-screen bg-gray-100 flex items-center justify-center px-4">

        <div class="bg-white w-full max-w-[420px] rounded-2xl shadow-xl px-7 py-8 text-center">

            <x-toast />

            {{ $slot }}

        </div>

    </div>

    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            password.type = password.type === 'password' ? 'text' : 'password';
        }

        function togglePasswordConfirmation() {
            const password = document.getElementById('password_confirmation');
            password.type = password.type === 'password' ? 'text' : 'password';
        }

        document.addEventListener('DOMContentLoaded', () => {
            const showToast = (message, type = 'success') => {
                setTimeout(() => {
                    window.dispatchEvent(new CustomEvent('notify', {
                        detail: {
                            message: message,
                            type: type
                        }
                    }));
                }, 500);
            };

            @if (session('success'))
                showToast("{{ session('success') }}", 'success');
            @endif

            @if (session('error'))
                showToast("{{ session('error') }}", 'error');
            @endif

            @if (session('status'))
                showToast("{{ session('status') }}", 'info');
            @endif

            @if ($errors->any())
                showToast("{{ $errors->first() }}", 'error');
            @endif
        });
    </script>

</x-layout-base>
