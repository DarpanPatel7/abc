<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Designation;
use Illuminate\Http\Request;
use App\Http\Traits\FileTrait;
use App\Http\Traits\ImageTrait;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\Employee\StoreRequest;

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
        dd('show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd('edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd('update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd('destroy');
    }
}
