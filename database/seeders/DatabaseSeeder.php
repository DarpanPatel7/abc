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
            $user = new User();
            $userFactory = $user->factory(1)->create();
            $userFactory[0]->email = Config::get('global.super_user');
            $userFactory[0]->password = Config::get('global.super_pass');
            $userFactory[0]->status = 1;
            $userFactory[0]->save();
        }

        $this->call([
            PermissionTableSeeder::class,

            //temp
            MenuTableSeeder::class,
            CountryTableSeeder::class,
            StateTableSeeder::class,
            CurrencyTableSeeder::class,
            LanguageTableSeeder::class,
            TimezoneTableSeeder::class,
        ]);
    }
}
