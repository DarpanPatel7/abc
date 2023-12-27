<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\Setting\VerticalMenuRequest;
use App\Http\Requests\Setting\HorizontalMenuRequest;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all designation by id desc
        $admin_setting = new Setting;

        $vertical_menus = $admin_setting->where('code', 'menu')->where('key', 'vertical_menu')->first();
        $horizontal_menus = $admin_setting->where('code', 'menu')->where('key', 'horizontal_menu')->first();

        return view('contents.settings.index', compact('vertical_menus', 'horizontal_menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveVerticalMenu(VerticalMenuRequest $request)
    {
        $settings = new Setting;
        if($settings->where('code', 'menu')->where('key', 'vertical_menu')->exists()){
            $settings->where('code', 'menu')->where('key', 'vertical_menu')->update(['value'=>$request->vertical_value]);
        }else{
            $settings_input[] = [
                'code' => 'menu',
                'key' => 'vertical_menu',
                'value' => $request->vertical_value,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        Setting::insert($settings_input ?? []);

        Session::put('success','Vertical Menu saved successfully!');
        return Response::json(['success' => 'Vertical Menu saved successfully!'], 202);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveHorizontalMenu(HorizontalMenuRequest $request)
    {
        $settings = new Setting;
        if($settings->where('code', 'menu')->where('key', 'horizontal_menu')->exists()){
            $settings->where('code', 'menu')->where('key', 'horizontal_menu')->update(['value'=>$request->horizontal_value]);
        }else{
            $settings_input[] = [
                'code' => 'menu',
                'key' => 'horizontal_menu',
                'value' => $request->horizontal_value,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        Setting::insert($settings_input ?? []);

        Session::put('success','Horizontal Menu saved successfully!');
        return Response::json(['success' => 'Horizontal Menu saved successfully!'], 202);
    }
}
