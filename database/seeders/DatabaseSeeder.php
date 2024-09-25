<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@sas.com',
            'password' => bcrypt('secret')
        ]);
        DB::table('waktu')->insert([
            'jam_masuk' => '07:00',
            'jam_pulang' => '15:00'
        ]);
        DB::table('pin')->insert([
            'pin' => '123456'
        ]);
    }
}
