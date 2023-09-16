<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\Employee\StoreRequest;

class EmployeeController extends Controller
{
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
        dd('creayte');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
        try {
            $employee = new User();
            $employee->employee_no = $request['designation_name'] ?? '';
            $employee->name = $request['designation_name'] ?? '';
            $employee->current_address = $request['designation_name'] ?? '';
            $employee->permanent_address = $request['designation_name'] ?? '';
            $employee->date_of_birth = $request['designation_name'] ?? '';
            $employee->joining_date = $request['designation_name'] ?? '';
            $employee->profile_photo = $request['designation_name'] ?? '';
            $employee->identiy_proof = $request['designation_name'] ?? '';
            $employee->designation = $request['designation_name'] ?? '';
            $employee->status = !empty($request['status']) ? 1 : 0;
            $employee->save();

            Session::put('success','Designation created successfully!');
            return Response::json(['success' => 'Designation created successfully!'], 202);
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
