<div>
    <!-- Sidebar Outer Container -->
    <aside class="fixed inset-y-0 left-0 z-50 flex flex-col w-full md:w-72 border-r border-slate-200/80 bg-white shadow-xl shadow-slate-900/10 transition-transform duration-300 ease-out md:translate-x-0 md:static md:inset-auto"
           :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'">
        
        <!-- Gradient Accent Bar -->
        <div class="h-1 w-full bg-gradient-to-r from-emerald-500 via-emerald-600 to-teal-600"></div>
        
        <!-- Sidebar Header (Brand/Logo) -->
        <div class="flex h-20 items-center justify-between border-b border-slate-100 px-6">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.22em] text-emerald-600">LETS AYURVEDA</p>
                <h1 class="text-lg font-semibold text-slate-900">Admin Portal</h1>
            </div>
            <button @click="sidebarOpen = false" class="inline-flex h-10 w-10 items-center justify-center rounded-xl text-slate-400 hover:text-slate-700 md:hidden active:scale-95 transition-transform" type="button" aria-label="Close sidebar">
                <span class="material-symbols-outlined text-2xl">close</span>
            </button>
        </div>

        <!-- Sidebar Navigation Links -->
        <nav class="flex-1 px-3 py-4 space-y-1.5 overflow-y-auto no-scrollbar font-medium">
            
            <!-- Dashboard Link -->
            <a href="/admin/dashboard" 
               class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all {{ request()->is('admin/dashboard') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg border bg-white transition-all {{ request()->is('admin/dashboard') ? 'border-emerald-200 text-emerald-700' : 'border-slate-200 text-slate-500 group-hover:text-slate-800' }}">
                    <span class="material-symbols-outlined text-lg">dashboard</span>
                </span>
                <span>Dashboard</span>
            </a>

            <!-- Blog Categories Link -->
            <a href="/admin/blog/categories" 
               class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all {{ request()->is('admin/blog/categories*') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg border bg-white transition-all {{ request()->is('admin/blog/categories*') ? 'border-emerald-200 text-emerald-700' : 'border-slate-200 text-slate-500 group-hover:text-slate-800' }}">
                    <span class="material-symbols-outlined text-lg">category</span>
                </span>
                <span>Blog Categories</span>
            </a>

            <!-- Blogs Link (Placeholder) -->
            <a href="#" 
               class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all opacity-50 cursor-not-allowed">
                <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-400">
                    <span class="material-symbols-outlined text-lg">article</span>
                </span>
                <span>Blogs</span>
            </a>

            <!-- Settings Link (Placeholder) -->
            <a href="#" 
               class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all opacity-50 cursor-not-allowed">
                <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-400">
                    <span class="material-symbols-outlined text-lg">settings</span>
                </span>
                <span>Settings</span>
            </a>

        </nav>

        <!-- Sidebar Footer -->
        <div class="p-4 bg-slate-50/50 border-t border-slate-100">
            <a href="/" class="flex items-center justify-center gap-2 px-4 py-2.5 text-xs font-semibold uppercase tracking-wider text-slate-600 hover:text-slate-900 bg-slate-100 hover:bg-slate-200 rounded-xl transition-all">
                <span class="material-symbols-outlined text-base">home</span>
                <span>Back to Live Site</span>
            </a>
        </div>
    </aside>

    <!-- Sidebar Overlay Backdrop for Mobile -->
    <div @click="sidebarOpen = false" 
         class="fixed inset-0 z-40 bg-slate-900/45 backdrop-blur-[1px] md:hidden transition-opacity duration-300"
         x-cloak
         x-show="sidebarOpen"></div>
</div>