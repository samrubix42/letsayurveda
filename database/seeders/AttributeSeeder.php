<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attribute;
use Illuminate\Support\Str;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributes = [
            'Size' => [
                '100ml',
                '200ml',
                '500ml',
                '60 tabs',
                '120 tabs',
                '50g',
                '100g',
            ],
            'Pack Type' => [
                'Single Pack',
                'Pack of 2',
                'Pack of 3',
            ],
            'Flavor' => [
                'Regular',
                'Mint',
                'Ginger',
                'Tulsi',
            ],
        ];

        foreach ($attributes as $attrName => $values) {
            $attribute = Attribute::updateOrCreate(
                ['slug' => Str::slug($attrName)],
                [
                    'name' => $attrName,
                    'status' => true,
                ]
            );

            foreach ($values as $val) {
                $attribute->values()->updateOrCreate(
                    [
                        'attribute_id' => $attribute->id,
                        'slug' => Str::slug($val),
                    ],
                    [
                        'value' => $val,
                    ]
                );
            }
        }
    }
}
