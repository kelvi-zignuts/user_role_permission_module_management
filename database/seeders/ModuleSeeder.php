<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            [
                'code' => 'con',
                'name' => 'Contact',
                'description' => 'Main module for contacts',
                'parent_module_code' => null,
                'is_active' => 1,
            ],
            [
                'code' => 'acc',
                'name' => 'Account',
                'description' => 'Main module for accounts',
                'parent_module_code' => null,
                'is_active' => 1,
            ],
        ];
        foreach ($modules as $module) {
            DB::table('modules')->insert($module);
        }

        $subModules = [
            // Sub modules for Contact
            [
                'code' => 'com',
                'name' => 'Company',
                'description' => 'Sub module for companies',
                'parent_module_code' => 'con',
                'is_active' => 1,
            ],
            [
                'code' => 'peo',
                'name' => 'People',
                'description' => 'Sub module for people',
                'parent_module_code' => 'con',
                'is_active' => 1,
            ],
            // Sub modules for Account
            [
                'code' => 'not',
                'name' => 'Notes',
                'description' => 'Sub module for notes',
                'parent_module_code' => 'acc',
                'is_active' => 1,
            ],
            [
                'code' => 'act',
                'name' => 'Activity Logs',
                'description' => 'Sub module for activity logs',
                'parent_module_code' => 'acc',
                'is_active' => 1,
            ],
            [
                'code' => 'mee',
                'name' => 'Meetings',
                'description' => 'Sub module for meetings',
                'parent_module_code' => 'acc',
                'is_active' => 1,
            ]
        ];

        // foreach ($modules as $module) {
        //     DB::table('modules')->insert($module);
        // }
        // Insert sub modules
        foreach ($subModules as $subModule) {
            DB::table('modules')->insert($subModule);
        }
    }
}