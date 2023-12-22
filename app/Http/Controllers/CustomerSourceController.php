<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerSource;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CustomerSource\StoreRequest;
use App\Http\Requests\CustomerSource\UpdateRequest;

class CustomerSourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $customer_sources = CustomerSource::select('id', 'name', 'status')->orderBy("id", "desc")->get();

                return DataTables::of($customer_sources)
                    ->addIndexColumn()
                    ->editColumn('status', function ($status) {
                        $badgeStatus = $status->badgeStatus ?? '';
                        $stringStatus = $status->stringStatus ?? '';
                        $userHtml = '<span class="'.$badgeStatus.'">'.$stringStatus.'</span>';
                        return $userHtml;
                    })
                    ->addColumn('action', function($action){
                        $editUrl = url('customer-sources/' . Crypt::Encrypt($action->id) . '/edit');
                        $deleteUrl = url('customer-sources/' . Crypt::Encrypt($action->id));
                        $actionHtml = '<div class="d-inline-block text-nowrap"><button class="btn btn-sm btn-icon editCustomerSource" data-url="'.$editUrl.'"><i class="bx bx-edit"></i></button><button class="btn btn-sm btn-icon deleteCustomerSource" data-url="'.$deleteUrl.'"><i class="bx bx-trash"></i></button> </div>';
                        return $actionHtml;
                    })
                    ->rawColumns(['status', 'action'])
                    ->make(true);
            }
            return view('contents.customer-sources.index');
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
            $customer_source = new CustomerSource();
            $customer_source->name = $request['customer_source_name'] ?? '';
            $customer_source->status = !empty($request['status']) ? 1 : 0;
            $customer_source->save();

            Session::put('success','Customer Source created successfully!');
            return Response::json(['success' => 'Customer Source created successfully!'], 202);
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
                'id' => 'required|exists:customer_sources,id'
            ]);

            if ($validator->fails()) {
                return Response::json(['error' => $validator->errors()->first()], 202);
            }

            $customer_source = CustomerSource::where('id', $id)->first();
            $returnHTML = view('contents.customer-sources.modal-edit')->with(compact('customer_source'))->render();
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
                'id' => 'required|exists:customer_sources,id'
            ]);

            if ($validator->fails()) {
                return Response::json(['error' => $validator->errors()->first()], 202);
            }

            $customer_source = CustomerSource::where('id', $id)->first();
            $customer_source->name = $request['customer_source_name'] ?? '';
            $customer_source->status = !empty($request['status']) ? 1 : 0;
            $customer_source->save();

            Session::put('success','Customer Source updated successfully!');
            return Response::json(['success' => 'Customer Source updated successfully!'], 202);
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
                'id' => 'required|exists:customer_sources,id'
            ]);

            if ($validator->fails()) {
                return Response::json(['error' => $validator->errors()->first()], 202);
            }

            CustomerSource::where('id',$id)->delete();

            return Response::json(['success' => 'Customer Source deleted successfully!'], 202);
        } catch (\Throwable $th) {
            return Response::json(['error' => $th->getMessage()], 202);
        }
    }
}
