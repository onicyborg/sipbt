@extends('layout.pelanggan-login')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Monitoring Bibit Pesanan Anda</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/pelanggan/pesanan">Pesanan Anda</a></li>
            <li class="breadcrumb-item active">Monitoring Pesanan Anda</li>
        </ol>
        <!-- Status Pesanan -->
        <div class="card mb-4">
            <div class="card-header">
                Status Pesanan
            </div>
            <div class="card-body">
                <div class="current-process mb-4">
                    <div class="list-group">
                        @if ($order->product->jenis_pesanan == 'preorder')
                            @if ($order->metode_pembayaran == 'Transfer')
                                @if ($order->bukti_transfer->status != 'Pembayaran Dikonfirmasi')
                                    <div class="list-group-item active-status">
                                        <i class="fas fa-hourglass-start"></i> Menunggu Konfirmasi Pembayaran
                                    </div>
                                    <div class="list-group-item">
                                        <i class="fas fa-seedling"></i> Pesanan Sedang Menunggu Proses Penanaman
                                    </div>
                                    <div class="list-group-item ">
                                        <i class="fas fa-leaf"></i> Pesanan Sedang Dalam Proses Penanaman
                                    </div>
                                    <div class="list-group-item">
                                        <i class="fas fa-truck"></i> Pesanan Siap Dikirim / Diambil
                                    </div>
                                    <div class="list-group-item">
                                        <i class="fas fa-check"></i> Pesanan Dikirim / Diambil
                                    </div>
                                @elseif ($order->bukti_transfer->status == 'Pembayaran Dikonfirmasi' && $order->status_pesanan == 'Pending')
                                    <div class="list-group-item completed-status">
                                        <i class="fas fa-hourglass-start"></i> Menunggu Konfirmasi Pembayaran
                                        <i class="fas fa-check ms-auto text-success"></i>
                                    </div>
                                    <div class="list-group-item active-status">
                                        <i class="fas fa-seedling"></i> Pesanan Sedang Menunggu Proses Penanaman
                                    </div>
                                    <div class="list-group-item ">
                                        <i class="fas fa-leaf"></i> Pesanan Sedang Dalam Proses Penanaman
                                    </div>
                                    <div class="list-group-item">
                                        <i class="fas fa-truck"></i> Pesanan Siap Dikirim / Diambil
                                    </div>
                                    <div class="list-group-item">
                                        <i class="fas fa-check"></i> Pesanan Dikirim / Diambil
                                    </div>
                                @elseif ($order->status_pesanan == 'Proses Penanaman')
                                    <div class="list-group-item completed-status">
                                        <i class="fas fa-hourglass-start"></i> Menunggu Konfirmasi Pembayaran
                                        <i class="fas fa-check ms-auto text-success"></i>
                                    </div>
                                    <div class="list-group-item completed-status">
                                        <i class="fas fa-seedling"></i> Pesanan Sedang Menunggu Proses Penanaman
                                        <i class="fas fa-check ms-auto text-success"></i>
                                    </div>
                                    <div class="list-group-item active-status">
                                        <i class="fas fa-leaf"></i> Pesanan Sedang Dalam Proses Penanaman
                                    </div>
                                    <div class="list-group-item">
                                        <i class="fas fa-truck"></i> Pesanan Siap Dikirim / Diambil
                                    </div>
                                    <div class="list-group-item">
                                        <i class="fas fa-check"></i> Pesanan Dikirim / Diambil
                                    </div>
                                @elseif ($order->status_pesanan == 'Siap Kirim / Siap Diambil')
                                    <div class="list-group-item completed-status">
                                        <i class="fas fa-hourglass-start"></i> Menunggu Konfirmasi Pembayaran
                                        <i class="fas fa-check ms-auto text-success"></i>
                                    </div>
                                    <div class="list-group-item completed-status">
                                        <i class="fas fa-seedling"></i> Pesanan Sedang Menunggu Proses Penanaman
                                        <i class="fas fa-check ms-auto text-success"></i>
                                    </div>
                                    <div class="list-group-item completed-status">
                                        <i class="fas fa-leaf"></i> Pesanan Sedang Dalam Proses Penanaman
                                        <i class="fas fa-check ms-auto text-success"></i>
                                    </div>
                                    <div class="list-group-item active-status">
                                        <i class="fas fa-truck"></i> Pesanan Siap Dikirim / Diambil
                                    </div>
                                    <div class="list-group-item">
                                        <i class="fas fa-check"></i> Pesanan Dikirim / Diambil
                                    </div>
                                @elseif ($order->status_pesanan == 'Dikirim / Diambil')
                                    <div class="list-group-item completed-status">
                                        <i class="fas fa-hourglass-start"></i> Menunggu Konfirmasi Pembayaran
                                        <i class="fas fa-check ms-auto text-success"></i>
                                    </div>
                                    <div class="list-group-item completed-status">
                                        <i class="fas fa-seedling"></i> Pesanan Sedang Menunggu Proses Penanaman
                                        <i class="fas fa-check ms-auto text-success"></i>
                                    </div>
                                    <div class="list-group-item completed-status">
                                        <i class="fas fa-leaf"></i> Pesanan Sedang Dalam Proses Penanaman
                                        <i class="fas fa-check ms-auto text-success"></i>
                                    </div>
                                    <div class="list-group-item completed-status">
                                        <i class="fas fa-truck"></i> Pesanan Siap Dikirim / Diambil
                                        <i class="fas fa-check ms-auto text-success"></i>
                                    </div>
                                    <div class="list-group-item active-status">
                                        <i class="fas fa-check"></i> Pesanan Dikirim / Diambil
                                    </div>
                                @endif
                            @else
                                @if ($order->status_pesanan == 'Pending')
                                    <div class="list-group-item active-status">
                                        <i class="fas fa-seedling"></i> Pesanan Sedang Menunggu Proses Penanaman
                                    </div>
                                    <div class="list-group-item ">
                                        <i class="fas fa-leaf"></i> Pesanan Sedang Dalam Proses Penanaman
                                    </div>
                                    <div class="list-group-item">
                                        <i class="fas fa-truck"></i> Pesanan Siap Dikirim / Diambil
                                    </div>
                                    <div class="list-group-item">
                                        <i class="fas fa-check"></i> Pesanan Dikirim / Diambil
                                    </div>
                                @elseif ($order->status_pesanan == 'Proses Penanaman')
                                    <div class="list-group-item completed-status">
                                        <i class="fas fa-seedling"></i> Pesanan Sedang Menunggu Proses Penanaman
                                        <i class="fas fa-check ms-auto text-success"></i>
                                    </div>
                                    <div class="list-group-item active-status">
                                        <i class="fas fa-leaf"></i> Pesanan Sedang Dalam Proses Penanaman
                                    </div>
                                    <div class="list-group-item">
                                        <i class="fas fa-truck"></i> Pesanan Siap Dikirim / Diambil
                                    </div>
                                    <div class="list-group-item">
                                        <i class="fas fa-check"></i> Pesanan Dikirim / Diambil
                                    </div>
                                @elseif ($order->status_pesanan == 'Siap Kirim / Siap Diambil')
                                    <div class="list-group-item completed-status">
                                        <i class="fas fa-seedling"></i> Pesanan Sedang Menunggu Proses Penanaman
                                        <i class="fas fa-check ms-auto text-success"></i>
                                    </div>
                                    <div class="list-group-item completed-status">
                                        <i class="fas fa-leaf"></i> Pesanan Sedang Dalam Proses Penanaman
                                        <i class="fas fa-check ms-auto text-success"></i>
                                    </div>
                                    <div class="list-group-item active-status">
                                        <i class="fas fa-truck"></i> Pesanan Siap Dikirim / Diambil
                                    </div>
                                    <div class="list-group-item">
                                        <i class="fas fa-check"></i> Pesanan Dikirim / Diambil
                                    </div>
                                @elseif ($order->status_pesanan == 'Dikirim / Diambil')
                                    <div class="list-group-item completed-status">
                                        <i class="fas fa-seedling"></i> Pesanan Sedang Menunggu Proses Penanaman
                                        <i class="fas fa-check ms-auto text-success"></i>
                                    </div>
                                    <div class="list-group-item completed-status">
                                        <i class="fas fa-leaf"></i> Pesanan Sedang Dalam Proses Penanaman
                                        <i class="fas fa-check ms-auto text-success"></i>
                                    </div>
                                    <div class="list-group-item completed-status">
                                        <i class="fas fa-truck"></i> Pesanan Siap Dikirim / Diambil
                                        <i class="fas fa-check ms-auto text-success"></i>
                                    </div>
                                    <div class="list-group-item active-status">
                                        <i class="fas fa-check"></i> Pesanan Dikirim / Diambil
                                    </div>
                                @endif
                            @endif
                        @else
                            @if ($order->metode_pembayaran == 'Transfer')
                                @if ($order->bukti_transfer->status != 'Pembayaran Dikonfirmasi')
                                    <div class="list-group-item active-status">
                                        <i class="fas fa-hourglass-start"></i> Menunggu Konfirmasi Pembayaran
                                    </div>
                                    <div class="list-group-item">
                                        <i class="fas fa-seedling"></i> Pesanan Sedang Disiapkan
                                    </div>
                                    <div class="list-group-item">
                                        <i class="fas fa-truck"></i> Pesanan Siap Dikirim / Diambil
                                    </div>
                                    <div class="list-group-item">
                                        <i class="fas fa-check"></i> Pesanan Dikirim / Diambil
                                    </div>
                                @elseif ($order->bukti_transfer->status == 'Pembayaran Dikonfirmasi' && $order->status_pesanan == 'Pending')
                                    <div class="list-group-item completed-status">
                                        <i class="fas fa-hourglass-start"></i> Menunggu Konfirmasi Pembayaran
                                        <i class="fas fa-check ms-auto text-success"></i>
                                    </div>
                                    <div class="list-group-item active-status">
                                        <i class="fas fa-seedling"></i> Pesanan Sedang Disiapkan
                                    </div>
                                    <div class="list-group-item">
                                        <i class="fas fa-truck"></i> Pesanan Siap Dikirim / Diambil
                                    </div>
                                    <div class="list-group-item">
                                        <i class="fas fa-check"></i> Pesanan Dikirim / Diambil
                                    </div>
                                @elseif ($order->status_pesanan == 'Siap Kirim / Siap Diambil')
                                    <div class="list-group-item completed-status">
                                        <i class="fas fa-hourglass-start"></i> Menunggu Konfirmasi Pembayaran
                                        <i class="fas fa-check ms-auto text-success"></i>
                                    </div>
                                    <div class="list-group-item completed-status">
                                        <i class="fas fa-seedling"></i> Pesanan Sedang Disiapkan
                                        <i class="fas fa-check ms-auto text-success"></i>
                                    </div>
                                    <div class="list-group-item active-status">
                                        <i class="fas fa-truck"></i> Pesanan Siap Dikirim / Diambil
                                    </div>
                                    <div class="list-group-item">
                                        <i class="fas fa-check"></i> Pesanan Dikirim / Diambil
                                    </div>
                                @elseif ($order->status_pesanan == 'Dikirim / Diambil')
                                    <div class="list-group-item completed-status">
                                        <i class="fas fa-hourglass-start"></i> Menunggu Konfirmasi Pembayaran
                                        <i class="fas fa-check ms-auto text-success"></i>
                                    </div>
                                    <div class="list-group-item completed-status">
                                        <i class="fas fa-seedling"></i> Pesanan Sedang Disiapkan
                                        <i class="fas fa-check ms-auto text-success"></i>
                                    </div>
                                    <div class="list-group-item completed-status">
                                        <i class="fas fa-truck"></i> Pesanan Siap Dikirim / Diambil
                                        <i class="fas fa-check ms-auto text-success"></i>
                                    </div>
                                    <div class="list-group-item active-status">
                                        <i class="fas fa-check"></i> Pesanan Dikirim / Diambil
                                    </div>
                                @endif
                            @else
                                @if ($order->status_pesanan == 'Pending')
                                    <div class="list-group-item active-status">
                                        <i class="fas fa-seedling"></i> Pesanan Sedang Disiapkan
                                    </div>
                                    <div class="list-group-item">
                                        <i class="fas fa-truck"></i> Pesanan Siap Dikirim / Diambil
                                    </div>
                                    <div class="list-group-item">
                                        <i class="fas fa-check"></i> Pesanan Dikirim / Diambil
                                    </div>
                                @elseif ($order->status_pesanan == 'Siap Kirim / Siap Diambil')
                                    <div class="list-group-item completed-status">
                                        <i class="fas fa-seedling"></i> Pesanan Sedang Disiapkan
                                        <i class="fas fa-check ms-auto text-success"></i>
                                    </div>
                                    <div class="list-group-item active-status">
                                        <i class="fas fa-truck"></i> Pesanan Siap Dikirim / Diambil
                                    </div>
                                    <div class="list-group-item">
                                        <i class="fas fa-check"></i> Pesanan Dikirim / Diambil
                                    </div>
                                @elseif ($order->status_pesanan == 'Dikirim / Diambil')
                                    <div class="list-group-item completed-status">
                                        <i class="fas fa-seedling"></i> Pesanan Sedang Disiapkan
                                        <i class="fas fa-check ms-auto text-success"></i>
                                    </div>
                                    <div class="list-group-item completed-status">
                                        <i class="fas fa-truck"></i> Pesanan Siap Dikirim / Diambil
                                        <i class="fas fa-check ms-auto text-success"></i>
                                    </div>
                                    <div class="list-group-item active-status">
                                        <i class="fas fa-check"></i> Pesanan Dikirim / Diambil
                                    </div>
                                @endif
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- Monitoring Perkembangan -->
        @if ($order->product->jenis_pesanan == 'preorder')
            <div class="card mb-4">
                <div class="card-header">
                    Monitoring Perkembangan {{ $order->product->nama }}
                </div>
                <div class="card-body">
                    <!-- Daftar Progress -->
                    <div class="list-group">
                        @if ($data->isEmpty())
                            <div class="alert alert-warning" role="alert">
                                Data progress masih kosong.
                            </div>
                        @else
                            @foreach ($data as $item)
                                <div class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img src="{{ asset('/storage/images/' . $item->image) }}"
                                                alt="Gambar Progress {{ $item->id }}" class="img-fluid">
                                        </div>
                                        <div class="col-md-9">
                                            <h5>{{ $item->title }}</h5>
                                            <p><strong>Umur:</strong> {{ $item->umur }} hari</p>
                                            <p><strong>Tinggi:</strong> {{ $item->tinggi }} cm</p>
                                            <p><strong>Deskripsi:</strong> {{ $item->keterangan }}.</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
@endSection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <style>
        .list-group-item {
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
        }

        .list-group-item img {
            border-radius: 5px;
        }

        .current-process .list-group-item {
            display: flex;
            align-items: center;
        }

        .current-process .list-group-item i {
            font-size: 1.5rem;
            margin-right: 10px;
        }

        .active-status {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
            animation: glow 1.5s infinite;
        }

        .completed-status {
            background-color: #e2e3e5;
            border-color: #d6d8db;
            color: #6c757d;
        }

        @keyframes glow {
            0% {
                box-shadow: 0 0 5px #c3e6cb;
            }

            50% {
                box-shadow: 0 0 20px #c3e6cb;
            }

            100% {
                box-shadow: 0 0 5px #c3e6cb;
            }
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
                title: 'Registrasi Gagal!',
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

    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
@endpush
