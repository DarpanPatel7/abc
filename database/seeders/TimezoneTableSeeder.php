<?php

namespace Database\Seeders;

use App\Models\Timezone;
use Illuminate\Database\Seeder;

class TimezoneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Timezone::truncate();
     	$timezones = [
   		    ['name' => 'America/New_York', 'utc_offset' => '-05:00', 'status' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
   		    ['name' => 'America/Chicago', 'utc_offset' => '-06:00', 'status' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
   		    ['name' => 'America/Los_Angeles', 'utc_offset' => '-08:00', 'status' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'International Date Line West', 'utc_offset' => '-12:00', 'status' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Midway Island, Samoa', 'utc_offset' => '-11:00', 'status' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Hawaii', 'utc_offset' => '-10:00', 'status' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Alaska', 'utc_offset' => '-09:00', 'status' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pacific Time (US & Canada)', 'utc_offset' => '-08:00', 'status' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tijuana, Baja California', 'utc_offset' => '-08:00', 'status' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Arizona', 'utc_offset' => '-07:00', 'status' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Chihuahua, La Paz, Mazatlan', 'utc_offset' => '-07:00', 'status' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mountain Time (US & Canada)', 'utc_offset' => '-07:00', 'status' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Central America', 'utc_offset' => '-06:00', 'status' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Central Time (US & Canada)', 'utc_offset' => '-06:00', 'status' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Guadalajara, Mexico City, Monterrey', 'utc_offset' => '-06:00', 'status' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Saskatchewan', 'utc_offset' => '-06:00', 'status' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bogota, Lima, Quito, Rio Branco', 'utc_offset' => '-05:00', 'status' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Eastern Time (US & Canada)', 'utc_offset' => '-05:00', 'status' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Indiana (East)', 'utc_offset' => '-05:00', 'status' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Atlantic Time (Canada)', 'utc_offset' => '-04:00', 'status' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Caracas, La Paz', 'utc_offset' => '-04:00', 'status' => 1, 'deleted_at' => null, 'created_at' => now(), 'updated_at' => now()],
		];
        Timezone::insert($timezones);
    }
}
