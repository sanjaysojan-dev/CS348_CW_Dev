<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->id = 1;
        $user->name = "test_1";
        $user->username = "test_1";
        $user->email = "test_1@gmal.com";
        $user->password = "test_1";
        $user->save();


        User::factory()
            ->times(5)
            ->create();
    }
}
