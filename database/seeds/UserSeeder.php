<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = \Spatie\Permission\Models\Role::create(
            ['name' => 'admin']
        );

        \Spatie\Permission\Models\Role::create(
            ['name' => 'customer']
        );

        $admin = factory(\App\User::class)->create([
            "name" => "Admin",
            "email" => "admin@mail.com",
        ]);

        $admin->assignRole($role_admin);

    }
}
