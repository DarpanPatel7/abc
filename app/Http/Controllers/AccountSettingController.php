<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AccountSetting\AccountRequest;
use App\Http\Requests\AccountSetting\StateByCountryRequest;

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
        $countries = Country::Active()->get()->pluck('name', 'id');

        return view('contents.account-settings.account', compact('user', 'countries'));
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
    public function saveAccount(AccountRequest $request)
    {
        try {

            $employee = User::where('id', Auth::User()->id ?? '')->first();

            $employee->employee_no = $request['employee_no'] ?? '';
            $employee->name = $request['name'] ?? '';
            $employee->current_address = $request['current_address'] ?? '';
            $employee->permanent_address = $request['permanent_address'] ?? '';
            $employee->date_of_birth = Carbon::createFromFormat(Config('global.date_format'), $request['date_of_birth'])->format(Config('global.db_date_format'));
            $employee->joining_date = Carbon::createFromFormat(Config('global.date_format'), $request['joining_date'])->format(Config('global.db_date_format'));
            //add or replace profile photo
            $user = User::where('id', Auth::User()->id ?? '')->first();
            if (!empty($request->profile_photo)) {
                $employee->profile_photo = $this->UploadBase64Image('employee', $request->profile_photo);
                if(!empty($user->profile_photo)){
                    $this->DeleteImage($user->profile_photo);
                }
            }

            if (!empty($request->file('identity_proof'))) {
                $file = $this->UploadFile('employee', $request->file('identity_proof'));
                $employee->identity_proof = $file ?? '';
                if(!empty($user->identity_proof)){
                    $this->DeleteImage($user->identity_proof);
                }
            }
            $employee->designation_id = $request['designation'] ?? '';
            $employee->status = !empty($request['status']) ? 1 : 0;
            $employee->save();

            return Response::json(['success' => 'Employee updated successfully!'], 202);
        } catch (\Throwable $th) {
            return Response::json(['error' => $th->getMessage()], 202);
        }
    }

    /**
     * Display the specified resource.
     * by Darpan, 01 Apr 2022
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getStateByCountry(StateByCountryRequest $request)
    {
        try {
            $states = State::where('country_id', $request->id)->get()->pluck('name', 'id');

            $returnHTML = view('contents.account-settings.state-dropdown')->with(compact('states'))->render();
            return Response::json(['success' => 'success.','data' => $returnHTML], 202);

        } catch (\Throwable $th) {
            return Response::json(['error' => $th->getMessage()], 202);
        }
    }
}
