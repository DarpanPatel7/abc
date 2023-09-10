<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\DataTables\DesignationDataTable;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\Designation\StoreRequest;
use App\Http\Requests\Designation\UpdateRequest;
use Illuminate\Support\Facades\Validator;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //get all designation by id desc
        $designations = Designation::orderBy("id", "desc")->get();

        return view('contents.designations.index', compact('designations'));
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
            $designation = new Designation();
            $designation->name = $request['designation_name'] ?? '';
            $designation->status = !empty($request['status']) ? 1 : 0;
            $designation->save();

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        try {
            $id = Crypt::decrypt($id);
            
            $validator = Validator::make(['id' => $id], [
                'id' => 'required|exists:designations,id'
            ]);
            
            if ($validator->fails()) {
                return Response::json(['error' => $validator->errors()->first()], 202);
            }

            $designation = Designation::where('id', $id)->first();
            $returnHTML = view('contents.designations.modal-edit')->with(compact('designation'))->render();
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

            $designation = Designation::where('id', $id)->first();
            $designation->name = $request['designation_name'] ?? '';
            $designation->status = !empty($request['status']) ? 1 : 0;
            $designation->save();
        
            Session::put('success','Designation updated successfully!');
            return Response::json(['success' => 'Designation updated successfully!'], 202);
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
                'id' => 'required|exists:designations,id'
            ]);
            
            if ($validator->fails()) {
                return Response::json(['error' => $validator->errors()->first()], 202);
            }

            Designation::where('id',$id)->delete();

            Session::put('success','Designation deleted successfully!');
            return Response::json(['success' => 'Designation deleted successfully!'], 202);
        } catch (\Throwable $th) {
            return Response::json(['error' => $th->getMessage()], 202);
        }
    }
}
