<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Admin', 'email' => 'admin@com7.com', 'level' => 'admin', 'password' => bcrypt('admin')],
            ['name' => 'Viewer', 'email' => 'viewer@com7.com', 'level' => 'viewer', 'password' => bcrypt('viewer')],
            ['name' => 'Editor', 'email' => 'editor@com7.com', 'level' => 'editor', 'password' => bcrypt('editor')]
        ];
        User::insert($users);
    }
}
