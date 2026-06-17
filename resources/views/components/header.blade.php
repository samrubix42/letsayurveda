<!-- Header Section (TopAppBar) -->
<header class="fixed top-0 w-full z-50 bg-background/80 backdrop-blur-md border-b border-outline-variant/10 shadow-sm h-20">
    <div class="max-w-[1440px] mx-auto h-full flex justify-between items-center px-margin-mobile md:px-margin-desktop">
        
        <!-- Left: Hamburger (Mobile) / Logo + Brand (Desktop & Mobile) -->
        <div class="flex items-center gap-4">
            <!-- Mobile Menu Toggle Button -->
            <button @click="mobileMenuOpen = true" class="md:hidden cursor-pointer active:scale-95 transition-transform text-primary flex items-center justify-center p-1 rounded-md hover:bg-surface-container">
                <span class="material-symbols-outlined text-2xl" data-icon="menu">menu</span>
            </button>
            
            <a href="/" class="flex items-center gap-3 active:scale-[0.98] transition-transform">
                <img src="/logo.png" alt="LetsAyurveda Logo" class="h-12 w-auto object-contain">
            </a>
        </div>
        
        <!-- Center: Desktop Navigation Links -->
        <nav class="hidden md:flex items-center gap-8 font-label-caps text-[11px] tracking-widest text-on-surface-variant font-medium">
            <a href="#shop" class="hover:text-secondary transition-colors duration-300">Shop</a>
            <a href="#about" class="hover:text-secondary transition-colors duration-300">About</a>
            <a href="#categories" class="hover:text-secondary transition-colors duration-300">Categories</a>
            <a href="#consultation" class="hover:text-secondary transition-colors duration-300">Consultation</a>
            <a href="#blog" class="hover:text-secondary transition-colors duration-300">Blog</a>
        </nav>
        
        <!-- Right: Actions (Search, Cart Drawer Trigger) -->
        <div class="flex items-center gap-4">
            <button class="cursor-pointer active:scale-95 transition-transform text-on-surface-variant hover:text-secondary transition-colors duration-300 p-2 rounded-full hover:bg-surface-container/50">
                <span class="material-symbols-outlined" data-icon="search">search</span>
            </button>
            
            <button @click="cartOpen = true" class="cursor-pointer active:scale-95 transition-transform text-primary relative p-2 rounded-full hover:bg-surface-container/50">
                <span class="material-symbols-outlined" data-icon="shopping_cart">shopping_cart</span>
                <span class="absolute top-1 right-1 bg-secondary text-white text-[9px] w-4 h-4 rounded-full flex items-center justify-center font-bold">2</span>
            </button>
        </div>
        
    </div>
</header>
