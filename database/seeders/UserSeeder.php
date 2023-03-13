<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'adminBlog',
            'username' => 'admin09',
            'email' => 'adminblog09@gmail.com',
            'password' => bcrypt('admin12345'),
            'is_admin' => true
        ]);

        User::factory(3)->create();
    }
}
