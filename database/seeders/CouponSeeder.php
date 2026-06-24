<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Coupon::updateOrCreate(
            ['code' => 'WELCOME10'],
            [
                'type' => 'percentage',
                'value' => 10.00,
                'min_spend' => 0.00,
                'is_active' => true,
            ]
        );

        Coupon::updateOrCreate(
            ['code' => 'AYUSH20'],
            [
                'type' => 'percentage',
                'value' => 20.00,
                'min_spend' => 50.00,
                'is_active' => true,
            ]
        );

        Coupon::updateOrCreate(
            ['code' => 'FREESHIP'],
            [
                'type' => 'fixed',
                'value' => 5.00,
                'min_spend' => 30.00,
                'is_active' => true,
            ]
        );
    }
}
