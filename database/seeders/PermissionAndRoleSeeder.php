<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Constants\PermissionAndRoleConstant;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Schema;

class PermissionAndRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // delete all permissions and roles. temporarily disable foregin key constraints and enable again.
        Schema::disableForeignKeyConstraints();
        Role::truncate();
        Permission::truncate();
        Schema::enableForeignKeyConstraints();

        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $allPermissions = PermissionAndRoleConstant::GetAllPermissions();

        foreach($allPermissions as $permision) {
            Permission::create([
                'name' => $permision
            ]);
        }

        $allPermissionAndRole = PermissionAndRoleConstant::GetAllPermissionAndRole();

        foreach($allPermissionAndRole as $key=>$permissions) {
            $role = Role::create([
                'name' => $key
            ]);

            $role->syncPermissions($permissions);
        }
    }
}
