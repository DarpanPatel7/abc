<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email',Config::get('global.super_user'))->count();
        if($user == 0){
            User::factory(1)->create();
        }

        $this->call([
            PermissionTableSeeder::class,
        ]);
    }
}
