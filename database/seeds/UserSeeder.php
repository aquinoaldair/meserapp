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
            ['name' => \App\User::ADMIN_ROLE]
        );

        \Spatie\Permission\Models\Role::create(
            ['name' => \App\User::CUSTOMER_ROLE]
        );

        \Spatie\Permission\Models\Role::create([
            'name' => \App\User::WAITER_ROLE
        ]);

        \Spatie\Permission\Models\Role::create([
            'name' => \App\User::CLIENT_ROLE
        ]);

        $admin = factory(\App\User::class)->create([
            "name" => "Admin",
            "email" => "admin@mail.com",
        ]);

        $admin->assignRole(\App\User::ADMIN_ROLE);

    }
}
