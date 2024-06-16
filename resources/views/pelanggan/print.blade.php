<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #000;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .order-details, .product-details, .payment-details {
            margin-bottom: 20px;
        }
        .order-details p, .product-details p, .payment-details p {
            margin: 5px 0;
        }
        .total {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Struk Pesanan</h1>
        </div>
        <div class="order-details">
            <h3>Detail Pesanan</h3>
            <p>Nama Pelanggan: {{ $order->user->nama }}</p>
            <p>Tanggal Pesanan: {{ $order->created_at->format('d/m/Y') }}</p>
            <p>Status Pesanan: {{ $order->status_pesanan }}</p>
        </div>
        <div class="product-details">
            <h3>Detail Produk</h3>
            <p>Nama Produk: {{ $order->product->nama }}</p>
            <p>Kode Produk: {{ $order->product->kode }}</p>
            <p>Harga Satuan: Rp {{ number_format($order->product->harga) }}</p>
            <p>Jumlah: {{ $order->jumlah }}</p>
        </div>
        <div class="delivery-details">
            <h3>Detail Pengiriman</h3>
            <p>Alamat Pengiriman: {{ $order->alamat_pengiriman }}</p>
            <p>Kecamatan: {{ $order->lokasi }}</p>
            <p>Ongkos Kirim: Rp {{ number_format($order->ongkir) }}</p>
        </div>
        <div class="payment-details">
            <h3>Detail Pembayaran</h3>
            <p>Metode Pembayaran: {{ $order->metode_pembayaran }}</p>
        </div>
        <div class="total">
            <h3>Total: Rp {{ number_format($order->total_keseluruhan) }}</h3>
        </div>
    </div>
    <script>
        // Jalankan fungsi cetak secara otomatis saat halaman dimuat
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
