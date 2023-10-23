<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Designation;
use Illuminate\Http\Request;
use App\Http\Traits\FileTrait;
use App\Http\Traits\ImageTrait;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
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
    public function index()
    {
        //get all employees by id desc
        $employees = User::orderBy("id", "desc")->get();
        $designations = Designation::Active()->get()->pluck('name', 'id');

        return view('contents.employees.index', compact('employees', 'designations'));
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

            Session::put('success', 'Employee created successfully!');
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
        dd('$employee');
        try {
            $id = Crypt::decrypt($id);

            $validator = Validator::make(['id' => $id], [
                'id' => 'required|exists:users,id'
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
            if (!empty($request->profile_photo)) {
                $employee->profile_photo = $this->UploadBase64Image('employee', $request->profile_photo);
            }

            $user = User::where('id', $id)->CompanyID()->first();
            if (!empty($request->profile_photo)) {
                $image = $this->UploadBase64Image('employee', $request->profile_photo);
                if(!empty($employee->profile_pic)){
                    $this->DeleteImage($employee->profile_pic);
                }
            }


            if (!empty($request->file('identity_proof'))) {
                $file = $this->UploadFile('employee', $request->file('identity_proof'));
                $employee->identity_proof = $file ?? '';
            }
            $employee->designation_id = $request['designation'] ?? '';
            $employee->status = !empty($request['status']) ? 1 : 0;
            $employee->save();

            Session::put('success','Employee updated successfully!');
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

            //User::where('id',$id)->delete();

            return Response::json(['success' => 'Employee deleted successfully!'], 202);
        } catch (\Throwable $th) {
            return Response::json(['error' => $th->getMessage()], 202);
        }
    }
}
