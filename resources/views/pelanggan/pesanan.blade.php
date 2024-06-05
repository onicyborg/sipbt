@extends('layout.pelanggan-login')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Pesanan Anda</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pesanan Anda</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                List Pesanan Anda
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-responsive" id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Bibit</th>
                                <th>Nama Bibit</th>
                                <th>Harga Satuan</th>
                                <th>Jumlah Pembelian</th>
                                <th>Ongkir</th>
                                <th>Total</th>
                                <th>Gambar</th>
                                <th>Status Pesanan</th>
                                <th class="text-center">#</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Kode Bibit</th>
                                <th>Nama Bibit</th>
                                <th>Harga Satuan</th>
                                <th>Jumlah Pembelian</th>
                                <th>Ongkir</th>
                                <th>Total</th>
                                <th>Gambar</th>
                                <th>Status Pesanan</th>
                                <th class="text-center">#</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($order as $no => $item)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $item->product->kode }}</td>
                                    <td>{{ $item->product->nama }}</td>
                                    <td>Rp. {{ number_format($item->product->harga) }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>
                                        @if ($item->ongkir == null)
                                            -
                                        @else
                                            {{ $item->ongkir }}
                                        @endif
                                    </td>
                                    <td>Rp. {{ number_format($item->total_keseluruhan) }}</td>
                                    <td>
                                        <img src="{{ asset('storage/images/' . $item->product->image) }}"
                                            alt="Gambar Produk" class="img-thumbnail" style="width: 100px; height: auto;">
                                    </td>
                                    <td>{{ $item->status_pesanan }}</td>
                                    <td>
                                        @if ($item->product->jenis_pesanan == 'ready')
                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip"
                                                title="Hanya Tersedia Untuk Pesanan Pre-Order">
                                                <button class="btn btn-secondary" type="button" disabled><i
                                                    class="fa-regular fa-share-from-square"></i></button>
                                            </span>
                                        @else
                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip"
                                                title="Lihat Proses Pesanan Pre-order">
                                                <a href="/pelanggan/detail-order/{{ $item->id }}"
                                                    class="btn btn-secondary"><i
                                                        class="fa-regular fa-share-from-square"></i></a>
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endSection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.4/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <link href="{{ asset('assetss/css/style.css') }}" rel="stylesheet">
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
