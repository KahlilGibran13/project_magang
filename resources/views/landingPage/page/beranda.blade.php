@extends('landingPage.layouts.main')

@section('title', 'Beranda')

@section('content')
    <div class="d-flexsi">
        <img src="{{ asset('gambar_tema/gambar_tema.webp') }}" width="100%" style="padding-top: 1px;">
    </div>
    <center>
        <section class="search-sec" style="overflow:hidden;">
            <div class="container">
                <form action="https://jdih.pertanian.go.id/fp/cari" enctype="multipart/form-data" method="post"
                    accept-charset="utf-8">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <input type="hidden" name="TS" value="1720232382">
                                <div class="col-lg-11">
                                    <input type="text" name="judul" class="form-control search-slt"
                                        placeholder="Kata Kunci Pencarian">
                                </div>
                                <div class="col-lg-1 mt-0">
                                    <button type="submit" class="btn btn-success wrn-btn">Cari</button>
                                    <a style="color:white;" class="btn btn-warning mt-3"
                                        onclick="if (!window.__cfRLUnblockHandlers) return false; myFunction()">Spesifik</a>
                                </div>
                            </div>
                            <div id="myDIV" style="display: none;">
                                <div class="row" style="padding:1px;">
                                    <div class="col-lg-7">
                                        <select class="form-control search-slt select2" name="bentuk"
                                            id="exampleFormControlSelect1">
                                            <option value="">Jenis Peraturan</option>
                                            <option value="1">pedoman</option>
                                            <option value="2">peraturan pemerintah</option>
                                            <option value="3">instruksi presiden</option>
                                            <option value="4">keputusan presiden</option>
                                            <option value="5">peraturan menteri pertanian</option>
                                            <option value="6">keputusan menteri</option>
                                            <option value="7">Undang-Undang</option>
                                            <option value="8">Peraturan Presiden</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <select class="form-control search-slt select2" name="bidang"
                                            id="exampleFormControlSelect2">
                                            <option value="">Tematik</option>
                                            <option value="1">Manajemen dan Kesekretariatan</option>
                                            <option value="2">Prasarana dan Sarana</option>
                                            <option value="3">Tanaman Pangan</option>
                                            <option value="4">Hortikultura</option>
                                            <option value="5">Peternakan dan Kesehatan Hewan</option>
                                            <option value="6">Perkebunan</option>
                                            <option value="7">Penelitian dan Pengembangan</option>
                                            <option value="8">Penyuluhan dan SDM Pertanian</option>
                                            <option value="9">Ketahanan Pangan</option>
                                            <option value="10">Karantina Pertanian</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-1">
                                        <input type="text" name="tahun" class="form-control search-slt"
                                            placeholder="Tahun ">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </center>
    <section id="featured-services" class="featured-services">
        <div class="container aos-init aos-animate" data-aos="fade-up">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-3 d-flex mb-5 mb-lg-0">
                    <a href="{{ route('fp-dokumenhukum-all-peraturan') }}">
                    </a>
                    <div class="icon-box col-md-12 aos-init aos-animate w-100" style="text-align:center;" data-aos="fade-up"
                        data-aos-delay="100"><a href="{{ route('fp-dokumenhukum-all-peraturan') }}">
                            <div class="icon"><i class="fas fa-balance-scale"></i></div>
                        </a>
                        <h4 class="title"><a href="{{ route('fp-dokumenhukum-all-peraturan') }}"></a><a
                                href="{{ route('fp-dokumenhukum-all-peraturan') }}">Peraturan</a></h4>
                        <p class="description"></p>
                    </div>

                </div>
                <div class="col-12 col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                    <a href="{{ route('fp-dokumenhukum-putusan') }}">
                    </a>
                    <div class="icon-box col-md-12 aos-init aos-animate w-100" style="text-align:center;" data-aos="fade-up"
                        data-aos-delay="100"><a href="{{ route('fp-dokumenhukum-putusan') }}">
                            <div class="icon"><i class="fas fa-gavel"></i></div>
                        </a>
                        <h4 class="title"><a href="{{ route('fp-dokumenhukum-putusan') }}"></a><a
                                href="{{ route('fp-dokumenhukum-putusan') }}">Putusan</a></h4>
                        <p class="description"></p>
                    </div>

                </div>
                <div class="col-12 col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                    <a href="{{ route('fp-dokumenhukum-monografi') }}">
                    </a>
                    <div class="icon-box col-md-12 aos-init aos-animate w-100" style="text-align:center;"
                        data-aos="fade-up" data-aos-delay="100"><a href="{{ route('fp-dokumenhukum-monografi') }}">
                            <div class="icon"><i class="fas fa-book"></i></div>
                        </a>
                        <h4 class="title"><a href="{{ route('fp-dokumenhukum-monografi') }}"></a><a
                                href="{{ route('fp-dokumenhukum-monografi') }}">Monografi</a></h4>
                        <p class="description"></p>
                    </div>

                </div>
                <div class="col-12 col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                    <a href="{{ route('fp-dokumenhukum-artikel') }}">
                    </a>
                    <div class="icon-box col-md-12 aos-init aos-animate w-100" style="text-align:center;"
                        data-aos="fade-up" data-aos-delay="100"><a href="{{ route('fp-dokumenhukum-artikel') }}">
                            <div class="icon"><i class="fas fa-newspaper"></i></div>
                        </a>
                        <h4 class="title"><a href="{{ route('fp-dokumenhukum-artikel') }}"></a><a
                                href="{{ route('fp-dokumenhukum-artikel') }}">Artikel</a></h4>
                        <p class="description"></p>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section id="services" class="services section-bg">
        <div class="container aos-init aos-animate" data-aos="fade-up">
            <div class="row aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                <div class="col-md-8">
                    <div class="card col-md-12">
                        <div class="card-header text-white bg-success">
                            Peraturan Terbaru
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-striped table-light">
                                <tbody>
                                    @foreach ($peraturans as $item)
                                        <tr>
                                            <td>
                                                <strong>
                                                    <a class="bold" style="color:black;" href="">
                                                        {{ $item->produk_judul }}
                                                    </a>
                                                </strong>
                                                <p>
                                                    Nomor : {{ $item->produk_nomor }} </p>
                                                @php
                                                    setlocale(LC_TIME, 'id_ID.UTF-8');
                                                    $tanggal = $item->produk_tglterbit;
                                                    $tanggalIndo = strftime('%A, %d %B %Y', strtotime($tanggal));
                                                @endphp
                                                <div class="pull-right small theme-font">
                                                    Ditetapkan pada {{ $tanggalIndo }} </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer w-100 d-flex">
                            <a class="btn btn-outline-success ms-auto"
                                href="{{ route('fp-dokumenhukum-all-peraturan') }}">Lihat Peraturan Lainnya</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-header text-white bg-success p-2 rounded-top">
                        Infografis
                    </div>
                    <div class="card-body p-2">
                        <div class="swiper" style="height: 600px;">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                <!-- Slides -->
                                @foreach ($infografis as $item)
                                    <div class="swiper-slide">
                                        <img data-toggle="modal" data-target="#modal{{ $item->infografis_id }}"
                                            src="{{ asset('assets/' . $item->infografis_gambar) }}"
                                            alt="{{ $item->infografis_nama }}" class="img-fluid">
                                    </div>
                                @endforeach
                            </div>
                            <!-- If we need pagination -->
                            <div class="swiper-pagination"></div>

                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>

                            <!-- If we need scrollbar -->
                            <div class="swiper-scrollbar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @foreach ($infografis as $item)
        <div class="modal fade" id="modal{{ $item->infografis_id }}" tabindex="-1"
            aria-labelledby="modal{{ $item->infografis_id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h5 class="modal-title" id="modal{{ $item->infografis_id }}}}">Infografis</h5>
                        <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img src="{{ asset('assets/' . $item->infografis_gambar) }}" alt="{{ $item->infografis_nama }}"
                            class="img-fluid">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <section id="team" class="team section-bg">
        <div class="container aos-init aos-animate" data-aos="fade-up">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title" style="background:#28a7458c;height:55px">
                        <h3 style="font-size:40px; color:white;">Tematik Peraturan</h3>
                    </div>
                    <div class="card-container aos-init aos-animate gap-2" data-aos="fade-up" data-aos-delay="100">
                        <div class="col-lg-2 col-md-4 d-flex align-items-stretch ml-2 aos-init aos-animate"
                            data-aos="fade-up" data-aos-delay="100">
                            <div class="member">
                                <div class="member-img">
                                    <img src="https://jdih.pertanian.go.id/sources/tematik/sekjen.jpg" class="img-fluid"
                                        alt="">
                                    <div class="social col-md-12">
                                        <a href="fp/peraturan/tematik/1" type="button" class="btn">Detail </a>
                                    </div>
                                </div>
                                <div class="member-info">
                                    <h4 style="text-align:center; ">Manajemen dan Kesekretariatan</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 d-flex align-items-stretch ml-2 aos-init aos-animate"
                            data-aos="fade-up" data-aos-delay="100">
                            <div class="member">
                                <div class="member-img">
                                    <img src="https://jdih.pertanian.go.id/sources/tematik/psp.jpg" class="img-fluid"
                                        alt="">
                                    <div class="social col-md-12">
                                        <a href="fp/peraturan/tematik/2" type="button" class="btn">Detail </a>
                                    </div>
                                </div>
                                <div class="member-info">
                                    <h4 style="text-align:center; ">Prasarana dan Sarana</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 d-flex align-items-stretch ml-2 aos-init aos-animate"
                            data-aos="fade-up" data-aos-delay="100">
                            <div class="member">
                                <div class="member-img">
                                    <img src="https://jdih.pertanian.go.id/sources/tematik/tanamanpangan.jpg"
                                        class="img-fluid" alt="">
                                    <div class="social col-md-12">
                                        <a href="fp/peraturan/tematik/3" type="button" class="btn">Detail </a>
                                    </div>
                                </div>
                                <div class="member-info">
                                    <h4 style="text-align:center; ">Tanaman Pangan</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 d-flex align-items-stretch ml-2 aos-init aos-animate"
                            data-aos="fade-up" data-aos-delay="100">
                            <div class="member">
                                <div class="member-img">
                                    <img src="https://jdih.pertanian.go.id/sources/tematik/horti.jpg" class="img-fluid"
                                        alt="">
                                    <div class="social col-md-12">
                                        <a href="fp/peraturan/tematik/4" type="button" class="btn">Detail </a>
                                    </div>
                                </div>
                                <div class="member-info">
                                    <h4 style="text-align:center; ">Hortikultura</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 d-flex align-items-stretch ml-2 aos-init aos-animate"
                            data-aos="fade-up" data-aos-delay="100">
                            <div class="member">
                                <div class="member-img">
                                    <img src="https://jdih.pertanian.go.id/sources/tematik/peternakan.jpg"
                                        class="img-fluid" alt="">
                                    <div class="social col-md-12">
                                        <a href="fp/peraturan/tematik/5" type="button" class="btn">Detail </a>
                                    </div>
                                </div>
                                <div class="member-info">
                                    <h4 style="text-align:center; ">Peternakan dan Kesehatan Hewan</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 d-flex align-items-stretch ml-2 aos-init aos-animate"
                            data-aos="fade-up" data-aos-delay="100">
                            <div class="member">
                                <div class="member-img">
                                    <img src="https://jdih.pertanian.go.id/sources/tematik/perkebunan.jpg"
                                        class="img-fluid" alt="">
                                    <div class="social col-md-12">
                                        <a href="fp/peraturan/tematik/6" type="button" class="btn">Detail </a>
                                    </div>
                                </div>
                                <div class="member-info">
                                    <h4 style="text-align:center; ">Perkebunan</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 d-flex align-items-stretch ml-2 aos-init aos-animate"
                            data-aos="fade-up" data-aos-delay="100">
                            <div class="member">
                                <div class="member-img">
                                    <img src="https://jdih.pertanian.go.id/sources/tematik/penelitian.jpg"
                                        class="img-fluid" alt="">
                                    <div class="social col-md-12">
                                        <a href="fp/peraturan/tematik/7" type="button" class="btn">Detail </a>
                                    </div>
                                </div>
                                <div class="member-info">
                                    <h4 style="text-align:center; ">Penelitian dan Pengembangan</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 d-flex align-items-stretch ml-2 aos-init aos-animate"
                            data-aos="fade-up" data-aos-delay="100">
                            <div class="member">
                                <div class="member-img">
                                    <img src="https://jdih.pertanian.go.id/sources/tematik/sdm.jpg" class="img-fluid"
                                        alt="">
                                    <div class="social col-md-12">
                                        <a href="fp/peraturan/tematik/8" type="button" class="btn">Detail </a>
                                    </div>
                                </div>
                                <div class="member-info">
                                    <h4 style="text-align:center; ">Penyuluhan dan SDM Pertanian</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 d-flex align-items-stretch ml-2 aos-init aos-animate"
                            data-aos="fade-up" data-aos-delay="100">
                            <div class="member">
                                <div class="member-img">
                                    <img src="https://jdih.pertanian.go.id/sources/tematik/ketahananpangan.jpg"
                                        class="img-fluid" alt="">
                                    <div class="social col-md-12">
                                        <a href="fp/peraturan/tematik/9" type="button" class="btn">Detail </a>
                                    </div>
                                </div>
                                <div class="member-info">
                                    <h4 style="text-align:center; ">Ketahanan Pangan</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 d-flex align-items-stretch ml-2 aos-init aos-animate"
                            data-aos="fade-up" data-aos-delay="100">
                            <div class="member">
                                <div class="member-img">
                                    <img src="https://jdih.pertanian.go.id/sources/tematik/karantina.jpg"
                                        class="img-fluid" alt="">
                                    <div class="social col-md-12">
                                        <a href="fp/peraturan/tematik/10" type="button" class="btn">Detail </a>
                                    </div>
                                </div>
                                <div class="member-info">
                                    <h4 style="text-align:center; ">Karantina Pertanian</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container d-flex justify-content-center">
                        <div class="card text-center mb-8">
                            <div class="circle-image"> <img src="https://jdih.pertanian.go.id/fp/assets/img/kementan.png"
                                    width="50"> </div><span class="name mb-1 fw-500">Biro Hukum </span>Kementerian
                            Pertanian
                            <form action="{{ route('survey.store') }}" enctype="multipart/form-data"
                                method="post" accept-charset="utf-8">
                                @csrf
                                <div class="rate bg-success py-3 text-white mt-2 p-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" type="email" name="email" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input class="form-control" type="text" name="nama" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Saran</label>
                                            <textarea class="form-control" type="text" name="saran"></textarea>
                                        </div>
                                    </div>
                                    <h6 class="mb-0">Rate Us</h6>
                                    <div class="rating"> 
                                        <input type="radio" name="rate" value="1" id="1">
                                        <label for="1">☆</label>
                                        <input type="radio" name="rate" value="2" id="2">
                                        <label for="2">☆</label>
                                        <input type="radio" name="rate" value="3" id="3">
                                        <label for="3">☆</label> 
                                        <input type="radio"name="rate" value="4" id="4">
                                        <label for="4">☆</label>
                                        <input type="radio" name="rate" value="5" id="5">
                                        <label for="5">☆</label> 
                                    </div>
                                    <div class="buttons px-4 mt-0"> <button type="submit"
                                            class="btn btn-warning btn-block rating-submit">Submit</button> </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section id="skills" class="skills section-bg">
        <div class="container aos-init aos-animate" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-8 col-md-8 d-flex align-items-stretch aos-init aos-animate" data-aos="zoom-in"
                    data-aos-delay="100">
                    <div class="icon-box">
                        <h4 style="color:green;">Survey IKM</h4>
                        <h5>Hasil Survei Kepuasan Layanan Jaringan<br>Dokumentasi dan Informasi Hukum</h5>
                        <p>Terima kasih atas penilaian yang telah anda berikan, masukan anda sangat bermanfaat untuk
                            kemajuan unit kami agar terus memperbaiki dan meningkatkan kualitas pelayanan bagi masyarakat.
                        </p>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                            Ikuti Survey
                        </button>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 d-flex align-items-stretch aos-init aos-animate" data-aos="zoom-in"
                    data-aos-delay="100">
                    <div class="icon-box">
                        <div class="card card-widget widget-user">

                            <div class="widget-user-header bg-success">
                                <h3 class="widget-user-username">JDIH<span> Kementerian Pertanian </span></h3>
                                <center>
                                    <h5 class="widget-user-desc">
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star-o"></span>
                                        <span class="fa fa-star-o"></span>
                                    </h5>
                                </center>
                            </div>
                            <div class="widget-user-image">
                                <img class="img-circle elevation-2"
                                    src="https://jdih.pertanian.go.id/fp/assets/img/kementan.png" alt="User Avatar">
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-sm-6 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">{{ $count_perturan_verif }}</h5>
                                            <span class="description-text">Peraturan</span>
                                        </div>

                                    </div>

                                    <div class="col-sm-6">
                                        <div class="description-block">
                                            <h5 class="description-header">{{ $count_artikel_verif }}</h5>
                                            <span class="description-text">Artikel</span>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="contact" class="contact">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-12">
                    <div class="icon-box">
                        <div class="section-title" style="padding:1px;">
                            <h3>Link <span>Terkait</span></h3>
                        </div>

                        <div class="my-slick">
                            @foreach ($linkterkait as $item)
                                <div>
                                    <a href="{{ $item->link_url }}">
                                        <img src="{{ asset('assets/' . $item->link_logo) }}"
                                            class="img-thumbnail border-0" alt="{{ $item->link_instansi }}">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="faq" class="faq section-bg">
        <div class="container aos-init aos-animate" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-6 col-md-6 footer-contact">
                    <h1 class="logo"><a href="https://jdih.pertanian.go.id/front"><img
                                src="https://jdih.pertanian.go.id/fp/assets/img/jdih.png" width="80%"> </a></h1>
                    <p>
                        <strong>BIRO HUKUM KEMENTERIAN PERTANIAN</strong><br>
                        Gedung A lantai 5<br>
                        Jl. Harsono RM No.3 Ragunan - Pasar Minggu<br>
                        Jakarta 12550<br>
                        <strong>Telp :</strong> +62 21 7816485<br>
                        <strong>Fax :</strong> +62 21 7804036<br>
                    </p>
                    <div class="social-links" style="color:#6c757d; font-size:xx-large;">
                        <a href="https://twitter.com/jkementan" class="twitter" style="color:#6c757d;"><i
                                class="bx bxl-twitter"></i></a>
                        <a href="https://facebook.com/jdihkementan" class="facebook" style="color:#6c757d;"><i
                                class="bx bxl-facebook"></i></a>
                        <a href="https://instagram.com/jdihkementan" class="instagram" style="color:#6c757d;"><i
                                class="bx bxl-instagram"></i></a>
                        <a href="https://youtube.com/" class="youtube" style="color:#6c757d;"><i
                                class="bx bxl-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 ">
                    <iframe class="mb-4 mb-lg-0"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1464.1807595826422!2d106.82286068601475!3d-6.296548796816493!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f2012682b1d5%3A0x1ba390c0a59a5e8a!2sDepartemen%20Pertanian%20Gedung%20A!5e0!3m2!1sid!2sid!4v1641350599450!5m2!1sid!2sid"
                        frameborder="0" style="border:0; width: 100%; height: 284px;" allowfullscreen=""></iframe>
                </div>
            </div>
        </div>
    </section>
@endsection
