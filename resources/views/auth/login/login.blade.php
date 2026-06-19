<div class="w-full max-w-md animate-fade-in-up">
    
    <!-- Outer Card Container -->
    <div class="bg-white/80 backdrop-blur-md border border-slate-200/60 rounded-3xl shadow-2xl overflow-hidden p-8 space-y-6">
        
        <!-- Header Brand/Logo -->
        <div class="text-center space-y-2">
            <div class="inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-600 shadow-inner">
                <span class="material-symbols-outlined text-3xl">spa</span>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.25em] text-emerald-600">LETS AYURVEDA</p>
                <h1 class="text-2xl font-bold text-slate-800 mt-1">Admin Portal</h1>
                <p class="text-xs text-slate-400">Sign in to manage wellness stories and sanctuary settings</p>
            </div>
        </div>

        <!-- Login Form -->
        <form wire:submit.prevent="login" class="space-y-5">
            
            <!-- Email Input -->
            <div class="space-y-1.5">
                <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-500">Email Address</label>
                <div class="relative flex items-center bg-white border border-slate-200 rounded-xl focus-within:border-emerald-500 focus-within:ring-2 focus-within:ring-emerald-500/10 transition-all">
                    <span class="material-symbols-outlined text-slate-400 absolute left-4 text-lg">mail</span>
                    <input id="email" wire:model="email" type="email" autocomplete="email" required
                           class="w-full pl-12 pr-4 py-3 bg-transparent text-sm text-slate-850 outline-none placeholder:text-slate-400" 
                           placeholder="admin@letsayurveda.com"/>
                </div>
                @error('email') <span class="text-rose-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

            <!-- Password Input -->
            <div class="space-y-1.5">
                <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-slate-500">Password</label>
                <div class="relative flex items-center bg-white border border-slate-200 rounded-xl focus-within:border-emerald-500 focus-within:ring-2 focus-within:ring-emerald-500/10 transition-all">
                    <span class="material-symbols-outlined text-slate-400 absolute left-4 text-lg">lock</span>
                    <input id="password" wire:model="password" type="password" autocomplete="current-password" required
                           class="w-full pl-12 pr-4 py-3 bg-transparent text-sm text-slate-850 outline-none placeholder:text-slate-450" 
                           placeholder="••••••••"/>
                </div>
                @error('password') <span class="text-rose-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

            <!-- Remember Me & Forgot Password Row -->
            <div class="flex items-center justify-between pt-1">
                <label class="inline-flex items-center gap-2 cursor-pointer select-none">
                    <input type="checkbox" wire:model="remember" class="w-4.5 h-4.5 rounded border-slate-350 text-emerald-600 focus:ring-emerald-500/25 bg-white">
                    <span class="text-xs font-semibold text-slate-500 hover:text-slate-700 transition-colors">Remember Me</span>
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" wire:loading.attr="disabled"
                    class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs tracking-wider py-3.5 rounded-xl hover:shadow-lg active:scale-[0.98] transition-all cursor-pointer flex items-center justify-center gap-2">
                
                <!-- Spinner shown while loading -->
                <span wire:loading wire:target="login" class="animate-spin inline-block h-3.5 w-3.5 border-2 border-white border-t-transparent rounded-full"></span>
                
                <span wire:loading.remove wire:target="login" class="material-symbols-outlined text-sm">login</span>
                
                <span>SIGN IN TO PORTAL</span>
            </button>

        </form>

    </div>
</div>