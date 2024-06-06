@extends('layout.pegawai')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Monitoring Bibit Untuk Pesanan Milik {{ $order->user->nama }}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/pegawai/monitoring-bibit">Monitoring Bibit</a></li>
            <li class="breadcrumb-item active">Detail Monitoring Bibit</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                Monitoring Perkembangan {{ $order->product->nama }}
            </div>
            <div class="card-body">
                <!-- Tombol Tambah Progress -->
                <div class="d-flex justify-content-end mb-4">
                    @if ($order->status_pesanan != 'Proses Penanaman')
                        <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" title="Bibit Ini Sudah Selesai Diproses">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProgressModal" disabled>Tambah
                                Progress</button>
                        </span>
                    @else
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProgressModal">Tambah
                            Progress</button>
                    @endif
                </div>
                <!-- Daftar Progress -->
                <div class="list-group">
                    @php
                        use Carbon\Carbon;
                    @endphp

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

                <!-- Modal Tambah Progress -->
                <div class="modal fade" id="addProgressModal" tabindex="-1" aria-labelledby="addProgressModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addProgressModalLabel">Tambah Progress</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/add-progress-monitoring/{{ $order->id }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="progressTitle" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="progressTitle" name="title"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="progressHeight" class="form-label">Tinggi (cm)</label>
                                        <input type="number" class="form-control" id="progressHeight" name="tinggi"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="progressDescription" class="form-label">Keterangan Progress</label>
                                        <textarea class="form-control" id="progressDescription" rows="3" name="keterangan" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="progressImage" class="form-label">Image</label>
                                        <input type="file" class="form-control" id="progressImage" name="image"
                                            required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
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
