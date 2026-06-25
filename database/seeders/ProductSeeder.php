<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVarient;
use App\Models\VariantAttribute;
use App\Models\ProductImage;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Inventory;
use App\Models\InventoryLog;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Wrap in transaction to ensure consistency
        DB::transaction(function () {
            // Fetch categories
            $herbalSupplements = Category::where('slug', 'herbal-supplements')->first();
            $skincare = Category::where('slug', 'skincare')->first();
            $haircare = Category::where('slug', 'haircare')->first();

            // Fetch attributes & values
            $sizeAttr = Attribute::where('slug', 'size')->first();
            
            $sixtyTabs = $sizeAttr ? $sizeAttr->values()->where('slug', '60-tabs')->first() : null;
            $oneTwentyTabs = $sizeAttr ? $sizeAttr->values()->where('slug', '120-tabs')->first() : null;
            $oneHundredMl = $sizeAttr ? $sizeAttr->values()->where('slug', '100ml')->first() : null;
            $twoHundredMl = $sizeAttr ? $sizeAttr->values()->where('slug', '200ml')->first() : null;

            // 1. Chyawanprash Special (Simple Product)
            $chyawanprash = Product::updateOrCreate(
                ['slug' => 'chyawanprash-special'],
                [
                    'name' => 'Chyawanprash Special',
                    'category_id' => $herbalSupplements?->id,
                    'short_description' => 'Traditional Ayurvedic health supplement rich in Vitamin C and antioxidants.',
                    'description' => 'LetsAyurveda\'s Chyawanprash Special is a time-tested formulation containing over 40 potent herbs, including Amla, Giloy, Ashwagandha, and Pippali. It helps boost immunity, supports digestion, and enhances energy and overall vitality.',
                    'has_variants' => false,
                    'is_featured' => true,
                    'status' => 'active',
                ]
            );

            // Simple products still require a default variant
            $chyVariant = ProductVarient::updateOrCreate(
                ['product_id' => $chyawanprash->id, 'sku' => 'CHY-SPEC-500G'],
                [
                    'barcode' => '8901234567890',
                    'price' => 450.00,
                    'sale_price' => 399.00,
                    'cost_price' => 200.00,
                    'weight' => 500.00, // 500g
                    'is_default' => true,
                    'status' => true,
                ]
            );

            // Update inventory
            $this->setupInventory($chyVariant, 50);

            // Product image
            ProductImage::updateOrCreate(
                ['product_id' => $chyawanprash->id, 'is_primary' => true],
                [
                    'image_path' => 'products/chyawanprash.jpg',
                    'sort_order' => 0,
                ]
            );


            // 2. Ashwagandha Tablets (Variant Product)
            $ashwagandha = Product::updateOrCreate(
                ['slug' => 'ashwagandha-tablets'],
                [
                    'name' => 'Ashwagandha Tablets',
                    'category_id' => $herbalSupplements?->id,
                    'short_description' => 'Premium stress relief and vitality booster capsules.',
                    'description' => 'Ashwagandha is one of the most powerful herbs in Ayurvedic healing. Known traditionally as an adaptogen, it helps the body manage stress, enhances stamina, promotes restful sleep, and supports general wellness.',
                    'has_variants' => true,
                    'is_featured' => true,
                    'status' => 'active',
                ]
            );

            // Variant 1: 60 tabs
            $ash60 = ProductVarient::updateOrCreate(
                ['product_id' => $ashwagandha->id, 'sku' => 'ASH-TAB-60'],
                [
                    'barcode' => '8901234567814',
                    'price' => 299.00,
                    'sale_price' => 249.00,
                    'cost_price' => 120.00,
                    'weight' => 60.00,
                    'is_default' => true,
                    'status' => true,
                ]
            );
            $this->setupInventory($ash60, 100);
            if ($sizeAttr && $sixtyTabs) {
                VariantAttribute::updateOrCreate(
                    ['product_variant_id' => $ash60->id, 'attribute_id' => $sizeAttr->id],
                    ['attribute_value_id' => $sixtyTabs->id]
                );
            }

            // Variant 2: 120 tabs
            $ash120 = ProductVarient::updateOrCreate(
                ['product_id' => $ashwagandha->id, 'sku' => 'ASH-TAB-120'],
                [
                    'barcode' => '8901234567821',
                    'price' => 499.00,
                    'sale_price' => 429.00,
                    'cost_price' => 200.00,
                    'weight' => 120.00,
                    'is_default' => false,
                    'status' => true,
                ]
            );
            $this->setupInventory($ash120, 75);
            if ($sizeAttr && $oneTwentyTabs) {
                VariantAttribute::updateOrCreate(
                    ['product_variant_id' => $ash120->id, 'attribute_id' => $sizeAttr->id],
                    ['attribute_value_id' => $oneTwentyTabs->id]
                );
            }

            // Product image
            ProductImage::updateOrCreate(
                ['product_id' => $ashwagandha->id, 'is_primary' => true],
                [
                    'image_path' => 'products/ashwagandha.jpg',
                    'sort_order' => 0,
                ]
            );


            // 3. Kumkumadi Tailam (Simple Product)
            $kumkumadi = Product::updateOrCreate(
                ['slug' => 'kumkumadi-tailam'],
                [
                    'name' => 'Kumkumadi Tailam',
                    'category_id' => $skincare?->id,
                    'short_description' => 'Miraculous beauty fluid for glowing skin and anti-aging.',
                    'description' => 'A unique blend of 26 rare herbs and oils, designed to brighten complexion, reduce hyperpigmentation, fight signs of aging, and nourish the skin deeply. Made with pure saffron and goat milk according to ancient Ayurvedic scripts.',
                    'has_variants' => false,
                    'is_featured' => false,
                    'status' => 'active',
                ]
            );

            $kumVariant = ProductVarient::updateOrCreate(
                ['product_id' => $kumkumadi->id, 'sku' => 'KUM-TAI-15ML'],
                [
                    'barcode' => '8901234567838',
                    'price' => 999.00,
                    'sale_price' => 899.00,
                    'cost_price' => 400.00,
                    'weight' => 15.00,
                    'is_default' => true,
                    'status' => true,
                ]
            );
            $this->setupInventory($kumVariant, 30);

            ProductImage::updateOrCreate(
                ['product_id' => $kumkumadi->id, 'is_primary' => true],
                [
                    'image_path' => 'products/kumkumadi.jpg',
                    'sort_order' => 0,
                ]
            );


            // 4. Bringadi Hair Oil (Variant Product)
            $bringadi = Product::updateOrCreate(
                ['slug' => 'bringadi-hair-oil'],
                [
                    'name' => 'Bringadi Hair Oil',
                    'category_id' => $haircare?->id,
                    'short_description' => 'Intensive hair treatment to prevent hair loss and dandruff.',
                    'description' => 'An all-in-one hair treatment that prevents hair loss, dandruff, and premature greening. It cools the scalp, stimulates hair growth, and leaves hair healthy, glossy, and strong.',
                    'has_variants' => true,
                    'is_featured' => false,
                    'status' => 'active',
                ]
            );

            // Variant 1: 100ml
            $bri100 = ProductVarient::updateOrCreate(
                ['product_id' => $bringadi->id, 'sku' => 'BRI-OIL-100'],
                [
                    'barcode' => '8901234567845',
                    'price' => 350.00,
                    'sale_price' => 299.00,
                    'cost_price' => 150.00,
                    'weight' => 100.00,
                    'is_default' => true,
                    'status' => true,
                ]
            );
            $this->setupInventory($bri100, 80);
            if ($sizeAttr && $oneHundredMl) {
                VariantAttribute::updateOrCreate(
                    ['product_variant_id' => $bri100->id, 'attribute_id' => $sizeAttr->id],
                    ['attribute_value_id' => $oneHundredMl->id]
                );
            }

            // Variant 2: 200ml
            $bri200 = ProductVarient::updateOrCreate(
                ['product_id' => $bringadi->id, 'sku' => 'BRI-OIL-200'],
                [
                    'barcode' => '8901234567852',
                    'price' => 650.00,
                    'sale_price' => 549.00,
                    'cost_price' => 250.00,
                    'weight' => 200.00,
                    'is_default' => false,
                    'status' => true,
                ]
            );
            $this->setupInventory($bri200, 60);
            if ($sizeAttr && $twoHundredMl) {
                VariantAttribute::updateOrCreate(
                    ['product_variant_id' => $bri200->id, 'attribute_id' => $sizeAttr->id],
                    ['attribute_value_id' => $twoHundredMl->id]
                );
            }

            ProductImage::updateOrCreate(
                ['product_id' => $bringadi->id, 'is_primary' => true],
                [
                    'image_path' => 'products/bringadi.jpg',
                    'sort_order' => 0,
                ]
            );

            // Generate 200 dynamic Ayurvedic products
            $prefixes = ['Premium', 'Organic', 'Pure', 'Natural', 'Classic', 'Daily', 'Golden', 'Ayur', 'Vedic', 'Divine', 'Advanced', 'Traditional', 'Royal'];
            $ingredients = ['Ashwagandha', 'Shatavari', 'Triphala', 'Brahmi', 'Neem', 'Turmeric', 'Amla', 'Giloy', 'Tulsi', 'Manjistha', 'Guggulu', 'Arjuna', 'Shilajit', 'Haritaki', 'Safed Musli', 'Bhringraj', 'Aloe Vera', 'Sandalwood', 'Kesar', 'Moringa', 'Ginger', 'Cardamom'];
            $suffixes = ['Churna', 'Capsules', 'Tablets', 'Rasayana', 'Ghruta', 'Tailam', 'Extract', 'Infusion', 'Syrup', 'Balm', 'Powder', 'Elixir', 'Face Wash', 'Cleanser', 'Pack', 'Serum', 'Tonic'];

            $categoriesList = Category::all();
            if ($categoriesList->isEmpty()) {
                $categoriesList = collect([$herbalSupplements, $skincare, $haircare]);
            }

            for ($i = 1; $i <= 200; $i++) {
                $prefix = $prefixes[array_rand($prefixes)];
                $ingredient = $ingredients[array_rand($ingredients)];
                $suffix = $suffixes[array_rand($suffixes)];

                $baseName = "{$prefix} {$ingredient} {$suffix}";
                
                // Add index to ensure unique name and slug
                $name = "{$baseName} #{$i}";
                $slug = Str::slug($name);

                $category = $categoriesList->random();

                // 50% chance of having variants
                $hasVariants = (rand(1, 100) > 50);
                $isFeatured = (rand(1, 100) > 85); // 15% chance of being featured

                $product = Product::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'name' => $name,
                        'category_id' => $category?->id,
                        'short_description' => "Premium quality {$baseName} for your daily health and wellness routine.",
                        'description' => "LetsAyurveda's {$name} is prepared using authentic methods and high-quality ingredients. Suitable for daily use to promote general wellbeing and vitality.",
                        'has_variants' => $hasVariants,
                        'is_featured' => $isFeatured,
                        'status' => 'active',
                    ]
                );

                if ($hasVariants) {
                    // Decide size attributes based on category
                    $isLiquid = ($category && in_array($category->slug, ['skincare', 'haircare', 'wellness-oils']));
                    
                    // Variant 1: Small Size
                    $sku1 = strtoupper(substr($ingredient, 0, 3)) . "-VAR-" . $i . "A";
                    $price1 = rand(150, 600);
                    $salePrice1 = (rand(1, 100) > 40) ? round($price1 * 0.85, 2) : null;
                    $costPrice1 = round($price1 * 0.45, 2);
                    $weight1 = $isLiquid ? 100.00 : 60.00;

                    $v1 = ProductVarient::updateOrCreate(
                        ['product_id' => $product->id, 'sku' => $sku1],
                        [
                            'barcode' => '890' . str_pad($i, 10, '0', STR_PAD_LEFT),
                            'price' => $price1,
                            'sale_price' => $salePrice1,
                            'cost_price' => $costPrice1,
                            'weight' => $weight1,
                            'is_default' => true,
                            'status' => true,
                        ]
                    );
                    $this->setupInventory($v1, rand(20, 100));

                    $attrVal1 = $isLiquid ? $oneHundredMl : $sixtyTabs;
                    if ($sizeAttr && $attrVal1) {
                        VariantAttribute::updateOrCreate(
                            ['product_variant_id' => $v1->id, 'attribute_id' => $sizeAttr->id],
                            ['attribute_value_id' => $attrVal1->id]
                        );
                    }

                    // Variant 2: Large Size
                    $sku2 = strtoupper(substr($ingredient, 0, 3)) . "-VAR-" . $i . "B";
                    $price2 = rand(650, 1500);
                    $salePrice2 = (rand(1, 100) > 40) ? round($price2 * 0.85, 2) : null;
                    $costPrice2 = round($price2 * 0.45, 2);
                    $weight2 = $isLiquid ? 200.00 : 120.00;

                    $v2 = ProductVarient::updateOrCreate(
                        ['product_id' => $product->id, 'sku' => $sku2],
                        [
                            'barcode' => '891' . str_pad($i, 10, '0', STR_PAD_LEFT),
                            'price' => $price2,
                            'sale_price' => $salePrice2,
                            'cost_price' => $costPrice2,
                            'weight' => $weight2,
                            'is_default' => false,
                            'status' => true,
                        ]
                    );
                    $this->setupInventory($v2, rand(15, 80));

                    $attrVal2 = $isLiquid ? $twoHundredMl : $oneTwentyTabs;
                    if ($sizeAttr && $attrVal2) {
                        VariantAttribute::updateOrCreate(
                            ['product_variant_id' => $v2->id, 'attribute_id' => $sizeAttr->id],
                            ['attribute_value_id' => $attrVal2->id]
                        );
                    }

                } else {
                    // Simple Product: Default Variant
                    $sku = strtoupper(substr($ingredient, 0, 3)) . "-SMP-" . $i;
                    $price = rand(100, 800);
                    $salePrice = (rand(1, 100) > 40) ? round($price * 0.85, 2) : null;
                    $costPrice = round($price * 0.45, 2);

                    $v = ProductVarient::updateOrCreate(
                        ['product_id' => $product->id, 'sku' => $sku],
                        [
                            'barcode' => '890' . str_pad($i, 10, '0', STR_PAD_LEFT),
                            'price' => $price,
                            'sale_price' => $salePrice,
                            'cost_price' => $costPrice,
                            'weight' => rand(50, 500),
                            'is_default' => true,
                            'status' => true,
                        ]
                    );
                    $this->setupInventory($v, rand(20, 150));
                }

                // Match product image based on category
                $imgName = 'products/chyawanprash.jpg';
                if ($category) {
                    if ($category->slug === 'skincare') {
                        $imgName = 'products/kumkumadi.jpg';
                    } elseif ($category->slug === 'haircare') {
                        $imgName = 'products/bringadi.jpg';
                    } elseif ($category->slug === 'herbal-supplements') {
                        $imgName = 'products/ashwagandha.jpg';
                    }
                }

                ProductImage::updateOrCreate(
                    ['product_id' => $product->id, 'is_primary' => true],
                    [
                        'image_path' => $imgName,
                        'sort_order' => 0,
                    ]
                );
            }
        });
    }

    /**
     * Helper to set up variant inventory and record a stock log.
     */
    private function setupInventory(ProductVarient $variant, int $quantity): void
    {
        // Load the auto-created inventory or create one if it doesn't exist
        $inventory = $variant->inventory;

        if (!$inventory) {
            $inventory = $variant->inventory()->create([
                'quantity' => $quantity,
                'low_stock_threshold' => 5,
                'track_inventory' => true,
            ]);
        } else {
            $inventory->update([
                'quantity' => $quantity,
            ]);
        }

        // Clean out any existing stock-in logs for this inventory to avoid duplication during re-runs
        InventoryLog::where('inventory_id', $inventory->id)
            ->where('type', 'stock_in')
            ->where('note', 'Initial stock on product creation')
            ->delete();

        // Create log if quantity > 0
        if ($quantity > 0) {
            InventoryLog::create([
                'inventory_id' => $inventory->id,
                'type' => 'stock_in',
                'quantity' => $quantity,
                'before_quantity' => 0,
                'after_quantity' => $quantity,
                'note' => 'Initial stock on product creation',
            ]);
        }
    }
}
