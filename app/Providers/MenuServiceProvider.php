<?php

namespace App\Providers;

// use Spatie\Menu\Link;
// use Spatie\Menu\Menu;
// use Spatie\Menu\Macro;

use App\Models\Menu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $verticalMenuJson = $horizontalMenuJson = '';
        if (Schema::hasTable('menus')) {
            // Code to create table
            $menu = new Menu;
            $verticalMenu = $menu->where('type', 'vertical')->Active()->first();
            $horizontalMenu = $menu->where('type', 'horizontal')->Active()->first();
        }

        //get vertical menu json data
        if(!empty($verticalMenu)){
            $verticalMenuJson = $verticalMenu->json_menu;
        }
        $verticalMenuData = json_decode($verticalMenuJson);

        //get horizontal menu json data
        if(!empty($horizontalMenu)){
            $horizontalMenuJson = $horizontalMenu->json_menu;
        }
        $horizontalMenuData = json_decode($horizontalMenuJson);

        // Share all menuData to all the views
        View::share('menuData', [$verticalMenuData, $horizontalMenuData]);
    }
}
