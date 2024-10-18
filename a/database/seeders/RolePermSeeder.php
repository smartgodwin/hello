<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Création des permissions sur les users avec le guard 'web'
        Permission::create(['name' => 'create User']);
        Permission::create(['name' => 'edit User']);
        Permission::create(['name' => 'update User']);
        Permission::create(['name' => 'show User']);
        Permission::create(['name' => 'destroy User']);

        // Permissions sur les produits avec le guard 'web'
        Permission::create(['name' => 'create Add']);
        Permission::create(['name' => 'edit Add']);
        Permission::create(['name' => 'update Add']);
        Permission::create(['name' => 'show Add']);
        Permission::create(['name' => 'destroy Add']);

        // Création des rôles et assignation des permissions avec le guard 'web'
        $Admin_role = Role::create(['name' => 'Admin']);
        $Admin_role->givePermissionTo(Permission::all());

        $super_Admin_role = Role::create(['name' => 'superAdmin']);
        $super_Admin_role->givePermissionTo(Permission::all());

       $admin = User::create([
           'name' => 'admin',
           'email' => 'admin@gmail.com',
           'phone_number' => +22871166384,
           'password' => bcrypt('password'),
       ]);

       // assigné role
       $admin->assignRole($Admin_role);


       $super_admin = User::create([
           'name' => 'superAdmin',
           'email' => 'superadmin@gmail.com',
           'phone_number' => +15718391142,
           'password' => bcrypt('password'),
       ]);

       // assigné role
       $super_admin->assignRole($super_Admin_role);

       $user = User::create([
           'name' => 'Godwin',
           'email' => 'mlaganigodwin2@gmail.com',
           'phone_number' => +22871166384,
           'password' => bcrypt(12345678),
       ]);
       $user = User::create([
           'name' => 'Gildas',
           'email' => 'koragildas@gmail.com',
           'phone_number' => +22891526909,
           'password' => bcrypt(123456789),
       ]);

        $user = User::create([
            'name' => 'Louis',
            'email' => 'louis@gmail.com',
            'phone_number' => +22898989898,
            'password' => bcrypt('admin123'),
        ]);
   }
}
