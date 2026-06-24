<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ensure we have an author/user
        $author = User::first();
        if (!$author) {
            $author = User::create([
                'name' => 'Dr. Ananya Sharma',
                'email' => 'ananya@letsayurveda.com',
                'password' => bcrypt('password'),
            ]);
        }

        // 2. Define Blog Categories
        $categories = [
            [
                'name' => 'Skincare Rituals',
                'slug' => 'skincare-rituals',
                'status' => true,
            ],
            [
                'name' => 'Hair Nourishment',
                'slug' => 'hair-nourishment',
                'status' => true,
            ],
            [
                'name' => 'Diet & Nutrition',
                'slug' => 'diet-and-nutrition',
                'status' => true,
            ],
            [
                'name' => 'Daily Vitality',
                'slug' => 'daily-vitality',
                'status' => true,
            ]
        ];

        $categoryModels = [];
        foreach ($categories as $cat) {
            $categoryModels[] = BlogCategory::updateOrCreate(
                ['slug' => $cat['slug']],
                ['name' => $cat['name'], 'status' => $cat['status']]
            );
        }

        // 3. Define Blog Posts
        $blogs = [
            [
                'title' => 'Kumkumadi Tailam: The Golden Elixir for Luminous Skin',
                'slug' => 'kumkumadi-tailam-golden-elixir-luminous-skin',
                'category_slug' => 'skincare-rituals',
                'banner_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuB6LGVZvguHodxq33XQpp6aprDmaYZIoJhGCW77y3u82NlVzT2OrB-tfSl0gz5tXOWx7HTmV-DeMtH39rg06Ni_pflBP9Ey_auZ_4S26YWii6J-7O_g4L0gN37kcw6ZKQcbyVP1QaNUY5ECi9hQ09P3T9LlyRrgQURU1bR41x4PYhY-lp1nnjki3tDsdhkjGSqsNtpP7PKiB7ohJlzIAJ7MuOrBotv7dOFjByzkWGGxKdTl_qvvxhtmn95OjnbOpk00oA0qz5EFbkzH',
                'excerpt' => 'Discover the ancient secrets of Kumkumadi Tailam, a unique blend of 26 rare Ayurvedic herbs formulated to restore your skin\'s natural radiance.',
                'content' => '
                    <p>In the vast treasury of Ayurvedic beauty rituals, few formulations command as much reverence as <strong>Kumkumadi Tailam</strong>. Often referred to as the "golden elixir," this miraculous night serum is a blend of 26 rare herbs, flowers, and fruits, meticulously prepared according to ancient text directives.</p>
                    
                    <h3>The Origin of the Miraculous Formulation</h3>
                    <p>Rooted in the Ashtanga Hrudaya, one of Ayurveda\'s primary authoritative texts, Kumkumadi literally translates to "Saffron oil." Saffron, or <em>Kesar</em>, forms the vital core of this blend, lending its brilliant gold hue and skin-brightening properties. This oil is cooked in a traditional decoction style over several days to extract the maximum concentration of bio-active compounds.</p>

                    <blockquote>
                        "Kumkumadi Tailam acts as a natural skin purifier. It pacifies the Pitta dosha (heat and inflammation) and stimulates microcirculation to revive tired, dull skin."
                    </blockquote>

                    <h3>Key Botanicals and Their Benefits</h3>
                    <ul>
                        <li><strong>Kashmiri Saffron (Kumkuma):</strong> Rich in crocin and crocetin, it reduces hyperpigmentation, shields against UV radiation, and restores cellular glow.</li>
                        <li><strong>Sandalwood (Chandana):</strong> A natural coolant that pacifies skin rashes, calms acne flare-ups, and refines pores.</li>
                        <li><strong>Yashtimadhu (Licorice):</strong> Inhibits melanin production, gently lightening dark circles and blemishes.</li>
                        <li><strong>Manjistha (Indian Madder):</strong> A potent blood-purifying herb that detoxifies skin tissues, correcting uneven texture.</li>
                    </ul>

                    <h3>How to Integrate Kumkumadi into Your Night Ritual</h3>
                    <p>To experience the absolute potency of this formulation, follow these simple steps before sleep:</p>
                    <ol>
                        <li>Thoroughly cleanse your face using a mild, soap-free cleanser.</li>
                        <li>Dampen your skin with pure Kannauj Rose Water. This helps the oil absorb uniformly.</li>
                        <li>Dispense 3-4 drops of Kumkumadi Tailam onto your palm, rub your hands to warm the oil, and pat it gently onto your face.</li>
                        <li>Massage in upward circular motions for 5 minutes, paying special attention to areas under the eyes and around the jawline.</li>
                    </ol>
                    <p>Leave it overnight to let your cells absorb the nourishment. Wake up to a visibly soft, refreshed, and dewy complexion.</p>
                ',
                'meta_title' => 'Kumkumadi Tailam: Ancient Ayurvedic Saffron Face Oil | LetsAyurveda',
                'meta_description' => 'Learn how Kumkumadi Tailam (Saffron oil) acts as a powerful Ayurvedic night serum to brighten skin, reduce hyperpigmentation, and soothe blemishes.',
                'meta_keywords' => 'kumkumadi tailam, ayurvedic face oil, saffron oil, natural skincare, glowing skin',
                'is_active' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'The Dinacharya Secret: Establishing a Sacred Morning Ritual',
                'slug' => 'dinacharya-secret-sacred-morning-ritual',
                'category_slug' => 'daily-vitality',
                'banner_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCRUfXu3mVAR3fbPyC0vAwGz1I1PU1RRmT4cb6_-Epb4h76WKfhzHJGQO91hOe4KWDHaY6171B5SKxqKxumHLwsaffQyp7BHtnMOiPUUJ-qChM9HCJG42LUi7zzrFMWUPXmjJpE9N4lxbASN8d7f_y2MwYQcSCy35CEg-dBwKgveqCp7RSEUkpKd2QPXr8JbpihNG_Atcod9wTCx-_dC3TUpl_mIfuTCvqi-ubF31LBCpPWLgdKE35dILaXPwMlRAwj85p-onQ-Bwkn',
                'excerpt' => 'Align your circadian biological clock with nature\'s rhythm. Explore Dinacharya, the Ayurvedic daily routine designed to build immunity and mental peace.',
                'content' => '
                    <p>In our hyper-connected modern lifestyle, our mornings are often hijacked by notifications, stress, and rushed routines. Ayurveda offers a timeless alternative called <strong>Dinacharya</strong>—a sequence of self-care steps designed to align our bodily rhythms with the movements of the sun.</p>
                    
                    <h3>Why Sunrise Matters: The Brahma Muhurta</h3>
                    <p>According to Ayurvedic science, the day is split into 4-hour cycles dominated by the three doshas. The period between 4:00 AM and 6:00 AM is known as the <em>Brahma Muhurta</em> (the time of creator). Air and space energies (Vata) are active, making the atmosphere exceptionally peaceful, clean, and ideal for meditation and clearing toxic thoughts.</p>

                    <h3>A Step-by-Step Dinacharya Guide</h3>
                    <p>You don\'t need to overhaul your entire life overnight. Try starting with these four fundamental practices:</p>
                    <ul>
                        <li><strong>Tongue Scraping (Jihwa Prakshalana):</strong> Use a pure copper scraper to remove the white coating (Ama or metabolic toxins) from your tongue. This stimulates digestion and awakens your tastebuds.</li>
                        <li><strong>Oil Pulling (Gandusha):</strong> Swish a tablespoon of organic, cold-pressed sesame oil in your mouth for 10-15 minutes. It strengthens gums, whitens teeth, and pulls microbes from the oral cavity.</li>
                        <li><strong>Self-Massage (Abhyanga):</strong> Apply warm oil to your body, starting from the crown of your head down to your toes. Use circular strokes over joints and long strokes over limbs. It calms the nervous system and nourishes dry skin cells.</li>
                        <li><strong>Nasal Therapy (Nasya):</strong> Administer 2 drops of warm Anu Tailam or pure Ghee into each nostril. It clears sinus channels, improves mental clarity, and wards off environmental allergies.</li>
                    </ul>

                    <blockquote>
                        "Establishing a Dinacharya routine is not about rigid discipline; it is about reclaiming custody of your day. It reminds us that wellness begins at dawn."
                    </blockquote>

                    <p>By starting your day with intention and self-care, you construct a protective bubble of calm that keeps you centered, focused, and resilient to whatever life throws at you.</p>
                ',
                'meta_title' => 'Dinacharya: The Ayurvedic Morning Routine Guide | LetsAyurveda',
                'meta_description' => 'Discover the science of Dinacharya, the Ayurvedic daily routine. Learn how tongue scraping, oil pulling, and self-massage promote long-term vitality.',
                'meta_keywords' => 'dinacharya, ayurvedic morning routine, oil pulling, tongue scraping, self-care',
                'is_active' => true,
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => 'Understanding the Three Doshas: Vata, Pitta, and Kapha',
                'slug' => 'understanding-three-doshas-vata-pitta-kapha',
                'category_slug' => 'daily-vitality',
                'banner_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCtvuWjBpX4Ud52-YiDxxvj3Oahyowxiapahu3coatkcN6CJxx4gypXqaxVq_CHod-NHB0j6EvUUTymIHZ0SX9iEl3lkBnl53EiQXCL6occYUzi09ivc8wBresNADED8_AJ8zOMaAVVxP6ygeTR2sfiYFBQv-JV7YGseX2hmmQ35u1gbQg2srDDLTJW3RD-TruxNQbCzOR_CCGHwWN_wAuo7kAoRlwBRPaFu_g2xTu92Tso-GscbWOZMNRArBmcCZuyOBA7IzMKuCJe',
                'excerpt' => 'Are you airy Vata, fiery Pitta, or earthy Kapha? Read our breakdown to understand how the five elements govern your health, mind, and physical traits.',
                'content' => '
                    <p>Every individual is born with a unique combination of physical, emotional, and psychological traits. In Ayurveda, this constitutional blueprint is known as your <em>Prakriti</em>, and it is governed by three primary metabolic energies: <strong>Vata</strong>, <strong>Pitta</strong>, and <strong>Kapha</strong>.</p>
                    
                    <h3>The Building Blocks: Five Elements</h3>
                    <p>Ayurveda observes that the universe is made of five elements: space, air, fire, water, and earth. The doshas represent different combinations of these elements working inside us:</p>

                    <h3>1. Vata (Air & Space)</h3>
                    <p>Vata is the energy of movement and circulation. It regulates breathing, heartbeat, muscle contractions, and nerve signals.</p>
                    <ul>
                        <li><strong>Physical Traits:</strong> Lean build, dry skin and hair, cold hands/feet, light sleeper.</li>
                        <li><strong>Mental Traits:</strong> Creative, quick learner, highly enthusiastic, prone to anxiety when out of balance.</li>
                        <li><strong>Balancing Tip:</strong> Warm cooked foods, sweet/sour/salty tastes, and regular sleep patterns.</li>
                    </ul>

                    <h3>2. Pitta (Fire & Water)</h3>
                    <p>Pitta is the energy of digestion and metabolism. It regulates chemical transformations, body temperature, and intelligence.</p>
                    <ul>
                        <li><strong>Physical Traits:</strong> Medium build, sensitive skin prone to redness, strong digestion, sweats easily.</li>
                        <li><strong>Mental Traits:</strong> Focused, highly organized, articulate, prone to anger or impatience when out of balance.</li>
                        <li><strong>Balancing Tip:</strong> Cooling foods, sweet/bitter/astringent tastes, and spending time in nature (forest bathing).</li>
                    </ul>

                    <h3>3. Kapha (Water & Earth)</h3>
                    <p>Kapha is the energy of lubrication, structure, and cohesion. It builds muscles, bones, and keeps the immune system strong.</p>
                    <ul>
                        <li><strong>Physical Traits:</strong> Strong robust frame, thick lustrous hair, smooth skin, slow metabolism.</li>
                        <li><strong>Mental Traits:</strong> Calm, loving, patient, loyal, prone to lethargy or attachment when out of balance.</li>
                        <li><strong>Balancing Tip:</strong> Warm stimulating spices, light dry foods, pungent/bitter tastes, and active physical exercise.</li>
                    </ul>

                    <blockquote>
                        "Disease is nothing but the deviation from your birth constitution. Knowing your dosha is the first step on the path of self-healing."
                    </blockquote>

                    <p>By understanding your dominant dosha, you can make informed choices about your diet, skincare, and exercise to restore harmony and cultivate long-term vitality.</p>
                ',
                'meta_title' => 'The Ayurvedic Guide to Vata, Pitta, and Kapha Doshas | LetsAyurveda',
                'meta_description' => 'Unravel the mysteries of your body. Learn the physical and mental traits of Vata, Pitta, and Kapha, and discover practical self-care tips for balancing them.',
                'meta_keywords' => 'three doshas, vata pitta kapha, ayurvedic body type, elemental healing',
                'is_active' => true,
                'published_at' => now()->subDays(15),
            ],
            [
                'title' => 'Amla: The Ultimate Ayurvedic Superfood for Hair Growth',
                'slug' => 'amla-ultimate-ayurvedic-superfood-hair-growth',
                'category_slug' => 'hair-nourishment',
                'banner_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBtOxP2-m1FzCmgTxTd7tSOHf0Wq404IJ1y9vjOa37tFF7JfoJW9eot7Z0DQJ6CgszYJU4R4d-88J_SkeNs1Ky3379K1q_GjDqlSWeIBssany8KKbtkn0XTjUpBYRZKNcxDZGDoxusQ6bRemu2QZWDQeX9ipcRupA9KLHNLCL6pl1ufCGeQ7X7-xs-bno_vFf4DtO6DY5HgOvOQitDF89faVv90cI4BnbffMTDva4cjpUYPfwJF2OkXM9eTYXIe-_egDB1LeTzWnVm7',
                'excerpt' => 'Explore the scientific and traditional reasons why Indian Gooseberry (Amla) is considered the most powerful natural remedy for hair thinning and premature graying.',
                'content' => '
                    <p>In a world saturated with synthetic hair serums and chemical colorants, the humble <strong>Amla</strong> (Indian Gooseberry) remains unmatched in its ability to rescue damaged roots. Revered in Sanskrit as <em>Amalaki</em>, which translates to "the sustainer," this small green fruit is one of the most powerful rejuvenators (Rasayanas) in Ayurvedic pharmacology.</p>
                    
                    <h3>A Vitamin C Powerhouse</h3>
                    <p>To put Amla\'s nutrient density into perspective, a single fresh Amla contains up to 20 times more Vitamin C than an orange. This extremely high concentration of ascorbic acid, combined with tannins, protects hair cells from oxidative stress and premature aging.</p>

                    <h3>How Amla Restores Hair Health</h3>
                    <ul>
                        <li><strong>Prevents Melanin Loss (Graying):</strong> High Pitta dosha is often the culprit behind premature graying. Amla\'s cooling properties pacify Pitta, preventing melanin depletion in hair follicles.</li>
                        <li><strong>Boosts Scalp Circulation:</strong> Applying Amla oil dilates scalp blood vessels, allowing oxygen and vital nutrients to feed the hair roots.</li>
                        <li><strong>Strengthens Keratin Fibers:</strong> The essential fatty acids present in Amla nourish the hair shaft, improving tensile strength and elasticity.</li>
                        <li><strong>Natural Clarifier:</strong> Anti-microbial properties combat fungal infections (dandruff) and clear sebum blockages from the pores.</li>
                    </ul>

                    <blockquote>
                        "Regular application of Amla paste or oil acts like a shield. It seals the hair cuticle, preserves natural color, and builds a lustrous volume from the roots."
                    </blockquote>

                    <h3>How to Make a Restorative Amla Mask at Home</h3>
                    <p>For an intense hair conditioning treatment, combine:</p>
                    <ol>
                        <li>2 tablespoons of organic Amla powder.</li>
                        <li>1 tablespoon of pure cold-pressed coconut oil or yogurt.</li>
                        <li>Warm water or Kannauj Rose Water to make a smooth paste.</li>
                    </ol>
                    <p>Apply the mixture to your scalp and hair length. Leave it for 30 minutes, then rinse using a mild botanical shampoo. Repeat weekly for visible density and shine.</p>
                ',
                'meta_title' => 'Amla for Hair Growth: Benefits, Oils & DIY Masks | LetsAyurveda',
                'meta_description' => 'Unlock thick, lustrous hair. Learn how Indian Gooseberry (Amla) prevents premature graying, strengthens follicles, and stimulates natural hair growth.',
                'meta_keywords' => 'amla for hair, natural hair growth, prevent graying, gooseberry hair mask',
                'is_active' => true,
                'published_at' => now()->subDays(20),
            ],
            [
                'title' => 'Ayurvedic Eating: The Six Tastes of Digestion (Shad Rasa)',
                'slug' => 'ayurvedic-eating-six-tastes-digestion-shad-rasa',
                'category_slug' => 'diet-and-nutrition',
                'banner_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuB2KqtdvrIlGaTzFICQA6FU-rEPz4ax6MdnCZ5uk9rR-EnrvPxJXvFkt6oF_JPl7NaB5HcIE3o4vCV_j_zp_hcktPaeGQVLTkS0tJdrhlQ5h_Q5AkD2PjIm2BerM7QiNqCz09DBsobBACw7_5UYgXteStK6GV2u8ybzPJE5x2ItjKXuRLNcoOsT-Rkx5KQ2aAqpDGurC8ETEMoLTcPavfyX7_4nS1011De7ivqGRze2MIIDlUVldVKtiyh0J2LLM-M96XNsUcGS_-BL',
                'excerpt' => 'Ayurveda doesn\'t count calories. Instead, it categorizes food by six tastes (Shad Rasa) that dictate satiety, metabolic fire (Agni), and nutrient absorption.',
                'content' => '
                    <p>Modern dietary guidelines focus heavily on macronutrients, calories, and scale measurements. Ayurveda, however, views food through the lens of energetic quality and taste, known as <strong>Shad Rasa</strong> (the six tastes). A truly balanced meal must include all six tastes to ensure proper digestion and prevent cravings.</p>
                    
                    <h3>The Six Tastes and Their Elemental Properties</h3>
                    <p>Each taste is a combination of two elements and has a direct influence on your doshas and metabolic fire (Agni):</p>
                    
                    <ol>
                        <li><strong>Sweet (Madhura - Earth & Water):</strong> Found in rice, wheat, dairy, and sweet fruits. It builds tissues, calm nerves, and provides long-term energy. <em>Pacifies Vata/Pitta, increases Kapha.</em></li>
                        <li><strong>Sour (Amla - Earth & Fire):</strong> Found in lemons, yogurt, vinegar, and fermented foods. It stimulates salivary flow, cleanses tissues, and sharpens concentration. <em>Pacifies Vata, increases Pitta/Kapha.</em></li>
                        <li><strong>Salty (Lavana - Water & Fire):</strong> Found in rock salt and seaweeds. It improves mineral absorption, retains water, and maintains electrolyte balance. <em>Pacifies Vata, increases Pitta/Kapha.</em></li>
                        <li><strong>Pungent (Katu - Fire & Air):</strong> Found in ginger, black pepper, garlic, and chilies. It clears congestion, warms the stomach, and burns sluggish fat. <em>Pacifies Kapha, increases Vata/Pitta.</em></li>
                        <li><strong>Bitter (Tikta - Air & Space):</strong> Found in kale, spinach, turmeric, and fenugreek. It detoxifies blood, tones the liver, and curbs sugar cravings. <em>Pacifies Pitta/Kapha, increases Vata.</em></li>
                        <li><strong>Astringent (Kashaya - Air & Earth):</strong> Found in green tea, pomegranates, beans, and broccoli. It cools inflammation, absorbs excess water, and tones tissues. <em>Pacifies Pitta/Kapha, increases Vata.</em></li>
                    </ol>

                    <blockquote>
                        "When all six tastes are present in a meal, your brain receives a signal of complete satiety. Cravings vanish, and your Agni digests the food with high efficiency."
                    </blockquote>

                    <h3>How to Apply Shad Rasa Today</h3>
                    <p>Take a look at your plate. If it is mostly beige and sweet (bread, pasta, meat), add a squeeze of lemon (sour), a pinch of black pepper (pungent), and some steamed bitter greens (bitter/astringent). You will notice an immediate difference in your energy levels and post-meal comfort.</p>
                ',
                'meta_title' => 'The Six Tastes of Ayurveda: Shad Rasa Diet | LetsAyurveda',
                'meta_description' => 'Understand how the six tastes (sweet, sour, salty, pungent, bitter, astringent) govern digestion, hormone levels, and satiety in Ayurvedic nutrition.',
                'meta_keywords' => 'six tastes, shad rasa, ayurvedic diet, mindful eating, digestion',
                'is_active' => true,
                'published_at' => now()->subDays(25),
            ]
        ];

        foreach ($blogs as $blogData) {
            $cat = BlogCategory::where('slug', $blogData['category_slug'])->first();
            
            Blog::updateOrCreate(
                ['slug' => $blogData['slug']],
                [
                    'user_id' => $author->id,
                    'category_id' => $cat->id,
                    'title' => $blogData['title'],
                    'content' => trim($blogData['content']),
                    'banner_image' => $blogData['banner_image'],
                    'meta_title' => $blogData['meta_title'],
                    'meta_description' => $blogData['meta_description'],
                    'meta_keywords' => $blogData['meta_keywords'],
                    'is_active' => $blogData['is_active'],
                    'published_at' => $blogData['published_at'],
                ]
            );
        }
    }
}
