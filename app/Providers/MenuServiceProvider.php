<?php

namespace App\Providers;

use App\Models\AdminSetting;
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
        //check if setting table exists if not then it will get menu json data from file from storage folder otherwise menu json data comes from table.
        //also seperately check vertical and horizontal menus json data from tables.
        if (Schema::hasTable('admin_settings')) {
            $menu = new AdminSetting;
            $verticalMenu = $menu->where('code', 'menu')->where('key', 'vertical_menu')->first();
            if(!empty($verticalMenu)){
                //get vertical menu json data
                if (!empty($verticalMenu)) {
                    $verticalMenuJson = $verticalMenu->value;
                }
                $verticalMenuData = json_decode($verticalMenuJson);
            }else{
                $verticalMenuJson = file_get_contents(base_path('resources/menu/verticalMenu.json'));
                $verticalMenuData = json_decode($verticalMenuJson);
            }

            $horizontalMenu = $menu->where('code', 'menu')->where('key', 'horizontal_menu')->first();
            if(!empty($horizontalMenu)){
                //get horizontal menu json data
                if (!empty($horizontalMenu)) {
                    $horizontalMenuJson = $horizontalMenu->value;
                }
                $horizontalMenuData = json_decode($horizontalMenuJson);
            }else{
                $horizontalMenuJson = file_get_contents(base_path('resources/menu/horizontalMenu.json'));
                $horizontalMenuData = json_decode($horizontalMenuJson);
            }
        } else {
            $verticalMenuJson = file_get_contents(base_path('resources/menu/verticalMenu.json'));
            $verticalMenuData = json_decode($verticalMenuJson);
            $horizontalMenuJson = file_get_contents(base_path('resources/menu/horizontalMenu.json'));
            $horizontalMenuData = json_decode($horizontalMenuJson);
        }

        // Share all menuData to all the views
        View::share('menuData', [$verticalMenuData, $horizontalMenuData]);
    }
}
