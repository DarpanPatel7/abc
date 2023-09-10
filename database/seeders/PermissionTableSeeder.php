<?php

namespace Database\Seeders;

Use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name'=>'role-list',
                'flag'=>'Role',
                'sort'=> 1
            ],
            [
                'name'=>'role-create',
                'flag'=>'Role',
                'sort'=> 1
            ],
            [
                'name'=>'role-edit',
                'flag'=>'Role',
                'sort'=> 1
            ],
            [
                'name'=>'role-delete',
                'flag'=>'Role',
                'sort'=> 1
            ],
            [
                'name'=>'designation-list',
                'flag'=>'Designation',
                'sort'=> 2
            ],
            [
                'name'=>'designation-create',
                'flag'=>'Designation',
                'sort'=> 2
            ],
            [
                'name'=>'designation-edit',
                'flag'=>'Designation',
                'sort'=> 2
            ],
            [
                'name'=>'designation-delete',
                'flag'=>'Designation',
                'sort'=> 2
            ]
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate([
                'name' => $permission['name'],
                'flag' => $permission['flag'],
                ],
                [
                'name' => $permission['name'],
                'flag' => $permission['flag'],
                'sort'  => $permission['sort']
            ]);
        }

        $permission = new Permission;
        $role = new Role;
        $user = new User;

        //delete roles that not in above array
        $permission->whereNotIn('name', array_column($permissions, 'name'))->delete();
        
        //create super admin role if not exist and assign permission to super admin user
        $superadminrole = $role->updateOrCreate(['name' => 'Super Admin']);
        $permissions = Permission::pluck('id', 'id')->all();
        $superadminrole->syncPermissions($permissions);

        //assign Panel Super Admin Role
        $panelsuperadmin = $user->where('email', Config::get('global.super_user'))->first();
        if(!empty($panelsuperadmin)){
            $checksapermission = $user->GetSuperAdmin()->where('email', Config::get('global.super_user'))->first();
            if(empty($checksapermission)){
                $panelsuperadmin->assignRole($superadminrole);
            }
        }
    }
}
