<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class InitialUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->deleteAllUsers();

        $this->createUsers(count: 10, userType: UserType::ADMIN);
        $this->createUsers(count: 20, userType: UserType::USER);
    }
    
    private function deleteAllUsers(): void 
    {
        Schema::disableForeignKeyConstraints();
        
        User::truncate();
        
        Schema::enableForeignKeyConstraints();
    }
    
    private function createUsers($count, UserType $userType) {
        User::factory()->count($count)->create(['user_type' => $userType]);
    }
}
