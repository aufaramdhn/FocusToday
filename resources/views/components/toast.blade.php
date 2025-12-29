<div x-data="{
    toasts: [],
    add(event) {
        const id = Date.now();
        const duration = 3000;

        this.toasts.push({
            id: id,
            message: event.detail.message,
            type: event.detail.type || 'success',
            show: true,
            percent: 100
        });

        setTimeout(() => {
            this.remove(id);
        }, duration + 300);
    },
    remove(id) {
        const index = this.toasts.findIndex(t => t.id === id);
        if (index > -1) {
            this.toasts[index].show = false;
            setTimeout(() => {
                this.toasts = this.toasts.filter(t => t.id !== id);
            }, 300);
        }
    }
}" @notify.window="add($event)"
    class="fixed top-4 right-0 md:right-4 z-50 flex flex-col gap-2 w-full md:w-[400px] px-4 md:px-0 pointer-events-none">

    <template x-for="toast in toasts" :key="toast.id">
        <div x-show="toast.show" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-x-0 opacity-100"
            x-transition:leave-end="translate-x-full opacity-0"
            class="pointer-events-auto relative overflow-hidden w-full bg-white rounded-lg shadow-lg border-l-4"
            :class="{
                'border-green-500': toast.type === 'success',
                'border-red-500': toast.type === 'error',
                'border-blue-500': toast.type === 'info',
                'border-yellow-500': toast.type === 'warning'
            }">

            <div class="p-4 flex items-start gap-3">
                <div class="flex-shrink-0">
                    <template x-if="toast.type === 'success'">
                        <x-ri-checkbox-circle-fill class="w-6 h-6 text-green-500" />
                    </template>
                    <template x-if="toast.type === 'error'">
                        <x-ri-error-warning-fill class="w-6 h-6 text-red-500" />
                    </template>
                    <template x-if="toast.type === 'info'">
                        <x-ri-information-fill class="w-6 h-6 text-blue-500" />
                    </template>
                    <template x-if="toast.type === 'warning'">
                        <x-ri-alert-fill class="w-6 h-6 text-yellow-500" />
                    </template>
                </div>

                <div class="flex-1 pt-0.5">
                    <p class="text-sm font-medium text-gray-900" x-text="toast.message"></p>
                </div>

                <button @click="remove(toast.id)" class="text-gray-400 hover:text-gray-600 transition">
                    <x-ri-close-line class="w-5 h-5" />
                </button>
            </div>

            <div x-data="{ width: 100 }" x-init="setTimeout(() => { width = 0 }, 100)"
                class="h-1 absolute bottom-0 left-0 transition-all ease-linear duration-[3000ms]"
                :style="`width: ${width}%`"
                :class="{
                    'bg-green-500': toast.type === 'success',
                    'bg-red-500': toast.type === 'error',
                    'bg-blue-500': toast.type === 'info',
                    'bg-yellow-500': toast.type === 'warning'
                }">
            </div>
        </div>
    </template>
</div>
