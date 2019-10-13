<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->line('============[UsersTableSeeder:start]============');
        $this->createBasicRole();
        $this->createDemoAccount();
        $this->command->line('=================[INFORMATION]=================');
        $this->command->error('[+] Super Admin');
        $this->command->info('  Username : admin');
        $this->command->info('  Password : admin');
        $this->command->error('[+] Example Kasir');
        $this->command->info('  Username : kasir');
        $this->command->info('  Password : kasir');
        $this->command->line('============[UsersTableSeeder:end]=============');
    }

    /** create basic role */
    protected function createBasicRole()
    {
        $this->command->error('[+] Create basic role');

        /** create role and permission */
        $this->command->info('  [=] Create Role');
        $this->createRole('admin');
        $this->createRole('kasir');
        $this->createRole('pembeli');
        $this->command->info('  [=] Create Permission');
        $this->createCrudPermission("barang");
        $this->createCrudPermission("barangrusak");
        $this->createCrudPermission("role");
        $this->createCrudPermission("permission");

        /** give permission to role */
        $this->command->info('  [=] Give Permission to Role');
        $this->giveCrudPermissionTo('admin', 'barang');
        $this->giveCrudPermissionTo('admin', 'barangrusak');
        $this->giveCrudPermissionTo('admin', 'role');
        $this->giveCrudPermissionTo('admin', 'permission');
        $this->giveCrudPermissionTo('kasir', 'barang');
        $this->giveCrudPermissionTo('admin', 'barangrusak');
    }

    /** create role */
    protected function createRole($name)
    {
        $role = Role::create(['name' => $name]);
        $this->command->line('    [-] Create role '.$name);
    }

    /** give permission to role */
    protected function giveCrudPermissionTo($role_name, $name)
    {
        $role = Role::findByName($role_name);
        $role->givePermissionTo([
            $name . '-create',
            $name . '-read',
            $name . '-update',
            $name . '-delete'
        ]);
        $this->command->line('    [-] Give Permision ['.$name.':create,read,update,delete] To '.$role_name);
    }

    /** create permission */
    protected function createPermission($name)
    {
        $permission = Permission::create(['name' => $name]);
    }

    /** create crud permission */
    protected function createCrudPermission($name)
    {
        $this->createPermission($name . '-create');
        $this->createPermission($name . '-read');
        $this->createPermission($name . '-update');
        $this->createPermission($name . '-delete');
        $this->command->line('    [-] Create Permision '.$name.':create,read,update,delete');
    }


    /** create demo account */
    protected function createDemoAccount()
    {
        $this->command->error('[+] Create Demo Account');
        $this->createAccount('SUPER ADMIN', 'admin', 'admin@mail.com', 'admin', 'admin');
        $this->createAccount('Example Kasir', 'kasir', 'kasir@mail.com', 'kasir', 'kasir');
    }

    /** function for create account */
    protected function createAccount($nama, $username, $email, $password, $role)
    {
        $user = new User;
        $user->nama     = $nama;
        $user->username = $username;
        $user->email    = $email; 
        $user->password = bcrypt($password);
        $user->save();
        $user->assignRole($role);

        $this->command->line('    [-] Create account ' . $nama . ' with role ' . $role);
    }
}
