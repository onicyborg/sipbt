@extends('layout.pegawai')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Detail Pesanan Bibit</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/pegawai/pesanan">Pesanan Pelanggan</a></li>
            <li class="breadcrumb-item active">Detail Pesanan Bibit</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                Detail Pesanan Bibit
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Gambar Produk -->
                    <div class="col-md-6">
                        <img src="{{ asset('storage/images/' . $order->product->image) }}" alt="Gambar Produk"
                            class="img-fluid img-thumbnail">
                    </div>
                    <!-- Detail Produk -->
                    <div class="col-md-6">
                        <h2>{{ $order->product->nama }}</h2>
                        <p><strong>Nama Pelanggan:</strong> {{ $order->user->nama }}</p>
                        <p><strong>Kode:</strong> {{ $order->product->kode }}</p>
                        <p><strong>Detail:</strong> {{ $order->product->detail }}</p>
                        <p><strong>Tanggal Penanaman:</strong>
                            @if ($order->tanggal_penanaman != null)
                                {{ $order->penanaman }}
                            @else
                                -
                            @endif
                        </p>
                        <p><strong>Harga Satuan:</strong> Rp. {{ number_format($order->product->harga) }}</p>
                        <p><strong>Jumlah Pembelian:</strong> {{ $order->jumlah }}</p>
                        <p><strong>Ongkir:</strong>
                            @if ($order->ongkir == null)
                                -
                            @else
                                Rp. {{ number_format($order->ongkir) }}
                            @endif
                        </p>
                        <p><strong>Total Pembayaran:</strong> Rp. {{ number_format($order->total_keseluruhan) }}</p>
                        <p><strong>Metode Pembayaran:</strong> {{ $order->metode_pembayaran }}</p>
                        @if ($order->bukti_transfer != null)
                            <p><strong>Status Pembayaran:</strong> {{ $order->bukti_transfer->status }}</p>
                        @endif
                        <p><strong>Status Pesanan Saat Ini:</strong> {{ $order->status_pesanan }}</p>
                        <p><strong>Alamat Pengantaran:</strong> {{ $order->alamat_pengiriman }}</p>

                        @if ($order->product->jenis_pesanan == 'ready')
                            @if ($order->metode_pembayaran == 'Transfer')
                                @if ($order->bukti_transfer->status == 'Menunggu Konfirmasi')
                                    <div class="mt-4">
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#confirmationPaymentModal">
                                            Konfirmasi Pembayaran
                                        </button>
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#readyToShipModal" disabled>
                                            Bibit Siap Dikirim / Diambil
                                        </button>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#shippedModal" disabled>
                                            Bibit Dikirim / Diambil
                                        </button>
                                    </div>
                                @elseif ($order->status_pesanan == 'Pending')
                                    <div class="mt-4">
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#confirmationPaymentModal">
                                            Lihat Bukti Pembayaran
                                        </button>
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#readyToShipModal">
                                            Bibit Siap Dikirim / Diambil
                                        </button>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#shippedModal" disabled>
                                            Bibit Dikirim / Diambil
                                        </button>
                                    </div>
                                @elseif ($order->status_pesanan == 'Siap Kirim / Siap Diambil')
                                    <div class="mt-4">
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#confirmationPaymentModal">
                                            Lihat Bukti Pembayaran
                                        </button>
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#readyToShipModal" disabled>
                                            Bibit Siap Dikirim / Diambil
                                        </button>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#shippedModal">
                                            Bibit Dikirim / Diambil
                                        </button>
                                    </div>
                                @elseif ($order->status_pesanan == 'Menunggu Pembayaran')
                                    <div class="mt-4">
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#confirmationPaymentModal">
                                            Lihat Bukti Pembayaran
                                        </button>
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#readyToShipModal" disabled>
                                            Bibit Siap Dikirim / Diambil
                                        </button>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#shippedModal" disabled>
                                            Bibit Dikirim / Diambil
                                        </button>
                                    </div>
                                @else
                                    <div class="mt-4">
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#confirmationPaymentModal">
                                            Lihat Bukti Pembayaran
                                        </button>
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#readyToShipModal" disabled>
                                            Bibit Siap Dikirim / Diambil
                                        </button>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#shippedModal" disabled>
                                            Bibit Dikirim / Diambil
                                        </button>
                                    </div>
                                @endif
                            @else
                                @if ($order->status_pesanan == 'Pending')
                                    <div class="mt-4">
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#readyToShipModal">
                                            Bibit Siap Dikirim / Diambil
                                        </button>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#shippedModal" disabled>
                                            Bibit Dikirim / Diambil
                                        </button>
                                    </div>
                                @elseif ($order->status_pesanan == 'Siap Kirim / Siap Diambil')
                                    <div class="mt-4">
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#readyToShipModal" disabled>
                                            Bibit Siap Dikirim / Diambil
                                        </button>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#shippedModal">
                                            Bibit Dikirim / Diambil
                                        </button>
                                    </div>
                                @else
                                    <div class="mt-4">
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#readyToShipModal" disabled>
                                            Bibit Siap Dikirim / Diambil
                                        </button>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#shippedModal" disabled>
                                            Bibit Dikirim / Diambil
                                        </button>
                                    </div>
                                @endif
                            @endif
                        @else
                            @if ($order->metode_pembayaran == 'Transfer')
                                @if ($order->bukti_transfer->status == 'Menunggu Konfirmasi')
                                    <div class="mt-4 d-flex justify-content-between gap-2">
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#confirmationPaymentModal">
                                            Konfirmasi Pembayaran
                                        </button>
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#processPlantingModal" disabled>
                                            Proses Penanaman Bibit
                                        </button>
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#readyToShipModal" disabled>
                                            Bibit Siap Dikirim / Diambil
                                        </button>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#shippedModal" disabled>
                                            Bibit Dikirim / Diambil
                                        </button>
                                    </div>
                                @elseif ($order->status_pesanan == 'Proses Penanaman')
                                    <div class="mt-4 d-flex justify-content-between gap-2">
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#confirmationPaymentModal">
                                            Lihat Bukti Pembayaran
                                        </button>
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#processPlantingModal" disabled>
                                            Proses Penanaman Bibit
                                        </button>
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#readyToShipModal">
                                            Bibit Siap Dikirim / Diambil
                                        </button>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#shippedModal" disabled>
                                            Bibit Dikirim / Diambil
                                        </button>
                                    </div>
                                @elseif ($order->bukti_transfer->status == 'Menunggu Pembayaran')
                                    <div class="mt-4 d-flex justify-content-between gap-2">
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#confirmationPaymentModal">
                                            Konfirmasi Pembayaran
                                        </button>
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#processPlantingModal" disabled>
                                            Proses Penanaman Bibit
                                        </button>
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#readyToShipModal" disabled>
                                            Bibit Siap Dikirim / Diambil
                                        </button>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#shippedModal" disabled>
                                            Bibit Dikirim / Diambil
                                        </button>
                                    </div>
                                @elseif ($order->status_pesanan == 'Siap Kirim / Siap Diambil')
                                    <div class="mt-4 d-flex justify-content-between gap-2">
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#confirmationPaymentModal">
                                            Lihat Bukti Pembayaran
                                        </button>
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#processPlantingModal" disabled>
                                            Proses Penanaman Bibit
                                        </button>
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#readyToShipModal" disabled>
                                            Bibit Siap Dikirim / Diambil
                                        </button>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#shippedModal">
                                            Bibit Dikirim / Diambil
                                        </button>
                                    </div>
                                @else
                                    <div class="mt-4 d-flex justify-content-between gap-2">
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#confirmationPaymentModal">
                                            Lihat Bukti Pembayaran
                                        </button>
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#processPlantingModal">
                                            Proses Penanaman Bibit
                                        </button>
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#readyToShipModal" disabled>
                                            Bibit Siap Dikirim / Diambil
                                        </button>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#shippedModal" disabled>
                                            Bibit Dikirim / Diambil
                                        </button>
                                    </div>
                                @endif
                            @else
                                @if ($order->status_pesanan == 'Pending')
                                    <div class="mt-4 d-flex gap-2">
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#processPlantingModal">
                                            Proses Penanaman Bibit
                                        </button>
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#readyToShipModal" disabled>
                                            Bibit Siap Dikirim / Diambil
                                        </button>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#shippedModal" disabled>
                                            Bibit Dikirim / Diambil
                                        </button>
                                    </div>
                                @elseif ($order->status_pesanan == 'Proses Penanaman')
                                    <div class="mt-4 d-flex gap-2">
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#processPlantingModal" disabled>
                                            Proses Penanaman Bibit
                                        </button>
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#readyToShipModal">
                                            Bibit Siap Dikirim / Diambil
                                        </button>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#shippedModal" disabled>
                                            Bibit Dikirim / Diambil
                                        </button>
                                    </div>
                                @elseif ($order->status_pesanan == 'Siap Kirim / Siap Diambil')
                                    <div class="mt-4 d-flex gap-2">
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#processPlantingModal" disabled>
                                            Proses Penanaman Bibit
                                        </button>
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#readyToShipModal" disabled>
                                            Bibit Siap Dikirim / Diambil
                                        </button>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#shippedModal">
                                            Bibit Dikirim / Diambil
                                        </button>
                                    </div>
                                @else
                                    <div class="mt-4 d-flex gap-2">
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#processPlantingModal" disabled>
                                            Proses Penanaman Bibit
                                        </button>
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#readyToShipModal" disabled>
                                            Bibit Siap Dikirim / Diambil
                                        </button>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#shippedModal" disabled>
                                            Bibit Dikirim / Diambil
                                        </button>
                                    </div>
                                @endif
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Proses Penanaman Bibit -->
        <div class="modal fade" id="processPlantingModal" tabindex="-1" aria-labelledby="processPlantingModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="processPlantingModalLabel">Konfirmasi Proses Penanaman Bibit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Anda yakin ingin memasukkan Pesanan ini ke proses penanaman? Hal ini tidak dapat dibatalkan.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form method="post" action="/pegawai/update-status-pesanan/tanam-bibit/{{ $order->id }}">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-info">Proses Penanaman</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Bibit Siap Dikirim / Diambil -->
        <div class="modal fade" id="readyToShipModal" tabindex="-1" aria-labelledby="readyToShipModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="readyToShipModalLabel">Konfirmasi Bibit Siap Dikirim / Diambil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Anda yakin ingin memasukkan Pesanan ini ke status siap antar / siap ambil? Hal ini tidak dapat
                        dikembalikan.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form method="post" action="/pegawai/update-status-pesanan/siap-kirim/{{ $order->id }}">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-success">Siap Dikirim / Diambil</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Bibit Dikirim / Diambil -->
        <div class="modal fade" id="shippedModal" tabindex="-1" aria-labelledby="shippedModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="shippedModalLabel">Konfirmasi Bibit Dikirim / Diambil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Pesanan ini sudah dikirim / diambil? Jika sudah silahkan konfirmasi dengan melakukan klik
                        tombol di bawah ini.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form method="post" action="/pegawai/update-status-pesanan/dikirim/{{ $order->id }}">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-primary">Dikirim / Diambil</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Payment --}}
        @if ($order->bukti_transfer != null)
            <div class="modal fade" id="confirmationPaymentModal" tabindex="-1"
                aria-labelledby="confirmationPaymentModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmationPaymentModalLabel">Konfirmasi Pembayaran</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @if ($order->bukti_transfer->image != '')
                                <img src="{{ asset('storage/images/' . $order->bukti_transfer->image) }}"
                                    alt="Bukti Pembayaran" class="img-fluid mb-3">
                                <p>Status Pembayaran: {{ $order->bukti_transfer->status }}</p>
                            @else
                                <p>Belum Mengirim Bukti Transfer.</p>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            @if ($order->bukti_transfer->image != '' && $order->bukti_transfer->status != 'Pembayaran Dikonfirmasi')
                                <form method="post" action="/pegawai/konfirmasi-pembayaran/{{ $order->id }}">
                                    @csrf
                                    <button type="submit" class="btn btn-warning">Konfirmasi</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
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
                title: 'Error!',
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
