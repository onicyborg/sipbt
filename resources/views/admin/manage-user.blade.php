@extends('layout.admin')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data User</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Data User</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                List Data User
            </div>
            <div class="card-body">
                <a class="btn btn-primary" href="/admin/manage-user/add"><i class="fa-solid fa-plus"></i>
                    Tambah Data</a>
                <div class="table-responsive">
                    <table class="table table-responsive" id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th class="text-center">Nomor Telepon</th>
                                <th>Alamat</th>
                                <th>Role</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th class="text-center">Nomor Telepon</th>
                                <th>Alamat</th>
                                <th>Role</th>
                                <th>#</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($user as $key)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $key->nama }}</td>
                                    <td class="text-center">{{ $key->nomortelepon }}</td>
                                    <td>{{ $key->alamat }}</td>
                                    <td>
                                        @if ($key->role == 'admin')
                                            Admin
                                        @elseif($key->role == 'pegawai')
                                            Pegawai
                                        @elseif($key->role == 'pemilik')
                                            Pemilik
                                        @else
                                            Pelanggan
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#edit{{ $key->id }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $key->id }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <div class="modal fade" id="edit{{ $key->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $key->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $key->id }}">Edit User
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="/admin/manage-user/edit/{{ $key->id }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="inputNama{{ $key->id }}">Nama Lengkap</label>
                                                        <input class="form-control" id="inputNama{{ $key->id }}"
                                                            type="text" name="nama" value="{{ $key->nama }}"
                                                            placeholder="Isikan Nama Lengkap" required />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="inputAlamat{{ $key->id }}">Alamat</label>
                                                        <input class="form-control" id="inputAlamat{{ $key->id }}"
                                                            type="text" name="alamat" value="{{ $key->alamat }}"
                                                            placeholder="Isikan Alamat" required />
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="inputNomorTelepon{{ $key->id }}">Nomor
                                                            Telepon</label>
                                                        <input class="form-control"
                                                            id="inputNomorTelepon{{ $key->id }}" type="text"
                                                            name="nomortelepon" value="{{ $key->nomortelepon }}"
                                                            placeholder="Isikan Nomor Telepon" required />
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <div class="mb-3 mb-md-0">
                                                                <label
                                                                    for="inputUsername{{ $key->id }}">Username</label>
                                                                <input class="form-control"
                                                                    id="inputUsername{{ $key->id }}" name="username"
                                                                    type="text" value="{{ $key->username }}"
                                                                    placeholder="Isikan Username" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3 mb-md-0">
                                                                <label
                                                                    for="inputPassword{{ $key->id }}">Password</label>
                                                                <input class="form-control"
                                                                    id="inputPassword{{ $key->id }}" name="password"
                                                                    type="password" placeholder="Isikan Password" />
                                                                <small class="form-text text-muted">Biarkan kosong jika
                                                                    tidak ingin mengubah password.</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="inputRole{{ $key->id }}">Role</label>
                                                        <select name="role" class="form-select" required>
                                                            <option disabled>- Pilih Role Akun -</option>
                                                            <option value="admin"
                                                                {{ $key->role == 'admin' ? 'selected' : '' }}>Admin
                                                            </option>
                                                            <option value="pegawai"
                                                                {{ $key->role == 'pegawai' ? 'selected' : '' }}>Pegawai
                                                            </option>
                                                            <option value="pemilik"
                                                                {{ $key->role == 'pemilik' ? 'selected' : '' }}>Pemilik
                                                            </option>
                                                            <option value="pelanggan"
                                                                {{ $key->role == 'pelanggan' ? 'selected' : '' }}>Pelanggan
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <button class="btn btn-primary" type="submit"><i
                                                                class="fa-solid fa-save"></i> Simpan Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="delete{{ $key->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Penghapusan</h5>
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
                                                    action="/admin/manage-user/delete/{{ $key->id }}">
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
@endpush
