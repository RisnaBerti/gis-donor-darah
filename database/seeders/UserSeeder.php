<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Membuat role admin jika belum ada
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Membuat permission jika belum ada
        $permissions = [
            'create_user',
            'edit_user',
            'delete_user',
            // Tambahkan permission lain jika diperlukan
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
            $adminRole->givePermissionTo($permission);
        }

        // Membuat user admin
        $user = User::firstOrCreate([
            'nik' => 330123,
            'email' => 'admin@mail.com',
            'password' => bcrypt('admin123'),
        ]);

        // Memberikan role admin kepada user
        $user->assignRole('admin'); // menggunakan method assignRole dari Spatie Permission
    }
}


