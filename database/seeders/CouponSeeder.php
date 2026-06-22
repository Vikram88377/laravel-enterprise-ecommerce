<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            Coupon::updateOrCreate(
                ['code' => 'SAVE10'],
                [
                    'type' => 'percentage',
                    'value' => 10,
                    'min_order_amount' => 1000,
                    'max_discount' => 500,
                    'start_date' => now(),
                    'end_date' => now()->addMonths(3),
                    'usage_limit' => 100,
                    'used_count' => 0,
                    'status' => true,
                ]
            );

        Coupon::updateOrCreate([
            'code' => 'FLAT500',
            'type' => 'fixed',
            'value' => 500,
            'min_order_amount' => 3000,
            'max_discount' => null,
            'start_date' => now(),
            'end_date' => now()->addMonths(3),
            'usage_limit' => 100,
            'used_count' => 0,
            'status' => true,
        ]);

       Coupon::updateOrCreate([
            'code' => 'SAVE20',
            'type' => 'percentage',
            'value' => 20,
            'min_order_amount' => 5000,
            'max_discount' => 1000,
            'start_date' => now(),
            'end_date' => now()->addMonths(2),
            'usage_limit' => 50,
            'used_count' => 0,
            'status' => true,
        ]);

        Coupon::updateOrCreate([
            'code' => 'WELCOME100',
            'type' => 'fixed',
            'value' => 100,
            'min_order_amount' => 500,
            'max_discount' => null,
            'start_date' => now(),
            'end_date' => now()->addMonths(6),
            'usage_limit' => 1000,
            'used_count' => 0,
            'status' => true,
        ]);
    }
}