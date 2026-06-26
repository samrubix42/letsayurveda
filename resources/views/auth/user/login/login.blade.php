<div class="w-full max-w-md animate-fade-in-up">
    
    <!-- Outer Card Container -->
    <div class="bg-white/80 backdrop-blur-md border border-outline-variant/60 rounded-3xl shadow-2xl overflow-hidden p-8 space-y-6">
        
        <!-- Header Brand/Logo -->
        <div class="text-center space-y-2">
            <div class="inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-primary-fixed/40 border border-primary/20 text-primary shadow-inner">
                <span class="material-symbols-outlined text-3xl">spa</span>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.25em] text-secondary font-bold">LETS AYURVEDA</p>
                <h1 class="font-headline-md text-2xl font-bold text-primary mt-1">Welcome Back</h1>
                <p class="text-xs text-on-surface-variant">Sign in to access your wellness sanctuary and orders</p>
            </div>
        </div>

        <!-- Login Form -->
        <form wire:submit.prevent="login" class="space-y-5">
            
            <!-- Email Input -->
            <div class="space-y-1.5">
                <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-on-surface-variant">Email Address</label>
                <div class="relative flex items-center bg-white border border-outline-variant rounded-xl focus-within:border-secondary focus-within:ring-2 focus-within:ring-secondary/10 transition-all">
                    <span class="material-symbols-outlined text-on-surface-variant absolute left-4 text-lg">mail</span>
                    <input id="email" wire:model="email" type="email" autocomplete="email" required
                           class="w-full pl-12 pr-4 py-3 bg-transparent text-sm text-on-surface outline-none placeholder:text-outline" 
                           placeholder="you@example.com"/>
                </div>
                @error('email') <span class="text-error text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

            <!-- Password Input -->
            <div class="space-y-1.5">
                <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-on-surface-variant">Password</label>
                <div class="relative flex items-center bg-white border border-outline-variant rounded-xl focus-within:border-secondary focus-within:ring-2 focus-within:ring-secondary/10 transition-all">
                    <span class="material-symbols-outlined text-on-surface-variant absolute left-4 text-lg">lock</span>
                    <input id="password" wire:model="password" type="password" autocomplete="current-password" required
                           class="w-full pl-12 pr-4 py-3 bg-transparent text-sm text-on-surface outline-none placeholder:text-outline" 
                           placeholder="••••••••"/>
                </div>
                @error('password') <span class="text-error text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

            <!-- Remember Me Row -->
            <div class="flex items-center justify-between pt-1">
                <label class="inline-flex items-center gap-2 cursor-pointer select-none">
                    <input type="checkbox" wire:model="remember" class="w-4.5 h-4.5 rounded border-outline text-secondary focus:ring-secondary/25 bg-white">
                    <span class="text-xs font-semibold text-on-surface-variant hover:text-on-surface transition-colors">Remember Me</span>
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" wire:loading.attr="disabled"
                    class="w-full bg-secondary hover:bg-secondary/90 text-white font-semibold text-xs tracking-wider py-3.5 rounded-xl hover:shadow-lg active:scale-[0.98] transition-all cursor-pointer flex items-center justify-center gap-2">
                
                <!-- Spinner shown while loading -->
                <span wire:loading wire:target="login" class="animate-spin inline-block h-3.5 w-3.5 border-2 border-white border-t-transparent rounded-full"></span>
                
                <span wire:loading.remove wire:target="login" class="material-symbols-outlined text-sm">login</span>
                
                <span>SIGN IN</span>
            </button>

        </form>

        <!-- Divider & Register Link -->
        <div class="pt-4 border-t border-outline-variant/30 text-center space-y-3">
            <p class="text-xs text-on-surface-variant">
                New to LetsAyurveda? 
                <a href="/register" wire:navigate class="font-bold text-secondary hover:text-secondary/80 underline transition-colors ml-1">Create an account</a>
            </p>
        </div>

    </div>
</div>