@extends('landingPage.layouts.main')

@section('title', $produk->produk_judul)

@section('content')

    @include('landingPage.layouts.breadcrumbs', ['title' => $produk->produk_judul])

    <section id="contact" class="contact">
        <div class="container aos-init aos-animate" data-aos="fade-up">
            <div class="row aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-5">
                    <div class="mb-4">
                        <div class="card">
                            <div class="card-header text-white bg-warning">
                                Detail Monografi
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Tipe Dokumen</th>
                                                <td>: </td>
                                                <td>Artikel</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Judul</th>
                                                <td>: </td>
                                                <td>
                                                    {{ $produk->produk_judul }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">T.E.U Orang/Badan</th>
                                                <td>: </td>
                                                <td>
                                                    {{ $produk->produk_tajuk }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Nomor Panggil</th>
                                                <td>: </td>
                                                <td>
                                                    {{ $produk->produk_nomor }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Cetakan/Edisi</th>
                                                <td>: </td>
                                                <td>
                                                    {{ $produk->produk_cetakan }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Tempat Terbit</th>
                                                <td>: </td>
                                                <td>
                                                    {{ $produk->produk_tempatterbit }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Penerbit</th>
                                                <td>: </td>
                                                <td>
                                                    {{ $produk->produk_penerbit }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Tahun Terbit</th>
                                                <td>: </td>
                                                <td>
                                                    {{ date('d/m/Y', strtotime($produk->produk_tglterbit)) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Deskripsi Fisik</th>
                                                <td>: </td>
                                                <td>
                                                    {{ $produk->produk_deskripsifisik }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Subjek</th>
                                                <td>: </td>
                                                <td>
                                                    {{ $produk->produk_subjek }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">ISBN/ISSN</th>
                                                <td>: </td>
                                                <td>
                                                    {{ $produk->produk_isbn }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Bahasa</th>
                                                <td>: </td>
                                                <td>
                                                    {{ $produk->produk_bahasa }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Bidang Hukum</th>
                                                <td>: </td>
                                                <td>
                                                    {{ $produk->produk_bidanghukum }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Nomor Induk Buku</th>
                                                <td>: </td>
                                                <td>
                                                    {{ $produk->produk_nib }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Lokasi</th>
                                                <td>: </td>
                                                <td>
                                                    {{ $produk->produk_lokasi }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 ">
                    <div class="card">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                    aria-selected="true">Cover</button>
                                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                                    aria-selected="false">Abstrak</button>
                            </div>
                        </nav>
                        <div class="card-body">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade active show" id="nav-home" role="tabpanel"
                                    aria-labelledby="nav-home-tab">
                                    <br>
                                    <iframe width="100%" height="760"
                                        src="{{ asset('dokumen/' . $produk->produk_dokumen) }}" frameborder="0"
                                        allowfullscreen="" webkitallowfullscreen=""></iframe>
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                    aria-labelledby="nav-profile-tab">
                                    <br>
                                    {!! $produk->produk_abstrak !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
