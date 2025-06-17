<header class="bg-primary fixed w-full top-0 left-0 z-50 transition-all duration-300" x-data="{ open: false, scrolled: false }"
    @scroll.window="scrolled = window.pageYOffset > 50"
    :class="{ 'shadow-lg bg-opacity-95': scrolled, 'bg-opacity-90': !scrolled }">

    <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
        <div class="flex lg:flex-1">
            <a href="#" class="-m-1.5 p-1.5 font-bold text-3xl">
                <span><i>Goceng Peduli.</i></span>
            </a>
        </div>

        <!-- Tombol Menu Mobile -->
        <div class="flex lg:hidden">
            <button @click="open = true" type="button"
                class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>

        <!-- Menu Desktop -->
        <div class="hidden lg:flex lg:gap-x-12">
            <a href="#" class="text-sm/7 font-semibold text-gray-900">Home</a>
            <a href="#tata-cara-donasi" class="text-sm/7 font-semibold text-gray-900">Tata cara</a>
            <a href="#donasi" class="text-sm/7 font-semibold text-gray-900">Donasi</a>
        </div>

        <div class="hidden lg:flex lg:flex-1 lg:justify-end">

        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="fixed inset-0 z-10 bg-gray-900/50" x-show="open" x-transition.opacity x-cloak></div>

    <div class="fixed inset-y-0 right-0 z-20 w-64 bg-white shadow-lg transform transition-transform duration-300"
        x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-x-0"
        x-transition:leave-end="opacity-0 translate-x-full" x-cloak>
        <div class="p-6">
            <div class="flex justify-between">
                <a href="#" class="text-lg font-bold"><i>Goceng Peduli.</i></a>
                <button @click="open = false" class="text-gray-700">
                    <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <nav class="mt-6">
                <a href="#" class="block py-2 text-gray-900 hover:bg-gray-50 rounded-lg px-3">Home</a>
                <a href="#" class="block py-2 text-gray-900 hover:bg-gray-50 rounded-lg px-3">Tata Cara</a>
                <a href="#" class="block py-2 text-gray-900 hover:bg-gray-50 rounded-lg px-3">Donasi</a>
            </nav>
        </div>
    </div>
</header>
