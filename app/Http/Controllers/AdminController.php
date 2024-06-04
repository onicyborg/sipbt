<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', ['menu' => 'dashboard']);
    }

    public function list_user()
    {
        $user = User::all();

        return view('admin.manage-user', ['menu' => 'datauser', 'user' => $user]);
    }

    public function add_user(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nomortelepon' => 'required|numeric|digits_between:10,15',
            'username' => 'required|string|min:3|max:50|unique:users,username',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,pelanggan,pegawai,pemilik'
        ]);

        $user = new User();

        $user->nama = $request->nama;
        $user->alamat = $request->alamat;
        $user->nomortelepon = $request->nomortelepon;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        return redirect('/admin/manage-user')->with('success', 'User berhasil ditambahkan');
    }

    public function delete_user($id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect('/admin/manage-user')->with('success', 'Berhasil Menghapus Data User');
    }

    public function update_user(Request $request, $id)
    {
        // Ambil data user yang akan diupdate
        $user = User::findOrFail($id);

        // Validasi data termasuk username
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nomortelepon' => 'required|numeric|digits_between:10,15',
            'username' => 'required|string|min:3|max:50|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:admin,pelanggan,pegawai,pemilik'
        ]);

        // Mengupdate data user
        $user->nama = $request->nama;
        $user->alamat = $request->alamat;
        $user->nomortelepon = $request->nomortelepon;
        $user->username = $request->username;

        if ($request->password != '') {
            $user->password = Hash::make($request->password);
        }

        $user->role = $request->role;
        $user->save();

        return redirect()->back()->with('success', 'User berhasil diupdate');
    }
}
