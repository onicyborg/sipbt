@extends('layout.pelanggan-login')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Monitoring Bibit Pesanan Anda</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/pelanggan/pesanan">Pesanan Anda</a></li>
            <li class="breadcrumb-item active">Monitoring Pesanan Anda</li>
        </ol>
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
    </div>
@endSection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.4/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    {{-- <link href="{{ asset('assetss/css/style.css') }}" rel="stylesheet"> --}}

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
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.datatables.net/2.0.4/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#datatablesSimple').DataTable({
                "order": [
                    [0, "asc"]
                ]
            });
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
