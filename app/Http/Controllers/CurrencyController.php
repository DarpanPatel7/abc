<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Currency\StoreRequest;
use App\Http\Requests\Currency\UpdateRequest;

class CurrencyController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\Response
     */
    /* public function __construct()
    {
        $this->middleware('permission:currency-list|currency-create|currency-edit|currency-delete', ['only' => ['index','store']]);
        $this->middleware('permission:currency-create', ['only' => ['create','store']]);
        $this->middleware('permission:currency-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:currency-delete', ['only' => ['destroy']]);
    } */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $currencies = Currency::select('id', 'name', 'status')->orderBy("id", "desc")->get();

                return DataTables::of($currencies)
                    ->addIndexColumn()
                    ->editColumn('status', function ($status) {
                        $badgeStatus = $status->badgeStatus ?? '';
                        $stringStatus = $status->stringStatus ?? '';
                        $userHtml = '<span class="'.$badgeStatus.'">'.$stringStatus.'</span>';
                        return $userHtml;
                    })
                    ->addColumn('action', function($action){
                        $editUrl = url('currencies/' . Crypt::Encrypt($action->id) . '/edit');
                        $deleteUrl = url('currencies/' . Crypt::Encrypt($action->id));
                        $actionHtml = '<div class="d-inline-block text-nowrap"><button class="btn btn-sm btn-icon editCurrency" data-url="'.$editUrl.'"><i class="bx bx-edit"></i></button><button class="btn btn-sm btn-icon deleteCurrency" data-url="'.$deleteUrl.'"><i class="bx bx-trash"></i></button> </div>';
                        return $actionHtml;
                    })
                    ->rawColumns(['status', 'action'])
                    ->make(true);
            }
            return view('contents.currencies.index');
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
            $currency = new Currency();
            $currency->name = $request['currency_name'] ?? '';
            $currency->status = !empty($request['status']) ? 1 : 0;
            $currency->save();

            return Response::json(['success' => 'Currency created successfully!'], 202);
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
                'id' => 'required|exists:currencies,id'
            ]);

            if ($validator->fails()) {
                return Response::json(['error' => $validator->errors()->first()], 202);
            }

            $currency = Currency::where('id', $id)->first();
            $returnHTML = view('contents.currencies.modal-edit')->with(compact('currency'))->render();
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
                'id' => 'required|exists:currencies,id'
            ]);

            if ($validator->fails()) {
                return Response::json(['error' => $validator->errors()->first()], 202);
            }

            $currency = Currency::where('id', $id)->first();
            $currency->name = $request['currency_name'] ?? '';
            $currency->status = !empty($request['status']) ? 1 : 0;
            $currency->save();

            return Response::json(['success' => 'Currency updated successfully!'], 202);
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
                'id' => 'required|exists:currencies,id'
            ]);

            if ($validator->fails()) {
                return Response::json(['error' => $validator->errors()->first()], 202);
            }

            Currency::where('id',$id)->delete();

            return Response::json(['success' => 'Currency deleted successfully!'], 202);
        } catch (\Throwable $th) {
            return Response::json(['error' => $th->getMessage()], 202);
        }
    }
}
