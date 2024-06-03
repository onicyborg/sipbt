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
                        @php
                            $produk = [
                                [
                                    'id_produk' => 1,
                                    'gambar_bibit' => '1.png',
                                    'nama_bibit' => 'Bibit Mangga',
                                    'harga_bibit' => 50000,
                                ],
                                [
                                    'id_produk' => 2,
                                    'gambar_bibit' => '2.jpg',
                                    'nama_bibit' => 'Bibit Jeruk',
                                    'harga_bibit' => 60000,
                                ],
                                [
                                    'id_produk' => 3,
                                    'gambar_bibit' => '3.jpg',
                                    'nama_bibit' => 'Bibit Apel',
                                    'harga_bibit' => 55000,
                                ],
                                [
                                    'id_produk' => 4,
                                    'gambar_bibit' => '4.jpg',
                                    'nama_bibit' => 'Bibit Durian',
                                    'harga_bibit' => 70000,
                                ],
                            ];
                        @endphp

                        @foreach ($produk as $key)
                            <div class="col-6 col-md-4 col-xl-3">
                                <div class="grid_item">
                                    <figure>
                                        <a href="">
                                            @php
                                                $images = $key['gambar_bibit'] ?: 'noimage.png';
                                            @endphp
                                            <img class="img-fluid lazy loaded"
                                                src="{{ asset('assetss/imggg/'.$images) }}"
                                                data-src="{{ asset('assetss/imggg/'.$images) }}" alt=""
                                                data-was-processed="true">
                                            <img class="img-fluid lazy loaded"
                                                src="{{ asset('assetss/imggg/'.$images) }}"
                                                data-src="{{ asset('assetss/imggg/'.$images) }}" alt=""
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
                                    <a href="">
                                        <h3>{{ $key['nama_bibit'] }}</h3>
                                    </a>
                                    <div class="price_box">
                                        <span class="new_price">Rp
                                            {{ number_format($key['harga_bibit'], 0, ',', '.') }}</span>
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
