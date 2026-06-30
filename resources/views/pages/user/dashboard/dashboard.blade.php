<div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-desktop py-12 animate-fade-in-up" 
     x-data="{ activeTab: 'overview' }">

    <!-- Welcome Header Banner -->
    <div class="bg-gradient-to-r from-primary-fixed to-surface-container border border-outline-variant/30 rounded-3xl p-6 md:p-8 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
        <div class="space-y-2">
            <span class="font-label-caps text-xs text-secondary font-bold tracking-widest uppercase">YOUR AYURVEDIC RETREAT</span>
            <h1 class="font-display-lg text-2xl md:text-3xl text-primary font-bold">Welcome back, {{ $user->name }}</h1>
            <p class="text-sm text-on-surface-variant max-w-xl">Find balance and harmony in your daily wellness journey. Manage your products, consultation requests, and track your wellness orders below.</p>
        </div>
        <div class="flex items-center gap-4 bg-white/60 backdrop-blur px-5 py-3 rounded-2xl border border-outline-variant/20 self-start md:self-auto shrink-0">
            <div class="h-10 w-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                <span class="material-symbols-outlined">calendar_today</span>
            </div>
            <div>
                <p class="text-[10px] font-label-caps text-secondary font-bold uppercase tracking-wider">TODAY</p>
                <p class="text-sm font-semibold text-slate-800">{{ now()->format('F d, Y') }}</p>
            </div>
        </div>
    </div>

    <!-- Main Dashboard Grid Layout -->
    <div class="flex flex-col lg:flex-row gap-8 items-start">
        
        <!-- Sidebar Navigation -->
        <div class="w-full lg:w-64 shrink-0 space-y-6">
            
            <!-- User Info Card -->
            <div class="bg-white border border-outline-variant/30 rounded-3xl p-6 shadow-sm flex flex-col items-center text-center space-y-3">
                <div class="h-16 w-16 rounded-full bg-primary/5 border border-outline-variant/30 flex items-center justify-center text-primary relative">
                    <span class="material-symbols-outlined text-4xl text-primary-container">account_circle</span>
                    <span class="absolute bottom-0 right-0 h-3.5 w-3.5 bg-emerald-500 rounded-full border-2 border-white"></span>
                </div>
                <div class="space-y-0.5">
                    <h3 class="font-display-lg text-base text-primary font-bold">{{ $user->name }}</h3>
                    <p class="text-xs text-on-surface-variant/80 truncate max-w-[200px]">{{ $user->email }}</p>
                </div>
                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-[10px] font-semibold bg-primary-fixed text-primary border border-primary/10">
                    <span class="material-symbols-outlined text-[12px] fill-icon text-secondary">eco</span>
                    <span>Sadhaka Member</span>
                </span>
            </div>

            <!-- Desktop Navigation Menu -->
            <div class="hidden lg:block bg-white border border-outline-variant/30 rounded-3xl p-4 shadow-sm space-y-1">
                <button @click="activeTab = 'overview'" 
                        :class="activeTab === 'overview' ? 'bg-primary text-white' : 'text-slate-700 hover:bg-slate-50'"
                        class="w-full text-left px-4 py-3 rounded-2xl font-semibold text-xs transition-all flex items-center gap-3 cursor-pointer">
                    <span class="material-symbols-outlined text-lg">dashboard</span>
                    <span>Dashboard Overview</span>
                </button>
                <button @click="activeTab = 'orders'" 
                        :class="activeTab === 'orders' ? 'bg-primary text-white' : 'text-slate-700 hover:bg-slate-50'"
                        class="w-full text-left px-4 py-3 rounded-2xl font-semibold text-xs transition-all flex items-center gap-3 cursor-pointer">
                    <span class="material-symbols-outlined text-lg">shopping_bag</span>
                    <span>Wellness Orders</span>
                </button>
                <button @click="activeTab = 'addresses'" 
                        :class="activeTab === 'addresses' ? 'bg-primary text-white' : 'text-slate-700 hover:bg-slate-50'"
                        class="w-full text-left px-4 py-3 rounded-2xl font-semibold text-xs transition-all flex items-center gap-3 cursor-pointer">
                    <span class="material-symbols-outlined text-lg">home_pin</span>
                    <span>Saved Addresses</span>
                </button>
                <button @click="activeTab = 'profile'" 
                        :class="activeTab === 'profile' ? 'bg-primary text-white' : 'text-slate-700 hover:bg-slate-50'"
                        class="w-full text-left px-4 py-3 rounded-2xl font-semibold text-xs transition-all flex items-center gap-3 cursor-pointer">
                    <span class="material-symbols-outlined text-lg">person</span>
                    <span>Profile Settings</span>
                </button>
                <button @click="activeTab = 'consultation'" 
                        :class="activeTab === 'consultation' ? 'bg-primary text-white' : 'text-slate-700 hover:bg-slate-50'"
                        class="w-full text-left px-4 py-3 rounded-2xl font-semibold text-xs transition-all flex items-center gap-3 cursor-pointer">
                    <span class="material-symbols-outlined text-lg">support_agent</span>
                    <span>Vaidya Consultation</span>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div class="lg:hidden w-full overflow-x-auto no-scrollbar border-b border-outline-variant/30 flex gap-2 pb-2 mb-2">
            <button @click="activeTab = 'overview'" 
                    :class="activeTab === 'overview' ? 'bg-primary text-white border-primary' : 'bg-white text-slate-700 border-outline-variant/30'"
                    class="shrink-0 px-4 py-2 rounded-full border font-semibold text-xs transition-all flex items-center gap-2 cursor-pointer">
                <span class="material-symbols-outlined text-sm">dashboard</span>
                <span>Overview</span>
            </button>
            <button @click="activeTab = 'orders'" 
                    :class="activeTab === 'orders' ? 'bg-primary text-white border-primary' : 'bg-white text-slate-700 border-outline-variant/30'"
                    class="shrink-0 px-4 py-2 rounded-full border font-semibold text-xs transition-all flex items-center gap-2 cursor-pointer">
                <span class="material-symbols-outlined text-sm">shopping_bag</span>
                <span>Orders</span>
            </button>
            <button @click="activeTab = 'addresses'" 
                    :class="activeTab === 'addresses' ? 'bg-primary text-white border-primary' : 'bg-white text-slate-700 border-outline-variant/30'"
                    class="shrink-0 px-4 py-2 rounded-full border font-semibold text-xs transition-all flex items-center gap-2 cursor-pointer">
                <span class="material-symbols-outlined text-sm">home_pin</span>
                <span>Addresses</span>
            </button>
            <button @click="activeTab = 'profile'" 
                    :class="activeTab === 'profile' ? 'bg-primary text-white border-primary' : 'bg-white text-slate-700 border-outline-variant/30'"
                    class="shrink-0 px-4 py-2 rounded-full border font-semibold text-xs transition-all flex items-center gap-2 cursor-pointer">
                <span class="material-symbols-outlined text-sm">person</span>
                <span>Profile</span>
            </button>
            <button @click="activeTab = 'consultation'" 
                    :class="activeTab === 'consultation' ? 'bg-primary text-white border-primary' : 'bg-white text-slate-700 border-outline-variant/30'"
                    class="shrink-0 px-4 py-2 rounded-full border font-semibold text-xs transition-all flex items-center gap-2 cursor-pointer">
                <span class="material-symbols-outlined text-sm">support_agent</span>
                <span>Consultation</span>
            </button>
        </div>

        <!-- Main Content Pane -->
        <div class="flex-1 w-full space-y-8 min-w-0">
            
            <!-- 1. OVERVIEW TAB -->
            <div x-show="activeTab === 'overview'" x-transition class="space-y-8">
                
                <!-- Quick Stats Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div class="bg-white border border-outline-variant/30 rounded-2xl p-5 flex items-center gap-4 shadow-sm hover:shadow-md transition-shadow">
                        <div class="h-12 w-12 rounded-xl bg-primary/5 flex items-center justify-center text-primary shrink-0">
                            <span class="material-symbols-outlined text-2xl text-primary">shopping_bag</span>
                        </div>
                        <div>
                            <p class="text-xs text-on-surface-variant font-medium">Wellness Orders</p>
                            <p class="text-lg font-bold text-slate-800">2 Orders</p>
                        </div>
                    </div>
                        <div>
                            <p class="text-xs text-on-surface-variant font-medium">Saved Addresses</p>
                            <p class="text-lg font-bold text-slate-800">{{ $user->addresses->count() }} Saved</p>
                        </div>
                    <div class="bg-white border border-outline-variant/30 rounded-2xl p-5 flex items-center gap-4 shadow-sm hover:shadow-md transition-shadow">
                        <div class="h-12 w-12 rounded-xl bg-amber-500/5 flex items-center justify-center text-amber-700 shrink-0">
                            <span class="material-symbols-outlined text-2xl text-amber-700">eco</span>
                        </div>
                        <div>
                            <p class="text-xs text-on-surface-variant font-medium">Loyalty Points</p>
                            <p class="text-lg font-bold text-slate-800">250 PTS</p>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders -->
                <div class="bg-white border border-outline-variant/30 rounded-3xl shadow-sm p-6 md:p-8 space-y-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-secondary text-xl">local_shipping</span>
                            <h2 class="font-headline-md text-lg md:text-xl text-primary font-bold">Recent Wellness Orders</h2>
                        </div>
                        <button @click="activeTab = 'orders'" class="text-xs font-semibold text-secondary hover:text-secondary/80 hover:underline transition-all cursor-pointer">View All</button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-sm">
                            <thead>
                                <tr class="border-b border-outline-variant/40 text-on-surface-variant font-label-caps text-xs tracking-wider">
                                    <th class="py-3 font-semibold">Order ID</th>
                                    <th class="py-3 font-semibold">Date</th>
                                    <th class="py-3 font-semibold">Status</th>
                                    <th class="py-3 font-semibold text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant/10 text-slate-700">
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="py-4 font-semibold text-primary">#LA-4829</td>
                                    <td class="py-4">June 24, 2026</td>
                                    <td class="py-4">
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Delivered
                                        </span>
                                    </td>
                                    <td class="py-4 text-right font-bold text-slate-800">₹2,540.00</td>
                                </tr>
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="py-4 font-semibold text-primary">#LA-4712</td>
                                    <td class="py-4">May 15, 2026</td>
                                    <td class="py-4">
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Delivered
                                        </span>
                                    </td>
                                    <td class="py-4 text-right font-bold text-slate-800">₹1,850.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Personalized Routine Recommendations -->
                <div class="bg-white border border-outline-variant/30 rounded-3xl shadow-sm p-6 md:p-8 space-y-6">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary text-xl">eco</span>
                        <h2 class="font-headline-md text-lg md:text-xl text-primary font-bold">Recommended for Your Routine</h2>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="border border-outline-variant/20 rounded-2xl p-4 flex gap-4 hover:shadow-md transition-all bg-slate-50/20">
                            <div class="w-16 h-16 bg-surface-container rounded-xl overflow-hidden shrink-0">
                                <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCaGcUHN_hSef4gbPhjwzrWRlF0VQd9mLMoo7bW_ZzvQqgUT6Mm2_btdPirXAUqgrhTaj5ZaMUZJNh_LhycWfK4RLmgi9n53hCH25gGLekBSSwDObkIW1O7PNN_gH0H0rWzDa2dNVRus-hHpHlZFLlUK7Smk9P0I5pTGDc7jurdCQALUXRzHToMOKAybjuQiIuK480TVeKqeyg_f3We_YwLzOPnrS95cdkqJd78qU470nXLRukT5ZVzg2k8Pg6EU7yMYqD123jAlCr1" alt="Radiance Face Oil"/>
                            </div>
                            <div class="flex flex-col justify-between py-0.5">
                                <div>
                                    <h3 class="font-bold text-primary text-xs">Radiance Face Oil</h3>
                                    <p class="text-[10px] text-on-surface-variant">Best for Vata skin types.</p>
                                </div>
                                <span class="text-xs font-bold text-secondary">₹1,850</span>
                            </div>
                        </div>
                        
                        <div class="border border-outline-variant/20 rounded-2xl p-4 flex gap-4 hover:shadow-md transition-all bg-slate-50/20">
                            <div class="w-16 h-16 bg-surface-container rounded-xl overflow-hidden shrink-0">
                                <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBQV7B1p6XZu46rVb_AKL5PvxUBWaqsj45IOBRHc-YNHFSxGRtukQMVZ_-9zDf1N7FGDsIeIV63t4STcavH_jtBrdCG6oEyKRN1rGhLXYPfBN9i_2lJgZ8o5tAmoNwsm4srlJaQ2RFco2B4f5wi5FQcJBtgqpsRzIN7YsKqDKSONvndofnY2arxv7CiKzMO0WmKWNVvW4hHkvKsfMQBRQiCSrCQPw_JF_-v2kFtrlBi4KLmfugFnaBzXrx_oTP_vx2BXNMPBRDEazLQ" alt="Vata Balancing Balm"/>
                            </div>
                            <div class="flex flex-col justify-between py-0.5">
                                <div>
                                    <h3 class="font-bold text-primary text-xs">Vata Balancing Balm</h3>
                                    <p class="text-[10px] text-on-surface-variant">Calming hydration balm.</p>
                                </div>
                                <span class="text-xs font-bold text-secondary">₹690</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- 2. ORDERS TAB -->
            <div x-show="activeTab === 'orders'" x-transition class="space-y-6" x-data="{ filterStatus: 'all', orderSearch: '' }">
                <div class="bg-white border border-outline-variant/30 rounded-3xl p-6 md:p-8 space-y-6 shadow-sm">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-outline-variant/10">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-secondary text-xl">local_shipping</span>
                            <h2 class="font-headline-md text-lg md:text-xl text-primary font-bold">Wellness Order History</h2>
                        </div>

                        <div class="flex items-center gap-1.5 bg-slate-100 p-1 rounded-xl shrink-0 self-start sm:self-auto">
                            <button @click="filterStatus = 'all'" :class="filterStatus === 'all' ? 'bg-white shadow text-primary font-semibold' : 'text-slate-650'" class="px-3 py-1.5 rounded-lg text-xs transition-all cursor-pointer">All</button>
                            <button @click="filterStatus = 'processing'" :class="filterStatus === 'processing' ? 'bg-white shadow text-primary font-semibold' : 'text-slate-650'" class="px-3 py-1.5 rounded-lg text-xs transition-all cursor-pointer">Processing</button>
                            <button @click="filterStatus = 'delivered'" :class="filterStatus === 'delivered' ? 'bg-white shadow text-primary font-semibold' : 'text-slate-650'" class="px-3 py-1.5 rounded-lg text-xs transition-all cursor-pointer">Delivered</button>
                        </div>
                    </div>

                    <!-- Search and filters -->
                    <div class="relative max-w-xs">
                        <span class="material-symbols-outlined text-slate-400 absolute left-3 top-1/2 -translate-y-1/2 text-base">search</span>
                        <input type="text" x-model="orderSearch" placeholder="Search by Order ID..." class="w-full bg-slate-50/50 border border-outline-variant/30 rounded-xl pl-9 pr-4 py-2 text-xs text-slate-800 focus:outline-none focus:border-primary focus:bg-white transition-all">
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-sm">
                            <thead>
                                <tr class="border-b border-outline-variant/30 text-on-surface-variant font-label-caps text-xs tracking-wider">
                                    <th class="py-3 font-semibold">Order ID</th>
                                    <th class="py-3 font-semibold">Date</th>
                                    <th class="py-3 font-semibold">Status</th>
                                    <th class="py-3 font-semibold text-right">Total</th>
                                    <th class="py-3 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant/10 text-slate-700">
                                <tr x-show="(filterStatus === 'all' || filterStatus === 'delivered') && ('#la-4829'.includes(orderSearch.toLowerCase()))" class="hover:bg-slate-50/50 transition-colors">
                                    <td class="py-4 font-semibold text-primary">#LA-4829</td>
                                    <td class="py-4 text-xs">June 24, 2026</td>
                                    <td class="py-4">
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Delivered
                                        </span>
                                    </td>
                                    <td class="py-4 text-right font-bold text-slate-800">₹2,540.00</td>
                                    <td class="py-4 text-right">
                                        <button class="text-xs font-semibold text-secondary hover:underline cursor-pointer">Track Order</button>
                                    </td>
                                </tr>
                                <tr x-show="(filterStatus === 'all' || filterStatus === 'delivered') && ('#la-4712'.includes(orderSearch.toLowerCase()))" class="hover:bg-slate-50/50 transition-colors">
                                    <td class="py-4 font-semibold text-primary">#LA-4712</td>
                                    <td class="py-4 text-xs">May 15, 2026</td>
                                    <td class="py-4">
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Delivered
                                        </span>
                                    </td>
                                    <td class="py-4 text-right font-bold text-slate-800">₹1,850.00</td>
                                    <td class="py-4 text-right">
                                        <button class="text-xs font-semibold text-secondary hover:underline cursor-pointer">Track Order</button>
                                    </td>
                                </tr>
                                <tr x-show="(filterStatus === 'all' || filterStatus === 'processing') && ('#la-4910'.includes(orderSearch.toLowerCase()))" class="hover:bg-slate-50/50 transition-colors" style="display: none;">
                                    <td class="py-4 font-semibold text-primary">#LA-4910</td>
                                    <td class="py-4 text-xs">June 29, 2026</td>
                                    <td class="py-4">
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-100">
                                            <span class="h-1.5 w-1.5 rounded-full bg-amber-500 animate-pulse"></span> Processing
                                        </span>
                                    </td>
                                    <td class="py-4 text-right font-bold text-slate-800">₹3,450.00</td>
                                    <td class="py-4 text-right">
                                        <button class="text-xs font-semibold text-secondary hover:underline cursor-pointer">Track Order</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- 3. SAVED ADDRESSES TAB -->
            <div x-show="activeTab === 'addresses'" x-transition class="space-y-6">
                <livewire:user.address />
            </div>

            <!-- 4. PROFILE SETTINGS TAB -->
            <div x-show="activeTab === 'profile'" x-transition class="space-y-6">
                <div class="bg-white border border-outline-variant/30 rounded-3xl p-6 md:p-8 space-y-8 shadow-sm">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary text-xl">person</span>
                        <h2 class="font-headline-md text-lg md:text-xl text-primary font-bold">Profile Details & Settings</h2>
                    </div>

                    <form @submit.prevent="alert('Profile updates are currently locked in this demo.')" class="space-y-6 max-w-xl">
                        <!-- Personal Information -->
                        <div class="space-y-4">
                            <h3 class="font-headline-sm text-xs text-secondary font-bold uppercase tracking-wider">Personal Information</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label class="block text-xs font-semibold text-slate-700">Full Name</label>
                                    <input type="text" value="{{ $user->name }}" class="w-full bg-slate-50/50 border border-outline-variant/30 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none focus:border-primary focus:bg-white transition-all">
                                </div>
                                <div class="space-y-1">
                                    <label class="block text-xs font-semibold text-slate-700">Email Address</label>
                                    <input type="email" value="{{ $user->email }}" disabled class="w-full bg-slate-100 border border-outline-variant/30 rounded-xl px-4 py-3 text-sm text-slate-450 cursor-not-allowed">
                                    <span class="text-[10px] text-on-surface-variant/70">Contact support to change verified email.</span>
                                </div>
                            </div>
                        </div>

                        <hr class="border-outline-variant/10">

                        <!-- Password Change -->
                        <div class="space-y-4">
                            <h3 class="font-headline-sm text-xs text-secondary font-bold uppercase tracking-wider">Change Password</h3>
                            <div class="grid grid-cols-1 gap-4">
                                <div class="space-y-1">
                                    <label class="block text-xs font-semibold text-slate-700">Current Password</label>
                                    <input type="password" placeholder="••••••••" class="w-full bg-slate-50/50 border border-outline-variant/30 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none focus:border-primary focus:bg-white transition-all">
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="space-y-1">
                                        <label class="block text-xs font-semibold text-slate-700">New Password</label>
                                        <input type="password" placeholder="Minimum 8 characters" class="w-full bg-slate-50/50 border border-outline-variant/30 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none focus:border-primary focus:bg-white transition-all">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="block text-xs font-semibold text-slate-700">Confirm New Password</label>
                                        <input type="password" placeholder="Re-type new password" class="w-full bg-slate-50/50 border border-outline-variant/30 rounded-xl px-4 py-3 text-sm text-slate-800 focus:outline-none focus:border-primary focus:bg-white transition-all">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action -->
                        <div class="pt-2">
                            <button type="submit" class="bg-primary hover:bg-primary/95 text-white font-semibold text-xs tracking-wider px-6 py-3.5 rounded-xl transition-all cursor-pointer">
                                SAVE CHANGES
                            </button>
                        </div>
                    </form>

                    <div class="pt-6 border-t border-outline-variant/10 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm">Sign Out of Portal</h4>
                            <p class="text-xs text-on-surface-variant">Sign out from your active session on this device.</p>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="shrink-0">
                            @csrf
                            <button type="submit" class="bg-rose-50 hover:bg-rose-100 text-rose-600 font-semibold text-xs tracking-wider px-5 py-3 rounded-xl transition-all cursor-pointer flex items-center gap-2 border border-rose-150 shadow-sm">
                                <span class="material-symbols-outlined text-sm">logout</span>
                                <span>SIGN OUT PORTAL</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- 5. CONSULTATION TAB -->
            <div x-show="activeTab === 'consultation'" x-transition class="space-y-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <!-- Main Consultation Info -->
                    <div class="lg:col-span-2 bg-white border border-outline-variant/30 rounded-3xl p-6 md:p-8 space-y-6 shadow-sm">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-secondary text-xl">support_agent</span>
                            <h2 class="font-headline-md text-lg md:text-xl text-primary font-bold">Ayurvedic Doctor Consultation</h2>
                        </div>
                        
                        <p class="text-xs text-slate-600 leading-relaxed">Connect with our team of certified Ayurvedic Vaidyas to discover your unique constitution (Prakriti), diagnose physical/mental imbalances (Vikriti), and design a personalized diet, herbs, and yoga plan tailored specifically for you.</p>

                        <!-- Feature Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                            <div class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-secondary bg-secondary/5 p-2 rounded-xl text-base">spa</span>
                                <div>
                                    <h4 class="font-bold text-slate-800 text-xs">Prakriti Analysis</h4>
                                    <p class="text-[10px] text-on-surface-variant mt-0.5">Determine your dominant Vata, Pitta, or Kapha Doshas.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-secondary bg-secondary/5 p-2 rounded-xl text-base">assignment</span>
                                <div>
                                    <h4 class="font-bold text-slate-800 text-xs">Tailored Herbs & Oils</h4>
                                    <p class="text-[10px] text-on-surface-variant mt-0.5">Receive custom recommendations of specific herbs, oils, and balms.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-secondary bg-secondary/5 p-2 rounded-xl text-base">video_camera_front</span>
                                <div>
                                    <h4 class="font-bold text-slate-800 text-xs">1-on-1 Video Session</h4>
                                    <p class="text-[10px] text-on-surface-variant mt-0.5">Direct 30-minute private consultation with an experienced Vaidya.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-secondary bg-secondary/5 p-2 rounded-xl text-base">chat</span>
                                <div>
                                    <h4 class="font-bold text-slate-800 text-xs">Post-Session Chat Support</h4>
                                    <p class="text-[10px] text-on-surface-variant mt-0.5">Two weeks of text chat follow-up with our support team.</p>
                                </div>
                            </div>
                        </div>

                        <hr class="border-outline-variant/10">

                        <!-- Package selection -->
                        <div class="space-y-4">
                            <h3 class="font-headline-sm text-xs text-secondary font-bold uppercase tracking-wider">Select Consultation Package</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="border-2 border-primary bg-primary/5 rounded-2xl p-5 flex flex-col justify-between space-y-4">
                                    <div class="space-y-1">
                                        <span class="bg-primary text-white text-[8px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wider">Most Popular</span>
                                        <h4 class="font-bold text-primary text-xs pt-1">Initial Consultation (30 Min)</h4>
                                        <p class="text-[11px] text-on-surface-variant">Comprehensive Dosha mapping & basic wellness plan.</p>
                                    </div>
                                    <div class="flex items-baseline justify-between pt-2">
                                        <span class="text-lg font-bold text-primary">₹1,200</span>
                                        <button class="bg-primary hover:bg-primary/95 text-white text-xs font-semibold px-4 py-2 rounded-xl transition-all cursor-pointer">
                                            BOOK NOW
                                        </button>
                                    </div>
                                </div>

                                <div class="border border-outline-variant/30 rounded-2xl p-5 flex flex-col justify-between space-y-4 hover:border-primary/50 transition-colors">
                                    <div class="space-y-1">
                                        <h4 class="font-bold text-slate-800 text-xs">Deep Dive Consultation (60 Min)</h4>
                                        <p class="text-[11px] text-on-surface-variant">Detailed health profile, diet plan, and chronic issue analysis.</p>
                                    </div>
                                    <div class="flex items-baseline justify-between pt-2">
                                        <span class="text-lg font-bold text-slate-800">₹2,000</span>
                                        <button class="bg-slate-800 hover:bg-slate-900 text-white text-xs font-semibold px-4 py-2 rounded-xl transition-all cursor-pointer">
                                            BOOK NOW
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Info -->
                    <div class="space-y-6">
                        <div class="bg-gradient-to-br from-primary to-primary-container text-white border border-primary/20 rounded-3xl p-6 shadow-xl space-y-6">
                            <div class="space-y-2">
                                <span class="font-label-caps text-[9px] text-secondary font-bold tracking-widest uppercase">EXPERT CARE</span>
                                <h3 class="font-headline-sm text-lg">Vaidya Availability</h3>
                                <p class="text-xs text-on-primary-container leading-relaxed">Book a personalized video consultation with a certified Ayurvedic Doctor (Vaidya) to analyze your Dosha and receive custom lifestyle routines.</p>
                            </div>
                            <div class="flex items-center gap-3 bg-white/10 px-4 py-3 rounded-2xl border border-white/5">
                                <span class="material-symbols-outlined text-secondary">support_agent</span>
                                <div class="text-xs">
                                    <p class="font-semibold">Next Available Vaidya</p>
                                    <p class="text-[10px] text-emerald-400">Available in 15 mins</p>
                                </div>
                            </div>
                            <button class="w-full bg-secondary hover:bg-secondary/90 text-white font-semibold text-xs tracking-wider py-3.5 rounded-xl transition-all text-center block shadow-lg cursor-pointer">
                                TALK TO VAIDYA NOW
                            </button>
                        </div>

                        <div class="bg-white border border-outline-variant/30 rounded-3xl p-6 shadow-sm space-y-4">
                            <h4 class="font-bold text-primary text-xs">Why consult a Vaidya?</h4>
                            <ul class="space-y-2.5 text-[11px] text-on-surface-variant">
                                <li class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-secondary text-sm">check_circle</span>
                                    <span>100% natural, drug-free wellness path</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-secondary text-sm">check_circle</span>
                                    <span>Recognize early signs of body imbalance</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-secondary text-sm">check_circle</span>
                                    <span>Custom diet guidance suited to your Prakriti</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
