<?php

namespace Database\Seeders;

use App\Models\User;
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
        $user = User::create([
            'npm' => '18110241',
            'name' => 'Wiyuda Pratama Mahardika',
            'email' => 'wiyudapratama19@gmail.com',
            'status' => 'admin',
            'password' => bcrypt('wiyuda19'),
        ]);

        $user->assignRole('admin');
    }
}
