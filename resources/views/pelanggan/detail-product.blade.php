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
                        <div class="mb-3" id="jumlah_div">
                            <label for="jumlah">Jumlah Produk</label>
                            <input class="form-control" id="jumlah" type="number" name="jumlah"
                                placeholder="Isikan Jumlah Produk" min="{{ $product->jenis_pesanan == 'ready' ? 1 : 400 }}"
                                required />
                        </div>
                        <div class="mb-3" id="luas_lahan_div" style="display: none;">
                            <label for="luas_lahan">Luas Lahan</label>
                            <select class="form-control" id="luas_lahan" name="luas_lahan">
                                <!-- Options will be dynamically populated by JavaScript -->
                            </select>
                        </div>
                        <div class="mb-3" id="satuan_luas_div" style="display: none;">
                            <label for="satuan_luas">Satuan Luas Lahan</label>
                            <select class="form-control" id="satuan_luas" name="satuan_luas">
                                <option value="hektar">Hektar</option>
                                <option value="m2">m2</option>
                            </select>
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
                        <div class="mb-3">
                            <label for="metode_pembayaran">Metode Pembayaran</label>
                            <select class="form-control" id="metode_pembayaran" name="metode_pembayaran">
                                <option disabled selected>- Pilih Metode Pembayaran -</option>
                                <option value="Transfer">Transfer</option>
                                <option value="COD">COD</option>
                            </select>
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

            const luasLahanDiv = document.getElementById('luas_lahan_div');
            const satuanLuasDiv = document.getElementById('satuan_luas_div');
            const luasLahanSelect = document.getElementById('luas_lahan');
            const satuanLuasSelect = document.getElementById('satuan_luas');

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

            function updateLuasLahanOptions() {
                const satuan = satuanLuasSelect.value;
                luasLahanSelect.innerHTML = '';

                if (satuan === 'hektar') {
                    for (let i = 1; i <= 5; i++) {
                        const option = document.createElement('option');
                        option.value = i;
                        option.textContent = i + ' hektar';
                        luasLahanSelect.appendChild(option);
                    }
                } else if (satuan === 'm2') {
                    const options = [175, 180, 200, 250, 300, 350, 400, 450, 500, 550, 600, 650, 700, 750, 800, 850,
                        900, 950, 1000, 1180, 1200, 1250, 1300, 1350
                    ];
                    options.forEach(function(value) {
                        const option = document.createElement('option');
                        option.value = value;
                        option.textContent = value + ' m2';
                        luasLahanSelect.appendChild(option);
                    });
                }
            }

            function calculateJumlah() {
                const satuan = satuanLuasSelect.value;
                const luasLahan = parseInt(luasLahanSelect.value);
                const jarakTanam =
                50; // Contoh nilai jarak tanam, ini bisa diambil dari properti produk atau input lainnya
                let jumlah = 0;

                const conversionData = {
                    50: {
                        'm2': {
                            175: 400,
                            180: 420,
                            200: 460,
                            250: 680,
                            300: 700,
                            350: 800,
                            400: 820,
                            450: 1040,
                            500: 1150,
                            550: 1265,
                            600: 1480,
                            650: 1495,
                            700: 1600,
                            750: 1750,
                            800: 1835,
                            850: 1950,
                            900: 2065,
                            950: 2180,
                            1000: 2295,
                            1180: 2410,
                            1200: 2520,
                            1250: 2635,
                            1300: 2750,
                            1350: 2865
                        },
                        'hektar': {
                            1: 3200,
                            2: 6400,
                            3: 9600,
                            4: 12800,
                            5: 16000
                        }
                    },
                    60: {
                        'm2': {
                            175: 500,
                            180: 520,
                            200: 560,
                            250: 725,
                            300: 865,
                            350: 1000,
                            400: 1150,
                            450: 1295,
                            500: 1435,
                            550: 1580,
                            600: 1725,
                            650: 1870,
                            700: 2000,
                            750: 2150,
                            800: 2295,
                            850: 2435,
                            900: 2580,
                            950: 2725,
                            1000: 2870,
                            1180: 3000,
                            1200: 3150,
                            1250: 3295,
                            1300: 3435,
                            1350: 3580
                        },
                        'hektar': {
                            1: 4000,
                            2: 8000,
                            3: 12000,
                            4: 16000,
                            5: 20000
                        }
                    }
                };

                if (conversionData[jarakTanam] && conversionData[jarakTanam][satuan] && conversionData[jarakTanam][
                        satuan
                    ][luasLahan]) {
                    jumlah = conversionData[jarakTanam][satuan][luasLahan];
                }

                jumlahInput.value = jumlah;
                calculateTotal();
            }

            if (jenisPesanan === 'preorder') {
                jumlahInput.readOnly = true;
                luasLahanDiv.style.display = 'block';
                satuanLuasDiv.style.display = 'block';

                satuanLuasSelect.addEventListener('change', function() {
                    updateLuasLahanOptions();
                    calculateJumlah();
                });

                luasLahanSelect.addEventListener('change', calculateJumlah);

                updateLuasLahanOptions();
                calculateJumlah();
            } else {
                jumlahInput.readOnly = false;
                luasLahanDiv.style.display = 'none';
                satuanLuasDiv.style.display = 'none';
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
