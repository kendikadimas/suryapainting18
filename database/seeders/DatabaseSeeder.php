<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $email = env('ADMIN_EMAIL', 'admin@tracking.com');
        $password = env('ADMIN_PASSWORD');

        if (empty($password)) {
            $this->command?->warn('ADMIN_PASSWORD is not set in .env; skipping admin user seeding.');

            return;
        }

        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => env('ADMIN_NAME', 'Admin Tracking'),
                'password' => bcrypt($password),
            ]
        );

        $this->command?->info("Admin user seeded: {$email}");
    }
}
