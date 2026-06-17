@extends('layouts.app')

@section('content')
<!-- Hero Section (Desktop Grid / Mobile Stack) -->
<section class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-desktop py-6">
    <div class="grid grid-cols-1 lg:grid-cols-12 bg-surface-container rounded-3xl overflow-hidden min-h-[75vh]">
        
        <!-- Left: Copy Block -->
        <div class="lg:col-span-6 flex flex-col justify-center p-8 md:p-16 lg:p-20 text-left">
            <span class="font-label-caps text-xs tracking-widest text-secondary font-bold mb-4 uppercase">HOLISTIC REMEDIES</span>
            <h2 class="font-display-lg text-4xl md:text-5xl lg:text-6xl text-primary font-bold leading-tight mb-6">
                Timeless Wellness <br class="hidden md:inline"/>for Modern Life
            </h2>
            <p class="font-body-lg text-lg text-on-surface-variant leading-relaxed mb-8 max-w-lg">
                Experience the ancient art of balance. Discover high-efficacy, luxury Ayurvedic formulations crafted to restore harmony to your hair, skin, and daily vitality.
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a class="inline-block bg-primary hover:bg-primary-container text-white px-8 py-4 rounded-full font-label-caps tracking-widest text-xs text-center hover:shadow-md transition-all duration-300 active:scale-95 cursor-pointer" href="#shop">
                    SHOP THE RITUALS
                </a>
                <a class="inline-block border border-outline hover:border-primary text-primary px-8 py-4 rounded-full font-label-caps tracking-widest text-xs text-center hover:bg-surface-container-low transition-all duration-300 active:scale-95 cursor-pointer" href="#quiz">
                    FIND YOUR DOSHA
                </a>
            </div>
        </div>
        
        <!-- Right: Styled Image Grid -->
        <div class="lg:col-span-6 relative h-64 lg:h-auto min-h-[350px] overflow-hidden">
            <img alt="Ayurvedic Wellness Hero" class="absolute inset-0 w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCRUfXu3mVAR3fbPyC0vAwGz1I1PU1RRmT4cb6_-Epb4h76WKfhzHJGQO91hOe4KWDHaY6171B5SKxqKxumHLwsaffQyp7BHtnMOiPUUJ-qChM9HCJG42LUi7zzrFMWUPXmjJpE9N4lxbASN8d7f_y2MwYQcSCy35CEg-dBwKgveqCp7RSEUkpKd2QPXr8JbpihNG_Atcod9wTCx-_dC3TUpl_mIfuTCvqi-ubF31LBCpPWLgdKE35dILaXPwMlRAwj85p-onQ-Bwkn"/>
            <div class="absolute inset-0 bg-gradient-to-r from-surface-container/10 to-transparent"></div>
        </div>
        
    </div>
</section>

<!-- Section: Benefits / Core Principles (About) -->
<section id="about" class="py-16 bg-surface-container-low">
    <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-desktop">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="font-label-caps text-xs text-secondary font-bold tracking-widest uppercase">OUR GUARANTEE</span>
            <h3 class="font-headline-md text-3xl text-primary font-bold mt-2">Why Our Ayurveda is Different</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- Benefit 1 -->
            <div class="bg-surface rounded-2xl p-8 border border-outline-variant/30 text-center hover:shadow-sm transition-shadow duration-300">
                <div class="w-12 h-12 rounded-full bg-primary-container flex items-center justify-center mx-auto mb-6">
                    <span class="material-symbols-outlined text-white" data-icon="nature">nature</span>
                </div>
                <h4 class="font-headline-sm text-xl text-primary mb-3">100% Wild-Harvested</h4>
                <p class="font-body-md text-on-surface-variant text-sm leading-relaxed">
                    Sourced sustainably from certified organic regions in India. We only harvest during peak botanical potency.
                </p>
            </div>
            
            <!-- Benefit 2 -->
            <div class="bg-surface rounded-2xl p-8 border border-outline-variant/30 text-center hover:shadow-sm transition-shadow duration-300">
                <div class="w-12 h-12 rounded-full bg-primary-container flex items-center justify-center mx-auto mb-6">
                    <span class="material-symbols-outlined text-white" data-icon="verified">verified</span>
                </div>
                <h4 class="font-headline-sm text-xl text-primary mb-3">Siddha-Validated</h4>
                <p class="font-body-md text-on-surface-variant text-sm leading-relaxed">
                    Each traditional recipe goes through dual scientific verification and chemical profiling for safety and performance.
                </p>
            </div>
            
            <!-- Benefit 3 -->
            <div class="bg-surface rounded-2xl p-8 border border-outline-variant/30 text-center hover:shadow-sm transition-shadow duration-300">
                <div class="w-12 h-12 rounded-full bg-primary-container flex items-center justify-center mx-auto mb-6">
                    <span class="material-symbols-outlined text-white" data-icon="water_drop">water_drop</span>
                </div>
                <h4 class="font-headline-sm text-xl text-primary mb-3">Therapeutic Dosha Alignment</h4>
                <p class="font-body-md text-on-surface-variant text-sm leading-relaxed">
                    Formulated with cooling or heating properties to correct imbalances and pacify Vata, Pitta, or Kapha constitution.
                </p>
            </div>
            
        </div>
    </div>
</section>

<!-- Categories Section -->
<section id="categories" class="py-16">
    <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-desktop">
        <div class="flex items-center justify-between mb-10">
            <div>
                <span class="font-label-caps text-xs text-secondary font-bold tracking-widest uppercase">THE SANCTUARY</span>
                <h3 class="font-headline-sm text-2xl md:text-3xl text-primary font-bold mt-1">Shop by Concern</h3>
            </div>
            <span class="font-label-caps text-xs text-secondary hover:text-primary cursor-pointer tracking-wider font-bold transition-colors">VIEW ALL CATEGORIES</span>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            
            <!-- Category 1 -->
            <div class="flex flex-col items-center gap-3 group cursor-pointer">
                <div class="w-24 h-24 md:w-36 md:h-36 rounded-full bg-surface-container overflow-hidden flex items-center justify-center group-hover:scale-105 transition-transform duration-300 border border-outline-variant/20 shadow-sm">
                    <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB2KqtdvrIlGaTzFICQA6FU-rEPz4ax6MdnCZ5uk9rR-EnrvPxJXvFkt6oF_JPl7NaB5HcIE3o4vCV_j_zp_hcktPaeGQVLTkS0tJdrhlQ5h_Q5AkD2PjIm2BerM7QiNqCz09DBsobBACw7_5UYgXteStK6GV2u8ybzPJE5x2ItjKXuRLNcoOsT-Rkx5KQ2aAqpDGurC8ETEMoLTcPavfyX7_4nS1011De7ivqGRze2MIIDlUVldVKtiyh0J2LLM-M96XNsUcGS_-BL" alt="Skincare"/>
                </div>
                <span class="font-label-caps text-xs tracking-widest text-primary font-bold group-hover:text-secondary transition-colors duration-300 uppercase">Skincare</span>
            </div>
            
            <!-- Category 2 -->
            <div class="flex flex-col items-center gap-3 group cursor-pointer">
                <div class="w-24 h-24 md:w-36 md:h-36 rounded-full bg-surface-container overflow-hidden flex items-center justify-center group-hover:scale-105 transition-transform duration-300 border border-outline-variant/20 shadow-sm">
                    <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA15Q4utUpBf5oPaeo4uI72jGgAXt24uCBuhq4bgkndAxNIbdMjAVFjinh5LaTaCATeRRQxyJhUj1fTWSbL8ixECWloApMVtuXxg2eYyqAvsd3SpZE1pwdf5Azn9817y4rY3kUnQTgfegLKciVuo4ZX2VXNhqG1ZJG4_VPM1kpyv-16dv-CZbZHIxA_OPnBXgmEu7IDb-RjLj5N3dWM2_3zLR2Zj7hnysTM-TTPL8oqF67FBEkqDPtI_jWHqW1rBpi4pxNkUjKwxy_-" alt="Haircare"/>
                </div>
                <span class="font-label-caps text-xs tracking-widest text-primary font-bold group-hover:text-secondary transition-colors duration-300 uppercase">Haircare</span>
            </div>
            
            <!-- Category 3 -->
            <div class="flex flex-col items-center gap-3 group cursor-pointer">
                <div class="w-24 h-24 md:w-36 md:h-36 rounded-full bg-surface-container overflow-hidden flex items-center justify-center group-hover:scale-105 transition-transform duration-300 border border-outline-variant/20 shadow-sm">
                    <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCtvuWjBpX4Ud52-YiDxxvj3Oahyowxiapahu3coatkcN6CJxx4gypXqaxVq_CHod-NHB0j6EvUUTymIHZ0SX9iEl3lkBnl53EiQXCL6occYUzi09ivc8wBresNADED8_AJ8zOMaAVVxP6ygeTR2sfiYFBQv-JV7YGseX2hmmQ35u1gbQg2srDDLTJW3RD-TruxNQbCzOR_CCGHwWN_wAuo7kAoRlwBRPaFu_g2xTu92Tso-GscbWOZMNRArBmcCZuyOBA7IzMKuCJe" alt="Wellness"/>
                </div>
                <span class="font-label-caps text-xs tracking-widest text-primary font-bold group-hover:text-secondary transition-colors duration-300 uppercase">Wellness</span>
            </div>
            
            <!-- Category 4 -->
            <div class="flex flex-col items-center gap-3 group cursor-pointer">
                <div class="w-24 h-24 md:w-36 md:h-36 rounded-full bg-surface-container overflow-hidden flex items-center justify-center group-hover:scale-105 transition-transform duration-300 border border-outline-variant/20 shadow-sm">
                    <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBAa7m03kwvnRFmELlh7O-eCXCrFDpGx7mndLB8sm-Pyj82hGyJTcbzL8fEahAc_djIO30Lp1wzpc6PF8jA-vMIOZ-yRQJrm24k4GoYppGD9d-ib-N3JTKl-S3jh6I9wVBToEqe9RxN-7gRX3dZoZMCNtHbovBcslwJpb0Cn5z607k70tHpMUdHRicV8_eWhRgP-FAK3Fjy7u5Q9J7wNH977L9ovdHOTDfZ6HtJpy_YmOLpOmJkVYQ2K08ztww5BuO_B0-WSKk9Mt61" alt="Essentials"/>
                </div>
                <span class="font-label-caps text-xs tracking-widest text-primary font-bold group-hover:text-secondary transition-colors duration-300 uppercase">Essentials</span>
            </div>
            
        </div>
    </div>
