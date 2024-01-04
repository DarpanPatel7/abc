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
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Employee\StoreRequest;
use App\Http\Requests\Employee\UpdateRequest;

class EmployeeController extends Controller
{
    use ImageTrait;
    use FileTrait;

    private $Model, $DesignationModel, $CountryModel, $LanguageModel, $TimezoneModel, $CurrencyModel, $StateModel;
    private $Table = 'users', $Folder = 'employees', $Slug = 'Employee', $UrlSlug = 'employees', $PermissionSlug = 'employee';

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
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $records = $this->Model->select('id', 'name', 'profile_photo', 'employee_no', 'designation_id', 'date_of_birth', 'status')->orderBy("id", "desc")->NoSuperAdminUser()->get();

                return DataTables::of($records)
                    ->addIndexColumn()
                    ->addColumn('user', function ($user) {
                        $ProfilePhotoPath = $user->ProfilePhotoPath ?? '';
                        $name = $user->name ?? '';
                        $email = $user->email ?? '';
                        $userHtml = '<div class="d-flex justify-content-start align-items-center user-name">
                            <div class="avatar-wrapper">
                                <div class="avatar avatar-sm me-3">
                                    <img src="' . $ProfilePhotoPath . '" alt="Avatar" class="rounded-circle">
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <a href="#" class="text-body text-truncate"><span class="fw-semibold">' . $name . '</span></a>
                                <small class="text-muted">' . $email . '</small>
                            </div>
                        </div>';
                        return $userHtml;
                    })
                    ->addColumn('designation', function ($designation) {
                        return $designation->Designation->name ?? '';
                    })
                    ->editColumn('date_of_birth', function ($date_of_birth) {
                        return $date_of_birth->Dob ?? '';
                    })
                    ->editColumn('status', function ($status) {
                        $badgeStatus = $status->badgeStatus ?? '';
                        $stringStatus = $status->stringStatus ?? '';
                        $userHtml = '<span class="' . $badgeStatus . '">' . $stringStatus . '</span>';
                        return $userHtml;
                    })
                    ->addColumn('action', function ($action) {
                        $editUrl = url($this->UrlSlug.'/' . Crypt::Encrypt($action->id) . '/edit');
                        $deleteUrl = url($this->UrlSlug.'/' . Crypt::Encrypt($action->id));
                        $actionHtml = '<div class="d-inline-block text-nowrap"><button class="btn btn-sm btn-icon edit'.$this->Slug.'" data-url="' . $editUrl . '"><i class="bx bx-edit"></i></button><button class="btn btn-sm btn-icon delete'.$this->Slug.'" data-url="' . $deleteUrl . '"><i class="bx bx-trash"></i></button> </div>';
                        return $actionHtml;
                    })
                    ->rawColumns(['user', 'designation', 'date_of_birth', 'status', 'action'])
                    ->make(true);
            }
            //get active designations by id desc
            $designations = $this->DesignationModel->Active()->get()->pluck('name', 'id');
            $countries = $this->CountryModel::Active()->get()->pluck('name', 'id');
            $languages = $this->LanguageModel::Active()->get()->pluck('name', 'id');
            $timezones = $this->TimezoneModel::Active()->get()->pluck('name', 'id');
            $currencies = $this->CurrencyModel::Active()->get()->pluck('name', 'id');

            return view('contents.' . $this->Folder . '.index', compact('designations', 'countries', 'languages', 'timezones', 'currencies'));
        } catch (\Throwable $th) {
            return Response::json(['error' => $th->getMessage()], 202);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            //validate and upload base 64 image
            if (!empty($request->profile_photo)) {
                $ValidateBase64 = $this->ValidateBase64Image($request->profile_photo);
                if (!$ValidateBase64) {
                    return Response::json(['error' => 'The photo must be a file of type: jpeg, png, jpg, svg.'], 202);
                }
            }

            if (!empty($request->profile_photo)) {
                $this->Model->profile_photo = $this->UploadBase64Image('employee', $request->profile_photo);
            }
            $this->Model->employee_no = $request['employee_no'] ?? '';
            $this->Model->name = $request['name'] ?? '';
            $this->Model->email = $request['email'] ?? '';
            $this->Model->phone_number = $request['phone_number'] ?? '';
            $this->Model->date_of_birth = Carbon::createFromFormat(Config('global.date_format'), $request['date_of_birth'])->format(Config('global.db_date_format'));
            $this->Model->joining_date = Carbon::createFromFormat(Config('global.date_format'), $request['joining_date'])->format(Config('global.db_date_format'));
            $this->Model->country_id = $request['country'] ?? '';
            $this->Model->state_id = $request['state'] ?? '';
            $this->Model->address = $request['address'] ?? '';
            $this->Model->zipcode = $request['zipcode'] ?? '';
            $this->Model->langauge_id = $request['language'] ?? '';
            $this->Model->timezone_id = $request['timezone'] ?? '';
            $this->Model->currency_id = $request['currency'] ?? '';
            $this->Model->designation_id = $request['designation'] ?? '';
            $this->Model->organization = $request['organization'] ?? '';
            if (!empty($request->file('identity_proof'))) {
                $file = $this->UploadFile('employee', $request->file('identity_proof'));
                $this->Model->identity_proof = $file ?? '';
            }
            $this->Model->status = !empty($request['status']) ? 1 : 0;
            $this->Model->save();

            return Response::json(['success' => trans('messages.success_store', ['attribute' => $this->Slug])], 202);
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $id = Crypt::decrypt($id);

            $validator = Validator::make(['id' => $id], [
                'id' => 'required|exists:' . $this->Table . ',id'
            ]);

            if ($validator->fails()) {
                return Response::json(['error' => $validator->errors()->first()], 202);
            }

            $data = $this->Model->where('id', $id)->first();
            $designations = $this->DesignationModel->Active()->get()->pluck('name', 'id');
            $countries = $this->CountryModel::Active()->get()->pluck('name', 'id');
            $statesbycountry = $this->StateModel::Active()->where('country_id', $data->country_id ?? '')->get()->pluck('name', 'id');
            $languages = $this->LanguageModel::Active()->get()->pluck('name', 'id');
            $timezones = $this->TimezoneModel::Active()->get()->pluck('name', 'id');
            $currencies = $this->CurrencyModel::Active()->get()->pluck('name', 'id');
            $returnHTML = view('contents.' . $this->Folder . '.modal-edit')->with(compact('data', 'designations', 'countries', 'statesbycountry', 'languages', 'timezones', 'currencies'))->render();
            return Response::json(['success' => 'success.', 'data' => $returnHTML], 202);
        } catch (\Throwable $th) {
            return Response::json(['error' => $th->getMessage()], 202);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $id = Crypt::decrypt($id);

            $validator = Validator::make(['id' => $id], [
                'id' => 'required|exists:' . $this->Table . ',id',
            ]);

            if ($validator->fails()) {
                return Response::json(['error' => $validator->errors()->first()], 202);
            }

            $update = $this->Model->where('id', $id)->first();

            //add or replace profile photo
            $user = $this->Model->where('id', $id)->first();
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
            $update->status = !empty($request['status']) ? 1 : 0;
            $update->save();

            return Response::json(['success' => trans('messages.success_update', ['attribute' => $this->Slug])], 202);
        } catch (\Throwable $th) {
            return Response::json(['error' => $th->getMessage()], 202);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $id = Crypt::decrypt($id);

            $validator = Validator::make(['id' => $id], [
                'id' => 'required|exists:' . $this->Table . ',id'
            ]);

            if ($validator->fails()) {
                return Response::json(['error' => $validator->errors()->first()], 202);
            }

            $user = $this->Model->where('id', $id)->first();
            if (!empty($user->profile_photo)) {
                $this->DeleteImage($user->profile_photo);
            }
            if (!empty($user->identity_proof)) {
                $this->DeleteImage($user->identity_proof);
            }
            $this->Model->where('id', $id)->delete();

            return Response::json(['success' => trans('messages.success_delete', ['attribute' => $this->Slug])], 202);
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
}
