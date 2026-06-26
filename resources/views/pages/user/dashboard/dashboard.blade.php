<div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-desktop py-12 space-y-10 animate-fade-in-up">
    
    <!-- Welcome Header Banner -->
    <div class="bg-gradient-to-r from-primary-fixed to-surface-container border border-outline-variant/30 rounded-3xl p-8 md:p-10 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="space-y-2">
            <span class="font-label-caps text-xs text-secondary font-bold tracking-widest uppercase">YOUR AYURVEDIC RETREAT</span>
            <h1 class="font-display-lg text-3xl md:text-4xl text-primary font-bold">Welcome, {{ $user->name }}</h1>
            <p class="text-sm text-on-surface-variant max-w-xl">Find balance and harmony in your daily wellness journey. Manage your products, consultation requests, and track your wellness orders below.</p>
        </div>
        <div class="flex items-center gap-4 bg-white/60 backdrop-blur px-6 py-4 rounded-2xl border border-outline-variant/20 self-start md:self-auto">
            <div class="h-10 w-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                <span class="material-symbols-outlined">calendar_today</span>
            </div>
            <div>
                <p class="text-[10px] font-label-caps text-secondary font-bold uppercase tracking-wider">TODAY</p>
                <p class="text-sm font-semibold text-slate-800">{{ now()->format('F d, Y') }}</p>
            </div>
        </div>
    </div>

    <!-- Dashboard Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left: Orders and Recommendations (2 Cols) -->
        <div class="lg:col-span-2 space-y-8">
            
            <!-- Orders Card -->
            <div class="bg-white border border-outline-variant/30 rounded-3xl shadow-sm p-6 md:p-8 space-y-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary text-2xl">local_shipping</span>
                        <h2 class="font-headline-md text-xl md:text-2xl text-primary font-bold">Recent Wellness Orders</h2>
                    </div>
                    <a href="{{ route('products') }}" class="text-xs font-semibold text-secondary hover:text-secondary/80 hover:underline transition-all">Shop More</a>
                </div>

                <!-- Orders Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-sm">
                        <thead>
                            <tr class="border-b border-outline-variant/40 text-on-surface-variant font-label-caps text-xs tracking-wider">
                                <th class="py-3 font-semibold">Order ID</th>
                                <th class="py-3 font-semibold">Date</th>
                                <th class="py-3 font-semibold font-body-md">Status</th>
                                <th class="py-3 font-semibold text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant/10 text-slate-700">
                            <!-- Dummy Order 1 -->
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="py-4 font-semibold text-primary">#LA-4829</td>
                                <td class="py-4">June 24, 2026</td>
                                <td class="py-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Delivered
                                    </span>
                                </td>
                                <td class="py-4 text-right font-bold text-slate-800">₹2,540.00</td>
                            </tr>
                            <!-- Dummy Order 2 -->
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="py-4 font-semibold text-primary">#LA-4712</td>
                                <td class="py-4">May 15, 2026</td>
                                <td class="py-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
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
                    <span class="material-symbols-outlined text-secondary text-2xl">eco</span>
                    <h2 class="font-headline-md text-xl md:text-2xl text-primary font-bold">Recommended for Your Routine</h2>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Recommendation Card 1 -->
                    <div class="border border-outline-variant/20 rounded-2xl p-4 flex gap-4 hover:shadow-md transition-all">
                        <div class="w-20 h-20 bg-surface-container rounded-lg overflow-hidden shrink-0">
                            <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCaGcUHN_hSef4gbPhjwzrWRlF0VQd9mLMoo7bW_ZzvQqgUT6Mm2_btdPirXAUqgrhTaj5ZaMUZJNh_LhycWfK4RLmgi9n53hCH25gGLekBSSwDObkIW1O7PNN_gH0H0rWzDa2dNVRus-hHpHlZFLlUK7Smk9P0I5pTGDc7jurdCQALUXRzHToMOKAybjuQiIuK480TVeKqeyg_f3We_YwLzOPnrS95cdkqJd78qU470nXLRukT5ZVzg2k8Pg6EU7yMYqD123jAlCr1" alt="Radiance Face Oil"/>
                        </div>
                        <div class="flex flex-col justify-between py-1">
                            <div>
                                <h3 class="font-bold text-primary text-sm">Radiance Face Oil</h3>
                                <p class="text-xs text-on-surface-variant">Best for Vata skin types.</p>
                            </div>
                            <span class="text-xs font-bold text-secondary">₹1,850</span>
                        </div>
                    </div>
                    
                    <!-- Recommendation Card 2 -->
                    <div class="border border-outline-variant/20 rounded-2xl p-4 flex gap-4 hover:shadow-md transition-all">
                        <div class="w-20 h-20 bg-surface-container rounded-lg overflow-hidden shrink-0">
                            <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBQV7B1p6XZu46rVb_AKL5PvxUBWaqsj45IOBRHc-YNHFSxGRtukQMVZ_-9zDf1N7FGDsIeIV63t4STcavH_jtBrdCG6oEyKRN1rGhLXYPfBN9i_2lJgZ8o5tAmoNwsm4srlJaQ2RFco2B4f5wi5FQcJBtgqpsRzIN7YsKqDKSONvndofnY2arxv7CiKzMO0WmKWNVvW4hHkvKsfMQBRQiCSrCQPw_JF_-v2kFtrlBi4KLmfugFnaBzXrx_oTP_vx2BXNMPBRDEazLQ" alt="Vata Balancing Balm"/>
                        </div>
                        <div class="flex flex-col justify-between py-1">
                            <div>
                                <h3 class="font-bold text-primary text-sm">Vata Balancing Balm</h3>
                                <p class="text-xs text-on-surface-variant">Calming hydration balm.</p>
                            </div>
                            <span class="text-xs font-bold text-secondary">₹690</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right: Profile Details & Doctor Consultation (1 Col) -->
        <div class="space-y-8">
            
            <!-- Profile Details Card -->
            <div class="bg-white border border-outline-variant/30 rounded-3xl shadow-sm p-6 space-y-6">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-secondary text-2xl">account_circle</span>
                    <h2 class="font-headline-md text-xl text-primary font-bold">Profile Details</h2>
                </div>

                <div class="space-y-4">
                    <div class="bg-surface-container-low p-4 rounded-2xl border border-outline-variant/10 space-y-3">
                        <div>
                            <span class="text-[10px] font-label-caps text-secondary font-bold uppercase tracking-wider block">NAME</span>
                            <span class="text-sm font-semibold text-slate-800">{{ $user->name }}</span>
                        </div>
                        <div>
                            <span class="text-[10px] font-label-caps text-secondary font-bold uppercase tracking-wider block">EMAIL</span>
                            <span class="text-sm font-semibold text-slate-800">{{ $user->email }}</span>
                        </div>
                        <div>
                            <span class="text-[10px] font-label-caps text-secondary font-bold uppercase tracking-wider block">MEMBERSHIP SINCE</span>
                            <span class="text-sm font-semibold text-slate-800">{{ $user->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full bg-rose-50 hover:bg-rose-100 text-rose-600 font-semibold text-xs tracking-wider py-3.5 rounded-xl transition-all cursor-pointer flex items-center justify-center gap-2 border border-rose-250">
                            <span class="material-symbols-outlined text-sm">logout</span>
                            <span>SIGN OUT OF PORTAL</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Doctor Consultation Ad -->
            <div class="bg-gradient-to-br from-primary to-primary-container text-white border border-primary/20 rounded-3xl p-6 shadow-xl space-y-6">
                <div class="space-y-2">
                    <span class="font-label-caps text-[9px] text-secondary font-bold tracking-widest uppercase">EXPERT CARE</span>
                    <h3 class="font-headline-sm text-xl">Vaidya Consultation</h3>
                    <p class="text-xs text-on-primary-container leading-relaxed">Book a personalized video consultation with a certified Ayurvedic Doctor (Vaidya) to analyze your Dosha and receive custom lifestyle routines.</p>
                </div>
                <div class="flex items-center gap-3 bg-white/10 px-4 py-3 rounded-2xl border border-white/5">
                    <span class="material-symbols-outlined text-secondary">support_agent</span>
                    <div class="text-xs">
                        <p class="font-semibold">Next Available Vaidya</p>
                        <p class="text-[10px] text-emerald-400">Available in 15 mins</p>
                    </div>
                </div>
                <a href="#consultation" class="w-full bg-secondary hover:bg-secondary/90 text-white font-semibold text-xs tracking-wider py-3.5 rounded-xl transition-all text-center block shadow-lg">
                    BOOK CONSULTATION
                </a>
            </div>

        </div>

    </div>

</div>
