<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\State;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Language;
use App\Models\Timezone;
use App\Models\Designation;
use Illuminate\Http\Request;
use App\Http\Traits\FileTrait;
use App\Http\Traits\ImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\AccountSetting\AccountRequest;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Requests\AccountSetting\DeactivateAccountRequest;

class AccountSettingController extends Controller
{
    use ImageTrait;
    use FileTrait;

    private $Model, $AuthModel, $DesignationModel, $CountryModel, $LanguageModel, $TimezoneModel, $CurrencyModel, $StateModel;
    private $Folder = 'account-settings', $PermissionSlug = 'currency';

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
        $this->Model = new User;
        $this->AuthModel = new Auth;
        $this->DesignationModel = new Designation;
        $this->CountryModel = new Country;
        $this->LanguageModel = new Language;
        $this->TimezoneModel = new Timezone;
        $this->CurrencyModel = new Currency;
        $this->StateModel = new State;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function account()
    {
        $user = $this->AuthModel::user();
        $designations = $this->DesignationModel->Active()->get()->pluck('name', 'id');
        $countries = $this->CountryModel->Active()->get()->pluck('name', 'id');
        $languages = $this->LanguageModel->Active()->get()->pluck('name', 'id');
        $timezones = $this->TimezoneModel->Active()->get()->pluck('name', 'id');
        $currencies = $this->CurrencyModel->Active()->get()->pluck('name', 'id');
        $statesbycountry = $this->StateModel::Active()->where('country_id', $user->country_id ?? '')->get()->pluck('name', 'id');

        return view('contents.'.$this->Folder.'.account', compact('user', 'countries', 'statesbycountry', 'languages', 'timezones', 'currencies', 'designations'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function security()
    {
        return view('contents.'.$this->Folder.'.security');
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
            //validate and upload base 64 image
            if (!empty($request->profile_photo)) {
                $ValidateBase64 = $this->ValidateBase64Image($request->profile_photo);
                if (!$ValidateBase64) {
                    return Response::json(['error' => 'The photo must be a file of type: jpeg, png, jpg, svg.'], 202);
                }
            }

            $update = $this->Model->where('id', Auth::User()->id ?? '')->first();

            //add or replace profile photo
            $user = $this->Model->where('id', Auth::User()->id ?? '')->first();
            if (!empty($request->profile_photo)) {
                $update->profile_photo = $this->UploadBase64Image('employee', $request->profile_photo);
                if (!empty($user->profile_photo)) {
                    $this->DeleteImage($user->profile_photo);
                }
            }
            $update->employee_no = $request['employee_no'] ?? '';
            $update->name = $request['name'] ?? '';
            $update->email = $request['email'] ?? '';
            $update->phone_number = $request['phone_number'] ?? '';
            $update->date_of_birth = Carbon::createFromFormat(Config('global.date_format'), $request['date_of_birth'])->format(Config('global.db_date_format'));
            $update->joining_date = Carbon::createFromFormat(Config('global.date_format'), $request['joining_date'])->format(Config('global.db_date_format'));
            $update->country_id = $request['country'] ?? '';
            $update->state_id = $request['state'] ?? '';
            $update->address = $request['address'] ?? '';
            $update->zipcode = $request['zipcode'] ?? '';
            $update->langauge_id = $request['language'] ?? '';
            $update->timezone_id = $request['timezone'] ?? '';
            $update->currency_id = $request['currency'] ?? '';
            $update->organization = $request['organization'] ?? '';
            $update->designation_id = $request['designation'] ?? '';
            if (!empty($request->file('identity_proof'))) {
                $file = $this->UploadFile('employee', $request->file('identity_proof'));
                $update->identity_proof = $file ?? '';
                if (!empty($user->identity_proof)) {
                    $this->DeleteImage($user->identity_proof);
                }
            }
            $update->save();

            Session::put('success', trans('messages.success_save', ['attribute' => 'Account']));
            return Response::json(['success' => trans('messages.success_save', ['attribute' => 'Account'])], 202);
        } catch (\Throwable $th) {
            return Response::json(['error' => $th->getMessage()], 202);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getStateByCountry(Request $request)
    {
        try {
            $states = $this->StateModel->where('country_id', $request->id ?? '')->get()->pluck('name', 'id');

            $returnHTML = view('contents.'.$this->Folder.'.state-dropdown')->with(compact('states'))->render();
            return Response::json(['success' => 'success.','data' => $returnHTML], 202);

        } catch (\Throwable $th) {
            return Response::json(['error' => $th->getMessage()], 202);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deactivateAccount(DeactivateAccountRequest $request)
    {
        try {
            if(Auth::user()->hasRole('Super Admin')){
                return Response::json(['error' => trans('messages.cnt_dct_sup_usr')], 202);
            }
            $user = Auth::user();
            $user->status = 2;
            $user->save();

            // Create an instance of the controller
            $controllerInstance = new AuthenticatedSessionController();
            // Call the destroy method on the instance
            $controllerInstance->destroy($request);

            Session::put('success', trans('messages.success', ['attribute' => 'Deactivated']));
            return Response::json(['success' => trans('messages.success', ['attribute' => 'Deactivated']), 'redirect_url' => route('login')], 202);

        } catch (\Throwable $th) {
            return Response::json(['error' => $th->getMessage()], 202);
        }
    }
}
