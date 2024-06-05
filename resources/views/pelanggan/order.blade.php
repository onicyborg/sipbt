@extends('layout.pelanggan-login')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Produk Bibit</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Produk Bibit</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                List Data Produk Bibit yang Tersedia
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-responsive" id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama Bibit</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Gambar</th>
                                <th>Terjual</th>
                                <th>Status</th>
                                <th class="text-center">#</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama Bibit</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Gambar</th>
                                <th>Terjual</th>
                                <th>Status</th>
                                <th class="text-center">#</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($product as $no => $item)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $item->kode }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>Rp. {{ number_format($item->harga) }}</td>
                                    <td>{{ $item->stok }}</td>
                                    <td>
                                        <img src="{{ asset('storage/images/' . $item->image) }}" alt="Gambar Produk"
                                            class="img-thumbnail" style="width: 100px; height: auto;">
                                    </td>
                                    <td>
                                        @if ($item->SalesProduct != null)
                                            {{ $item->SalesProduct->sum('jumlah') }}
                                        @else
                                            0
                                        @endif
                                    </td>
                                    <td>{{ $item->jenis_pesanan }}</td>
                                    <td>
                                        <a href="/pelanggan/order/{{ $item->id }}" class="btn btn-success"><i
                                                class="fa-solid fa-shopping-cart"></i></a>
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
@endpush
