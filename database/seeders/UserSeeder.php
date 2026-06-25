<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'email' => 'admin@spk.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'nama_lengkap' => 'Administrator',
            'is_active' => true
        ]);

        User::create([
            'username' => 'hrd',
            'email' => 'hrd@spk.com',
            'password' => Hash::make('hrd123'),
            'role' => 'hrd',
            'nama_lengkap' => 'HRD Manager',
            'is_active' => true
        ]);

        User::create([
            'username' => 'manager',
            'email' => 'manager@spk.com',
            'password' => Hash::make('manager123'),
            'role' => 'manager',
            'nama_lengkap' => 'General Manager',
            'is_active' => true
        ]);
    }
}