@extends('layout.pelanggan-login')

@section('content')
    <main>
        <div id="carousel-home">
            <div class="container margin_60_35">
                <div class="main_title">
                    <h2>Bibit Terlaris</h2>
                    <span>Bibit</span>
                    <p>Bibit Terlaris dan Kualitas Terbaik</p>
                </div>
                <div class="row small-gutters">

                    @foreach ($best_produk as $key)
                        <div class="col-6 col-md-4 col-xl-3">
                            <div class="grid_item">
                                <figure>
                                    @if ($key->jenis_pesanan == 'ready')
                                        <span class="ribbon hot">Ready</span>
                                    @else
                                        <span class="ribbon off">Pre-Order</span>
                                    @endif
                                    <a href="/pelanggan/order/{{ $key->id }}">
                                        <img class="img-fluid lazy loaded" src="{{ asset('storage/images/' . $key->image) }}"
                                            data-src="{{ asset('storage/images/' . $key->image) }}" alt=""
                                            data-was-processed="true">
                                        <img class="img-fluid lazy loaded"
                                            src="{{ asset('storage/images/' . $key->image) }}"
                                            data-src="{{ asset('storage/images/' . $key->image) }}" alt=""
                                            data-was-processed="true">
                                    </a>
                                </figure>
                                <div class="rating">
                                    <i class="icon-star voted"></i>
                                    <i class="icon-star voted"></i>
                                    <i class="icon-star voted"></i>
                                    <i class="icon-star voted"></i>
                                    <i class="icon-star voted"></i>
                                </div>
                                <a href="/pelanggan/order/{{ $key->id }}">
                                    <h3>{{ $key->nama }}</h3>
                                </a>
                                <div class="price_box">
                                    <span class="new_price">Rp
                                        {{ number_format($key->harga, 0, ',', '.') }}</span>
                                </div>
                                <ul>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- /row -->
            </div>
            <div id="icon_drag_mobile"></div>
        </div>
        <!--/carousel-->
    </main>
@endSection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <link href="{{ asset('assetss/css/style.css') }}" rel="stylesheet">
@endpush
