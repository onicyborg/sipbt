@extends('layout.pegawai')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">List Pesanan Pelanggan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pesanan Pelanggan</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                List Pesanan Pelanggan
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-responsive" id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pelanggan</th>
                                <th>Kode Bibit</th>
                                <th>Nama Bibit</th>
                                <th>Gambar</th>
                                <th>Status Pesanan</th>
                                <th class="text-center">#</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Pelanggan</th>
                                <th>Kode Bibit</th>
                                <th>Nama Bibit</th>
                                <th>Gambar</th>
                                <th>Status Pesanan</th>
                                <th class="text-center">#</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($order as $no => $item)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $item->user->nama }}</td>
                                    <td>{{ $item->product->kode }}</td>
                                    <td>{{ $item->product->nama }}</td>
                                    <td>
                                        <img src="{{ asset('storage/images/' . $item->product->image) }}"
                                            alt="Gambar Produk" class="img-thumbnail" style="width: 100px; height: auto;">
                                    </td>
                                    <td>{{ $item->status_pesanan }}</td>
                                    <td>
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip"
                                            title="Lihat Detail Pesanan Pelanggan">
                                            <a href="/pegawai/detail-pesanan/{{ $item->id }}"
                                                class="btn btn-secondary"><i class="fa-solid fa-circle-info"></i></a>
                                        </span>
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
