<template x-teleport="body">
    <div x-show="showModal" style="display: none" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/50 z-[77777] flex items-center justify-center p-4">

        <div @click.outside="showModal = false" x-show="showModal" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            class="bg-white rounded-lg shadow-xl w-full max-w-md p-6 relative">

            <div class="flex items-center justify-center w-12 h-12 mx-auto rounded-full mb-4 transition-colors duration-300"
                :class="{
                    'bg-red-100 text-red-600': modalType === 'danger',
                    'bg-yellow-100 text-yellow-600': modalType === 'warning',
                    'bg-green-100 text-green-600': modalType === 'success'
                }">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                    </path>
                </svg>
            </div>

            <div class="text-center">
                <h3 class="text-lg font-bold text-gray-900" x-text="modalTitle"></h3>
                <p class="text-sm text-gray-500 mt-2">
                    <span x-text="modalMessage"></span>
                </p>
            </div>

            <div class="mt-6 flex justify-center gap-3">
                <button @click="showModal = false" type="button"
                    class="px-4 py-2 bg-gray-200 text-gray-800 text-base font-medium rounded-md hover:bg-gray-300 transition cursor-pointer">
                    Batal
                </button>

                <form :action="modalUrl" method="POST">
                    @csrf

                    <input type="hidden" name="_method" :value="modalMethod">

                    <button type="submit"
                        class="px-4 py-2 text-white text-base font-medium rounded-md transition cursor-pointer"
                        :class="{
                            'bg-red-600 hover:bg-red-700': modalType === 'danger',
                            'bg-yellow-500 hover:bg-yellow-600': modalType === 'warning',
                            'bg-green-600 hover:bg-green-700': modalType === 'success'
                        }"
                        x-text="modalButtonText">
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>
