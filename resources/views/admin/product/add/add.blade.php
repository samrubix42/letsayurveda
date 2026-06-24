<div x-data="{ animating: false }" class="max-w-5xl mx-auto space-y-6">

    {{-- PAGE HEADER --}}
    <div>
        <h1 class="font-headline-sm text-3xl font-bold text-slate-800 tracking-tight">Add New Product</h1>
        <p class="text-sm text-slate-500 mt-1">Fill in the details to create a new product listing in the wellness sanctuary.</p>
    </div>

    {{-- STEPPER NAVIGATION --}}
    @php
        $steps = $this->stepInfo;
    @endphp

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 px-8 py-6">
        <div class="flex items-center justify-between">
            @foreach($steps as $num => $info)
                @php
                    $skipped   = $this->isStepSkipped($num);
                    $completed = $num < $step;
                    $current   = $num === $step;
                @endphp

                {{-- Step Circle + Label --}}
                <div class="flex flex-col items-center relative z-10">
                    <button
                        wire:click="goToStep({{ $num }})"
                        @class([
                            'w-11 h-11 rounded-full flex items-center justify-center transition-all duration-300 border-2 cursor-pointer',
                            'bg-gradient-to-br from-emerald-500 to-emerald-600 text-white border-emerald-400 shadow-md scale-110' => $current,
                            'bg-emerald-600 text-white border-emerald-500 shadow-sm' => $completed && !$skipped,
                            'bg-slate-100 text-slate-300 border-slate-200 opacity-50 cursor-not-allowed' => $skipped,
                            'bg-white text-slate-400 border-slate-200 hover:border-slate-300' => !$current && !$completed && !$skipped,
                        ])
                        @if($skipped) disabled @endif
                    >
                        @if($completed && !$skipped)
                            <span class="material-symbols-outlined text-sm">check</span>
                        @else
                            <span class="material-symbols-outlined text-base">{{ $info['icon'] }}</span>
                        @endif
                    </button>

                    <span @class([
                        'text-[10px] font-bold uppercase tracking-wider mt-2 transition-colors duration-300',
                        'text-emerald-600 font-bold' => $current,
                        'text-emerald-500' => $completed && !$skipped,
                        'text-slate-300 line-through' => $skipped,
                        'text-slate-400' => !$current && !$completed && !$skipped,
                    ])>
                        {{ $info['title'] }}
                    </span>
                </div>

                {{-- Connector Line --}}
                @if(!$loop->last)
                    <div class="flex-1 mx-3 mt-[-20px]">
                        <div @class([
                            'h-0.5 rounded-full transition-all duration-500',
                            'bg-emerald-600' => $completed,
                            'bg-slate-200' => !$completed,
                        ])></div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    {{-- STEP CONTENT --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 min-h-[400px]">

        {{-- Step Title --}}
        <div class="mb-8 pb-5 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center text-white shadow-sm">
                    <span class="material-symbols-outlined text-lg">{{ $steps[$step]['icon'] ?? 'file_open' }}</span>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-slate-800">{{ $steps[$step]['title'] ?? '' }}</h2>
                    <p class="text-xs text-slate-400">Step {{ $step }} of {{ $totalSteps }}</p>
                </div>
            </div>
        </div>

        {{-- Step Body --}}
        <div wire:key="step-content-{{ $step }}">
            <style>
                @keyframes fadeSlideIn {
                    from { opacity: 0; transform: translateY(12px); }
                    to   { opacity: 1; transform: translateY(0); }
                }
                .animate-in { animation: fadeSlideIn .35s ease-out; }
            </style>

            <div class="animate-in">
                @switch($step)
                    @case(1) @include('admin.product.steps.step-1') @break
                    @case(2) @include('admin.product.steps.step-2') @break
                    @case(3) @include('admin.product.steps.step-3') @break
                    @case(4) @include('admin.product.steps.step-4') @break
                    @case(5) @include('admin.product.steps.step-5') @break
                @endswitch
            </div>
        </div>
    </div>

    {{-- NAVIGATION BUTTONS --}}
    <div class="flex items-center justify-between">
        <div>
            @if($step > 1)
                <button wire:click="back"
                    class="group inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-white border border-slate-200 text-slate-600
                           hover:bg-slate-50 hover:border-slate-300 transition-all duration-200 text-xs font-semibold uppercase tracking-wider shadow-sm cursor-pointer">
                    <span class="material-symbols-outlined text-sm transition-transform group-hover:-translate-x-0.5">arrow_back</span>
                    <span>Back</span>
                </button>
            @endif
        </div>

        <div>
            @if($step < $totalSteps)
                <button wire:click="next"
                    class="group inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-emerald-600
                           text-white hover:bg-emerald-700 transition-all duration-200 text-xs font-semibold uppercase tracking-wider
                           shadow-md cursor-pointer">
                    <span>Continue</span>
                    <span class="material-symbols-outlined text-sm transition-transform group-hover:translate-x-0.5">arrow_forward</span>
                </button>
            @else
                <button wire:click="save"
                    wire:loading.attr="disabled"
                    class="group inline-flex items-center gap-2 px-7 py-2.5 rounded-full bg-gradient-to-r from-emerald-600 to-teal-600
                           text-white hover:from-emerald-700 hover:to-teal-700 transition-all duration-200 text-xs font-semibold uppercase tracking-wider
                           shadow-md disabled:opacity-60 cursor-pointer">
                    <span wire:loading.remove wire:target="save" class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">rocket_launch</span>
                        <span>Publish Product</span>
                    </span>
                    <span wire:loading wire:target="save" class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm animate-spin">sync</span>
                        <span>Publishing…</span>
                    </span>
                </button>
            @endif
        </div>
    </div>
</div>