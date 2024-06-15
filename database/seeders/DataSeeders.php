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
                'harga' => 250,
                'stok' => 10000,
                'image' => 'default.png',
                'jenis_pesanan' => 'ready',
                'jarak_tanam' => null,
                'tanggal_tanam' => Carbon::now()->subDays(10),
                'display' => 'Tampilkan'
            ],
            [
                'kode' => Str::random(10),
                'nama' => 'Produk B',
                'detail' => 'Detail produk B',
                'harga' => 150,
                'stok' => 10000,
                'image' => 'default.png',
                'jenis_pesanan' => 'preorder',
                'jarak_tanam' => '50',
                'tanggal_tanam' => null,
                'display' => 'Tampilkan'
            ],
            [
                'kode' => Str::random(10),
                'nama' => 'Produk C',
                'detail' => 'Detail produk C',
                'harga' => 400,
                'stok' => 10000,
                'image' => 'default.png',
                'jenis_pesanan' => 'ready',
                'jarak_tanam' => null,
                'tanggal_tanam' => Carbon::now()->subDays(20),
                'display' => 'Tampilkan'
            ],
            [
                'kode' => Str::random(10),
                'nama' => 'Produk D',
                'detail' => 'Detail produk D',
                'harga' => 200,
                'stok' => 10000,
                'image' => 'default.png',
                'jenis_pesanan' => 'preorder',
                'jarak_tanam' => '60',
                'tanggal_tanam' => null,
                'display' => 'Tampilkan'
            ],
            [
                'kode' => Str::random(10),
                'nama' => 'Produk E',
                'detail' => 'Detail produk E',
                'harga' => 100,
                'stok' => 10000,
                'image' => 'default.png',
                'jenis_pesanan' => 'ready',
                'jarak_tanam' => null,
                'tanggal_tanam' => Carbon::now()->subDays(5),
                'display' => 'Tampilkan'
            ],
            [
                'kode' => Str::random(10),
                'nama' => 'Produk F',
                'detail' => 'Detail produk F',
                'harga' => 500,
                'stok' => 10000,
                'image' => 'default.png',
                'jenis_pesanan' => 'preorder',
                'jarak_tanam' => '50',
                'tanggal_tanam' => null,
                'display' => 'Tampilkan'
            ],
            [
                'kode' => Str::random(10),
                'nama' => 'Produk G',
                'detail' => 'Detail produk G',
                'harga' => 300,
                'stok' => 10000,
                'image' => 'default.png',
                'jenis_pesanan' => 'ready',
                'jarak_tanam' => null,
                'tanggal_tanam' => Carbon::now()->subDays(15),
                'display' => 'Tampilkan'
            ],
            [
                'kode' => Str::random(10),
                'nama' => 'Produk H',
                'detail' => 'Detail produk H',
                'harga' => 1000,
                'stok' => 10000,
                'image' => 'default.png',
                'jenis_pesanan' => 'preorder',
                'jarak_tanam' => '60',
                'tanggal_tanam' => null,
                'display' => 'Tampilkan'
            ],
            [
                'kode' => Str::random(10),
                'nama' => 'Produk I',
                'detail' => 'Detail produk I',
                'harga' => 230,
                'stok' => 10000,
                'image' => 'default.png',
                'jenis_pesanan' => 'ready',
                'jarak_tanam' => null,
                'tanggal_tanam' => Carbon::now()->subDays(8),
                'display' => 'Tampilkan'
            ],
            [
                'kode' => Str::random(10),
                'nama' => 'Produk J',
                'detail' => 'Detail produk J',
                'harga' => 210,
                'stok' => 10000,
                'image' => 'default.png',
                'jenis_pesanan' => 'preorder',
                'jarak_tanam' => '50',
                'tanggal_tanam' => null,
                'display' => 'Tampilkan'
            ],
        ];

        DB::table('product')->insert($products);
    }
}
