<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->get()->each(function ($user) {
            DB::table('user_statuses')->insert([
                'user_id' => $user->id,
                'status_id' => 1,
            ]);
        });
    }
}
