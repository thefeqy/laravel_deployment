<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FirstAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate([
            "name" => "admin",
        ], [
            "email" => "admin@admin.dev",
            "email_verified_at" => Carbon::now(),
            "password" => 123456789,
            "user_type" => UserType::ADMIN,
        ]);
    }
}
