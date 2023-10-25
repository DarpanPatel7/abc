<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Role\StoreRequest;
use Illuminate\Support\Facades\Response;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Role\UpdateRequest;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('id', 'desc')->get();
        $permissions = Permission::orderBy('sort', 'asc')->get();
        $module_permissions = [];
        foreach ($permissions as $key => $value) {
            $module_permissions[$value->flag][] = $value;
        }
        $employees = User::orderBy("id", "desc")->get();
        return view('contents.roles.index', compact('roles', 'permissions', 'module_permissions', 'employees'));
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

            $role = Role::create($input);
            $role->syncPermissions($request->input('permission'));

            Session::put('success','Role created successfully!');
            return Response::json(['success' => 'Role created successfully!'], 202);
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
                'id' => 'required|exists:roles,id'
            ]);

            if ($validator->fails()) {
                return Response::json(['error' => $validator->errors()->first()], 202);
            }

            $role = Role::where('id', $id)->first();
            $permissions = Permission::orderBy('sort', 'asc')->get();
            $module_permissions = [];
            foreach ($permissions as $key => $value) {
                $module_permissions[$value->flag][] = $value;
            }
            $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')->all();

            $returnHTML = view('contents.roles.modal-edit')->with(compact('role', 'permissions', 'rolePermissions', 'module_permissions'))->render();
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
                'id' => 'required|exists:roles,id'
            ]);

            if ($validator->fails()) {
                return Response::json(['error' => $validator->errors()->first()], 202);
            }

            $checksuperadmin = Role::where('id',$id)->where('name','Super Admin')->count();
            if($checksuperadmin > 0){
                return Response::json(['error' => 'You cannot update super admin role.'], 202);
            }

            $role = Role::where('id', $id)->first();
            $role->name = $request->input('role_name');
            $role->save();

            $role->syncPermissions($request->input('permission'));

            Session::put('success','Role updated successfully!');
            return Response::json(['success' => 'Role updated successfully!'], 202);
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
                'id' => 'required|exists:roles,id'
            ]);

            if ($validator->fails()) {
                return Response::json(['error' => $validator->errors()->first()], 202);
            }

            $checksuperadmin = Role::where('id',$id)->where('name','Super Admin')->count();
            if($checksuperadmin > 0){
                return Response::json(['error' => 'Can not delete super admin role.'], 202);
            }

            //do not delete super admin role
            //can delete any other role
            Role::where('id',$id)->where('name','!=','Super Admin')->delete();

            Session::put('success','Role Deleted successfully!');
            return Response::json(['success' => 'Role Deleted successfully!'], 202);
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
                'id' => 'required|exists:users,id'
            ]);

            if ($validator->fails()) {
                return Response::json(['error' => $validator->errors()->first()], 202);
            }

            $employee = User::where('id', $id)->first();
            $roles = Role::where('name', '!=', 'Super Admin')->pluck('name', 'name')->all();
            $employeeRole = $employee->roles->pluck('name', 'name')->all();

            $returnHTML = view('contents.roles.modal-assign')->with(compact('employee', 'roles', 'employeeRole'))->render();
            return Response::json(['success' => 'success.','data' => $returnHTML], 202);

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
                'id' => 'required|exists:users,id'
            ]);

            if ($validator->fails()) {
                return Response::json(['error' => $validator->errors()->first()], 202);
            }

            // update/assign role
            $employee = User::where('id', $id)->first();
            DB::table('model_has_roles')->where('model_id', $id)->delete();
            if(!empty($request->input('roles'))){
                $role = Role::wherein('name', $request->input('roles'))->get();
                $employee->assignRole($role);
            }

            Session::put('success','Assing role successfully!');
            return Response::json(['success' => 'Assign role successfully!'], 202);
        } catch (\Throwable $th) {
            return Response::json(['error' => $th->getMessage()], 202);
        }
    }
}
