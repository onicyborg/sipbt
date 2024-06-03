<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DataSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'nama' => 'Pemilik User',
                'alamat' => 'Jl. Contoh Alamat No.1',
                'nomortelepon' => '081234567890',
                'username' => 'pemilik',
                'password' => Hash::make('passwordpemilik'),
                'role' => 'pemilik',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Admin User',
                'alamat' => 'Jl. Contoh Alamat No.2',
                'nomortelepon' => '081234567891',
                'username' => 'admin',
                'password' => Hash::make('passwordadmin'),
                'role' => 'admin',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Pegawai User',
                'alamat' => 'Jl. Contoh Alamat No.3',
                'nomortelepon' => '081234567892',
                'username' => 'pegawai',
                'password' => Hash::make('passwordpegawai'),
                'role' => 'pegawai',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
