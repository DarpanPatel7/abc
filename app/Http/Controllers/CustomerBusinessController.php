<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerBusiness;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CustomerBusiness\StoreRequest;
use App\Http\Requests\CustomerBusiness\UpdateRequest;

class CustomerBusinessController extends Controller
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
                $customer_businesses = CustomerBusiness::select('id', 'name', 'status')->orderBy("id", "desc")->get();

                return DataTables::of($customer_businesses)
                    ->addIndexColumn()
                    ->editColumn('status', function ($status) {
                        $badgeStatus = $status->badgeStatus ?? '';
                        $stringStatus = $status->stringStatus ?? '';
                        $userHtml = '<span class="'.$badgeStatus.'">'.$stringStatus.'</span>';
                        return $userHtml;
                    })
                    ->addColumn('action', function($action){
                        $editUrl = url('customer-businesses/' . Crypt::Encrypt($action->id) . '/edit');
                        $deleteUrl = url('customer-businesses/' . Crypt::Encrypt($action->id));
                        $actionHtml = '<div class="d-inline-block text-nowrap"><button class="btn btn-sm btn-icon editCustomerBusiness" data-url="'.$editUrl.'"><i class="bx bx-edit"></i></button><button class="btn btn-sm btn-icon deleteCustomerBusiness" data-url="'.$deleteUrl.'"><i class="bx bx-trash"></i></button> </div>';
                        return $actionHtml;
                    })
                    ->rawColumns(['status', 'action'])
                    ->make(true);
            }
            return view('contents.customer-businesses.index');
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
            $customer_business = new CustomerBusiness();
            $customer_business->name = $request['customer_business_name'] ?? '';
            $customer_business->status = !empty($request['status']) ? 1 : 0;
            $customer_business->save();

            return Response::json(['success' => 'Customer Business created successfully!'], 202);
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
                'id' => 'required|exists:customer_businesses,id'
            ]);

            if ($validator->fails()) {
                return Response::json(['error' => $validator->errors()->first()], 202);
            }

            $customer_business = CustomerBusiness::where('id', $id)->first();
            $returnHTML = view('contents.customer-businesses.modal-edit')->with(compact('customer_business'))->render();
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
                'id' => 'required|exists:customer_businesses,id'
            ]);

            if ($validator->fails()) {
                return Response::json(['error' => $validator->errors()->first()], 202);
            }

            $customer_business = CustomerBusiness::where('id', $id)->first();
            $customer_business->name = $request['customer_business_name'] ?? '';
            $customer_business->status = !empty($request['status']) ? 1 : 0;
            $customer_business->save();

            return Response::json(['success' => 'Customer Business updated successfully!'], 202);
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
                'id' => 'required|exists:customer_businesses,id'
            ]);

            if ($validator->fails()) {
                return Response::json(['error' => $validator->errors()->first()], 202);
            }

            CustomerBusiness::where('id',$id)->delete();

            return Response::json(['success' => 'Customer Business deleted successfully!'], 202);
        } catch (\Throwable $th) {
            return Response::json(['error' => $th->getMessage()], 202);
        }
    }
}
