<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //USER MODEL
        $userPermission1 = Permission::create(['name' =>'create: user', 'description' =>'Create User']);
        $userPermission2 = Permission::create(['name' =>'read: user', 'description' =>'Read User']);
        $userPermission3 = Permission::create(['name' =>'update: user', 'description' =>'Update User']);
        $userPermission4 = Permission::create(['name' =>'delete: user', 'description' =>'Delete User']);
        //ROLE MODEL
        $rolePermission1 = Permission::create(['name' =>'create: role', 'description' =>'Create role']);
        $rolePermission2 = Permission::create(['name' =>'read: role', 'description' =>'Read role']);
        $rolePermission3 = Permission::create(['name' =>'update: role', 'description' =>'Update role']);
        $rolePermission4 = Permission::create(['name' =>'delete: role', 'description' =>'Delete role']);
        //ADMINS MODEL
        $adminPermission1 = Permission::create(['name' =>'read: admin', 'description' =>'Read admin']);
        $adminPermission2 = Permission::create(['name' =>'update: admin', 'description' =>'Update admin']);
        //PERMISSIONS MODEL
        $permission1 = Permission::create(['name' =>'create: permission', 'description' =>'Create permission']);
        $permission2 = Permission::create(['name' =>'read: permission', 'description' =>'Read permission']);
        $permission3 = Permission::create(['name' =>'update: permission', 'description' =>'Update permission']);
        $permission4 = Permission::create(['name' =>'delete: permission', 'description' =>'Delete permission']);
        // Misc
        $miscPermission = Permission::create(['name' => 'N/A', 'description' => 'N/A']);

        $superAdminRole = Role::create(['name' =>'super-admin']);
        $adminRole = Role::create(['name' =>'admin']);
        $moderatorRole = Role::create(['name' =>'moderator']);
        $developerRole = Role::create(['name' =>'developer']);
        $userRole = Role::create(['name' =>'user']);

        $superAdminRole->syncPermissions([
            $userPermission1,
            $userPermission2,
            $userPermission3,
            $userPermission4,
            $rolePermission1,
            $rolePermission2,
            $rolePermission3,
            $rolePermission4,
            $permission1,
            $permission2,
            $permission3,
            $permission4,
            $adminPermission1,
            $adminPermission2,
        ]);

         $adminRole->syncPermissions([
            $userPermission1,
            $userPermission2,
            $userPermission3,
            $userPermission4,
            $rolePermission1,
            $rolePermission2,
            $rolePermission3,
            $rolePermission4,
            $permission1,
            $permission2,
            $permission3,
            $permission4,
            $adminPermission1,
            $adminPermission2,
        ]);

        $moderatorRole->syncPermissions([
            $userPermission2,
            $rolePermission2,
            $permission2,
            $adminPermission1,
        ]);

        $developerRole->syncPermissions([
            $adminPermission1,
        ]);

        $userRole->syncPermissions([
            $miscPermission,
        ]);

        $superAdmin = User::create([
            'name' => 'super admin',
            'is_admin' => 1,
            'email' => 'super@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        $admin = User::create([
            'name' => 'admin',
            'is_admin' => 1,
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        $moderator = User::create([
            'name' => 'moderator',
            'is_admin' => 1,
            'email' => 'moderator@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        $developer = User::create([
            'name' => 'developer',
            'is_admin' => 1,
            'email' => 'developer@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        $user = User::create([
            'name' => 'test',
            'is_admin' => 0,
            'email' => 'test@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        $superAdmin->syncRoles([$superAdminRole]);

        $admin->syncRoles([$adminRole]);

        $moderator->syncRoles($moderatorRole);

        $developer->syncRoles($developerRole);

        $user->syncRoles($userRole);
    }
}
