<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\Role\StoreRequest;
use Illuminate\Support\Facades\Response;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Role\UpdateRequest;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    private $MainModel, $UserModel, $PermissionModel, $Table = 'roles', $userTable = 'user', $Folder = 'roles', $Slug = 'Role', $UrlSlug = 'roles', $PermissionSlug = 'role';

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
        $this->MainModel = new Role;
        $this->UserModel = new User;
        $this->PermissionModel = new Permission;
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
                $records = $this->UserModel->select('id', 'name', 'profile_photo', 'status')->orderBy("id", "desc")->get();

                return DataTables::of($records)
                    ->addIndexColumn()
                    ->addColumn('user', function ($user) {
                        $ProfilePhotoPath = $user->ProfilePhotoPath ?? '';
                        $name = $user->name ?? '';
                        $email = $user->email ?? '';
                        $userHtml = '<div class="d-flex justify-content-start align-items-center user-name">
                            <div class="avatar-wrapper">
                                <div class="avatar avatar-sm me-3">
                                    <img src="' . $ProfilePhotoPath . '" alt="Avatar" class="rounded-circle">
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <a href="#" class="text-body text-truncate"><span class="fw-semibold">' . $name . '</span></a>
                                <small class="text-muted">' . $email . '</small>
                            </div>
                        </div>';
                        return $userHtml;
                    })
                    ->addColumn('role', function ($role) {
                        $roleHtml = '';
                        if (!empty($role->getRoleNames())) {
                            foreach ($role->getRoleNames() as $v) {
                                $roleHtml .= '<span class="btn btn-info btn-sm mx-2 my-1">' . $v . '</span>';
                            }
                        }
                        return $roleHtml ?? '';
                    })
                    ->editColumn('status', function ($status) {
                        $badgeStatus = $status->badgeStatus ?? '';
                        $stringStatus = $status->stringStatus ?? '';
                        $userHtml = '<span class="' . $badgeStatus . '">' . $stringStatus . '</span>';
                        return $userHtml;
                    })
                    ->addColumn('action', function ($action) {
                        if (!$action->hasRole('Super Admin')) {
                            $editUrl = url('roles.getRole/' . Crypt::Encrypt($action->id));
                            $actionHtml = '<button class="btn btn-sm btn-icon assign' . $this->Slug . '" data-url="' . $editUrl . '"><i class="bx bx-edit"></i></button>';
                        }
                        return $actionHtml ?? '';
                    })
                    ->rawColumns(['user', 'role', 'status', 'action'])
                    ->make(true);
            }
            $roles = $this->MainModel->orderBy('id', 'desc')->get();
            $permissions = $this->PermissionModel->orderBy('sort', 'asc')->get();
            $module_permissions = [];
            foreach ($permissions as $key => $value) {
                $module_permissions[$value->flag][] = $value;
            }
            $employees = $this->UserModel->orderBy("id", "desc")->get();
            return view('contents.' . $this->Folder . '.index', compact('roles', 'permissions', 'module_permissions', 'employees'));
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
            $input['name'] = $request->input('role_name');

            $role = $this->MainModel->create($input);
            $role->syncPermissions($request->input('permission'));

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

            $role = $this->MainModel->where('id', $id)->first();
            $permissions = $this->PermissionModel->orderBy('sort', 'asc')->get();
            $module_permissions = [];
            foreach ($permissions as $key => $value) {
                $module_permissions[$value->flag][] = $value;
            }
            $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')->all();

            $returnHTML = view('contents.' . $this->Folder . '.modal-edit')->with(compact('role', 'permissions', 'rolePermissions', 'module_permissions'))->render();
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

            $checksuperadmin = $this->MainModel->where('id', $id)->where('name', 'Super Admin')->count();
            if ($checksuperadmin > 0) {
                return Response::json(['error' => trans('messages.cnt_upd_sup_usr')], 202);
            }

            $role = $this->MainModel->where('id', $id)->first();
            $role->name = $request->input('role_name');
            $role->save();

            $role->syncPermissions($request->input('permission'));

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

            $checksuperadmin = $this->MainModel->where('id', $id)->where('name', 'Super Admin')->count();
            if ($checksuperadmin > 0) {
                return Response::json(['error' => trans('messages.cnt_del_sup_usr')], 202);
            }

            //do not delete super admin role
            //can delete any other role
            $this->MainModel->where('id', $id)->where('name', '!=', 'Super Admin')->delete();

            return Response::json(['success' => trans('messages.success_delete', ['attribute' => $this->Slug])], 202);
        } catch (\Throwable $th) {
            return Response::json(['error' => $th->getMessage()], 202);
        }
    }

    /**
     * Get role
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getRole($id)
    {
        try {
            $id = Crypt::decrypt($id);

            $validator = Validator::make(['id' => $id], [
                'id' => 'required|exists:'.$this->userTable.',id'
            ]);

            if ($validator->fails()) {
                return Response::json(['error' => $validator->errors()->first()], 202);
            }

            $employee = $this->UserModel->where('id', $id)->first();
            $roles = $this->MainModel->where('name', '!=', 'Super Admin')->pluck('name', 'name')->all();
            $employeeRole = $employee->roles->pluck('name', 'name')->all();

            $returnHTML = view('contents.roles.modal-assign')->with(compact('employee', 'roles', 'employeeRole'))->render();
            return Response::json(['success' => 'success.', 'data' => $returnHTML], 202);
        } catch (\Throwable $th) {
            return Response::json(['error' => $th->getMessage()], 202);
        }
    }

    /**
     * Update role
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateRole(Request $request, $id)
    {
        try {
            $id = Crypt::decrypt($id);

            $validator = Validator::make(['id' => $id], [
                'id' => 'required|exists:'.$this->userTable.',id'
            ]);

            if ($validator->fails()) {
                return Response::json(['error' => $validator->errors()->first()], 202);
            }

            // update/assign role
            $employee = $this->UserModel->where('id', $id)->first();
            DB::table('model_has_roles')->where('model_id', $id)->delete();
            if (!empty($request->input('roles'))) {
                $role = $this->MainModel->wherein('name', $request->input('roles'))->get();
                $employee->assignRole($role);
            }

            return Response::json(['success' => trans('messages.success', ['attribute' => 'Assign role'])], 202);
        } catch (\Throwable $th) {
            return Response::json(['error' => $th->getMessage()], 202);
        }
    }
}
