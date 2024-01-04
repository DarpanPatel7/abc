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
                'name'=>'employee-list',
                'flag'=>'Employee',
                'sort'=> 1
            ],
            [
                'name'=>'employee-create',
                'flag'=>'Employee',
                'sort'=> 1
            ],
            [
                'name'=>'employee-edit',
                'flag'=>'Employee',
                'sort'=> 1
            ],
            [
                'name'=>'employee-delete',
                'flag'=>'Employee',
                'sort'=> 1
            ],
            [
                'name'=>'role-list',
                'flag'=>'Role',
                'sort'=> 2
            ],
            [
                'name'=>'role-create',
                'flag'=>'Role',
                'sort'=> 2
            ],
            [
                'name'=>'role-edit',
                'flag'=>'Role',
                'sort'=> 2
            ],
            [
                'name'=>'role-delete',
                'flag'=>'Role',
                'sort'=> 2
            ],
            [
                'name'=>'account-setting-account',
                'flag'=>'Account Setting',
                'sort'=> 3
            ],
            [
                'name'=>'account-setting-security',
                'flag'=>'Account Setting',
                'sort'=> 3
            ],
            [
                'name'=>'admin-setting',
                'flag'=>'Admin Setting',
                'sort'=> 4
            ],
            [
                'name'=>'designation-list',
                'flag'=>'Designation',
                'sort'=> 5
            ],
            [
                'name'=>'designation-create',
                'flag'=>'Designation',
                'sort'=> 5
            ],
            [
                'name'=>'designation-edit',
                'flag'=>'Designation',
                'sort'=> 5
            ],
            [
                'name'=>'designation-delete',
                'flag'=>'Designation',
                'sort'=> 5
            ],
            [
                'name'=>'customer-source-list',
                'flag'=>'Customer Source',
                'sort'=> 6
            ],
            [
                'name'=>'customer-source-create',
                'flag'=>'Customer Source',
                'sort'=> 6
            ],
            [
                'name'=>'customer-source-edit',
                'flag'=>'Customer Source',
                'sort'=> 6
            ],
            [
                'name'=>'customer-source-delete',
                'flag'=>'Customer Source',
                'sort'=> 6
            ],
            [
                'name'=>'customer-business-list',
                'flag'=>'Customer Business',
                'sort'=> 7
            ],
            [
                'name'=>'customer-business-create',
                'flag'=>'Customer Business',
                'sort'=> 7
            ],
            [
                'name'=>'customer-business-edit',
                'flag'=>'Customer Business',
                'sort'=> 7
            ],
            [
                'name'=>'customer-business-delete',
                'flag'=>'Customer Business',
                'sort'=> 7
            ],
            [
                'name'=>'currency-list',
                'flag'=>'Currency',
                'sort'=> 8
            ],
            [
                'name'=>'currency-create',
                'flag'=>'Currency',
                'sort'=> 8
            ],
            [
                'name'=>'currency-edit',
                'flag'=>'Currency',
                'sort'=> 8
            ],
            [
                'name'=>'currency-delete',
                'flag'=>'Currency',
                'sort'=> 8
            ],
            [
                'name'=>'language-list',
                'flag'=>'Language',
                'sort'=> 9
            ],
            [
                'name'=>'language-create',
                'flag'=>'Language',
                'sort'=> 9
            ],
            [
                'name'=>'language-edit',
                'flag'=>'Language',
                'sort'=> 9
            ],
            [
                'name'=>'language-delete',
                'flag'=>'Language',
                'sort'=> 9
            ],
            [
                'name'=>'timezone-list',
                'flag'=>'Timezone',
                'sort'=> 10
            ],
            [
                'name'=>'timezone-create',
                'flag'=>'Timezone',
                'sort'=> 10
            ],
            [
                'name'=>'timezone-edit',
                'flag'=>'Timezone',
                'sort'=> 10
            ],
            [
                'name'=>'timezone-delete',
                'flag'=>'Timezone',
                'sort'=> 10
            ],
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
