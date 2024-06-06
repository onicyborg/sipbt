@extends('layout.admin')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data User</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item "><a href="/admin/manage-user">Data User</a></li>
            <li class="breadcrumb-item active">Tambah Data User</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                Tambah Data User
            </div>
            <div class="card-body">
                <form method="post" action="/admin/manage-user/add">
                    @csrf
                    <div class="mb-3">
                        <label for="inputNama">Nama Lengkap</label>
                        <input class="form-control" id="inputNama" type="text" name="nama"
                            placeholder="Isikan Nama Lengkap" required />
                    </div>
                    <div class="mb-3">
                        <label for="inputAlamat">Alamat</label>
                        <input class="form-control" id="inputAlamat" type="text" name="alamat"
                            placeholder="Isikan Alamat" required />
                    </div>
                    <div class="mb-3">
                        <label for="inputNama">Nomor Telepon</label>
                        <input class="form-control" id="inputNomorTelepon" type="text" name="nomortelepon"
                            placeholder="Isikan Nomor Telepon" required />
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="mb-3 mb-md-0">
                                <label for="inputUsername">Username</label>
                                <input class="form-control" id="inputUsername" name="username" type="text"
                                    placeholder="Isikan Username" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 mb-md-0">
                                <label for="inputPassword">Password</label>
                                <input class="form-control" id="inputPassword" name="password" type="password"
                                    placeholder="Isikan Password" required />
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="inputNama">Role</label>
                        <select name="role" class="form-select" required>
                            <option selected disabled>- Pilih Role Akun -</option>
                            <option value="admin">Admin</option>
                            <option value="pegawai">Pegawai</option>
                            <option value="pemilik">Pemilik</option>
                            <option value="pelanggan">Pelanggan</option>
                        </select>
                    </div>
                    <div class="form-floating mb-3">
                        <button class="btn btn-primary" type="submit"><i class="fa-solid fa-plus"></i> Tambah Data</button>
                    </div>
                </form>
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
