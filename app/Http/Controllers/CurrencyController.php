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
    private $Model, $Table = 'currencies', $Folder = 'currencies', $Slug = 'Currency', $UrlSlug = 'currencies', $PermissionSlug = 'currency';

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
        $this->Model = new Currency;
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
                $records = $this->Model->select('id', 'name', 'code', 'rate', 'status')->orderBy("id", "desc")->get();

                return DataTables::of($records)
                    ->addIndexColumn()
                    ->editColumn('status', function ($status) {
                        $badgeStatus = $status->badgeStatus ?? '';
                        $stringStatus = $status->stringStatus ?? '';
                        $userHtml = '<span class="' . $badgeStatus . '">' . $stringStatus . '</span>';
                        return $userHtml;
                    })
                    ->addColumn('action', function ($action) {
                        $editUrl = url($this->UrlSlug . '/' . Crypt::Encrypt($action->id) . '/edit');
                        $deleteUrl = url($this->UrlSlug . '/' . Crypt::Encrypt($action->id));
                        $actionHtml = '<div class="d-inline-block text-nowrap"><button class="btn btn-sm btn-icon edit' . $this->Slug . '" data-url="' . $editUrl . '"><i class="bx bx-edit"></i></button><button class="btn btn-sm btn-icon delete' . $this->Slug . '" data-url="' . $deleteUrl . '"><i class="bx bx-trash"></i></button> </div>';
                        return $actionHtml;
                    })
                    ->rawColumns(['status', 'action'])
                    ->make(true);
            }
            return view('contents.' . $this->Folder . '.index');
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
            $this->Model->name = $request['currency_name'] ?? '';
            $this->Model->code = $request['currency_code'] ?? '';
            $this->Model->rate = $request['currency_rate'] ?? '';
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
            $returnHTML = view('contents.' . $this->Folder . '.modal-edit')->with(compact('data'))->render();
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
                'id' => 'required|exists:' . $this->Table . ',id'
            ]);

            if ($validator->fails()) {
                return Response::json(['error' => $validator->errors()->first()], 202);
            }

            $update = $this->Model->where('id', $id)->first();
            $update->name = $request['currency_name'] ?? '';
            $update->code = $request['currency_code'] ?? '';
            $update->rate = $request['currency_rate'] ?? '';
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

            $this->Model->where('id', $id)->delete();

            return Response::json(['success' => trans('messages.success_delete', ['attribute' => $this->Slug])], 202);
        } catch (\Throwable $th) {
            return Response::json(['error' => $th->getMessage()], 202);
        }
    }
}
