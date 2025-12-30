<div x-data="{
    open: false,
    top: 0,
    left: 0,
    placement: 'bottom',

    toggle() {
        if (this.open) {
            this.open = false;
        } else {
            const button = $el.querySelector('button');
            const rect = button.getBoundingClientRect();

            const spaceBelow = window.innerHeight - rect.bottom;

            if (spaceBelow < 90) {
                this.placement = 'top';
                this.top = rect.top + window.scrollY;
            } else {
                this.placement = 'bottom';
                this.top = rect.bottom + window.scrollY;
            }

            this.left = rect.right - 160 + window.scrollX;

            this.open = true;
        }
    }
}" class="relative inline-block text-left">
    <button @click="toggle()" type="button"
        class="inline-flex items-center justify-center px-3 py-1.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
        <span>Aksi</span>
        <x-ri-arrow-up-s-line class="w-5 h-5 text-gray-700 ml-1 transition-transform duration-200"
            x-bind:class="open ? 'rotate-180' : ''" />
    </button>

    <template x-teleport="body">
        <div x-show="open" @click.outside="open = false" :style="`top: ${top}px; left: ${left}px`"
            :class="placement === 'top' ? '-translate-y-full -mt-1 origin-bottom-right' : 'mt-1 origin-top-right'"
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
            class="fixed z-50 w-40 bg-white rounded-md shadow-lg border border-gray-100 max-h-[250px] overflow-y-auto"
            style="display: none;">

            <div class="py-1 flex flex-col">
                {{ $slot }}
            </div>
        </div>
    </template>
</div>
