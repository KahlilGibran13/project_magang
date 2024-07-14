@extends('landingPage.layouts.main')

@section('title', $produk->produk_nomor)

@section('content')

    @include('landingPage.layouts.breadcrumbs', ['title' => $produk->produk_nomor])

    <section id="contact" class="contact">
        <div class="container aos-init aos-animate" data-aos="fade-up">
            <div class="row aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-5">
                    <div class="mb-4">
                        <div class="card">
                            <div class="card-header text-white bg-warning">
                                Detail Putusan
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Tipe Dokumen</th>
                                                <td>: </td>
                                                <td>Putusan Pengadilan</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Judul</th>
                                                <td>: </td>
                                                <td>
                                                    {{ $produk->produk_judul }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">T.E.U Badan</th>
                                                <td>: </td>
                                                <td>{{ $produk->produk_tajuk }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Nomor Putusan</th>
                                                <td>: </td>
                                                <td>{{ $produk->produk_nomor }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Jenis Peradilan</th>
                                                <td>: </td>
                                                <td>
                                                    @foreach ($produk->temas as $item)
                                                        <span class="badge bg-success">{{ $item->tema_deskripsi }}</span>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Singkatan Jenis Peradilan</th>
                                                <td>: </td>
                                                <td>
                                                    {{ $produk->produk_singkatan }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Tempat Peradilan</th>
                                                <td>: </td>
                                                <td>
                                                    {{ $produk->produk_tempatterbit }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Tanggal Dibacakan</th>
                                                <td>: </td>
                                                <td>
                                                    //
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Sumber</th>
                                                <td>: </td>
                                                <td>
                                                    {{ $produk->produk_sumber }}
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
                                                <th scope="row">Status Putusan</th>
                                                <td>: </td>
                                                <td>
                                                    {{ $produk->produk_statusberlaku }}
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
                                                <th scope="row">Bidang Hukum/Jenis Perkara</th>
                                                <td>: </td>
                                                <td>
                                                    {{ $produk->produk_bidanghukum }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Lokasi</th>
                                                <td>: </td>
                                                <td>
                                                    {{ $produk->produk_lokasi }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Tematik</th>
                                                <td>: </td>
                                                <td>
                                                    @foreach ($produk->clusters as $item)
                                                        <span class="badge bg-warning">{{ $item->cluster_nama }}</span>
                                                    @endforeach
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
                                    aria-selected="true">File Digital</button>
                                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                                    aria-selected="false">Abstrak</button>
                            </div>
                        </nav>
                        <div class="card-body">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                    aria-labelledby="nav-home-tab">
                                    <br>
                                    <iframe width="100%" height="760"
                                        src="{{ asset('dokumen/'.$produk->produk_dokumen) }}"
                                        frameborder="0" allowfullscreen="" webkitallowfullscreen=""></iframe>
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
