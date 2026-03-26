<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@sayursegar.com'],
            [
                'name' => 'Administrator',
                'email' => 'admin@sayursegar.com',
                'phone' => '08123456789',
                'role' => 'admin',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('✅ Admin user berhasil dibuat:');
        $this->command->info('   Email   : admin@sayursegar.com');
        $this->command->info('   Password: admin123');
    }
}
