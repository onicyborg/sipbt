<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SalesProduct;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // Total sales today
        $salesToday = SalesProduct::whereDate('created_at', $today)->sum('total_keseluruhan');

        // Total sales
        $totalSales = SalesProduct::sum('total_keseluruhan');

        // Total products
        $totalProducts = Product::count();

        // Total users
        $totalUsers = User::count();

        // Sales data for chart (last 7 days)
        $salesData = SalesProduct::selectRaw('DATE(created_at) as date, SUM(total_keseluruhan) as total')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->take(7)
            ->get()
            ->reverse();

        // Format the dates correctly
        $salesData->transform(function ($item) {
            $item->date = Carbon::parse($item->date)->format('Y-m-d');
            return $item;
        });

        return view('admin.dashboard', [
            'salesToday' => $salesToday,
            'totalSales' => $totalSales,
            'totalProducts' => $totalProducts,
            'totalUsers' => $totalUsers,
            'salesData' => $salesData,
            'menu' => 'dashboard'
        ]);
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
