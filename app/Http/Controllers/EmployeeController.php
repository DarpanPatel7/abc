<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $employees = User::select('id', 'name', 'profile_photo', 'employee_no', 'designation_id', 'date_of_birth', 'status')->orderBy("id", "desc")->NoSuperAdminUser()->get();

                return DataTables::of($employees)
                    ->addIndexColumn()
                    ->addColumn('user', function ($user) {
                        $ProfilePhotoPath = $user->ProfilePhotoPath ?? '';
                        $name = $user->name ?? '';
                        $email = $user->email ?? '';
                        $userHtml = '<div class="d-flex justify-content-start align-items-center user-name">
                            <div class="avatar-wrapper">
                                <div class="avatar avatar-sm me-3">
                                    <img src="'.$ProfilePhotoPath.'" alt="Avatar" class="rounded-circle">
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <a href="#" class="text-body text-truncate"><span class="fw-semibold">'.$name.'</span></a>
                                <small class="text-muted">'.$email.'</small>
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
                        $userHtml = '<span class="'.$badgeStatus.'">'.$stringStatus.'</span>';
                        return $userHtml;
                    })
                    ->addColumn('action', function($action){
                        $editUrl = url('employees/' . Crypt::Encrypt($action->id) . '/edit');
                        $deleteUrl = url('employees/' . Crypt::Encrypt($action->id));
                        $actionHtml = '<div class="d-inline-block text-nowrap"><button class="btn btn-sm btn-icon editEmployee" data-url="'.$editUrl.'"><i class="bx bx-edit"></i></button><button class="btn btn-sm btn-icon deleteEmployee" data-url="'.$deleteUrl.'"><i class="bx bx-trash"></i></button> </div>';
                        return $actionHtml;
                    })
                    ->rawColumns(['user', 'designation', 'date_of_birth', 'status', 'action'])
                    ->make(true);
            }
            //get all employees by id desc
            $designations = Designation::Active()->get()->pluck('name', 'id');

            return view('contents.employees.index', compact('designations'));
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

            $employee = new User();
            $employee->employee_no = $request['employee_no'] ?? '';
            $employee->name = $request['name'] ?? '';
            $employee->current_address = $request['current_address'] ?? '';
            $employee->permanent_address = $request['permanent_address'] ?? '';
            $employee->date_of_birth = Carbon::createFromFormat(Config('global.date_format'), $request['date_of_birth'])->format(Config('global.db_date_format'));
            $employee->joining_date = Carbon::createFromFormat(Config('global.date_format'), $request['joining_date'])->format(Config('global.db_date_format'));
            if (!empty($request->profile_photo)) {
                $employee->profile_photo = $this->UploadBase64Image('employee', $request->profile_photo);
            }
            if (!empty($request->file('identity_proof'))) {
                $file = $this->UploadFile('employee', $request->file('identity_proof'));
                $employee->identity_proof = $file ?? '';
            }
            $employee->designation_id = $request['designation'] ?? '';
            $employee->status = !empty($request['status']) ? 1 : 0;
            $employee->save();

            return Response::json(['success' => 'Employee created successfully!'], 202);
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
                'id' => 'required|exists:users,id'
            ]);

            if ($validator->fails()) {
                return Response::json(['error' => $validator->errors()->first()], 202);
            }

            $employee = User::where('id', $id)->first();
            $designations = Designation::Active()->get()->pluck('name', 'id');
            $returnHTML = view('contents.employees.modal-edit')->with(compact('employee', 'designations'))->render();
            return Response::json(['success' => 'success.','data' => $returnHTML], 202);

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
                'id' => 'required|exists:users,id',
            ]);

            if ($validator->fails()) {
                return Response::json(['error' => $validator->errors()->first()], 202);
            }

            $employee = User::where('id', $id)->first();

            $employee->employee_no = $request['employee_no'] ?? '';
            $employee->name = $request['name'] ?? '';
            $employee->current_address = $request['current_address'] ?? '';
            $employee->permanent_address = $request['permanent_address'] ?? '';
            $employee->date_of_birth = Carbon::createFromFormat(Config('global.date_format'), $request['date_of_birth'])->format(Config('global.db_date_format'));
            $employee->joining_date = Carbon::createFromFormat(Config('global.date_format'), $request['joining_date'])->format(Config('global.db_date_format'));
            //add or replace profile photo
            $user = User::where('id', $id)->first();
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
                'id' => 'required|exists:users,id'
            ]);

            if ($validator->fails()) {
                return Response::json(['error' => $validator->errors()->first()], 202);
            }

            $user = User::where('id', $id)->first();
            if(!empty($user->profile_photo)){
                $this->DeleteImage($user->profile_photo);
            }
            if(!empty($user->identity_proof)){
                $this->DeleteImage($user->identity_proof);
            }
            User::where('id',$id)->delete();

            return Response::json(['success' => 'Employee deleted successfully!'], 202);
        } catch (\Throwable $th) {
            return Response::json(['error' => $th->getMessage()], 202);
        }
    }
}
