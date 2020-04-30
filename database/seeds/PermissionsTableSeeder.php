<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
        //Permission list
        Permission::create(['name' => 'inventario.index']);
        Permission::create(['name' => 'inventario.edit']);
        Permission::create(['name' => 'inventario.show']);
        Permission::create(['name' => 'inventario.create']);
        Permission::create(['name' => 'inventario.destroy']);
        Permission::create(['name' => 'evento.index']);
        Permission::create(['name' => 'evento.edit']);
        Permission::create(['name' => 'evento.show']);
        Permission::create(['name' => 'evento.create']);
        Permission::create(['name' => 'evento.destroy']);
        Permission::create(['name' => 'usuario.index']);
        Permission::create(['name' => 'usuario.edit']);
        Permission::create(['name' => 'usuario.show']);
        Permission::create(['name' => 'usuario.create']);
        Permission::create(['name' => 'usuario.destroy']);
        Permission::create(['name' => 'payment.index']);


        //Admin
        $admin = Role::create(['name' => 'Admin']);

        $admin->givePermissionTo([
            'inventario.index',
            'inventario.edit',
            'inventario.show',
            'inventario.create',
            'inventario.destroy',
            'evento.index',
            'evento.edit',
            'evento.show',
            'evento.create',
            'evento.destroy',
            'usuario.index',
            'usuario.edit',
            'usuario.show',
            'usuario.create',
            'usuario.destroy',
            'payment.index'
        ]);
        //$admin->givePermissionTo('inventario.index');
        //$admin->givePermissionTo(Permission::all());
       
        //Guest
        $guest = Role::create(['name' => 'Editor']);

        //User Admin
        $user = User::find(1); //Admin
        $user->assignRole('Admin');
    }
}
