@extends('layout.pegawai')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Produk Bibit</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/pegawai/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/pegawai/product">Produk Bibit</a></li>
            <li class="breadcrumb-item active">Tambah Produk Bibit</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                Tambah Data Produk Bibit
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="productTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="preorder-tab" data-bs-toggle="tab" data-bs-target="#preorder"
                            type="button" role="tab" aria-controls="preorder" aria-selected="true">Preorder</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="ready-tab" data-bs-toggle="tab" data-bs-target="#ready" type="button"
                            role="tab" aria-controls="ready" aria-selected="false">Ready</button>
                    </li>
                </ul>
                <div class="tab-content" id="productTabsContent">
                    <!-- Preorder Form -->
                    <div class="tab-pane fade show active" id="preorder" role="tabpanel" aria-labelledby="preorder-tab">
                        <form method="post" action="/pegawai/product/add" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="jenis_pesanan" value="preorder">
                            <div class="mb-3">
                                <label for="kode_bibit_preorder" class="form-label">Kode Bibit</label>
                                <input class="form-control" id="kode_bibit_preorder" type="text" name="kode"
                                    placeholder="Isikan Kode Bibit" required />
                            </div>
                            <div class="mb-3">
                                <label for="nama_preorder" class="form-label">Nama Bibit</label>
                                <input class="form-control" id="nama_preorder" type="text" name="nama"
                                    placeholder="Isikan Nama Bibit" required />
                            </div>
                            <div class="mb-3">
                                <label for="detail_preorder" class="form-label">Detail</label>
                                <textarea class="form-control" id="detail_preorder" name="detail" placeholder="Isikan Detail Bibit" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="harga_preorder" class="form-label">Harga</label>
                                <input class="form-control" id="harga_preorder" type="text" name="harga"
                                    placeholder="Isikan Harga Bibit" required />
                            </div>
                            <div class="mb-3">
                                <label for="stok_preorder" class="form-label">Stok</label>
                                <input class="form-control" id="stok_preorder" type="text" name="stok"
                                    placeholder="Isikan Stok Bibit" required />
                            </div>
                            <div class="mb-3">
                                <label for="image_preorder" class="form-label">Gambar</label>
                                <input class="form-control" id="image_preorder" name="image" type="file">
                            </div>
                            <div class="form-floating mb-3">
                                <button class="btn btn-primary" type="submit"><i class="fa-solid fa-plus"></i> Tambah
                                    Data</button>
                            </div>
                        </form>
                    </div>
                    <!-- Ready Form -->
                    <div class="tab-pane fade" id="ready" role="tabpanel" aria-labelledby="ready-tab">
                        <form method="post" action="/pegawai/product/add" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="jenis_pesanan" value="ready">
                            <div class="mb-3">
                                <label for="kode_bibit_ready" class="form-label">Kode Bibit</label>
                                <input class="form-control" id="kode_bibit_ready" type="text" name="kode"
                                    placeholder="Isikan Kode Bibit" required />
                            </div>
                            <div class="mb-3">
                                <label for="nama_ready" class="form-label">Nama Bibit</label>
                                <input class="form-control" id="nama_ready" type="text" name="nama"
                                    placeholder="Isikan Nama Bibit" required />
                            </div>
                            <div class="mb-3">
                                <label for="detail_ready" class="form-label">Detail</label>
                                <textarea class="form-control" id="detail_ready" name="detail" placeholder="Isikan Detail Bibit" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="harga_ready" class="form-label">Harga</label>
                                <input class="form-control" id="harga_ready" type="text" name="harga"
                                    placeholder="Isikan Harga Bibit" required />
                            </div>
                            <div class="mb-3">
                                <label for="stok_ready" class="form-label">Stok</label>
                                <input class="form-control" id="stok_ready" type="text" name="stok"
                                    placeholder="Isikan Stok Bibit" required />
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_tanam_ready" class="form-label">Tanggal Tanam</label>
                                <input class="form-control" id="tanggal_tanam_ready" type="date" name="tanggal_tanam"
                                    required />
                            </div>
                            <div class="mb-3">
                                <label for="image_ready" class="form-label">Gambar</label>
                                <input class="form-control" id="image_ready" name="image" type="file">
                            </div>
                            <div class="form-floating mb-3">
                                <button class="btn btn-primary" type="submit"><i class="fa-solid fa-plus"></i> Tambah
                                    Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
