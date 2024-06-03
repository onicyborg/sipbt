@extends('layout.pelanggan')

@section('content')
    <main>
        <div id="carousel-home">
            <div class="owl-carousel owl-theme owl-loaded owl-drag">
                <!--/owl-slide-->
                <!--/owl-slide-->
                <div class="owl-stage-outer">
                    <div class="owl-stage" style="transform: translate3d(-1716px, 0px, 0px); transition: all; width: 6006px;">
                        <div class="owl-item active" style="width: 858px;">
                            <div class="owl-slide cover" style="background-image: url({{ asset('assetss/imggg/0.png') }});">
                                <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)"
                                    style="background-color: rgba(0, 0, 0, 0.5);">
                                    <div class="container">
                                        <div class="row justify-content-center justify-content-md-end">
                                            <div class="col-lg-6 static">
                                                <div class="slide-text text-end white">
                                                    <h2 class="owl-slide-animated owl-slide-title is-transitioned">Selamat
                                                        Datang Di<br>Republik Bibit</h2>
                                                    <p class="owl-slide-animated owl-slide-subtitle is-transitioned">
                                                        Tempatnya Beli Bibit Berkualitas
                                                    </p>
                                                    <div class="owl-slide-animated owl-slide-cta is-transitioned"><a
                                                            class="btn_1" href="/registrasi" role="button">Registrasi
                                                            Sekarang</a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container margin_60_35">
                <div class="main_title">
                    <h2>Bibit Terlaris</h2>
                    <span>Bibit</span>
                    <p>Bibit Terlaris dan Kualitas Terbaik</p>
                </div>
                <div class="row small-gutters">
                    <div class="col-6 col-md-4 col-xl-3">
                        <div class="grid_item">
                            <figure>
                                <span class="ribbon off">-30%</span>
                                <a href="product-detail-1.html">
                                    <img class="img-fluid lazy loaded" src="{{ asset('assetss/imggg/1.png') }}"
                                        data-src="{{ asset('assetss/imggg/1.png') }}" alt="" data-was-processed="true">
                                    <img class="img-fluid lazy loaded" src="{{ asset('assetss/imggg/1.png') }}"
                                        data-src="{{ asset('assetss/imggg/1.png') }}" alt="" data-was-processed="true">
                                </a>
                                <div data-countdown="2024/04/10" class="countdown">00D 00:00:00</div>
                            </figure>
                            <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i
                                    class="icon-star voted"></i><i class="icon-star voted"></i><i
                                    class="icon-star voted"></i></div>
                            <a href="product-detail-1.html">
                                <h3>Melon Pertiwi</h3>
                            </a>
                            <div class="price_box">
                                <span class="new_price">Rp 50.000</span>
                                <span class="old_price">Rp 120.000</span>
                            </div>
                            <ul>
                            </ul>
                        </div>
                        <!-- /grid_item -->
                    </div>
                    <!-- /col -->
                    <div class="col-6 col-md-4 col-xl-3">
                        <div class="grid_item">
                            <span class="ribbon hot">Hot</span>
                            <figure>
                                <a href="product-detail-1.html">
                                    <img class="img-fluid lazy loaded" src="{{ asset('assetss/imggg/2.jpg') }}"
                                        data-src="{{ asset('assetss/imggg/2.jpg') }}" alt="" data-was-processed="true">
                                    <img class="img-fluid lazy loaded" src="{{ asset('assetss/imggg/2.jpg') }}"
                                        data-src="{{ asset('assetss/imggg/2.jpg') }}" alt="" data-was-processed="true">
                                </a>
                            </figure>
                            <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i
                                    class="icon-star voted"></i><i class="icon-star voted"></i><i
                                    class="icon-star voted"></i></div>
                            <a href="product-detail-1.html">
                                <h3>Terong Bintang Asia</h3>
                            </a>
                            <div class="price_box">
                                <span class="new_price">Rp 25.000</span>
                            </div>
                            <ul>
                            </ul>
                        </div>
                        <!-- /grid_item -->
                    </div>
                    <!-- /col -->
                    <div class="col-6 col-md-4 col-xl-3">
                        <div class="grid_item">
                            <span class="ribbon hot">Hot</span>
                            <figure>
                                <a href="product-detail-1.html">
                                    <img class="img-fluid lazy loaded" src="{{ asset('assetss/imggg/3.jpg') }}"
                                        data-src="{{ asset('assetss/imggg/3.jpg') }}" alt="" data-was-processed="true">
                                    <img class="img-fluid lazy loaded" src="{{ asset('assetss/imggg/3.jpg') }}"
                                        data-src="{{ asset('assetss/imggg/3.jpg') }}" alt="" data-was-processed="true">
                                </a>
                            </figure>
                            <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i
                                    class="icon-star voted"></i><i class="icon-star voted"></i><i
                                    class="icon-star voted"></i></div>
                            <a href="product-detail-1.html">
                                <h3>Cabe Rawit Pelita F1</h3>
                            </a>
                            <div class="price_box">
                                <span class="new_price">Rp 10.000</span>
                            </div>
                            <ul>
                            </ul>
                        </div>
                        <!-- /grid_item -->
                    </div>
                    <!-- /col -->
                    <div class="col-6 col-md-4 col-xl-3">
                        <div class="grid_item">
                            <span class="ribbon hot">Hot</span>
                            <figure>
                                <a href="product-detail-1.html">
                                    <img class="img-fluid lazy loaded" src="{{ asset('assetss/imggg/4.jpg') }}"
                                        data-src="{{ asset('assetss/imggg/4.jpg') }}" alt="" data-was-processed="true">
                                    <img class="img-fluid lazy loaded" src="{{ asset('assetss/imggg/4.jpg') }}"
                                        data-src="{{ asset('assetss/imggg/4.jpg') }}" alt="" data-was-processed="true">
                                </a>
                            </figure>
                            <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i
                                    class="icon-star voted"></i><i class="icon-star voted"></i><i
                                    class="icon-star voted"></i></div>
                            <a href="product-detail-1.html">
                                <h3>Semangka Bintang Asia</h3>
                            </a>
                            <div class="price_box">
                                <span class="new_price">Rp 10.000</span>
                            </div>
                            <ul>
                            </ul>
                        </div>
                        <!-- /grid_item -->
                    </div>
                    <!-- /col -->
                </div>
                <!-- /row -->
            </div>
            <div id="icon_drag_mobile"></div>
        </div>
        <!--/carousel-->
    </main>
@endSection
