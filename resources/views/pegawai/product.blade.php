@extends('layout.pegawai')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Produk Bibit</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/pegawai/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Produk Bibit</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                List Data Produk Bibit
            </div>
            <div class="card-body">
                <a class="btn btn-primary" href="/pegawai/product/add"><i class="fa-solid fa-plus"></i>
                    Tambah Data</a>
                <div class="table-responsive">
                    <table class="table table-responsive" id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama Bibit</th>
                                <th>Detail</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Gambar</th>
                                <th>Terjual</th>
                                <th>Status</th>
                                <th>Etalase</th>
                                <th class="text-center">#</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama Bibit</th>
                                <th>Detail</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Gambar</th>
                                <th>Terjual</th>
                                <th>Status</th>
                                <th>Etalase</th>
                                <th class="text-center">#</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($product as $no => $item)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $item->kode }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->detail }}</td>
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
                                    <td>{{ $item->display }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#edit{{ $item->id }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="edit{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Produk
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="/pegawai/product/update/{{ $item->id }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label>Kode Bibit</label>
                                                        <input class="form-control" type="text" name="kode"
                                                            value="{{ $item->kode }}" required />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Nama Bibit</label>
                                                        <input class="form-control" type="text" name="nama"
                                                            value="{{ $item->nama }}" required />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Detail</label>
                                                        <textarea class="form-control" name="detail" required>{{ $item->detail }}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Harga</label>
                                                        <input class="form-control" type="text" name="harga"
                                                            value="{{ $item->harga }}" required />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Stok</label>
                                                        <input class="form-control" type="text" name="stok"
                                                            value="{{ $item->stok }}" required />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Jenis Pesanan</label>
                                                        <select name="jenis_pesanan" class="form-select"
                                                            id="jenisPesanan{{ $item->id }}"
                                                            onchange="toggleTanggalTanam({{ $item->id }})" required>
                                                            <option value="preorder"
                                                                @if ($item->jenis_pesanan == 'preorder') selected @endif>Preorder
                                                            </option>
                                                            <option value="ready"
                                                                @if ($item->jenis_pesanan == 'ready') selected @endif>Ready
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Tampilkan Di Etalase</label>
                                                        <select name="display" class="form-select" required>
                                                            <option value="Tampilkan"
                                                                @if ($item->display == 'Tampilkan') selected @endif>Tampilkan
                                                            </option>
                                                            <option value="Sembunyikan"
                                                                @if ($item->display == 'Sembunyikan') selected @endif>Sembunyikan
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3" id="tanggalTanamDiv{{ $item->id }}"
                                                        @if ($item->jenis_pesanan == 'preorder') style="display: none;" @endif>
                                                        <label>Tanggal Tanam</label>
                                                        <input class="form-control" type="date" name="tanggal_tanam"
                                                            id="tanggalTanam{{ $item->id }}"
                                                            @if ($item->jenis_pesanan == 'ready') value="{{ $item->tanggal_tanam }}" @endif />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Gambar</label>
                                                        <input class="form-control" name="image" type="file">
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <button class="btn btn-primary" type="submit">Update Data</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="delete{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">
                                                    Konfirmasi Penghapusan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat
                                                dibatalkan.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <form method="POST"
                                                    action="/pegawai/product/delete/{{ $item->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
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
        function toggleTanggalTanam(id) {
            const jenisPesanan = document.getElementById('jenisPesanan' + id).value;
            const tanggalTanamDiv = document.getElementById('tanggalTanamDiv' + id);
            const tanggalTanam = document.getElementById('tanggalTanam' + id);

            if (jenisPesanan === 'ready') {
                tanggalTanamDiv.style.display = 'block';
                tanggalTanam.required = true;
            } else {
                tanggalTanamDiv.style.display = 'none';
                tanggalTanam.required = false;
            }
        }
    </script>
@endpush
