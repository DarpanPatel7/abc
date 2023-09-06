<?php

namespace App\Http\Controllers;

use Datatables;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\DataTables\DesignationDataTable;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\Designation\StoreRequest;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $data = Designation::select('id','name','status')->latest()->get();
        // dd($data);
        //get all employees by id desc
        // $designations = Designation::orderBy("id", "desc")->get();

        // return view('contents.designations.index', compact('designations'));
        return view('contents.designations.index');


    }

    public function list1()
    {
        dd('sdfsdfd');
        // return $dataTable->render();
    }

    public function sdfdfgfdg(Request $request)
    {
        dd('sdfdf1');
        if ($request->ajax()) {
            dd('sdfdf');
            $data = Designation::select('id','name','status')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
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
            $designation = new Designation();
            $designation->name = $request['designation_name'] ?? '';
            // add other fields
            $designation->save();

            // $response = [
            //     'status' => 'success',
            //     'message' => 'Designation created successfully.',
            // ];

            // return response()->json($response, 200);
            Session::put('success','Designation created successfully!');
            return Response::json(['success' => 'Designation created successfully!'], 202);
        } catch (\Exception $e) {
            return $e->getMessage();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
