<div class="space-y-8 animate-fade-in-up">
    
    <!-- Welcome Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="font-headline-sm text-3xl font-bold text-slate-800 tracking-tight">System Overview</h1>
            <p class="text-sm text-slate-500 mt-1">Holistic health administration and content management dashboard.</p>
        </div>
        <div class="text-xs text-slate-400 font-semibold bg-white border border-slate-200 px-3.5 py-2 rounded-lg shadow-sm">
            LAST LOGIN: {{ now()->format('d M Y, h:i A') }}
        </div>
    </div>

    <!-- Quick Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- Stat Item 1: Blog Categories -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between group hover:shadow-md transition-shadow duration-300">
            <div class="space-y-2">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Blog Categories</span>
                <h3 class="text-3xl font-bold text-slate-800 tracking-tight">{{ $categoryCount }}</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center group-hover:bg-emerald-500 group-hover:text-white transition-all duration-300">
                <span class="material-symbols-outlined text-2xl">category</span>
            </div>
        </div>

        <!-- Stat Item 2: Published Blogs -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between group hover:shadow-md transition-shadow duration-300">
            <div class="space-y-2">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Active Blogs</span>
                <h3 class="text-3xl font-bold text-slate-800 tracking-tight">14</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center group-hover:bg-blue-500 group-hover:text-white transition-all duration-300">
                <span class="material-symbols-outlined text-2xl">article</span>
            </div>
        </div>

        <!-- Stat Item 3: Virtual Consultations -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between group hover:shadow-md transition-shadow duration-300">
            <div class="space-y-2">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Vaidya Sessions</span>
                <h3 class="text-3xl font-bold text-slate-800 tracking-tight">8</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-500 flex items-center justify-center group-hover:bg-indigo-500 group-hover:text-white transition-all duration-300">
                <span class="material-symbols-outlined text-2xl">medical_services</span>
            </div>
        </div>

        <!-- Stat Item 4: Compliance Status -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between group hover:shadow-md transition-shadow duration-300">
            <div class="space-y-2">
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">System Health</span>
                <h3 class="text-3xl font-bold text-slate-800 tracking-tight">100%</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center group-hover:bg-amber-500 group-hover:text-white transition-all duration-300">
                <span class="material-symbols-outlined text-2xl">verified_user</span>
            </div>
        </div>

    </div>

    <!-- Recent Activity & Status -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Column 1 & 2: Recent Operations -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                <h2 class="font-headline-sm text-lg font-bold text-slate-800">Recent Admin Activities</h2>
                <span class="text-xs font-bold text-emerald-500 bg-emerald-50 px-2 py-1 rounded">Live Logs</span>
            </div>
            <div class="divide-y divide-slate-100">
                
                <div class="flex items-start gap-4 p-6 hover:bg-slate-50/50 transition-colors">
                    <span class="material-symbols-outlined text-emerald-500 mt-0.5">add_circle</span>
                    <div class="flex-1 space-y-1">
                        <p class="text-sm font-semibold text-slate-800">Category Created</p>
                        <p class="text-xs text-slate-400">Created blog category "Kumkumadi Rituals" by admin.</p>
                    </div>
                    <span class="text-xs text-slate-400 font-medium">10 mins ago</span>
                </div>

                <div class="flex items-start gap-4 p-6 hover:bg-slate-50/50 transition-colors">
                    <span class="material-symbols-outlined text-amber-500 mt-0.5">update</span>
                    <div class="flex-1 space-y-1">
                        <p class="text-sm font-semibold text-slate-800">Post Modified</p>
                        <p class="text-xs text-slate-400">Updated "Dinacharya morning routine" header image.</p>
                    </div>
                    <span class="text-xs text-slate-400 font-medium">1 hr ago</span>
                </div>

                <div class="flex items-start gap-4 p-6 hover:bg-slate-50/50 transition-colors">
                    <span class="material-symbols-outlined text-blue-500 mt-0.5">schedule</span>
                    <div class="flex-1 space-y-1">
                        <p class="text-sm font-semibold text-slate-800">Vaidya Session Booked</p>
                        <p class="text-xs text-slate-400">Devika Sen confirmed consultation booking for 20 Jun.</p>
                    </div>
                    <span class="text-xs text-slate-400 font-medium">3 hrs ago</span>
                </div>

            </div>
        </div>

        <!-- Column 3: Quick Info Card -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-6">
            <h2 class="font-headline-sm text-lg font-bold text-slate-800 border-b border-slate-100 pb-4">Wellness Tip</h2>
            <div class="bg-emerald-50/50 p-4 rounded-xl border border-emerald-100 flex gap-3 text-left">
                <span class="material-symbols-outlined text-emerald-500 text-3xl font-variation-settings-'FILL'-1">psychology</span>
                <div>
                    <h4 class="text-sm font-bold text-emerald-800">Dhyana & Admin Balance</h4>
                    <p class="text-xs text-emerald-700/80 leading-relaxed mt-1">
                        Keep dashboard navigation clean and components decoupled. Professional admin panel structures ensure sustainable scalability.
                    </p>
                </div>
            </div>
            
            <div class="space-y-4">
                <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Quick Links</h3>
                <div class="grid grid-cols-2 gap-3">
                    <a href="/admin/blog/categories" class="flex flex-col items-center gap-2 p-4 bg-slate-50 border border-slate-100 rounded-xl hover:bg-slate-100 transition-colors text-slate-600 hover:text-slate-900 group">
                        <span class="material-symbols-outlined text-2xl group-hover:scale-115 transition-transform">category</span>
                        <span class="text-xs font-semibold">Categories</span>
                    </a>
                    <a href="/" class="flex flex-col items-center gap-2 p-4 bg-slate-50 border border-slate-100 rounded-xl hover:bg-slate-100 transition-colors text-slate-600 hover:text-slate-900 group">
                        <span class="material-symbols-outlined text-2xl group-hover:scale-115 transition-transform">visibility</span>
                        <span class="text-xs font-semibold">Live Site</span>
                    </a>
                </div>
            </div>

        </div>

    </div>

</div>