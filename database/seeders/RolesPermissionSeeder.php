<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //Permisson
        Permission::create(['name'=>'create user']);
        Permission::create(['name'=>'read user']);
        Permission::create(['name'=>'update user']);
        Permission::create(['name'=>'delete user']);

        Permission::create(['name'=>'create admin']);
        Permission::create(['name'=>'read admin']);
        Permission::create(['name'=>'update admin']);
        Permission::create(['name'=>'delete admin']);

        Permission::create(['name'=>'create axie account']);
        Permission::create(['name'=>'read axie account']);
        Permission::create(['name'=>'update axie account']);
        Permission::create(['name'=>'delete axie account']);

        Permission::create(['name'=>'create slp']);
        Permission::create(['name'=>'read slp']);

        Permission::create(['name'=>'create transaction']);
        Permission::create(['name'=>'read transaction']);
        Permission::create(['name'=>'update transaction']);

        Permission::create(['name'=>'create axie']);
        Permission::create(['name'=>'read axie']);
        Permission::create(['name'=>'update axie']);
        Permission::create(['name'=>'delete axie']);

        //Role
        $role1=Role::create(['name'=>'administrator']);

        $role2 = Role::create(['name' => 'user']);
        $role2->givePermissionTo('create axie account');
        $role2->givePermissionTo('read axie account');
        $role2->givePermissionTo('update axie account');
        $role2->givePermissionTo('delete axie account');

        $role2->givePermissionTo('create slp');
        $role2->givePermissionTo('read slp');

        $role2->givePermissionTo('create transaction');
        $role2->givePermissionTo('read transaction');
        $role2->givePermissionTo('update transaction');

        $role2->givePermissionTo('create axie');
        $role2->givePermissionTo('read axie');
        $role2->givePermissionTo('delete axie');
        $role2->givePermissionTo('update axie');
    }
}
