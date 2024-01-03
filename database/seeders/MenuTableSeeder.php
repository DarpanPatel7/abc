<?php

namespace Database\Seeders;

use App\Models\AdminSetting;
use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * temp menu seeder.
     *
     * @return void
     */
    public function run()
    {
        $model = new AdminSetting;
        $json = '{
            "menu": [
                {
                    "icon": "menu-icon tf-icons bx bx-grid-alt",
                    "url": "dashboard",
                    "name": "Dashboard",
                    "slug": "dashboard.index"
                },
                {
                    "menuHeader": "Apps & Pages",
                    "permission": [
                        "employee-list",
                        "role-list"
                    ]
                },
                {
                    "name": "Employees",
                    "icon": "menu-icon tf-icons bx bx-user",
                    "slug": "employee",
                    "permission": [
                        "employee-list"
                    ],
                    "submenu": [
                        {
                            "url": "employees",
                            "name": "List",
                            "slug": "employees.index",
                            "permission": [
                                "employee-list"
                            ]
                        }
                    ]
                },
                {
                    "name": "Roles & Permissions",
                    "icon": "menu-icon tf-icons bx bx-check-shield",
                    "slug": "role",
                    "permission": [
                        "role-list"
                    ],
                    "submenu": [
                        {
                            "url": "roles",
                            "name": "Roles",
                            "slug": "roles.index",
                            "permission": [
                                "role-list"
                            ]
                        }
                    ]
                },
                {
                    "menuHeader": "Masters",
                    "permission": [
                        "designation-list",
                        "customer-sources-list",
                        "customer-businesses-list",
                        "currencies-list",
                        "languages-list",
                        "timezones-list"
                    ]
                },
                {
                    "url": "designations",
                    "name": "Designations",
                    "icon": "menu-icon tf-icons bx bxs-user-badge",
                    "slug": "designations.index",
                    "permission": [
                        "designation-list"
                    ]
                },
                {
                    "url": "customer-sources",
                    "name": "Customer Sources",
                    "icon": "menu-icon tf-icons bx bxs-user-badge",
                    "slug": "customer-sources.index",
                    "permission": [
                        "customer-sources-list"
                    ]
                },
                {
                    "url": "customer-businesses",
                    "name": "Customer Business",
                    "icon": "menu-icon tf-icons bx bxs-user-badge",
                    "slug": "customer-businesses.index",
                    "permission": [
                        "customer-businesses-list"
                    ]
                },
                {
                    "url": "currencies",
                    "name": "Currencies",
                    "icon": "menu-icon tf-icons bx bx-money",
                    "slug": "currencies.index",
                    "permission": [
                        "currencies-list"
                    ]
                },
                {
                    "url": "languages",
                    "name": "Languages",
                    "icon": "menu-icon tf-icons bx bx-flag",
                    "slug": "languages.index",
                    "permission": [
                        "languages-list"
                    ]
                },
                {
                    "url": "timezones",
                    "name": "Timezones",
                    "icon": "menu-icon tf-icons bx bxs-timer",
                    "slug": "timezones.index",
                    "permission": [
                        "timezones-list"
                    ]
                }
            ]
        }';
        $update = $model->where('code', 'menu')->where('key', 'vertical_menu')->first();
        $update->value = $json ?? '';
        $update->save();
    }
}
