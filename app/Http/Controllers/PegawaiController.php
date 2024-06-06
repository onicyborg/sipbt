<?php

namespace App\Http\Controllers;

use App\Models\Perkembangan;
use App\Models\Product;
use App\Models\SalesProduct;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PegawaiController extends Controller
{
    public function index()
    {
        $product = Product::all();

        return view('pegawai.product', ['product' => $product, 'menu' => 'produkbibit']);
    }

    public function store(Request $request)
    {
        // Validation rules for both forms
        $rules = [
            'kode' => 'required|string|unique:product,kode|max:255',
            'nama' => 'required|string|max:255',
            'detail' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];

        if ($request->jenis_pesanan == 'ready') {
            $rules['tanggal_tanam'] = 'required|date';
        }

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Store the validated data
        $validatedData = $validator->validated();
        $product = new Product();
        $product->kode = $validatedData['kode'];
        $product->nama = $validatedData['nama'];
        $product->detail = $validatedData['detail'];
        $product->harga = $validatedData['harga'];
        $product->stok = $validatedData['stok'];
        $product->jenis_pesanan = $request->jenis_pesanan;

        // Handle the image upload
        if ($request->hasFile('image')) {
            $imageName = Str::uuid() . '.' . $request->image->extension();

            // Gunakan storage:link untuk mengakses folder storage/images
            $request->image->storeAs('public/images', $imageName);

            // Simpan nama file ke dalam database
            $product->image = $imageName;
        }

        if ($request->jenis_pesanan == 'ready') {
            $product->tanggal_tanam = $validatedData['tanggal_tanam'];
        }

        $product->save();

        return redirect('/pegawai/product')->with('success', 'Produk Bibit berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'kode' => 'required|string|max:255|unique:product,kode,' . $id,
            'nama' => 'required|string|max:255',
            'detail' => 'required|string',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'jenis_pesanan' => 'required|in:preorder,ready',
            'tanggal_tanam' => 'nullable|date|required_if:jenis_pesanan,ready',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'display' => 'required'
        ]);

        // Temukan produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Update data produk
        $product->kode = $request->kode;
        $product->nama = $request->nama;
        $product->detail = $request->detail;
        $product->harga = $request->harga;
        $product->stok = $request->stok;
        $product->jenis_pesanan = $request->jenis_pesanan;
        $product->display = $request->display;

        if ($request->jenis_pesanan == 'ready') {
            $product->tanggal_tanam = $request->tanggal_tanam;
        } else {
            $product->tanggal_tanam = null;
        }

        // Proses upload gambar
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image != 'default.png') {
                if ($product->image && File::exists(public_path('storage/images/' . $product->image))) {
                    File::delete(public_path('storage/images/' . $product->image));
                }
            }

            $image = $request->file('image');
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/images'), $imageName);
            $product->image = $imageName;
        }

        // Simpan perubahan
        $product->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Produk berhasil diperbarui');
    }

    public function pesanan()
    {
        $order = SalesProduct::orderBy('created_at', 'desc')->get();

        return view('pegawai.pesanan', ['menu' => 'pesanan', 'order' => $order]);
    }

    public function detail_pesanan($id)
    {
        $order = SalesProduct::find($id);

        return view('pegawai.detail-pesanan', ['menu' => 'pesanan', 'order' => $order]);
    }

    public function update_status_tanam_bibit($id)
    {
        $order = SalesProduct::find($id);
        $order->status_pesanan = 'Proses Penanaman';
        $order->save();
        return redirect()->back()->with('success', 'Status Pesanan Diubah');
    }

    public function update_status_siap_kirim($id)
    {
        $order = SalesProduct::find($id);
        $order->status_pesanan = 'Siap Kirim / Siap Diambil';
        $order->save();
        return redirect()->back()->with('success', 'Status Pesanan Diubah');
    }

    public function update_status_dikirim($id)
    {
        $order = SalesProduct::find($id);
        $order->status_pesanan = 'Dikirim / Diambil';
        $order->save();
        return redirect()->back()->with('success', 'Status Pesanan Diubah');
    }

    public function index_monitoring()
    {
        $order = SalesProduct::where('status_pesanan', '!=', 'Pending')
            ->whereHas('product', function ($query) {
                $query->where('jenis_pesanan', '!=', 'ready');
            })
            ->get();

        return view('pegawai.monitoring-bibit', ['menu' => 'monitoringbibit', 'order' => $order]);
    }

    public function detail_monitoring($id)
    {
        $order = SalesProduct::find($id);
        $data = Perkembangan::where('sales_product_id', $id)->orderBy('created_at', 'desc')->get();

        return view('pegawai.detail-monitoring-bibit', ['menu' => 'monitoringbibit', 'data' => $data, 'order' => $order]);
    }

    public function store_data_monitoring(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'tinggi' => 'required|numeric|min:0',
            'keterangan' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Buat instance baru untuk Perkembangan
        $monitoring = new Perkembangan();

        // Mengisi properti monitoring dari request
        $monitoring->title = $request->title;
        $monitoring->tinggi = $request->tinggi;
        $monitoring->keterangan = $request->keterangan;
        $monitoring->sales_product_id = $id;

        if ($request->hasFile('image')) {
            $imageName = Str::uuid() . '.' . $request->image->extension();

            // Gunakan storage:link untuk mengakses folder storage/images
            $request->image->storeAs('public/images', $imageName);

            // Simpan nama file ke dalam database
            $monitoring->image = $imageName;
        }

        $order = SalesProduct::find($id);
        if ($order->tanggal_penanaman == null) {
            $order->tanggal_penanaman = now();
        }
        $order->save();

        $tanggalPenanaman = Carbon::parse($order->tanggal_penanaman);
        $createdAt = Carbon::parse(now());
        $umur = $createdAt->diffInDays($tanggalPenanaman);
        // Menyimpan data monitoring ke database
        $monitoring->umur = $umur;
        $monitoring->save();


        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Data progress berhasil ditambahkan');
    }
}
