<?php

use Illuminate\Database\Seeder;

class InitDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = \DB::table('permissions')->insert(array_map(function($name) {
            return [
                'name' => $name,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ];
        }, $this->superAdminPermissions()));

        $superAdmin = $this->createSuperAdmin();
        $admin = $this->createAdmin();
        $user = $this->createUser();
    }

    protected function adminPermissions()
    {
        return [
            'view-user',
            'create-user',
            'update-user',
            'block-post',
            'block-comment',
            'manage-tag',
            'manage-category',
        ];
    }

    protected function superAdminPermissions()
    {
        return [
            'view-user',
            'create-user',
            'update-user',
            'delete-user',
            'update-user->role',
            'block-post',
            'delete-comment',
            'block-comment',
            'manage-role',
            'manage-permission',
            'manage-tag',
            'manage-category',
        ];
    }

    protected function createSuperAdmin()
    {
        $superAdmin = new \App\User();
        $superAdmin->name = 'superAdmin';
        $superAdmin->password = \Hash::make('123123');
        $superAdmin->email = 'superAdmin@superAdmin.com';
        $superAdmin->save();

        $superAdminRole = \App\Role::create([
            'name' => 'superAdmin',
        ]);

        $permissions = \App\Permission::whereIn('name', $this->superAdminPermissions())->get();

        $superAdminRole->attachPermissions($permissions);

        $superAdmin->attachRole($superAdminRole);

        return $superAdmin;
    }

    protected function createAdmin()
    {
        $admin = new \App\User();
        $admin->name = 'admin';
        $admin->password = \Hash::make('123123');
        $admin->email = 'admin@admin.com';
        $admin->save();

        $adminRole = \App\Role::create([
            'name' => 'admin',
        ]);

        $permissions = \App\Permission::whereIn('name', $this->adminPermissions())->get();
        $adminRole->attachPermissions($permissions);

        $admin->attachRole($adminRole);

        return $admin;
    }

    protected function createUser()
    {
        $user = new \App\User();
        $user->name = 'user';
        $user->password = \Hash::make('123123');
        $user->email = 'user@user.com';
        $user->save();

        $userRole = \App\Role::create([
            'name' => 'user',
        ]);

        $user->attachRole($userRole);

        return $user;
    }
}
