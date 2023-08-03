<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user_data = [
            'id'=>1,
            'name' => 'superadmin',
            'email' => 'superadmin@sherifshalaby.tech',
            'password' => Hash::make('123456'),
            // 'is_superadmin' => 1,
            // 'is_admin' => 0,
            // 'is_detault' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        User::updateOrCreate(['id'=>1],$user_data);

        $user_data = [
            'id'=>2,
            'name' => 'Admin',
            'email' => 'admin@sherifshalaby.tech',
            'password' => Hash::make('123456'),
            // 'is_superadmin' => 0,
            // 'is_admin' => 1,
            // 'is_detault' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        $user = User::updateOrCreate(['id'=>2],$user_data);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
