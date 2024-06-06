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
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .order-details {
            margin-bottom: 20px;
        }
        .order-details p {
            margin: 5px 0;
        }
        .product-details {
            margin-bottom: 20px;
        }
        .product-details p {
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
            <p>Nama Pelanggan: {{ $order->user->nama }}</p>
            <p>Tanggal Pesanan: {{ $order->created_at->format('d/m/Y') }}</p>
        </div>
        <div class="product-details">
            <h3>Detail Produk</h3>
            <p>Nama Produk: {{ $order->product->nama }}</p>
            <p>Kode Produk: {{ $order->product->kode }}</p>
            <p>Alamat Pengiriman: {{ $order->alamat_pengiriman }}</p>
            <p>Harga Satuan: Rp {{ number_format($order->product->harga) }}</p>
            <p>Jumlah: {{ $order->jumlah }}</p>
            <p>Ongkos Kirim: {{ $order->ongkir }}</p>
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
