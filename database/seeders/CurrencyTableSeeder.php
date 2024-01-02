<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::truncate();
     	$currencies = [
   		    ['name' => 'USD', 'code' => 'US Dollar', 'rate' => 1.0000, 'status' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
   		    ['name' => 'Euro', 'code' => 'Euro', 'rate' => 0.8925, 'status' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
   		    ['name' => 'GBP', 'code' => 'British Pound', 'rate' => 0.7562, 'status' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
   		    ['name' => 'JPY', 'code' => 'Japanese Yen', 'rate' => 112.3456, 'status' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
		];
        Currency::insert($currencies);
    }
}
