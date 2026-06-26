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
                <h1 class="font-headline-md text-2xl font-bold text-primary mt-1">Create Account</h1>
                <p class="text-xs text-on-surface-variant">Join our wellness sanctuary and begin your journey</p>
            </div>
        </div>

        <!-- Registration Form -->
        <form wire:submit.prevent="register" class="space-y-4.5">
            
            <!-- Full Name Input -->
            <div class="space-y-1">
                <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-on-surface-variant">Full Name</label>
                <div class="relative flex items-center bg-white border border-outline-variant rounded-xl focus-within:border-secondary focus-within:ring-2 focus-within:ring-secondary/10 transition-all">
                    <span class="material-symbols-outlined text-on-surface-variant absolute left-4 text-lg">person</span>
                    <input id="name" wire:model="name" type="text" autocomplete="name" required
                           class="w-full pl-12 pr-4 py-2.5 bg-transparent text-sm text-on-surface outline-none placeholder:text-outline" 
                           placeholder="Arjun Singh"/>
                </div>
                @error('name') <span class="text-error text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

            <!-- Email Address Input -->
            <div class="space-y-1">
                <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-on-surface-variant">Email Address</label>
                <div class="relative flex items-center bg-white border border-outline-variant rounded-xl focus-within:border-secondary focus-within:ring-2 focus-within:ring-secondary/10 transition-all">
                    <span class="material-symbols-outlined text-on-surface-variant absolute left-4 text-lg">mail</span>
                    <input id="email" wire:model="email" type="email" autocomplete="email" required
                           class="w-full pl-12 pr-4 py-2.5 bg-transparent text-sm text-on-surface outline-none placeholder:text-outline" 
                           placeholder="arjun@example.com"/>
                </div>
                @error('email') <span class="text-error text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

            <!-- Password Input -->
            <div class="space-y-1">
                <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-on-surface-variant">Password</label>
                <div class="relative flex items-center bg-white border border-outline-variant rounded-xl focus-within:border-secondary focus-within:ring-2 focus-within:ring-secondary/10 transition-all">
                    <span class="material-symbols-outlined text-on-surface-variant absolute left-4 text-lg">lock</span>
                    <input id="password" wire:model="password" type="password" autocomplete="new-password" required
                           class="w-full pl-12 pr-4 py-2.5 bg-transparent text-sm text-on-surface outline-none placeholder:text-outline" 
                           placeholder="••••••••"/>
                </div>
                @error('password') <span class="text-error text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

            <!-- Confirm Password Input -->
            <div class="space-y-1">
                <label for="password_confirmation" class="block text-xs font-semibold uppercase tracking-wider text-on-surface-variant">Confirm Password</label>
                <div class="relative flex items-center bg-white border border-outline-variant rounded-xl focus-within:border-secondary focus-within:ring-2 focus-within:ring-secondary/10 transition-all">
                    <span class="material-symbols-outlined text-on-surface-variant absolute left-4 text-lg">lock_reset</span>
                    <input id="password_confirmation" wire:model="password_confirmation" type="password" autocomplete="new-password" required
                           class="w-full pl-12 pr-4 py-2.5 bg-transparent text-sm text-on-surface outline-none placeholder:text-outline" 
                           placeholder="••••••••"/>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" wire:loading.attr="disabled"
                    class="w-full bg-secondary hover:bg-secondary/90 text-white font-semibold text-xs tracking-wider py-3.5 rounded-xl hover:shadow-lg active:scale-[0.98] transition-all cursor-pointer flex items-center justify-center gap-2 mt-2">
                
                <!-- Spinner shown while loading -->
                <span wire:loading wire:target="register" class="animate-spin inline-block h-3.5 w-3.5 border-2 border-white border-t-transparent rounded-full"></span>
                
                <span wire:loading.remove wire:target="register" class="material-symbols-outlined text-sm">person_add</span>
                
                <span>CREATE ACCOUNT</span>
            </button>

        </form>

        <!-- Divider & Login Link -->
        <div class="pt-4 border-t border-outline-variant/30 text-center space-y-3">
            <p class="text-xs text-on-surface-variant">
                Already have an account? 
                <a href="/login" wire:navigate class="font-bold text-secondary hover:text-secondary/80 underline transition-colors ml-1">Sign in</a>
            </p>
        </div>

    </div>
</div>