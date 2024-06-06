@extends('layout.pemilik')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Laporan Penjualan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Laporan Penjualan</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                Filter Laporan
            </div>
            <div class="card-body">
                <form id="filterForm" method="GET" action="{{ route('laporan.penjualan') }}">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="start_date" class="form-label">Tanggal Mulai</label>
                            <input type="date" id="start_date" name="start_date" class="form-control"
                                value="{{ $start_date }}">
                        </div>
                        <div class="col-md-3">
                            <label for="end_date" class="form-label">Tanggal Akhir</label>
                            <input type="date" id="end_date" name="end_date" class="form-control"
                                value="{{ $end_date }}">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered" id="laporanTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Pembeli</th>
                                <th>Kode Produk</th>
                                <th>Nama Produk</th>
                                <th>Alamat Pengiriman</th>
                                <th>Harga Satuan</th>
                                <th>Jumlah Pembelian</th>
                                <th>Ongkir</th>
                                <th>Total</th>
                                <th>Tanggal Pesanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->user->nama }}</td>
                                    <td>{{ $order->product->kode }}</td>
                                    <td>{{ $order->product->nama }}</td>
                                    <td>{{ $order->alamat_pengiriman }}</td>
                                    <td>Rp. {{ number_format($order->product->harga) }}</td>
                                    <td>{{ $order->jumlah }}</td>
                                    <td>
                                        @if ($order->ongkir != null)
                                            Rp. {{ number_format($order->ongkir) }}
                                        @else
                                            Rp. 0
                                        @endif
                                    </td>
                                    <td>Rp. {{ number_format($order->total_keseluruhan) }}</td>
                                    <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            var startDate = $('#start_date').val();
            var endDate = $('#end_date').val();
            var fileTitle = 'Laporan Penjualan ';

            if (startDate && endDate) {
                fileTitle += startDate + ' sampai ' + endDate;
            } else {
                fileTitle += 'All';
            }

            $('#laporanTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: fileTitle,
                        filename: fileTitle.replace(/ /g, '_')
                    },
                    {
                        extend: 'print',
                        title: fileTitle
                    }
                ],
                "order": [
                    [0, "asc"]
                ]
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if ($errors->any())
        <script>
            Swal.fire({
                title: 'Error!',
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
