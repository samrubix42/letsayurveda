<header class="flex items-center justify-between h-20 px-6 bg-white border-b border-slate-200">
    
    <!-- Left: Hamburger (Mobile) & Search -->
    <div class="flex items-center gap-4 flex-1">
        <!-- Sidebar Toggle Button (Mobile Only) -->
        <button @click="sidebarOpen = true" class="text-slate-500 hover:text-slate-800 md:hidden p-1 rounded hover:bg-slate-100 active:scale-95 transition-transform" type="button">
            <span class="material-symbols-outlined text-2xl">menu</span>
        </button>

        <!-- Search Bar (Decorative) -->
        <div class="hidden sm:flex items-center gap-2 max-w-xs w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-slate-400">
            <span class="material-symbols-outlined text-sm">search</span>
            <input class="bg-transparent border-none text-xs outline-none text-slate-700 placeholder:text-slate-400 w-full focus:ring-0" placeholder="Search resources..." type="text"/>
        </div>
    </div>

    <!-- Right: Actions (Notification & Profile Dropdown) -->
    <div class="flex items-center gap-6">
        
        <!-- Notifications Bell (Decorative) -->
        <button class="relative text-slate-500 hover:text-slate-800 p-1 rounded hover:bg-slate-100 transition-all cursor-pointer">
            <span class="material-symbols-outlined text-2xl">notifications</span>
            <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-emerald-500 rounded-full border border-white"></span>
        </button>

        <!-- Admin Profile Dropdown (Alpine.js) -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" @click.outside="open = false" class="flex items-center gap-2 cursor-pointer focus:outline-none select-none group">
                <div class="w-10 h-10 rounded-full bg-emerald-600 text-white font-bold flex items-center justify-center border border-emerald-500 shadow-sm transition-transform active:scale-95">
                    A
                </div>
                <div class="hidden md:flex flex-col text-left">
                    <span class="text-sm font-semibold text-slate-800 leading-none group-hover:text-emerald-600 transition-colors">Administrator</span>
                    <span class="text-[10px] text-slate-400 mt-0.5 leading-none">Super Admin</span>
                </div>
                <span class="material-symbols-outlined text-sm text-slate-400 group-hover:text-slate-600 transition-colors">keyboard_arrow_down</span>
            </button>

            <!-- Dropdown Menu -->
            <div class="absolute right-0 mt-2 w-48 bg-white border border-slate-200 rounded-xl shadow-lg py-2 z-50 overflow-hidden"
                 x-cloak
                 x-show="open"
                 x-transition:enter="transition ease-out duration-100"
                 x-transition:enter-start="transform opacity-0 scale-95"
                 x-transition:enter-end="transform opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="transform opacity-100 scale-100"
                 x-transition:leave-end="transform opacity-0 scale-95">
                
                <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 transition-colors">
                    <span class="material-symbols-outlined text-sm text-slate-400">person</span>
                    <span>My Profile</span>
                </a>
                <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 transition-colors">
                    <span class="material-symbols-outlined text-sm text-slate-400">settings</span>
                    <span>Settings</span>
                </a>
                
                <hr class="border-slate-100 my-1"/>

                <form method="POST" action="/admin/logout" class="block w-full">
                    <button type="submit" class="flex w-full items-center gap-2 px-4 py-2 text-sm text-rose-600 hover:bg-rose-50 transition-colors text-left cursor-pointer">
                        <span class="material-symbols-outlined text-sm text-rose-500">logout</span>
                        <span>Sign Out</span>
                    </button>
                </form>

            </div>
        </div>

    </div>
</header>