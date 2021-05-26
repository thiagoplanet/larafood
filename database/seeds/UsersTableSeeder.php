<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Thiago Planet',
            'email'=> 'thiagoplanet2004@hotmail.com',
            'password' => bcrypt('123456')
        ]);
    }
}
