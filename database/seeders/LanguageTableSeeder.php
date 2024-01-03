<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::truncate();
     	$languages = [
   		    ['name' => 'English', 'shortcode' => 'EN', 'status' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
   		    ['name' => 'French', 'shortcode' => 'FR', 'status' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
   		    ['name' => 'German', 'shortcode' => 'DE', 'status' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
   		    ['name' => 'Portuguese', 'shortcode' => 'PT', 'status' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
		];
        Language::insert($languages);
    }
}
