<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AccountSetting\AccountRequest;

class AccountSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function account()
    {
        $user = Auth::user();

        return view('contents.account-settings.account', compact('user'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function security()
    {
        return view('contents.account-settings.security');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveAccount(Request $request)
    {
        dd($request->all());
        $admin_settings = new AdminSetting;
        if($admin_settings->where('code', 'menu')->where('key', 'vertical_menu')->exists()){
            $admin_settings->where('code', 'menu')->where('key', 'vertical_menu')->update(['value'=>$request->vertical_value]);
        }else{
            $admin_settings_input[] = [
                'code' => 'menu',
                'key' => 'vertical_menu',
                'value' => $request->vertical_value,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        AdminSetting::insert($admin_settings_input ?? []);

        Session::put('success','Vertical Menu saved successfully!');
        return Response::json(['success' => 'Vertical Menu saved successfully!'], 202);
    }
}
