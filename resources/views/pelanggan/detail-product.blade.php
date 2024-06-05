@extends('layout.pelanggan-login')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Detail Produk Bibit</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/pelanggan/order">Produk Bibit</a></li>
            <li class="breadcrumb-item active">Detail Produk Bibit</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                Detail Produk Bibit
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Gambar Produk -->
                    <div class="col-md-6">
                        <img src="{{ asset('storage/images/' . $product->image) }}" alt="Gambar Produk"
                            class="img-fluid img-thumbnail">
                    </div>
                    <!-- Detail Produk -->
                    <div class="col-md-6">
                        <h2>{{ $product->nama }}</h2>
                        <p><strong>Kode:</strong> {{ $product->kode }}</p>
                        <p><strong>Detail:</strong> {{ $product->detail }}</p>
                        <p><strong>Harga:</strong> Rp. {{ number_format($product->harga) }}</p>
                        <p><strong>Stok:</strong> {{ $product->stok }}</p>
                        <p><strong>Jenis Pesanan:</strong> {{ $product->jenis_pesanan }}</p>
                        @if ($product->jenis_pesanan == 'ready')
                            <p><strong>Tanggal Tanam:</strong> {{ $product->tanggal_tanam }}</p>
                        @endif
                    </div>
                </div>
                <!-- Form Pemesanan -->
                <div class="mt-4">
                    <h3>Pesan Produk Ini</h3>
                    <form method="post" action="/pelanggan/order">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" id="harga" value="{{ $product->harga }}">
                        <input type="hidden" id="jenis_pesanan" value="{{ $product->jenis_pesanan }}">
                        <div class="mb-3">
                            <label for="jumlah">Jumlah Produk @if ($product->jenis_pesanan == 'preorder')
                                    (Untuk produk preorder minimal pembelian adalah 400 batang)
                                @endif
                            </label>
                            <input class="form-control" id="jumlah" type="number" name="jumlah"
                                placeholder="Isikan Jumlah Produk" min="{{ $product->jenis_pesanan == 'ready' ? 1 : 400 }}"
                                required />
                        </div>
                        <div class="mb-3">
                            <label for="delivery_option">Pilih Opsi Pengiriman</label>
                            <select class="form-control" id="delivery_option" name="delivery_option" required>
                                <option value="antar">Diantar ke Alamat</option>
                                <option value="ambil">Ambil Sendiri</option>
                            </select>
                        </div>
                        <div class="mb-3" id="alamat_div">
                            <label for="alamat">Alamat Pengiriman</label>
                            <textarea class="form-control" id="alamat" name="alamat" placeholder="Isikan Alamat Pengiriman"></textarea>
                        </div>
                        <div class="mb-3" id="lokasi_div">
                            <label for="lokasi">Lokasi</label>
                            <select class="form-control" id="lokasi" name="lokasi">
                                <option value="dalam">Dalam Kecamatan Kertosono</option>
                                <option value="luar">Luar Kecamatan Kertosono</option>
                            </select>
                        </div>
                        <div class="mb-3" id="ongkir_div">
                            <label for="ongkir">Ongkir</label>
                            <input class="form-control" id="ongkir" type="text" name="ongkir" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="total">Total Harga</label>
                            <input class="form-control" id="total" type="text" name="total" readonly />
                        </div>
                        <div class="form-floating mb-3">
                            <button class="btn btn-primary" type="submit"><i class="fa-solid fa-shopping-cart"></i> Pesan
                                Sekarang</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jenisPesanan = document.getElementById('jenis_pesanan').value;
            const jumlahInput = document.getElementById('jumlah');
            const deliveryOption = document.getElementById('delivery_option');
            const alamatDiv = document.getElementById('alamat_div');
            const lokasiDiv = document.getElementById('lokasi_div');
            const ongkirDiv = document.getElementById('ongkir_div');
            const ongkirInput = document.getElementById('ongkir');
            const totalInput = document.getElementById('total');
            const harga = parseInt(document.getElementById('harga').value);

            function calculateTotal() {
                const jumlah = parseInt(jumlahInput.value) || 0;
                const ongkir = parseInt(ongkirInput.value.replace(/[^\d]/g, '')) || 0;
                const total = (harga * jumlah) + ongkir;
                totalInput.value = 'Rp. ' + total.toLocaleString('id-ID');
            }

            function updateOngkir() {
                if (deliveryOption.value === 'ambil') {
                    alamatDiv.style.display = 'none';
                    lokasiDiv.style.display = 'none';
                    ongkirDiv.style.display = 'none';
                    ongkirInput.value = 0;
                } else {
                    alamatDiv.style.display = 'block';
                    lokasiDiv.style.display = 'block';
                    ongkirDiv.style.display = 'block';

                    if (jenisPesanan === 'ready') {
                        ongkirInput.value = 50000;
                    } else {
                        const lokasi = document.getElementById('lokasi').value;
                        if (lokasi === 'dalam') {
                            ongkirInput.value = 100000;
                        } else {
                            ongkirInput.value = 150000;
                        }
                    }
                }
                calculateTotal();
            }

            jumlahInput.addEventListener('input', calculateTotal);
            deliveryOption.addEventListener('change', updateOngkir);
            document.getElementById('lokasi').addEventListener('change', updateOngkir);

            // Initialize fields based on the default delivery option
            updateOngkir();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Sukses!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'Ok'
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            Swal.fire({
                title: 'Gagal Input Pesanan!',
                html: '<ul>' +
                    @foreach ($errors->all() as $error)
                        '<li>{{ $error }}</li>' +
                    @endforeach
                '</ul>',
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        </script>
    @endif
@endpush
