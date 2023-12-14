<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
//        Permission::create(['name' => 'view drivers']);

        $superAdminRole = Role::create(['name' => RoleEnum::SUPER_ADMIN]);
        $adminRole = Role::create(['name' => RoleEnum::ADMIN]);
        $userRole = Role::create(['name' => RoleEnum::USER]);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $superAdmin = User::factory()->create([
            'name' => 'Rahman SuperAdmin',
            'mobile' => '989332246347',
        ]);
        $admin = User::factory()->create([
            'name' => 'Rahman Admin',
            'mobile' => '989332246345',
        ]);

        $user = User::factory()->create([
            'name' => 'Majid User',
            'mobile' => '989332246346',
        ]);

        $superAdmin->assignRole($superAdminRole);
        $admin->assignRole($adminRole);
        $user->assignRole($userRole);
    }
}
