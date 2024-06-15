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
                                        <div class="d-flex flex-wrap">
                                            <div class="mb-2 me-2">
                                                <span data-bs-toggle="tooltip" title="Lihat Detail Pesanan">
                                                    <a href="/pelanggan/detail-order/{{ $item->id }}"
                                                        class="btn btn-secondary btn-sm"><i
                                                            class="fa-regular fa-share-from-square"></i></a>
                                                </span>
                                            </div>
                                            <div class="mb-2 me-2">
                                                <span data-bs-toggle="tooltip" title="Print Struk Pesanan">
                                                    <a href="/pelanggan/cetak-struk/{{ $item->id }}"
                                                        class="btn btn-secondary btn-sm" target="blank"><i
                                                            class="fa-solid fa-print"></i></a>
                                                </span>
                                            </div>
                                            @if ($item->metode_pembayaran == 'Transfer')
                                                @if (isset($item->bukti_transfer) && ($item->bukti_transfer->image == '' || $item->bukti_transfer->image == null))
                                                    <div class="mb-2 me-2">
                                                        <span data-bs-toggle="tooltip" title="Upload Bukti Pembayaran">
                                                            <button type="button" class="btn btn-secondary btn-sm"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#uploadModal{{ $item->id }}">
                                                                <i class="fa-solid fa-upload"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                @else
                                                    <div class="mb-2">
                                                        <span data-bs-toggle="tooltip" title="Lihat Bukti Pembayaran">
                                                            <button type="button" class="btn btn-secondary btn-sm"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#viewModal{{ $item->id }}">
                                                                <i class="fa-solid fa-eye"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </td>
                                </tr>


                                <!-- Modal -->
                                <div class="modal fade" id="uploadModal{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="uploadModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="post" action="/pelanggan/upload-bukti/{{ $item->id }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="uploadModalLabel{{ $item->id }}">Upload
                                                        Bukti Pembayaran</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="buktiPembayaran{{ $item->id }}"
                                                            class="form-label">Pilih Bukti Pembayaran</label>
                                                        <input class="form-control" id="buktiPembayaran{{ $item->id }}"
                                                            name="image" type="file" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Upload</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal View -->
                                <div class="modal fade" id="viewModal{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="viewModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewModalLabel{{ $item->id }}">Bukti
                                                    Pembayaran</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                @if ($item->bukti_transfer)
                                                    <img src="{{ asset('storage/images/' . $item->bukti_transfer->image) }}"
                                                        alt="Bukti Pembayaran" class="img-fluid">
                                                    <p class="mt-3">
                                                        Status:
                                                        @if ($item->bukti_transfer->status == 'Menunggu Konfirmasi')
                                                            Menunggu Konfirmasi
                                                        @else
                                                            Pembayaran Dikonfirmasi
                                                        @endif
                                                    </p>
                                                @else
                                                    <p>Tidak ada bukti pembayaran yang tersedia.</p>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
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
@endSection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.4/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    {{-- <link href="{{ asset('assetss/css/style.css') }}" rel="stylesheet"> --}}
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
