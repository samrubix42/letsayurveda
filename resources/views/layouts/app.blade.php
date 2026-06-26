<!DOCTYPE html>
<html class="scroll-smooth" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>LetsAyurveda | Timeless Wellness</title>
    <meta content="Ancient Ayurvedic wisdom for modern lives. Premium skincare, haircare, and wellness." name="description"/>
    <meta name="robots" content="noindex, nofollow"/>
    <!-- Preconnect to Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Playfair+Display:ital,wght@0,400..900;1,400..900&amp;display=swap" rel="stylesheet"/>
    
    <!-- Vite Assets (Includes compiled Tailwind CSS v4 & AlpineJS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-on-surface font-body-md" x-data="{ cartOpen: false, quickViewOpen: false, selectedProduct: null, dosha: null, mobileMenuOpen: false }">

    <!-- Header component -->
    <livewire:public.header />

    <!-- Main Page Content -->
    <main class="pt-20">
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    <!-- Footer component -->
    <livewire:public.footer />

    <!-- Mobile Slide-out Menu Drawer -->
    <div aria-labelledby="mobile-menu-title" aria-modal="true" class="fixed inset-0 z-[100]" role="dialog" x-cloak x-show="mobileMenuOpen"
         x-transition:enter="transition-opacity ease-linear duration-500"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-500"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        <div @click="mobileMenuOpen = false" class="absolute inset-0 bg-black/30 backdrop-blur-sm"
             x-transition:enter="ease-in-out duration-500"
             x-transition:enter-end="opacity-100"
             x-transition:enter-start="opacity-0"
             x-transition:leave="ease-in-out duration-500"
             x-transition:leave-end="opacity-0"
             x-transition:leave-start="opacity-100"></div>
        <div class="fixed inset-y-0 left-0 max-w-full flex">
            <div class="w-screen max-w-xs"
                 x-transition:enter="transform transition ease-in-out duration-500"
                 x-transition:enter-end="translate-x-0"
                 x-transition:enter-start="-translate-x-full"
                 x-transition:leave="transform transition ease-in-out duration-500"
                 x-transition:leave-end="-translate-x-full"
                 x-transition:leave-start="translate-x-0">
                <div class="h-full flex flex-col bg-surface shadow-2xl">
                    <div class="flex-1 py-6 overflow-y-auto px-margin-mobile">
                        <div class="flex items-center justify-between border-b border-outline-variant/30 pb-4">
                            <span class="font-display-lg text-display-lg-mobile text-primary font-bold">Menu</span>
                            <button @click="mobileMenuOpen = false" class="text-on-surface-variant cursor-pointer active:scale-95" type="button">
                                <span class="material-symbols-outlined" data-icon="close">close</span>
                            </button>
                        </div>
                        <nav class="mt-8 flex flex-col gap-6 font-label-caps text-label-caps tracking-widest text-primary text-lg">
                            <a @click="mobileMenuOpen = false" href="{{ route('products') }}" wire:navigate class="hover:text-secondary py-2 border-b border-outline-variant/10">Shop</a>
                            <a @click="mobileMenuOpen = false" href="#about" class="hover:text-secondary py-2 border-b border-outline-variant/10">About</a>
                            <a @click="mobileMenuOpen = false" href="#categories" class="hover:text-secondary py-2 border-b border-outline-variant/10">Categories</a>
                            <a @click="mobileMenuOpen = false" href="#consultation" class="hover:text-secondary py-2 border-b border-outline-variant/10">Consultation</a>
                            <a @click="mobileMenuOpen = false" href="{{ route('blogs') }}" wire:navigate class="hover:text-secondary py-2">Blog</a>

                            @auth
                                <div class="mt-4 pt-4 border-t border-outline-variant/20 flex flex-col gap-4 font-body-md text-sm text-slate-700">
                                    <a @click="mobileMenuOpen = false" href="{{ route('dashboard') }}" wire:navigate class="text-xs font-bold text-secondary hover:text-secondary/80 flex items-center gap-2"><span class="material-symbols-outlined text-lg">account_circle</span> {{ Auth::user()->name }}</a>
                                    @if(Auth::user()->is_admin)
                                        <a @click="mobileMenuOpen = false" href="{{ route('admin.dashboard') }}" wire:navigate class="hover:text-secondary py-2 font-bold flex items-center gap-2"><span class="material-symbols-outlined text-lg">dashboard</span> Admin Portal</a>
                                    @endif
                                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                                        @csrf
                                        <button type="submit" class="w-full text-left text-rose-600 hover:text-rose-700 py-2 font-bold flex items-center gap-2 cursor-pointer font-label-caps text-label-caps tracking-widest">
                                            <span class="material-symbols-outlined text-lg">logout</span> Sign Out
                                        </button>
                                    </form>
                                </div>
                            @else
                                <div class="mt-4 pt-4 border-t border-outline-variant/20 flex flex-col gap-4">
                                    <a @click="mobileMenuOpen = false" href="{{ route('login') }}" wire:navigate class="hover:text-secondary py-2 font-bold flex items-center gap-2"><span class="material-symbols-outlined text-lg">login</span> Sign In</a>
                                    <a @click="mobileMenuOpen = false" href="{{ route('register') }}" wire:navigate class="hover:text-secondary py-2 font-bold flex items-center gap-2"><span class="material-symbols-outlined text-lg">person_add</span> Register</a>
                                </div>
                            @endauth
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cart Drawer -->
    <div aria-labelledby="slide-over-title" aria-modal="true" class="fixed inset-0 z-[100]" role="dialog" x-cloak x-show="cartOpen"
         x-transition:enter="transition-opacity ease-linear duration-500"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-500"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        <div @click="cartOpen = false" class="absolute inset-0 bg-black/30 backdrop-blur-sm"
             x-transition:enter="ease-in-out duration-500"
             x-transition:enter-end="opacity-100"
             x-transition:enter-start="opacity-0"
             x-transition:leave="ease-in-out duration-500"
             x-transition:leave-end="opacity-0"
             x-transition:leave-start="opacity-100"></div>
        <div class="fixed inset-y-0 right-0 max-w-full flex">
            <div class="w-screen max-w-md"
                 x-transition:enter="transform transition ease-in-out duration-500"
                 x-transition:enter-end="translate-x-0"
                 x-transition:enter-start="translate-x-full"
                 x-transition:leave="transform transition ease-in-out duration-500"
                 x-transition:leave-end="translate-x-full"
                 x-transition:leave-start="translate-x-0">
                <livewire:public.cart />
            </div>
        </div>
    </div>

    <!-- Quick View Modal -->
    <div class="fixed inset-0 z-[110] flex items-center justify-center px-4" x-cloak x-show="quickViewOpen">
        <div @click="quickViewOpen = false" class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>
        <div class="relative bg-surface w-full max-w-md rounded-2xl overflow-hidden shadow-2xl"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-end="opacity-0 scale-95"
             x-transition:leave-start="opacity-100 scale-100">
            <button @click="quickViewOpen = false" class="absolute top-4 right-4 z-10 text-primary bg-white/80 rounded-full p-1 cursor-pointer active:scale-95">
                <span class="material-symbols-outlined" data-icon="close">close</span>
            </button>
            <div class="aspect-square bg-surface-container">
                <template x-if="selectedProduct?.image">
                    <img class="w-full h-full object-cover" :src="selectedProduct.image" :alt="selectedProduct.name"/>
                </template>
                <template x-if="!selectedProduct?.image">
                    <div class="w-full h-full flex items-center justify-center text-outline-variant">
                        <span class="material-symbols-outlined text-6xl">spa</span>
                    </div>
                </template>
            </div>
            <div class="p-6">
                <h2 class="font-headline-md text-headline-md text-primary mb-2" x-text="selectedProduct?.name"></h2>
                <p class="font-body-md text-on-surface-variant mb-6" x-text="selectedProduct?.desc"></p>
                <div class="flex items-center justify-between">
                    <span class="font-headline-sm text-headline-sm text-secondary" x-text="selectedProduct?.price"></span>
                    <button @click="$dispatch('add-to-cart', { productId: selectedProduct.id }); quickViewOpen = false; cartOpen = true" class="bg-primary hover:bg-primary-container text-white px-6 py-3 rounded-full font-label-caps text-[10px] tracking-widest active:scale-95 transition-transform cursor-pointer">
                        ADD TO CART
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Vaidya (Doctor) Consultation Badge -->
    <a href="#consultation" class="fixed bottom-6 right-6 z-40 flex items-center gap-3 bg-white border border-outline-variant/30 text-primary pl-3 pr-5 py-2.5 rounded-full shadow-2xl hover:shadow-emerald-900/10 active:scale-95 transition-all duration-300 group hover:bg-surface-container-low" title="Consult a Vaidya">
        <div class="relative">
            <!-- Doctor Avatar Image -->
            <div class="w-10 h-10 rounded-full overflow-hidden bg-primary-container flex items-center justify-center border border-secondary/20 shadow-inner">
                <img src="/doctor-avatar.png" alt="Vaidya Online" class="w-full h-full object-cover">
            </div>
            <!-- Online Pulsing Badge -->
            <span class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full ring-2 ring-white bg-emerald-500 animate-pulse"></span>
        </div>
        <div class="flex flex-col text-left">
            <span class="text-[9px] font-label-caps text-secondary font-bold tracking-widest leading-none">ONLINE VAIDYA</span>
            <span class="text-xs font-bold text-primary leading-tight mt-0.5 group-hover:text-secondary transition-colors">Consult Doctor</span>
        </div>
    </a>
</body>
</html>
