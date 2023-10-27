<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Generator;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class FirstUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Generator::class);

        User::insert([
            'employee_no' => Str::random(10),
            'name' => $faker->name(),
            'email' => Config::get('global.super_user'),
            'password' => Config::get('global.super_pass'),
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
