<!DOCTYPE html>
<html class="scroll-smooth" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>LetsAyurveda | Timeless Wellness</title>
    <meta content="Ancient Ayurvedic wisdom for modern lives. Premium skincare, haircare, and wellness." name="description"/>
    <meta name="robots" content="noindex, nofollow"/>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Playfair+Display:ital,wght@0,400..900;1,400..900&amp;display=swap" rel="stylesheet"/>
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
        }
        .fill-icon {
            font-variation-settings: 'FILL' 1;
        }
        [x-cloak] { display: none !important; }
        
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-surface": "#1b1c1c",
                        "surface-variant": "#e4e2e1",
                        "error-container": "#ffdad6",
                        "secondary-fixed": "#ffdbd0",
                        "inverse-surface": "#303030",
                        "outline": "#737973",
                        "background": "#fbf9f8",
                        "on-secondary-container": "#793822",
                        "on-error": "#ffffff",
                        "primary-container": "#1b3022",
                        "on-tertiary-fixed": "#261900",
                        "surface-container-high": "#eae8e7",
                        "on-secondary-fixed": "#390b00",
                        "tertiary": "#211500",
                        "on-secondary-fixed-variant": "#73341f",
                        "on-tertiary-container": "#b18d48",
                        "surface-bright": "#fbf9f8",
                        "surface-container-low": "#f6f3f2",
                        "surface": "#fbf9f8",
                        "on-tertiary": "#ffffff",
                        "inverse-primary": "#b4cdb8",
                        "on-error-container": "#93000a",
                        "primary": "#061b0e",
                        "secondary": "#914b34",
                        "inverse-on-surface": "#f3f0f0",
                        "tertiary-container": "#3a2800",
                        "on-secondary": "#ffffff",
                        "on-surface-variant": "#434843",
                        "surface-container": "#f0eded",
                        "error": "#ba1a1a",
                        "on-tertiary-fixed-variant": "#5d4201",
                        "on-background": "#1b1c1c",
                        "primary-fixed": "#d0e9d4",
                        "surface-dim": "#dcd9d9",
                        "surface-container-lowest": "#ffffff",
                        "on-primary-fixed": "#0b2013",
                        "primary-fixed-dim": "#b4cdb8",
                        "outline-variant": "#c3c8c1",
                        "secondary-fixed-dim": "#ffb59d",
                        "surface-tint": "#4d6453",
                        "secondary-container": "#ffa588",
                        "on-primary-fixed-variant": "#364c3c",
                        "on-primary": "#ffffff",
                        "surface-container-highest": "#e4e2e1",
                        "on-primary-container": "#819986",
                        "tertiary-fixed": "#ffdea5",
                        "tertiary-fixed-dim": "#e9c176"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "spacing": {
                        "gutter": "24px",
                        "margin-mobile": "20px",
                        "margin-desktop": "64px",
                        "base": "8px",
                        "section-gap-desktop": "80px",
                        "section-gap-mobile": "48px"
                    },
                    "fontFamily": {
                        "body-md": ["Inter"],
                        "display-lg-mobile": ["Playfair Display"],
                        "body-lg": ["Inter"],
                        "display-lg": ["Playfair Display"],
                        "headline-md": ["Playfair Display"],
                        "headline-sm": ["Playfair Display"],
                        "label-caps": ["Inter"]
                    },
                    "fontSize": {
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "display-lg-mobile": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "700"}],
                        "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                        "display-lg": ["48px", {"lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "headline-md": ["32px", {"lineHeight": "40px", "fontWeight": "600"}],
                        "headline-sm": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                        "label-caps": ["12px", {"lineHeight": "16px", "letterSpacing": "0.1em", "fontWeight": "600"}]
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-background text-on-surface font-body-md" x-data="{ cartOpen: false, quickViewOpen: false, selectedProduct: null, dosha: null, mobileMenuOpen: false }">

    <!-- Header component -->
    <x-header />

    <!-- Main Page Content -->
    <main class="pt-20">
        @yield('content')
    </main>

    <!-- Footer component -->
    <x-footer />

    <!-- Mobile Slide-out Menu Drawer -->
    <div aria-labelledby="mobile-menu-title" aria-modal="true" class="fixed inset-0 z-[100]" role="dialog" x-cloak x-show="mobileMenuOpen">
        <div @click="mobileMenuOpen = false" class="absolute inset-0 bg-black/30 backdrop-blur-sm"
             x-transition:enter="ease-in-out duration-500"
             x-transition:enter-end="opacity-100"
             x-transition:enter-start="opacity-0"
             x-transition:leave="ease-in-out duration-500"
             x-transition:leave-end="opacity-0"
             x-transition:leave-start="opacity-100"></div>
        <div class="fixed inset-y-0 left-0 max-w-full flex">
            <div class="w-screen max-w-xs"
                 x-transition:enter="transform transition ease-in-out duration-500"
                 x-transition:enter-end="translate-x-0"
                 x-transition:enter-start="-translate-x-full"
                 x-transition:leave="transform transition ease-in-out duration-500"
                 x-transition:leave-end="-translate-x-full"
                 x-transition:leave-start="translate-x-0">
                <div class="h-full flex flex-col bg-surface shadow-2xl">
                    <div class="flex-1 py-6 overflow-y-auto px-margin-mobile">
                        <div class="flex items-center justify-between border-b border-outline-variant/30 pb-4">
                            <span class="font-display-lg text-display-lg-mobile text-primary font-bold">Menu</span>
                            <button @click="mobileMenuOpen = false" class="text-on-surface-variant cursor-pointer active:scale-95" type="button">
                                <span class="material-symbols-outlined" data-icon="close">close</span>
                            </button>
                        </div>
                        <nav class="mt-8 flex flex-col gap-6 font-label-caps text-label-caps tracking-widest text-primary text-lg">
                            <a @click="mobileMenuOpen = false" href="#shop" class="hover:text-secondary py-2 border-b border-outline-variant/10">Shop</a>
                            <a @click="mobileMenuOpen = false" href="#about" class="hover:text-secondary py-2 border-b border-outline-variant/10">About</a>
                            <a @click="mobileMenuOpen = false" href="#categories" class="hover:text-secondary py-2 border-b border-outline-variant/10">Categories</a>
                            <a @click="mobileMenuOpen = false" href="#consultation" class="hover:text-secondary py-2 border-b border-outline-variant/10">Consultation</a>
                            <a @click="mobileMenuOpen = false" href="#blog" class="hover:text-secondary py-2">Blog</a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cart Drawer -->
    <div aria-labelledby="slide-over-title" aria-modal="true" class="fixed inset-0 z-[100]" role="dialog" x-cloak x-show="cartOpen">
        <div @click="cartOpen = false" class="absolute inset-0 bg-black/30 backdrop-blur-sm"
             x-transition:enter="ease-in-out duration-500"
             x-transition:enter-end="opacity-100"
             x-transition:enter-start="opacity-0"
             x-transition:leave="ease-in-out duration-500"
             x-transition:leave-end="opacity-0"
             x-transition:leave-start="opacity-100"></div>
        <div class="fixed inset-y-0 right-0 max-w-full flex">
            <div class="w-screen max-w-md"
                 x-transition:enter="transform transition ease-in-out duration-500"
                 x-transition:enter-end="translate-x-0"
                 x-transition:enter-start="translate-x-full"
                 x-transition:leave="transform transition ease-in-out duration-500"
                 x-transition:leave-end="translate-x-full"
                 x-transition:leave-start="translate-x-0">
                <div class="h-full flex flex-col bg-surface shadow-2xl">
                    <div class="flex-1 py-6 overflow-y-auto px-margin-mobile">
                        <div class="flex items-start justify-between">
                            <h2 class="font-headline-sm text-headline-sm text-primary">Your Cart</h2>
                            <button @click="cartOpen = false" class="text-on-surface-variant cursor-pointer active:scale-95" type="button">
                                <span class="material-symbols-outlined" data-icon="close">close</span>
                            </button>
                        </div>
                        <div class="mt-12 space-y-8">
                            <div class="flex gap-4">
                                <div class="w-20 h-24 bg-surface-container rounded-lg overflow-hidden shrink-0">
                                    <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCaGcUHN_hSef4gbPhjwzrWRlF0VQd9mLMoo7bW_ZzvQqgUT6Mm2_btdPirXAUqgrhTaj5ZaMUZJNh_LhycWfK4RLmgi9n53hCH25gGLekBSSwDObkIW1O7PNN_gH0H0rWzDa2dNVRus-hHpHlZFLlUK7Smk9P0I5pTGDc7jurdCQALUXRzHToMOKAybjuQiIuK480TVeKqeyg_f3We_YwLzOPnrS95cdkqJd78qU470nXLRukT5ZVzg2k8Pg6EU7yMYqD123jAlCr1" alt="Radiance Face Oil"/>
                                </div>
                                <div class="flex flex-col justify-between py-1">
                                    <div>
                                        <h3 class="font-bold text-primary">Radiance Face Oil</h3>
                                        <p class="text-sm text-on-surface-variant">Qty: 1</p>
                                    </div>
                                    <p class="font-bold text-secondary">₹1,850</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div class="w-20 h-24 bg-surface-container rounded-lg overflow-hidden shrink-0">
                                    <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBQV7B1p6XZu46rVb_AKL5PvxUBWaqsj45IOBRHc-YNHFSxGRtukQMVZ_-9zDf1N7FGDsIeIV63t4STcavH_jtBrdCG6oEyKRN1rGhLXYPfBN9i_2lJgZ8o5tAmoNwsm4srlJaQ2RFco2B4f5wi5FQcJBtgqpsRzIN7YsKqDKSONvndofnY2arxv7CiKzMO0WmKWNVvW4hHkvKsfMQBRQiCSrCQPw_JF_-v2kFtrlBi4KLmfugFnaBzXrx_oTP_vx2BXNMPBRDEazLQ" alt="Vata Balancing Balm"/>
                                </div>
                                <div class="flex flex-col justify-between py-1">
                                    <div>
                                        <h3 class="font-bold text-primary">Vata Balancing Balm</h3>
                                        <p class="text-sm text-on-surface-variant">Qty: 1</p>
                                    </div>
                                    <p class="font-bold text-secondary">₹690</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-t border-outline-variant p-6 space-y-4 bg-surface-container-low">
                        <div class="flex justify-between font-headline-sm text-headline-sm">
                            <span>Subtotal</span>
                            <span>₹2,540.00</span>
                        </div>
                        <p class="text-sm text-on-surface-variant italic">Shipping and taxes calculated at checkout.</p>
                        <button class="w-full bg-secondary text-white py-4 rounded-full font-label-caps tracking-widest text-label-caps hover:bg-secondary/90 active:scale-95 transition-all">
                            PROCEED TO CHECKOUT
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick View Modal -->
    <div class="fixed inset-0 z-[110] flex items-center justify-center px-4" x-cloak x-show="quickViewOpen">
        <div @click="quickViewOpen = false" class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>
        <div class="relative bg-surface w-full max-w-md rounded-2xl overflow-hidden shadow-2xl"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-end="opacity-0 scale-95"
             x-transition:leave-start="opacity-100 scale-100">
            <button @click="quickViewOpen = false" class="absolute top-4 right-4 z-10 text-primary bg-white/80 rounded-full p-1 cursor-pointer active:scale-95">
                <span class="material-symbols-outlined" data-icon="close">close</span>
            </button>
            <div class="aspect-square bg-surface-container">
                <template x-if="selectedProduct?.image">
                    <img class="w-full h-full object-cover" :src="selectedProduct.image" :alt="selectedProduct.name"/>
                </template>
                <template x-if="!selectedProduct?.image">
                    <div class="w-full h-full flex items-center justify-center text-outline-variant">
                        <span class="material-symbols-outlined text-6xl">spa</span>
                    </div>
                </template>
            </div>
            <div class="p-6">
                <h2 class="font-headline-md text-headline-md text-primary mb-2" x-text="selectedProduct?.name"></h2>
                <p class="font-body-md text-on-surface-variant mb-6" x-text="selectedProduct?.desc"></p>
                <div class="flex items-center justify-between">
                    <span class="font-headline-sm text-headline-sm text-secondary" x-text="selectedProduct?.price"></span>
                    <button @click="quickViewOpen = false; cartOpen = true" class="bg-primary hover:bg-primary-container text-white px-6 py-3 rounded-full font-label-caps text-[10px] tracking-widest active:scale-95 transition-transform cursor-pointer">
                        ADD TO CART
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Vaidya (Doctor) Consultation Badge -->
    <a href="#consultation" class="fixed bottom-6 right-6 z-40 flex items-center gap-3 bg-white border border-outline-variant/30 text-primary pl-3 pr-5 py-2.5 rounded-full shadow-2xl hover:shadow-emerald-900/10 active:scale-95 transition-all duration-300 group hover:bg-surface-container-low" title="Consult a Vaidya">
        <div class="relative">
            <!-- Doctor Avatar Image -->
            <div class="w-10 h-10 rounded-full overflow-hidden bg-primary-container flex items-center justify-center border border-secondary/20 shadow-inner">
                <img src="/doctor-avatar.png" alt="Vaidya Online" class="w-full h-full object-cover">
            </div>
            <!-- Online Pulsing Badge -->
            <span class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full ring-2 ring-white bg-emerald-500 animate-pulse"></span>
        </div>
        <div class="flex flex-col text-left">
            <span class="text-[9px] font-label-caps text-secondary font-bold tracking-widest leading-none">ONLINE VAIDYA</span>
            <span class="text-xs font-bold text-primary leading-tight mt-0.5 group-hover:text-secondary transition-colors">Consult Doctor</span>
        </div>
    </a>
</body>
</html>
