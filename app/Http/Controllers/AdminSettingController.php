<?php

namespace App\Http\Controllers;

use App\Models\AdminSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\AdminSetting\VerticalMenuRequest;
use App\Http\Requests\AdminSetting\HorizontalMenuRequest;

class AdminSettingController extends Controller
{
    private $Model, $Folder = 'admin-settings', $PermissionSlug = 'currency';

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // $this->middleware('permission:'.$this->PermissionSlug.'-list|'.$this->PermissionSlug.'-create|'.$this->PermissionSlug.'-edit|'.$this->PermissionSlug.'-delete', ['only' => ['index','store']]);
        // $this->middleware('permission:'.$this->PermissionSlug.'-create', ['only' => ['create','store']]);
        // $this->middleware('permission:'.$this->PermissionSlug.'-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:'.$this->PermissionSlug.'-delete', ['only' => ['destroy']]);
        $this->Model = new AdminSetting;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all designation by id desc
        $admin_setting = $this->Model;

        $vertical_menus = $admin_setting->where('code', 'menu')->where('key', 'vertical_menu')->first();
        $horizontal_menus = $admin_setting->where('code', 'menu')->where('key', 'horizontal_menu')->first();

        return view('contents.'.$this->Folder.'.index', compact('vertical_menus', 'horizontal_menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveVerticalMenu(VerticalMenuRequest $request)
    {
        $model = $this->Model;
        if ($model->where('code', 'menu')->where('key', 'vertical_menu')->exists()) {
            $model->where('code', 'menu')->where('key', 'vertical_menu')->update(['value' => $request->vertical_value]);
        } else {
            $model_input[] = [
                'code' => 'menu',
                'key' => 'vertical_menu',
                'value' => $request->vertical_value,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        $this->Model->insert($model_input ?? []);

        Session::put('success', trans('messages.success_save', ['attribute' => 'Vertical Menu']));
        return Response::json(['success' => trans('messages.success_save', ['attribute' => 'Vertical Menu'])], 202);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveHorizontalMenu(HorizontalMenuRequest $request)
    {
        $admin_settings = $this->Model;
        if ($admin_settings->where('code', 'menu')->where('key', 'horizontal_menu')->exists()) {
            $admin_settings->where('code', 'menu')->where('key', 'horizontal_menu')->update(['value' => $request->horizontal_value]);
        } else {
            $admin_settings_input[] = [
                'code' => 'menu',
                'key' => 'horizontal_menu',
                'value' => $request->horizontal_value,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        $this->Model->insert($admin_settings_input ?? []);

        Session::put('success', trans('messages.success_save', ['attribute' => 'Horizontal Menu']));
        return Response::json(['success' => trans('messages.success_save', ['attribute' => 'Horizontal Menu'])], 202);
    }
}
