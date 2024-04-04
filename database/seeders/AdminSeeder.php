<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

date_default_timezone_set('Asia/Kathmandu');
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $uid = rand(10000, 59999);
        $user = User::create([
            // 'uid' => Str::uuid(),
            'uid' => $uid,
            'email' => 'admin@gmail.com',
            'password' => Hash::make('1234'),
            'email_verified_at' => now()
        ]);
        $user->userInfo()->create([
            'full_name' => 'Admin',
            'position_id' => 1,
        ]);
        $user->assignRole(['admin']);
    }
}
