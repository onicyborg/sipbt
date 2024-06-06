<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            [
                'nama' => 'Pelanggan User',
                'alamat' => 'Jl. Contoh Alamat No.3',
                'nomortelepon' => '081234567892',
                'username' => 'pelanggan',
                'password' => Hash::make('passwordpelanggan'),
                'role' => 'pelanggan',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);


        $products = [
            [
                'kode' => Str::random(10),
                'nama' => 'Produk A',
                'detail' => 'Detail produk A',
                'harga' => 100000,
                'stok' => 50,
                'image' => 'default.png',
                'jenis_pesanan' => 'ready',
                'tanggal_tanam' => Carbon::now()->subDays(10),
                'display' => 'Tampilkan'
            ],
            [
                'kode' => Str::random(10),
                'nama' => 'Produk B',
                'detail' => 'Detail produk B',
                'harga' => 150000,
                'stok' => 2000,
                'image' => 'default.png',
                'jenis_pesanan' => 'preorder',
                'tanggal_tanam' => null,
                'display' => 'Tampilkan'
            ],
            [
                'kode' => Str::random(10),
                'nama' => 'Produk C',
                'detail' => 'Detail produk C',
                'harga' => 200000,
                'stok' => 40,
                'image' => 'default.png',
                'jenis_pesanan' => 'ready',
                'tanggal_tanam' => Carbon::now()->subDays(20),
                'display' => 'Tampilkan'
            ],
            [
                'kode' => Str::random(10),
                'nama' => 'Produk D',
                'detail' => 'Detail produk D',
                'harga' => 120000,
                'stok' => 2000,
                'image' => 'default.png',
                'jenis_pesanan' => 'preorder',
                'tanggal_tanam' => null,
                'display' => 'Tampilkan'
            ],
            [
                'kode' => Str::random(10),
                'nama' => 'Produk E',
                'detail' => 'Detail produk E',
                'harga' => 180000,
                'stok' => 20,
                'image' => 'default.png',
                'jenis_pesanan' => 'ready',
                'tanggal_tanam' => Carbon::now()->subDays(5),
                'display' => 'Tampilkan'
            ],
            [
                'kode' => Str::random(10),
                'nama' => 'Produk F',
                'detail' => 'Detail produk F',
                'harga' => 220000,
                'stok' => 2000,
                'image' => 'default.png',
                'jenis_pesanan' => 'preorder',
                'tanggal_tanam' => null,
                'display' => 'Tampilkan'
            ],
            [
                'kode' => Str::random(10),
                'nama' => 'Produk G',
                'detail' => 'Detail produk G',
                'harga' => 140000,
                'stok' => 28,
                'image' => 'default.png',
                'jenis_pesanan' => 'ready',
                'tanggal_tanam' => Carbon::now()->subDays(15),
                'display' => 'Tampilkan'
            ],
            [
                'kode' => Str::random(10),
                'nama' => 'Produk H',
                'detail' => 'Detail produk H',
                'harga' => 160000,
                'stok' => 2000,
                'image' => 'default.png',
                'jenis_pesanan' => 'preorder',
                'tanggal_tanam' => null,
                'display' => 'Tampilkan'
            ],
            [
                'kode' => Str::random(10),
                'nama' => 'Produk I',
                'detail' => 'Detail produk I',
                'harga' => 170000,
                'stok' => 45,
                'image' => 'default.png',
                'jenis_pesanan' => 'ready',
                'tanggal_tanam' => Carbon::now()->subDays(8),
                'display' => 'Tampilkan'
            ],
            [
                'kode' => Str::random(10),
                'nama' => 'Produk J',
                'detail' => 'Detail produk J',
                'harga' => 130000,
                'stok' => 2000,
                'image' => 'default.png',
                'jenis_pesanan' => 'preorder',
                'tanggal_tanam' => null,
                'display' => 'Tampilkan'
            ],
        ];

        DB::table('product')->insert($products);
    }
}
