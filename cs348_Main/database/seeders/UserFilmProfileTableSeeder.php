<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserFilmProfile;
use Illuminate\Database\Seeder;

class UserFilmProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::all()->each(function($user) {
            UserFilmProfile::factory()->create(['user_id' => $user->id]);
        });
    }
}
