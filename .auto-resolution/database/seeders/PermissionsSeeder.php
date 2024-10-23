<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit kode']);
        Permission::create(['name' => 'delete kode']);
        Permission::create(['name' => 'create kode']);
        Permission::create(['name' => 'view kode']);
        
        Permission::create(['name' => 'edit satuan']);
        Permission::create(['name' => 'delete satuan']);
        Permission::create(['name' => 'create satuan']);
        Permission::create(['name' => 'view satuan']);

        Permission::create(['name' => 'edit vendor']);
        Permission::create(['name' => 'delete vendor']);
        Permission::create(['name' => 'create vendor']);
        Permission::create(['name' => 'view vendor']);

        Permission::create(['name' => 'edit tipe']);
        Permission::create(['name' => 'delete tipe']);
        Permission::create(['name' => 'create tipe']);
        Permission::create(['name' => 'view tipe']);

        Permission::create(['name' => 'edit merek']);
        Permission::create(['name' => 'delete merek']);
        Permission::create(['name' => 'create merek']);
        Permission::create(['name' => 'view merek']);

        Permission::create(['name' => 'edit tipe-merek']);
        Permission::create(['name' => 'delete tipe-merek']);
        Permission::create(['name' => 'create tipe-merek']);
        Permission::create(['name' => 'view tipe-merek']);

        Permission::create(['name' => 'edit unit']);
        Permission::create(['name' => 'delete unit']);
        Permission::create(['name' => 'create unit']);
        Permission::create(['name' => 'view unit']);

        Permission::create(['name' => 'edit aset']);
        Permission::create(['name' => 'delete aset']);
        Permission::create(['name' => 'create aset']);
        Permission::create(['name' => 'view aset']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'kabag']);
        $role1->givePermissionTo('edit kode');
        $role1->givePermissionTo('delete kode');
        $role1->givePermissionTo('create kode');
        $role1->givePermissionTo('view kode');

        $role1->givePermissionTo('edit satuan');
        $role1->givePermissionTo('delete satuan');
        $role1->givePermissionTo('create satuan');
        $role1->givePermissionTo('view satuan');

        $role1->givePermissionTo('edit vendor');
        $role1->givePermissionTo('delete vendor');
        $role1->givePermissionTo('create vendor');
        $role1->givePermissionTo('view vendor');

        $role1->givePermissionTo('edit tipe');
        $role1->givePermissionTo('delete tipe');
        $role1->givePermissionTo('create tipe');
        $role1->givePermissionTo('view tipe');

        $role1->givePermissionTo('edit merek');
        $role1->givePermissionTo('delete merek');
        $role1->givePermissionTo('create merek');
        $role1->givePermissionTo('view merek');

        $role1->givePermissionTo('edit unit');
        $role1->givePermissionTo('delete unit');
        $role1->givePermissionTo('create unit');
        $role1->givePermissionTo('view unit');

        $role1->givePermissionTo('edit aset');
        $role1->givePermissionTo('delete aset');
        $role1->givePermissionTo('create aset');
        $role1->givePermissionTo('view aset');

        $role2 = Role::create(['name' => 'karyawan']);
        $role2->givePermissionTo('view aset');

        $role3 = Role::create(['name' => 'Super-Admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        $pass = config('app.seeder_default');
        // create demo users
        $user = User::create([
            'npp' => 'kabag',
            'email' => 'kabag@pindadmedika.com',
            'email_verified_at' => now(),
            'password' => Hash::make($pass), // password
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole($role1);

        $user = User::create([
            'npp' => '12503',
            'email' => 'rizky.rizky@pindadmedika.com',
            'email_verified_at' => now(),
            'password' => Hash::make($pass), // password
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole($role2);

        // $user = User::factory()->create([
        //     'npp' => 'spadmin',
        //     'email' => 'spadmin@pindadmedika.com',
        // ]);
        // $user->assignRole($role3);
    }
}
