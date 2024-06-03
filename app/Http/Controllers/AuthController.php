<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registrasi(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nomortelepon' => 'required|numeric|digits_between:10,15',
            'username' => 'required|string|min:3|max:50|unique:users,username',
            'password' => 'required|string|min:8'
        ]);

        $user = new User();

        $user->nama = $request->nama;
        $user->alamat = $request->alamat;
        $user->nomortelepon = $request->nomortelepon;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);

        if ($user->save()) {
            return redirect('/login')->with('success', 'Anda Berhasil Mendaftar, Silahkan Login');
        } else {
            return redirect('/registrasi')->with('error', 'Gagal Mendaftarkan Akun Anda');
        }
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Mencoba untuk login
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            // Authentication passed...
            $user = Auth::user();

            // Cek peran (role) dan redirect sesuai peran
            switch ($user->role) {
                case 'pemilik':
                    // return redirect()->route('pemilik.dashboard');
                case 'admin':
                    // return redirect()->route('admin.dashboard');
                case 'pegawai':
                    // return redirect()->route('pegawai.dashboard');
                case 'pelanggan':
                    return redirect('/pelanggan');
                default:
                    Auth::logout();
                    return redirect()->route('login')->with('error', 'Role tidak dikenal.');
            }
        } else {
            // Authentication failed...
            return redirect()->route('login')->with('error', 'Username atau password salah.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
