<?php

namespace App\Http\Controllers;

use App\Models\BuktiTransfer;
use App\Models\Perkembangan;
use App\Models\Product;
use App\Models\SalesProduct;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PelangganController extends Controller
{
    public function index()
    {
        $best_product = Product::where('display', 'Tampilkan')->withSum('SalesProduct', 'jumlah')
            ->orderBy('sales_product_sum_jumlah', 'desc')
            ->where('stok', '>', 0)
            ->take(4)
            ->get();

        return view('pelanggan.index', ['menu' => 'home', 'best_produk' => $best_product]);
    }

    public function order()
    {
        $product = Product::where('display', 'Tampilkan')->where('stok', '>', 0)->get();

        return view('pelanggan.order', ['menu' => 'order', 'product' => $product]);
    }

    public function detail_product($id)
    {
        $product = Product::find($id);

        return view('pelanggan.detail-product', ['menu' => 'order', 'product' => $product]);
    }

    public function store_order(Request $request)
    {
        $product = Product::find($request->product_id);

        $request->validate([
            'product_id' => 'required|exists:product,id',
            'delivery_option' => 'required|in:antar,ambil',
            'jumlah' => 'required|integer|min:1|max:' . $product->stok,
            'luas_lahan' => 'required_if:jenis_pesanan,preorder|integer',
            'satuan_luas' => 'required_if:jenis_pesanan,preorder|in:hektar,m2',
            'alamat' => 'required_if:delivery_option,antar',
            'lokasi' => 'required_if:delivery_option,antar|in:dalam,luar',
        ]);

        $jumlah = $request->jumlah;
        $harga = $product->harga;

        if ($product->jenis_pesanan == 'ready') {
            $ongkir = 50000;
        } else {
            if ($request->lokasi == 'dalam') {
                $ongkir = 100000;
            } else {
                $ongkir = 150000;
            }
        }

        $total = ($harga * $jumlah) + ($request->delivery_option == 'ambil' ? 0 : $ongkir);

        $order = new SalesProduct();
        $order->user_id = Auth::id();
        $order->product_id = $request->product_id;
        if ($request->delivery_option != 'ambil') {
            $order->alamat_pengiriman = $request->alamat;
            $order->ongkir = $ongkir;
        }

        $order->status_pesanan = 'Pending'; //disini

        if ($product->tanggal_tanam != null) {
            $order->tanggal_penanaman = $product->tanggal_tanam;
        }
        $order->jumlah = $jumlah;
        $order->total = $harga * $jumlah;
        $order->total_keseluruhan = $total;
        $order->metode_pembayaran = $request->metode_pembayaran;
        $order->save();

        $product->stok = ($product->stok - $jumlah);
        $product->save();

        if ($request->metode_pembayaran == 'Transfer') {
            $bukti_transfer = new BuktiTransfer();
            $bukti_transfer->status = 'Menunggu Pembayaran';
            $bukti_transfer->sales_product_id = $order->id;
            $bukti_transfer->save();
        }
        return redirect('/pelanggan/order')->with('success', 'Order berhasil dibuat!');
    }



    public function pesanan_index()
    {
        $order = SalesProduct::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

        return view('pelanggan.pesanan', ['menu' => 'pesanan', 'order' => $order]);
    }

    public function detail_monitoring($id)
    {
        $order = SalesProduct::find($id);
        $data = Perkembangan::where('sales_product_id', $id)->orderBy('created_at', 'desc')->get();

        return view('pelanggan.detail-pesanan', ['menu' => 'pesanan', 'data' => $data, 'order' => $order]);
    }

    // Fungsi untuk mencetak struk pesanan
    public function cetakStruk($id)
    {
        $order = SalesProduct::findOrFail($id);
        return view('pelanggan.print', compact('order'));
    }

    public function upload_bukti_transfer(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'image.required' => 'File bukti pembayaran wajib diunggah.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'File gambar harus berformat JPG/JPEG.',
            'image.max' => 'Ukuran file maksimal adalah 2MB.',
        ]);


        $order = SalesProduct::find($id);
        $bukti_transfer = BuktiTransfer::where('sales_product_id', $id)->first();

        $bukti_transfer->status = 'Menunggu Konfirmasi';

        // Handle the image upload
        if ($request->hasFile('image')) {
            $imageName = Str::uuid() . '.' . $request->image->extension();

            // Gunakan storage:link untuk mengakses folder storage/images
            $request->image->storeAs('public/images', $imageName);

            // Simpan nama file ke dalam database
            $bukti_transfer->image = $imageName;
        }

        if ($order->save() && $bukti_transfer->save()) {
            return redirect()->back()->with('success', 'Bukti Pembayaran Berhasil Diupload');
        }
    }
}
