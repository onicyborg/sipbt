<?php

namespace App\Http\Controllers;

use App\Models\Perkembangan;
use App\Models\Product;
use App\Models\SalesProduct;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelangganController extends Controller
{
    public function index()
    {
        $best_product = Product::where('display', 'Tampilkan')->withSum('SalesProduct', 'jumlah')
            ->orderBy('sales_product_sum_jumlah', 'desc')
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
            'alamat' => 'required_if:delivery_option,antar',
            'lokasi' => 'required_if:delivery_option,antar|in:dalam,luar',
        ]);

        $jumlah = $request->jumlah;
        $harga = $product->harga;

        if ($product->jenis_pesanan == 'ready') {
            $minimalJumlah = 1;
            $ongkir = 50000;
        } else {
            $minimalJumlah = 400;
            if ($request->lokasi == 'dalam') {
                $ongkir = 100000;
            } else {
                $ongkir = 150000;
            }
        }

        if ($jumlah < $minimalJumlah) {
            return redirect('/pelanggan/order')->withErrors(['jumlah' => 'Jumlah minimal untuk produk ini adalah ' . $minimalJumlah]);
        }

        $total = ($harga * $jumlah) + ($request->delivery_option == 'ambil' ? 0 : $ongkir);

        $order = new SalesProduct();
        $order->user_id = Auth::id();
        $order->product_id = $request->product_id;
        if ($request->delivery_option != 'ambil') {
            $order->alamat_pengiriman = $request->alamat;
            $order->ongkir = $ongkir;
        }
        if ($product->jenis_pesanan == 'ready') {
            $order->status_pesanan = 'Siap Kirim / Siap Diambil';
        } else {
            $order->status_pesanan = 'Pending';
        }
        if ($product->tanggal_tanam != null) {
            $order->tanggal_penanaman = $product->tanggal_tanam;
        }
        $order->jumlah = $jumlah;
        $order->total = $harga * $jumlah;
        $order->total_keseluruhan = $total;
        $order->save();

        $product->stok = ($product->stok - $request->jumlah);
        $product->save();

        return redirect('/pelanggan/order')->with('success', 'Order berhasil dibuat!');
    }

    public function pesanan_index()
    {
        $order = SalesProduct::where('user_id', Auth::id())->get();

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
}
