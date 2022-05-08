<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
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
          'first_name' => 'Shubh',
          'last_name' => 'Jangam',
          'email' => 'shubhjangam100@gmail.com',
          'phone_number' => '9653316033',
          'age' => 21,
          'gender' => 'Male',
          'password' => bcrypt('password'),
        ]);
        $user->assignRole('Normal User');
    }
}
