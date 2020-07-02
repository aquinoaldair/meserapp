<?php

use Illuminate\Database\Seeder;

class RoleClientSeeder extends Seeder
{

    public function run()
    {
        \Spatie\Permission\Models\Role::create([
            'name' => \App\User::CLIENT_ROLE
        ]);
    }
}