</section>

<!-- Best Sellers Section -->
<section id="shop" class="py-16 bg-surface-container-low">
    <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-desktop">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="font-label-caps text-xs text-secondary font-bold tracking-widest uppercase">THE BOUTIQUE</span>
            <h3 class="font-headline-md text-3xl text-primary font-bold mt-2">Our Bestselling Formulas</h3>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <!-- Product Card 1 -->
            <div class="bg-surface rounded-2xl overflow-hidden shadow-sm border border-outline-variant/20 hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                <div @click="selectedProduct = { name: 'Radiance Face Oil', price: '₹1,850', desc: 'A potent infusion of saffron and sandalwood for a deep, luminous glow.', image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuB6LGVZvguHodxq33XQpp6aprDmaYZIoJhGCW77y3u82NlVzT2OrB-tfSl0gz5tXOWx7HTmV-DeMtH39rg06Ni_pflBP9Ey_auZ_4S26YWii6J-7O_g4L0gN37kcw6ZKQcbyVP1QaNUY5ECi9hQ09P3T9LlyRrgQURU1bR41x4PYhY-lp1nnjki3tDsdhkjGSqsNtpP7PKiB7ohJlzIAJ7MuOrBotv7dOFjByzkWGGxKdTl_qvvxhtmn95OjnbOpk00oA0qz5EFbkzH' }; quickViewOpen = true" class="relative aspect-[4/5] overflow-hidden cursor-pointer">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB6LGVZvguHodxq33XQpp6aprDmaYZIoJhGCW77y3u82NlVzT2OrB-tfSl0gz5tXOWx7HTmV-DeMtH39rg06Ni_pflBP9Ey_auZ_4S26YWii6J-7O_g4L0gN37kcw6ZKQcbyVP1QaNUY5ECi9hQ09P3T9LlyRrgQURU1bR41x4PYhY-lp1nnjki3tDsdhkjGSqsNtpP7PKiB7ohJlzIAJ7MuOrBotv7dOFjByzkWGGxKdTl_qvvxhtmn95OjnbOpk00oA0qz5EFbkzH" alt="Radiance Face Oil"/>
                    <div class="absolute top-4 left-4 bg-secondary-container/90 text-on-secondary-container px-3 py-1 rounded-full text-[10px] font-label-caps font-bold">KUMKUMADI CORES</div>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="flex items-center gap-1 mb-2">
                        <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                        <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                        <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                        <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                        <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                        <span class="text-xs text-on-surface-variant ml-1">(48)</span>
                    </div>
                    <h4 class="font-headline-sm text-lg text-primary font-bold mb-2 cursor-pointer hover:text-secondary transition-colors" @click="selectedProduct = { name: 'Radiance Face Oil', price: '₹1,850', desc: 'A potent infusion of saffron and sandalwood for a deep, luminous glow.', image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuB6LGVZvguHodxq33XQpp6aprDmaYZIoJhGCW77y3u82NlVzT2OrB-tfSl0gz5tXOWx7HTmV-DeMtH39rg06Ni_pflBP9Ey_auZ_4S26YWii6J-7O_g4L0gN37kcw6ZKQcbyVP1QaNUY5ECi9hQ09P3T9LlyRrgQURU1bR41x4PYhY-lp1nnjki3tDsdhkjGSqsNtpP7PKiB7ohJlzIAJ7MuOrBotv7dOFjByzkWGGxKdTl_qvvxhtmn95OjnbOpk00oA0qz5EFbkzH' }; quickViewOpen = true">
                        Radiance Face Oil
                    </h4>
                    <p class="text-sm text-on-surface-variant leading-relaxed mb-4 flex-grow">
                        A traditional saffron formulation designed to smooth fine lines and illuminate dry skin types.
                    </p>
                    <div class="flex items-center justify-between mt-auto">
                        <span class="font-headline-sm text-lg text-secondary font-bold">₹1,850</span>
                        <button @click="cartOpen = true" class="bg-primary text-white p-3 rounded-full hover:bg-secondary hover:shadow-md transition-all active:scale-90 flex items-center justify-center cursor-pointer">
                            <span class="material-symbols-outlined text-base">add_shopping_cart</span>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Product Card 2 -->
            <div class="bg-surface rounded-2xl overflow-hidden shadow-sm border border-outline-variant/20 hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                <div @click="selectedProduct = { name: 'Vata Balancing Balm', price: '₹690', desc: 'Deeply nourishing shea and brahmi to ground the senses and calm the mind.', image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDfqLG_7gf5UL65-70XieBWo9Rd-OfCN2rJvIHCudAdGI4daN-pJhQUYL0upCaoNi2A4hIL8Hdspu9f6BFMKIC4oJXFKCiijR-Sv8gPA9PRkSjfftscRHt1-Tlwjm9CZ5-noeijSy0Nc7ISio2V0g1dEqEfylXvcrdjbp1zWnkmC27FpIfje2GvxnoCd8omaNMjm9R2i5SrvwSdntTX3qV-LhKH5KQISt-33qRMdU-TPkaWI8uAZh73hR3Eyp-6UfbfZBej06gmQkP7' }; quickViewOpen = true" class="relative aspect-[4/5] overflow-hidden cursor-pointer">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDfqLG_7gf5UL65-70XieBWo9Rd-OfCN2rJvIHCudAdGI4daN-pJhQUYL0upCaoNi2A4hIL8Hdspu9f6BFMKIC4oJXFKCiijR-Sv8gPA9PRkSjfftscRHt1-Tlwjm9CZ5-noeijSy0Nc7ISio2V0g1dEqEfylXvcrdjbp1zWnkmC27FpIfje2GvxnoCd8omaNMjm9R2i5SrvwSdntTX3qV-LhKH5KQISt-33qRMdU-TPkaWI8uAZh73hR3Eyp-6UfbfZBej06gmQkP7" alt="Vata Balancing Balm"/>
                    <div class="absolute top-4 left-4 bg-secondary-container/90 text-on-secondary-container px-3 py-1 rounded-full text-[10px] font-label-caps font-bold">SOOTHING BALMS</div>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="flex items-center gap-1 mb-2">
                        <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                        <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                        <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                        <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                        <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                        <span class="text-xs text-on-surface-variant ml-1">(32)</span>
                    </div>
                    <h4 class="font-headline-sm text-lg text-primary font-bold mb-2 cursor-pointer hover:text-secondary transition-colors" @click="selectedProduct = { name: 'Vata Balancing Balm', price: '₹690', desc: 'Deeply nourishing shea and brahmi to ground the senses and calm the mind.', image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDfqLG_7gf5UL65-70XieBWo9Rd-OfCN2rJvIHCudAdGI4daN-pJhQUYL0upCaoNi2A4hIL8Hdspu9f6BFMKIC4oJXFKCiijR-Sv8gPA9PRkSjfftscRHt1-Tlwjm9CZ5-noeijSy0Nc7ISio2V0g1dEqEfylXvcrdjbp1zWnkmC27FpIfje2GvxnoCd8omaNMjm9R2i5SrvwSdntTX3qV-LhKH5KQISt-33qRMdU-TPkaWI8uAZh73hR3Eyp-6UfbfZBej06gmQkP7' }; quickViewOpen = true">
                        Vata Balancing Balm
                    </h4>
                    <p class="text-sm text-on-surface-variant leading-relaxed mb-4 flex-grow">
                        Infused with Ashwagandha and Sesame oil to ground hyperactive energies and soothe rough skin patches.
                    </p>
                    <div class="flex items-center justify-between mt-auto">
                        <span class="font-headline-sm text-lg text-secondary font-bold">₹690</span>
                        <button @click="cartOpen = true" class="bg-primary text-white p-3 rounded-full hover:bg-secondary hover:shadow-md transition-all active:scale-90 flex items-center justify-center cursor-pointer">
                            <span class="material-symbols-outlined text-base">add_shopping_cart</span>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Product Card 3 -->
            <div class="bg-surface rounded-2xl overflow-hidden shadow-sm border border-outline-variant/20 hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                <div @click="selectedProduct = { name: 'Silk Hair Nectar', price: '₹1,450', desc: 'A rich infusion of Amla and Coconut milk for restorative shine.', image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBtOxP2-m1FzCmgTxTd7tSOHf0Wq404IJ1y9vjOa37tFF7JfoJW9eot7Z0DQJ6CgszYJU4R4d-88J_SkeNs1Ky3379K1q_GjDqlSWeIBssany8KKbtkn0XTjUpBYRZKNcxDZGDoxusQ6bRemu2QZWDQeX9ipcRupA9KLHNLCL6pl1ufCGeQ7X7-xs-bno_vFf4DtO6DY5HgOvOQitDF89faVv90cI4BnbffMTDva4cjpUYPfwJF2OkXM9eTYXIe-_egDB1LeTzWnVm7' }; quickViewOpen = true" class="relative aspect-[4/5] overflow-hidden cursor-pointer">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBtOxP2-m1FzCmgTxTd7tSOHf0Wq404IJ1y9vjOa37tFF7JfoJW9eot7Z0DQJ6CgszYJU4R4d-88J_SkeNs1Ky3379K1q_GjDqlSWeIBssany8KKbtkn0XTjUpBYRZKNcxDZGDoxusQ6bRemu2QZWDQeX9ipcRupA9KLHNLCL6pl1ufCGeQ7X7-xs-bno_vFf4DtO6DY5HgOvOQitDF89faVv90cI4BnbffMTDva4cjpUYPfwJF2OkXM9eTYXIe-_egDB1LeTzWnVm7" alt="Silk Hair Nectar"/>
                    <div class="absolute top-4 left-4 bg-secondary-container/90 text-on-secondary-container px-3 py-1 rounded-full text-[10px] font-label-caps font-bold">HAIR REJUVENATION</div>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="flex items-center gap-1 mb-2">
                        <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                        <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                        <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                        <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                        <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                        <span class="text-xs text-on-surface-variant ml-1">(54)</span>
                    </div>
                    <h4 class="font-headline-sm text-lg text-primary font-bold mb-2 cursor-pointer hover:text-secondary transition-colors" @click="selectedProduct = { name: 'Silk Hair Nectar', price: '₹1,450', desc: 'A rich infusion of Amla and Coconut milk for restorative shine.', image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBtOxP2-m1FzCmgTxTd7tSOHf0Wq404IJ1y9vjOa37tFF7JfoJW9eot7Z0DQJ6CgszYJU4R4d-88J_SkeNs1Ky3379K1q_GjDqlSWeIBssany8KKbtkn0XTjUpBYRZKNcxDZGDoxusQ6bRemu2QZWDQeX9ipcRupA9KLHNLCL6pl1ufCGeQ7X7-xs-bno_vFf4DtO6DY5HgOvOQitDF89faVv90cI4BnbffMTDva4cjpUYPfwJF2OkXM9eTYXIe-_egDB1LeTzWnVm7' }; quickViewOpen = true">
                        Silk Hair Nectar
                    </h4>
                    <p class="text-sm text-on-surface-variant leading-relaxed mb-4 flex-grow">
                        Restores vitality to dry roots and brittle ends with cold-pressed Amla berries and clarifying Neem extracts.
                    </p>
                    <div class="flex items-center justify-between mt-auto">
                        <span class="font-headline-sm text-lg text-secondary font-bold">₹1,450</span>
                        <button @click="cartOpen = true" class="bg-primary text-white p-3 rounded-full hover:bg-secondary hover:shadow-md transition-all active:scale-90 flex items-center justify-center cursor-pointer">
                            <span class="material-symbols-outlined text-base">add_shopping_cart</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product Card 4: Kumkumadi Rejuvenating Serum -->
            <div class="bg-surface rounded-2xl overflow-hidden shadow-sm border border-outline-variant/20 hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                <div @click="selectedProduct = { name: 'Kumkumadi Rejuvenating Serum', price: '₹1,249', desc: 'Traditional night serum that restores youthful glow and repairs skin cells overnight.', image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuB2KqtdvrIlGaTzFICQA6FU-rEPz4ax6MdnCZ5uk9rR-EnrvPxJXvFkt6oF_JPl7NaB5HcIE3o4vCV_j_zp_hcktPaeGQVLTkS0tJdrhlQ5h_Q5AkD2PjIm2BerM7QiNqCz09DBsobBACw7_5UYgXteStK6GV2u8ybzPJE5x2ItjKXuRLNcoOsT-Rkx5KQ2aAqpDGurC8ETEMoLTcPavfyX7_4nS1011De7ivqGRze2MIIDlUVldVKtiyh0J2LLM-M96XNsUcGS_-BL' }; quickViewOpen = true" class="relative aspect-[4/5] overflow-hidden cursor-pointer">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB2KqtdvrIlGaTzFICQA6FU-rEPz4ax6MdnCZ5uk9rR-EnrvPxJXvFkt6oF_JPl7NaB5HcIE3o4vCV_j_zp_hcktPaeGQVLTkS0tJdrhlQ5h_Q5AkD2PjIm2BerM7QiNqCz09DBsobBACw7_5UYgXteStK6GV2u8ybzPJE5x2ItjKXuRLNcoOsT-Rkx5KQ2aAqpDGurC8ETEMoLTcPavfyX7_4nS1011De7ivqGRze2MIIDlUVldVKtiyh0J2LLM-M96XNsUcGS_-BL" alt="Kumkumadi Rejuvenating Serum"/>
                    <div class="absolute top-4 left-4 bg-secondary-container/90 text-on-secondary-container px-3 py-1 rounded-full text-[10px] font-label-caps font-bold">NIGHT REPAIR</div>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="flex items-center gap-1 mb-2">
                        <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                        <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                        <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                        <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                        <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                        <span class="text-xs text-on-surface-variant ml-1">(27)</span>
                    </div>
                    <h4 class="font-headline-sm text-lg text-primary font-bold mb-2 cursor-pointer hover:text-secondary transition-colors" @click="selectedProduct = { name: 'Kumkumadi Rejuvenating Serum', price: '₹1,249', desc: 'Traditional night serum that restores youthful glow and repairs skin cells overnight.', image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuB2KqtdvrIlGaTzFICQA6FU-rEPz4ax6MdnCZ5uk9rR-EnrvPxJXvFkt6oF_JPl7NaB5HcIE3o4vCV_j_zp_hcktPaeGQVLTkS0tJdrhlQ5h_Q5AkD2PjIm2BerM7QiNqCz09DBsobBACw7_5UYgXteStK6GV2u8ybzPJE5x2ItjKXuRLNcoOsT-Rkx5KQ2aAqpDGurC8ETEMoLTcPavfyX7_4nS1011De7ivqGRze2MIIDlUVldVKtiyh0J2LLM-M96XNsUcGS_-BL' }; quickViewOpen = true">
                        Kumkumadi Rejuvenating Serum
                    </h4>
                    <p class="text-sm text-on-surface-variant leading-relaxed mb-4 flex-grow">
                        Traditional night serum that restores youthful glow and repairs skin cells overnight with premium Kashmiri Saffron.
                    </p>
                    <div class="flex items-center justify-between mt-auto">
                        <span class="font-headline-sm text-lg text-secondary font-bold">₹1,249</span>
                        <button @click="cartOpen = true" class="bg-primary text-white p-3 rounded-full hover:bg-secondary hover:shadow-md transition-all active:scale-90 flex items-center justify-center cursor-pointer">
                            <span class="material-symbols-outlined text-base">add_shopping_cart</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product Card 5: Tejas Brightening Face Mask -->
            <div class="bg-surface rounded-2xl overflow-hidden shadow-sm border border-outline-variant/20 hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                <div @click="selectedProduct = { name: 'Tejas Brightening Face Mask', price: '₹899', desc: 'A cooling herbal clay mask to target active breakouts and instantly brighten tanned skin.', image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBAa7m03kwvnRFmELlh7O-eCXCrFDpGx7mndLB8sm-Pyj82hGyJTcbzL8fEahAc_djIO30Lp1wzpc6PF8jA-vMIOZ-yRQJrm24k4GoYppGD9d-ib-N3JTKl-S3jh6I9wVBToEqe9RxN-7gRX3dZoZMCNtHbovBcslwJpb0Cn5z607k70tHpMUdHRicV8_eWhRgP-FAK3Fjy7u5Q9J7wNH977L9ovdHOTDfZ6HtJpy_YmOLpOmJkVYQ2K08ztww5BuO_B0-WSKk9Mt61' }; quickViewOpen = true" class="relative aspect-[4/5] overflow-hidden cursor-pointer">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBAa7m03kwvnRFmELlh7O-eCXCrFDpGx7mndLB8sm-Pyj82hGyJTcbzL8fEahAc_djIO30Lp1wzpc6PF8jA-vMIOZ-yRQJrm24k4GoYppGD9d-ib-N3JTKl-S3jh6I9wVBToEqe9RxN-7gRX3dZoZMCNtHbovBcslwJpb0Cn5z607k70tHpMUdHRicV8_eWhRgP-FAK3Fjy7u5Q9J7wNH977L9ovdHOTDfZ6HtJpy_YmOLpOmJkVYQ2K08ztww5BuO_B0-WSKk9Mt61" alt="Tejas Brightening Face Mask"/>
                    <div class="absolute top-4 left-4 bg-secondary-container/90 text-on-secondary-container px-3 py-1 rounded-full text-[10px] font-label-caps font-bold">DETOX MASK</div>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="flex items-center gap-1 mb-2">
                        <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                        <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                        <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                        <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                        <span class="material-symbols-outlined text-sm text-secondary/40">star</span>
                        <span class="text-xs text-on-surface-variant ml-1">(19)</span>
                    </div>
                    <h4 class="font-headline-sm text-lg text-primary font-bold mb-2 cursor-pointer hover:text-secondary transition-colors" @click="selectedProduct = { name: 'Tejas Brightening Face Mask', price: '₹899', desc: 'A cooling herbal clay mask to target active breakouts and instantly brighten tanned skin.', image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBAa7m03kwvnRFmELlh7O-eCXCrFDpGx7mndLB8sm-Pyj82hGyJTcbzL8fEahAc_djIO30Lp1wzpc6PF8jA-vMIOZ-yRQJrm24k4GoYppGD9d-ib-N3JTKl-S3jh6I9wVBToEqe9RxN-7gRX3dZoZMCNtHbovBcslwJpb0Cn5z607k70tHpMUdHRicV8_eWhRgP-FAK3Fjy7u5Q9J7wNH977L9ovdHOTDfZ6HtJpy_YmOLpOmJkVYQ2K08ztww5BuO_B0-WSKk9Mt61' }; quickViewOpen = true">
                        Tejas Brightening Face Mask
                    </h4>
                    <p class="text-sm text-on-surface-variant leading-relaxed mb-4 flex-grow">
                        A cooling herbal clay mask to target active breakouts, tighten pores, and instantly brighten tanned skin constitutions.
                    </p>
                    <div class="flex items-center justify-between mt-auto">
                        <span class="font-headline-sm text-lg text-secondary font-bold">₹899</span>
                        <button @click="cartOpen = true" class="bg-primary text-white p-3 rounded-full hover:bg-secondary hover:shadow-md transition-all active:scale-90 flex items-center justify-center cursor-pointer">
                            <span class="material-symbols-outlined text-base">add_shopping_cart</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product Card 6: Ojas Immunity Booster Elixir -->
            <div class="bg-surface rounded-2xl overflow-hidden shadow-sm border border-outline-variant/20 hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                <div @click="selectedProduct = { name: 'Ojas Immunity Booster Elixir', price: '₹650', desc: 'Fortified with Amla, Giloy and pure wild honey to boost daily energy and viral defense.', image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuCtvuWjBpX4Ud52-YiDxxvj3Oahyowxiapahu3coatkcN6CJxx4gypXqaxVq_CHod-NHB0j6EvUUTymIHZ0SX9iEl3lkBnl53EiQXCL6occYUzi09ivc8wBresNADED8_AJ8zOMaAVVxP6ygeTR2sfiYFBQv-JV7YGseX2hmmQ35u1gbQg2srDDLTJW3RD-TruxNQbCzOR_CCGHwWN_wAuo7kAoRlwBRPaFu_g2xTu92Tso-GscbWOZMNRArBmcCZuyOBA7IzMKuCJe' }; quickViewOpen = true" class="relative aspect-[4/5] overflow-hidden cursor-pointer">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCtvuWjBpX4Ud52-YiDxxvj3Oahyowxiapahu3coatkcN6CJxx4gypXqaxVq_CHod-NHB0j6EvUUTymIHZ0SX9iEl3lkBnl53EiQXCL6occYUzi09ivc8wBresNADED8_AJ8zOMaAVVxP6ygeTR2sfiYFBQv-JV7YGseX2hmmQ35u1gbQg2srDDLTJW3RD-TruxNQbCzOR_CCGHwWN_wAuo7kAoRlwBRPaFu_g2xTu92Tso-GscbWOZMNRArBmcCZuyOBA7IzMKuCJe" alt="Ojas Immunity Booster Elixir"/>
                    <div class="absolute top-4 left-4 bg-secondary-container/90 text-on-secondary-container px-3 py-1 rounded-full text-[10px] font-label-caps font-bold">DAILY WELLNESS</div>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="flex items-center gap-1 mb-2">
                        <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                        <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                        <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                        <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                        <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                        <span class="text-xs text-on-surface-variant ml-1">(61)</span>
                    </div>
                    <h4 class="font-headline-sm text-lg text-primary font-bold mb-2 cursor-pointer hover:text-secondary transition-colors" @click="selectedProduct = { name: 'Ojas Immunity Booster Elixir', price: '₹650', desc: 'Fortified with Amla, Giloy and pure wild honey to boost daily energy and viral defense.', image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuCtvuWjBpX4Ud52-YiDxxvj3Oahyowxiapahu3coatkcN6CJxx4gypXqaxVq_CHod-NHB0j6EvUUTymIHZ0SX9iEl3lkBnl53EiQXCL6occYUzi09ivc8wBresNADED8_AJ8zOMaAVVxP6ygeTR2sfiYFBQv-JV7YGseX2hmmQ35u1gbQg2srDDLTJW3RD-TruxNQbCzOR_CCGHwWN_wAuo7kAoRlwBRPaFu_g2xTu92Tso-GscbWOZMNRArBmcCZuyOBA7IzMKuCJe' }; quickViewOpen = true">
                        Ojas Immunity Booster Elixir
                    </h4>
                    <p class="text-sm text-on-surface-variant leading-relaxed mb-4 flex-grow">
                        Fortified with wild Amla berries, adaptogenic Giloy and pure honey to boost daily energy and viral defense.
                    </p>
                    <div class="flex items-center justify-between mt-auto">
                        <span class="font-headline-sm text-lg text-secondary font-bold">₹650</span>
                        <button @click="cartOpen = true" class="bg-primary text-white p-3 rounded-full hover:bg-secondary hover:shadow-md transition-all active:scale-90 flex items-center justify-center cursor-pointer">
                            <span class="material-symbols-outlined text-base">add_shopping_cart</span>
                        </button>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- Section: Key Ingredients Showcase -->
<section id="ingredients" class="py-16">
    <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-desktop">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="font-label-caps text-xs text-secondary font-bold tracking-widest uppercase">THE BIO-ACTIVES</span>
            <h3 class="font-headline-md text-3xl text-primary font-bold mt-2">Active Botanical Powerhouses</h3>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Herb 1 -->
            <div class="bg-surface-container rounded-2xl p-6 border border-outline-variant/10 text-center hover:bg-surface-container-high transition-colors duration-300">
                <span class="material-symbols-outlined text-4xl text-secondary mb-4">brightness_high</span>
                <h4 class="font-headline-sm text-lg text-primary font-bold mb-2">Kumkumadi (Saffron)</h4>
                <p class="font-body-md text-xs text-on-surface-variant leading-relaxed">
                    Sourced from Kashmir valleys. Rich in antioxidants to repair cells, neutralize inflammation, and promote an even skin tone.
                </p>
            </div>
            
            <!-- Herb 2 -->
            <div class="bg-surface-container rounded-2xl p-6 border border-outline-variant/10 text-center hover:bg-surface-container-high transition-colors duration-300">
                <span class="material-symbols-outlined text-4xl text-secondary mb-4">self_improvement</span>
                <h4 class="font-headline-sm text-lg text-primary font-bold mb-2">Ashwagandha</h4>
                <p class="font-body-md text-xs text-on-surface-variant leading-relaxed">
                    A powerful adaptogenic root that helps neutralize cortisol and calm skin conditions triggered by external stressors.
                </p>
            </div>
            
            <!-- Herb 3 -->
            <div class="bg-surface-container rounded-2xl p-6 border border-outline-variant/10 text-center hover:bg-surface-container-high transition-colors duration-300">
                <span class="material-symbols-outlined text-4xl text-secondary mb-4">eco</span>
                <h4 class="font-headline-sm text-lg text-primary font-bold mb-2">Gotu Kola (Centella)</h4>
                <p class="font-body-md text-xs text-on-surface-variant leading-relaxed">
                    Often called the 'herb of longevity'. Promotes healthy blood microcirculation to trigger collagen synthesis and firm skin tissues.
                </p>
            </div>
            
            <!-- Herb 4 -->
            <div class="bg-surface-container rounded-2xl p-6 border border-outline-variant/10 text-center hover:bg-surface-container-high transition-colors duration-300">
                <span class="material-symbols-outlined text-4xl text-secondary mb-4">spa</span>
                <h4 class="font-headline-sm text-lg text-primary font-bold mb-2">Brahmi &amp; Amla</h4>
                <p class="font-body-md text-xs text-on-surface-variant leading-relaxed">
                    Infused to stimulate hair follicles, control dry dandruff flakes, and lock in deep moisture to provide hair thickness and shine.
                </p>
            </div>
            
        </div>
    </div>
</section>

<!-- Section: Interactive Dosha Quiz Card -->
<section id="quiz" class="py-16 bg-surface-container-low">
    <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-desktop">
        <div class="bg-primary-container text-white rounded-3xl overflow-hidden p-8 md:p-12 lg:p-16 shadow-lg relative">
            
            <div class="absolute -right-20 -bottom-20 opacity-20 w-80 h-80 rounded-full border-4 border-dashed border-white"></div>
            
            <div class="relative z-10 max-w-3xl mx-auto text-center">
                <span class="font-label-caps text-xs text-secondary-container font-bold tracking-widest uppercase mb-2 block">DISCOVER YOUR CONSTITUTION</span>
                <h3 class="font-display-lg text-3xl md:text-4xl text-white font-bold mb-4">Find Your Dosha Alignment</h3>
                <p class="font-body-lg text-base text-white/90 mb-10 max-w-xl mx-auto">
                    Ayurveda believes everything consists of Vata (Air/Space), Pitta (Fire/Water), or Kapha (Earth/Water). Pick your dominant trait below to find your ritual.
                </p>
                
                <!-- Quick Selection Buttons -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 text-left">
                    
                    <button :class="dosha === 'vata' ? 'bg-secondary border-secondary' : 'bg-surface/10 border-white/20 hover:bg-surface/20'" @click="dosha = 'vata'" class="py-4 px-6 rounded-xl border transition-all text-white flex justify-between items-center group cursor-pointer">
                        <div>
                            <span class="font-bold block text-sm">Vata Skin type</span>
                            <span class="text-xs opacity-75">Dry, cold, thin, prone to scales.</span>
                        </div>
                        <span class="material-symbols-outlined text-lg opacity-80" data-icon="air">air</span>
                    </button>
                    
                    <button :class="dosha === 'pitta' ? 'bg-secondary border-secondary' : 'bg-surface/10 border-white/20 hover:bg-surface/20'" @click="dosha = 'pitta'" class="py-4 px-6 rounded-xl border transition-all text-white flex justify-between items-center group cursor-pointer">
                        <div>
                            <span class="font-bold block text-sm">Pitta Skin type</span>
                            <span class="text-xs opacity-75">Sensitive, hot, red, prone to flares.</span>
                        </div>
                        <span class="material-symbols-outlined text-lg opacity-80" data-icon="mode_fan">mode_fan</span>
                    </button>
                    
                    <button :class="dosha === 'kapha' ? 'bg-secondary border-secondary' : 'bg-surface/10 border-white/20 hover:bg-surface/20'" @click="dosha = 'kapha'" class="py-4 px-6 rounded-xl border transition-all text-white flex justify-between items-center group cursor-pointer">
                        <div>
                            <span class="font-bold block text-sm">Kapha Skin type</span>
                            <span class="text-xs opacity-75">Oily, thick, cold, prone to congestion.</span>
                        </div>
                        <span class="material-symbols-outlined text-lg opacity-80" data-icon="water_drop">water_drop</span>
                    </button>
                    
                </div>
                
                <!-- Recommendation Text (with transition effects) -->
                <div class="bg-surface/10 p-6 rounded-2xl border border-white/10 text-white text-left max-w-xl mx-auto shadow-inner" x-cloak x-show="dosha" x-transition>
                    <h4 class="font-bold text-sm tracking-wider uppercase mb-2 text-secondary-container">Your Custom Recommended Ritual:</h4>
                    
                    <div x-show="dosha === 'vata'" class="text-sm leading-relaxed opacity-95">
                        <p class="mb-2">Your dry Vata skin requires deep hydration. We suggest our <strong>Vata Balancing Balm</strong> infused with adaptogenic Ashwagandha and rich sesame seed oils to protect the lipid barrier.</p>
                        <span class="font-semibold text-secondary-container text-xs">Self-care Tip: Warm oil massages at dusk.</span>
                    </div>
                    
                    <div x-show="dosha === 'pitta'" class="text-sm leading-relaxed opacity-95">
                        <p class="mb-2">Your sensitive Pitta skin requires cooling bio-actives. We suggest cooling sandalwood face washes and our <strong>Radiance Face Oil</strong> to target hyperpigmentation without irritating skin.</p>
                        <span class="font-semibold text-secondary-container text-xs">Self-care Tip: Avoid hot spicy spices.</span>
                    </div>
                    
                    <div x-show="dosha === 'kapha'" class="text-sm leading-relaxed opacity-95">
                        <p class="mb-2">Your oily Kapha skin requires warming, stimulating herbs. We suggest regular gentle exfoliation and our dry <strong>Silk Hair Nectar</strong> scalp scrubs to clean follicles and boost oxygenation.</p>
                        <span class="font-semibold text-secondary-container text-xs">Self-care Tip: Dry massage before bathing.</span>
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>
</section>

<!-- Section: Consultation -->
<section id="consultation" class="py-16">
    <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-desktop">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center bg-surface-container rounded-3xl p-8 md:p-16">
            
            <!-- Left: Consultation Copy -->
            <div class="lg:col-span-7">
                <span class="font-label-caps text-xs text-secondary font-bold tracking-widest uppercase">PERSONALIZED HEALING</span>
                <h3 class="font-headline-md text-3xl md:text-4xl text-primary font-bold mt-2 mb-6">Speak to an Ayurvedic Expert</h3>
                <p class="font-body-lg text-base text-on-surface-variant leading-relaxed mb-6">
                    Ayurveda is not a one-size-fits-all remedy. True healing requires understanding your unique constitutional blueprint.
                </p>
                <p class="font-body-md text-sm text-on-surface-variant leading-relaxed mb-8">
                    Schedule a private virtual consultation with our certified Ayurvedic Vaidyas. In a 45-minute session, we will analyze your Prakriti (birth constitution) and current imbalances (Vikriti) to craft a customized lifestyle journal, diet plan, and targeted botanical rituals.
                </p>
                
                <!-- Trust Points -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary text-xl">verified_user</span>
                        <span class="text-sm font-semibold text-primary">Certified Vaidyas (BAMS Doctors)</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary text-xl">chat</span>
                        <span class="text-sm font-semibold text-primary">45-Min Private Zoom Session</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary text-xl">menu_book</span>
                        <span class="text-sm font-semibold text-primary">Personalized Food & Herb Journal</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary text-xl">favorite</span>
                        <span class="text-sm font-semibold text-primary">Follow-up Support & Diagnostics</span>
                    </div>
                </div>
            </div>
            
            <!-- Right: Booking Card Form -->
            <div class="lg:col-span-5 bg-surface rounded-2xl p-8 border border-outline-variant/30 shadow-sm">
                <h4 class="font-headline-sm text-lg text-primary font-bold mb-4">Book Your Vaidya Session</h4>
                <form class="space-y-4">
                    <div>
                        <label class="block text-xs font-label-caps text-on-surface-variant uppercase font-bold mb-2">Full Name</label>
                        <input class="w-full bg-surface-container-low border border-outline-variant/40 focus:border-secondary rounded-lg px-4 py-3 outline-none text-sm" placeholder="Devika Sen" type="text"/>
                    </div>
                    <div>
                        <label class="block text-xs font-label-caps text-on-surface-variant uppercase font-bold mb-2">Email Address</label>
                        <input class="w-full bg-surface-container-low border border-outline-variant/40 focus:border-secondary rounded-lg px-4 py-3 outline-none text-sm" placeholder="devika@healing.com" type="email"/>
                    </div>
                    <div>
                        <label class="block text-xs font-label-caps text-on-surface-variant uppercase font-bold mb-2">Primary Wellness Concern</label>
                        <select class="w-full bg-surface-container-low border border-outline-variant/40 focus:border-secondary rounded-lg px-4 py-3 outline-none text-sm">
                            <option>Skin Concerns (Acne, Redness, Dryness)</option>
                            <option>Hair Loss / Scalp Imbalances</option>
                            <option>Chronic Fatigue & Low Immunity</option>
                            <option>Digestive / Metabolic Concerns</option>
                            <option>Stress & Mind-Body Imbalance</option>
                        </select>
                    </div>
                    <button class="w-full bg-secondary hover:bg-secondary/90 text-white font-label-caps text-xs tracking-wider py-4 rounded-full active:scale-95 transition-all mt-4 font-bold cursor-pointer" type="button">
                        CONFIRM APPOINTMENT (₹1,500)
                    </button>
                </form>
            </div>
            
        </div>
    </div>
</section>

<!-- Section: Blog -->
<section id="blog" class="py-16 bg-surface-container-low">
    <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-desktop">
        <div class="flex items-center justify-between mb-12">
            <div>
                <span class="font-label-caps text-xs text-secondary font-bold tracking-widest uppercase">THE JOURNAL</span>
                <h3 class="font-headline-sm text-2xl md:text-3xl text-primary font-bold mt-1">Ayurvedic Sanctuary Wisdom</h3>
            </div>
            <span class="font-label-caps text-xs text-secondary hover:text-primary cursor-pointer tracking-wider font-bold transition-colors">READ ALL JOURNALS</span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- Post 1 -->
            <article class="bg-surface rounded-2xl overflow-hidden border border-outline-variant/20 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col group">
                <div class="relative aspect-video overflow-hidden">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB2KqtdvrIlGaTzFICQA6FU-rEPz4ax6MdnCZ5uk9rR-EnrvPxJXvFkt6oF_JPl7NaB5HcIE3o4vCV_j_zp_hcktPaeGQVLTkS0tJdrhlQ5h_Q5AkD2PjIm2BerM7QiNqCz09DBsobBACw7_5UYgXteStK6GV2u8ybzPJE5x2ItjKXuRLNcoOsT-Rkx5KQ2aAqpDGurC8ETEMoLTcPavfyX7_4nS1011De7ivqGRze2MIIDlUVldVKtiyh0J2LLM-M96XNsUcGS_-BL" alt="Dinacharya Routine"/>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <span class="font-label-caps text-[10px] text-secondary font-bold mb-2">DAILY RITUALS</span>
                    <h4 class="font-headline-sm text-lg text-primary font-bold mb-3 group-hover:text-secondary transition-colors">
                        Dinacharya: The Morning Routine of Eternal Radiance
                    </h4>
                    <p class="text-xs text-on-surface-variant leading-relaxed mb-4 flex-grow">
                        Discover the vital morning sequence of oil pulling, copper tongue scraping, and warm self-massages to purge toxins.
                    </p>
                    <a class="text-xs font-bold text-primary hover:text-secondary inline-flex items-center gap-1 group-hover:gap-2 transition-all mt-auto" href="#">
                        READ JOURNAL <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>
            </article>
            
            <!-- Post 2 -->
            <article class="bg-surface rounded-2xl overflow-hidden border border-outline-variant/20 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col group">
                <div class="relative aspect-video overflow-hidden">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCtvuWjBpX4Ud52-YiDxxvj3Oahyowxiapahu3coatkcN6CJxx4gypXqaxVq_CHod-NHB0j6EvUUTymIHZ0SX9iEl3lkBnl53EiQXCL6occYUzi09ivc8wBresNADED8_AJ8zOMaAVVxP6ygeTR2sfiYFBQv-JV7YGseX2hmmQ35u1gbQg2srDDLTJW3RD-TruxNQbCzOR_CCGHwWN_wAuo7kAoRlwBRPaFu_g2xTu92Tso-GscbWOZMNRArBmcCZuyOBA7IzMKuCJe" alt="Shad Rasa tastes"/>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <span class="font-label-caps text-[10px] text-secondary font-bold mb-2">DIET &amp; NUTRITION</span>
                    <h4 class="font-headline-sm text-lg text-primary font-bold mb-3 group-hover:text-secondary transition-colors">
                        The Six Tastes (Shad Rasa) for Digestive Harmony
                    </h4>
                    <p class="text-xs text-on-surface-variant leading-relaxed mb-4 flex-grow">
                        Learn how balancing Sweet, Sour, Salty, Bitter, Pungent, and Astringent tastes stabilizes metabolism and eliminates food cravings.
                    </p>
                    <a class="text-xs font-bold text-primary hover:text-secondary inline-flex items-center gap-1 group-hover:gap-2 transition-all mt-auto" href="#">
                        READ JOURNAL <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>
            </article>
            
            <!-- Post 3 -->
            <article class="bg-surface rounded-2xl overflow-hidden border border-outline-variant/20 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col group">
                <div class="relative aspect-video overflow-hidden">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB6LGVZvguHodxq33XQpp6aprDmaYZIoJhGCW77y3u82NlVzT2OrB-tfSl0gz5tXOWx7HTmV-DeMtH39rg06Ni_pflBP9Ey_auZ_4S26YWii6J-7O_g4L0gN37kcw6ZKQcbyVP1QaNUY5ECi9hQ09P3T9LlyRrgQURU1bR41x4PYhY-lp1nnjki3tDsdhkjGSqsNtpP7PKiB7ohJlzIAJ7MuOrBotv7dOFjByzkWGGxKdTl_qvvxhtmn95OjnbOpk00oA0qz5EFbkzH" alt="Herbs and Oils"/>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <span class="font-label-caps text-[10px] text-secondary font-bold mb-2">BOTANICAL SCIENCE</span>
                    <h4 class="font-headline-sm text-lg text-primary font-bold mb-3 group-hover:text-secondary transition-colors">
                        Sandalwood: The Cooling Nectar of Pitta Pacification
                    </h4>
                    <p class="text-xs text-on-surface-variant leading-relaxed mb-4 flex-grow">
                        An in-depth look at sandalwood's thermodynamic properties to instantly soothe active skin inflammation, redness, and high fire.
                    </p>
                    <a class="text-xs font-bold text-primary hover:text-secondary inline-flex items-center gap-1 group-hover:gap-2 transition-all mt-auto" href="#">
                        READ JOURNAL <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>
            </article>
            
        </div>
    </div>
</section>

<!-- Section: FAQ Accordion -->
<section id="faq" class="py-16 bg-surface-container-low border-t border-outline-variant/10" x-data="{ activeFaq: null }">
    <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-desktop">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="font-label-caps text-xs text-secondary font-bold tracking-widest uppercase">KNOWLEDGE BASE</span>
            <h3 class="font-headline-md text-3xl text-primary font-bold mt-2">Frequently Asked Questions</h3>
        </div>
        <div class="max-w-3xl mx-auto space-y-4">
            <!-- FAQ 1 -->
            <div class="bg-surface rounded-2xl border border-outline-variant/20 overflow-hidden transition-all duration-300">
                <button @click="activeFaq = (activeFaq === 1 ? null : 1)" class="w-full text-left px-6 py-5 flex justify-between items-center gap-4 cursor-pointer hover:bg-surface-container-low/50">
                    <span class="font-headline-sm text-base md:text-lg text-primary font-semibold">How do I know my Dosha type?</span>
                    <span class="material-symbols-outlined text-secondary transition-transform duration-300" :class="activeFaq === 1 ? 'rotate-180' : ''">keyboard_arrow_down</span>
                </button>
                <div x-cloak x-show="activeFaq === 1" x-transition class="px-6 pb-5 text-sm text-on-surface-variant leading-relaxed">
                    You can use our interactive <a href="#quiz" class="text-secondary hover:underline font-semibold">Dosha Quiz</a> above to get a quick initial constitution analysis. For a comprehensive diagnostics report, we recommend scheduling a private session with our certified Vaidyas.
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="bg-surface rounded-2xl border border-outline-variant/20 overflow-hidden transition-all duration-300">
                <button @click="activeFaq = (activeFaq === 2 ? null : 2)" class="w-full text-left px-6 py-5 flex justify-between items-center gap-4 cursor-pointer hover:bg-surface-container-low/50">
                    <span class="font-headline-sm text-base md:text-lg text-primary font-semibold">Are all ingredients organic and sustainably sourced?</span>
                    <span class="material-symbols-outlined text-secondary transition-transform duration-300" :class="activeFaq === 2 ? 'rotate-180' : ''">keyboard_arrow_down</span>
                </button>
                <div x-cloak x-show="activeFaq === 2" x-transition class="px-6 pb-5 text-sm text-on-surface-variant leading-relaxed">
                    Yes, 100% of our botanicals are wild-harvested or organically farmed in peak seasons from local farms in India, ensuring peak therapeutic efficacy while supporting sustainable farming communities.
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="bg-surface rounded-2xl border border-outline-variant/20 overflow-hidden transition-all duration-300">
                <button @click="activeFaq = (activeFaq === 3 ? null : 3)" class="w-full text-left px-6 py-5 flex justify-between items-center gap-4 cursor-pointer hover:bg-surface-container-low/50">
                    <span class="font-headline-sm text-base md:text-lg text-primary font-semibold">What is the return policy for wellness products?</span>
                    <span class="material-symbols-outlined text-secondary transition-transform duration-300" :class="activeFaq === 3 ? 'rotate-180' : ''">keyboard_arrow_down</span>
                </button>
                <div x-cloak x-show="activeFaq === 3" x-transition class="px-6 pb-5 text-sm text-on-surface-variant leading-relaxed">
                    We offer a 30-day money-back guarantee on all our products if you do not see a positive difference in your skin or hair wellness, or if you experience any sensitivity.
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="bg-surface rounded-2xl border border-outline-variant/20 overflow-hidden transition-all duration-300">
                <button @click="activeFaq = (activeFaq === 4 ? null : 4)" class="w-full text-left px-6 py-5 flex justify-between items-center gap-4 cursor-pointer hover:bg-surface-container-low/50">
                    <span class="font-headline-sm text-base md:text-lg text-primary font-semibold">How long does shipping take?</span>
                    <span class="material-symbols-outlined text-secondary transition-transform duration-300" :class="activeFaq === 4 ? 'rotate-180' : ''">keyboard_arrow_down</span>
                </button>
                <div x-cloak x-show="activeFaq === 4" x-transition class="px-6 pb-5 text-sm text-on-surface-variant leading-relaxed">
                    We ship all over India. Orders are dispatched within 24-48 hours and typically arrive within 3-5 business days. Express shipping options are available at checkout.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section: Testimonials -->
<section id="testimonials" class="py-16">
    <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-desktop">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="font-label-caps text-xs text-secondary font-bold tracking-widest uppercase">TESTIMONIALS</span>
            <h3 class="font-headline-md text-3xl text-primary font-bold mt-2">Loved by Conscious Minds</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- Review 1 -->
            <div class="bg-surface-container rounded-2xl p-8 border border-outline-variant/10 flex flex-col justify-between hover:shadow-sm transition-shadow">
                <div class="flex items-center gap-1 mb-4">
                    <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                    <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                    <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                    <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                    <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                </div>
                <p class="font-body-md text-sm text-on-surface-variant italic leading-relaxed mb-6">
                    "The Radiance Face Oil completely transformed my skin texture! I used to have dark dry spots, but within two weeks of night usage, my face looks glowing and supple. It feels like a high-end luxury spa."
                </p>
                <div class="flex items-center gap-3 mt-auto">
                    <div class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center font-bold text-on-secondary-container text-xs">
                        DS
                    </div>
                    <div>
                        <span class="font-bold block text-sm text-primary">Devika S.</span>
                        <span class="text-xs text-on-surface-variant">Verified Buyer</span>
                    </div>
                </div>
            </div>
            
            <!-- Review 2 -->
            <div class="bg-surface-container rounded-2xl p-8 border border-outline-variant/10 flex flex-col justify-between hover:shadow-sm transition-shadow">
                <div class="flex items-center gap-1 mb-4">
                    <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                    <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                    <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                    <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                    <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                </div>
                <p class="font-body-md text-sm text-on-surface-variant italic leading-relaxed mb-6">
                    "The Vata Balancing Balm has been my savior during cold winter months. My dry elbows and cheeks stay hydrated all day without feeling sticky or heavy. The woodsy aroma is extremely grounding."
                </p>
                <div class="flex items-center gap-3 mt-auto">
                    <div class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center font-bold text-on-secondary-container text-xs">
                        MK
                    </div>
                    <div>
                        <span class="font-bold block text-sm text-primary">Marcus K.</span>
                        <span class="text-xs text-on-surface-variant">Verified Buyer</span>
                    </div>
                </div>
            </div>
            
            <!-- Review 3 -->
            <div class="bg-surface-container rounded-2xl p-8 border border-outline-variant/10 flex flex-col justify-between hover:shadow-sm transition-shadow">
                <div class="flex items-center gap-1 mb-4">
                    <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                    <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                    <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                    <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                    <span class="material-symbols-outlined text-sm text-secondary fill-icon">star</span>
                </div>
                <p class="font-body-md text-sm text-on-surface-variant italic leading-relaxed mb-6">
                    "I have tried dozens of clean haircare nectars, but this one is on another level. My scalp feels energized and my hair is incredibly silky. Scent is absolutely divine."
                </p>
                <div class="flex items-center gap-3 mt-auto">
                    <div class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center font-bold text-on-secondary-container text-xs">
                        PP
                    </div>
                    <div>
                        <span class="font-bold block text-sm text-primary">Priya P.</span>
                        <span class="text-xs text-on-surface-variant">Verified Buyer</span>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- Section: Visual Sanctuary (Instagram Gallery) -->
<section class="py-16 bg-surface-container-low border-t border-outline-variant/10">
    <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-desktop">
        <div class="text-center max-w-2xl mx-auto mb-10">
            <span class="font-label-caps text-xs text-secondary font-bold tracking-widest uppercase">VISUAL SANCTUARY</span>
            <h3 class="font-headline-sm text-2xl text-primary font-bold mt-1">#LetsAyurveda</h3>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
            
            <div class="aspect-square bg-surface-container rounded-2xl overflow-hidden shadow-sm hover:scale-[1.03] transition-transform duration-300">
                <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB2KqtdvrIlGaTzFICQA6FU-rEPz4ax6MdnCZ5uk9rR-EnrvPxJXvFkt6oF_JPl7NaB5HcIE3o4vCV_j_zp_hcktPaeGQVLTkS0tJdrhlQ5h_Q5AkD2PjIm2BerM7QiNqCz09DBsobBACw7_5UYgXteStK6GV2u8ybzPJE5x2ItjKXuRLNcoOsT-Rkx5KQ2aAqpDGurC8ETEMoLTcPavfyX7_4nS1011De7ivqGRze2MIIDlUVldVKtiyh0J2LLM-M96XNsUcGS_-BL" alt="Sanctuary 1"/>
            </div>
            <div class="aspect-square bg-surface-container rounded-2xl overflow-hidden shadow-sm hover:scale-[1.03] transition-transform duration-300">
                <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA15Q4utUpBf5oPaeo4uI72jGgAXt24uCBuhq4bgkndAxNIbdMjAVFjinh5LaTaCATeRRQxyJhUj1fTWSbL8ixECWloApMVtuXxg2eYyqAvsd3SpZE1pwdf5Azn9817y4rY3kUnQTgfegLKciVuo4ZX2VXNhqG1ZJG4_VPM1kpyv-16dv-CZbZHIxA_OPnBXgmEu7IDb-RjLj5N3dWM2_3zLR2Zj7hnysTM-TTPL8oqF67FBEkqDPtI_jWHqW1rBpi4pxNkUjKwxy_-" alt="Sanctuary 2"/>
            </div>
            <div class="aspect-square bg-surface-container rounded-2xl overflow-hidden shadow-sm hover:scale-[1.03] transition-transform duration-300">
                <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCtvuWjBpX4Ud52-YiDxxvj3Oahyowxiapahu3coatkcN6CJxx4gypXqaxVq_CHod-NHB0j6EvUUTymIHZ0SX9iEl3lkBnl53EiQXCL6occYUzi09ivc8wBresNADED8_AJ8zOMaAVVxP6ygeTR2sfiYFBQv-JV7YGseX2hmmQ35u1gbQg2srDDLTJW3RD-TruxNQbCzOR_CCGHwWN_wAuo7kAoRlwBRPaFu_g2xTu92Tso-GscbWOZMNRArBmcCZuyOBA7IzMKuCJe" alt="Sanctuary 3"/>
            </div>
            <div class="aspect-square bg-surface-container rounded-2xl overflow-hidden shadow-sm hover:scale-[1.03] transition-transform duration-300">
                <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBAa7m03kwvnRFmELlh7O-eCXCrFDpGx7mndLB8sm-Pyj82hGyJTcbzL8fEahAc_djIO30Lp1wzpc6PF8jA-vMIOZ-yRQJrm24k4GoYppGD9d-ib-N3JTKl-S3jh6I9wVBToEqe9RxN-7gRX3dZoZMCNtHbovBcslwJpb0Cn5z607k70tHpMUdHRicV8_eWhRgP-FAK3Fjy7u5Q9J7wNH977L9ovdHOTDfZ6HtJpy_YmOLpOmJkVYQ2K08ztww5BuO_B0-WSKk9Mt61" alt="Sanctuary 4"/>
            </div>
            <div class="aspect-square bg-surface-container rounded-2xl overflow-hidden shadow-sm hover:scale-[1.03] transition-transform duration-300">
                <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB6LGVZvguHodxq33XQpp6aprDmaYZIoJhGCW77y3u82NlVzT2OrB-tfSl0gz5tXOWx7HTmV-DeMtH39rg06Ni_pflBP9Ey_auZ_4S26YWii6J-7O_g4L0gN37kcw6ZKQcbyVP1QaNUY5ECi9hQ09P3T9LlyRrgQURU1bR41x4PYhY-lp1nnjki3tDsdhkjGSqsNtpP7PKiB7ohJlzIAJ7MuOrBotv7dOFjByzkWGGxKdTl_qvvxhtmn95OjnbOpk00oA0qz5EFbkzH" alt="Sanctuary 5"/>
            </div>
            <div class="aspect-square bg-surface-container rounded-2xl overflow-hidden shadow-sm hover:scale-[1.03] transition-transform duration-300">
                <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCRUfXu3mVAR3fbPyC0vAwGz1I1PU1RRmT4cb6_-Epb4h76WKfhzHJGQO91hOe4KWDHaY6171B5SKxqKxumHLwsaffQyp7BHtnMOiPUUJ-qChM9HCJG42LUi7zzrFMWUPXmjJpE9N4lxbASN8d7f_y2MwYQcSCy35CEg-dBwKgveqCp7RSEUkpKd2QPXr8JbpihNG_Atcod9wTCx-_dC3TUpl_mIfuTCvqi-ubF31LBCpPWLgdKE35dILaXPwMlRAwj85p-onQ-Bwkn" alt="Sanctuary 6"/>
            </div>
            
        </div>
    </div>
</section>
@endsection
