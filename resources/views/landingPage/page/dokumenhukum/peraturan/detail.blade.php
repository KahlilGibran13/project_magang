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
                                Detail Peraturan
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Tipe Dokumen</th>
                                                <td>: </td>
                                                <td>Peraturan Perundang-Undangan</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Judul</th>
                                                <td>: </td>
                                                <td>{{ $produk->produk_judul }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">T.E.U Badan/Pengarang</th>
                                                <td>: </td>
                                                <td>{{ $produk->produk_tajuk }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Nomor Peraturan</th>
                                                <td>: </td>
                                                <td>{{ $produk->produk_nomor }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Jenis/Bentuk Peraturan</th>
                                                <td>: </td>
                                                <td>
                                                    @foreach ($produk->temas as $item)
                                                        <span class="badge bg-success">{{ $item->tema_deskripsi }}</span>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Singkatan Jenis/Bentuk Peraturan</th>
                                                <td>: </td>
                                                <td>{{ $produk->produk_singkatan }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Tempat Penetapan</th>
                                                <td>: </td>
                                                <td>{{ $produk->produk_tempatterbit }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Tanggal Ditetapkan</th>
                                                <td>: </td>
                                                <td>
                                                    {{ date('d/m/Y', strtotime($produk->produk_tglterbit)) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Tanggal Diundangkan</th>
                                                <td>: </td>
                                                <td>
                                                    {{ date('d/m/Y', strtotime($produk->produk_tgldiundangkan)) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Sumber</th>
                                                <td>: </td>
                                                <td>{{ $produk->produk_sumber }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Subjek</th>
                                                <td>: </td>
                                                <td>{{ $produk->produk_subjek }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Status</th>
                                                <td>: </td>
                                                <td>{{ $produk->produk_statusberlaku }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Bahasa</th>
                                                <td>: </td>
                                                <td>{{ $produk->produk_bahasa }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Lokasi</th>
                                                <td>: </td>
                                                <td>{{ $produk->produk_lokasi }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Bidang Hukum</th>
                                                <td>: </td>
                                                <td>{{ $produk->produk_bidanghukum }}</td>
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
                                    <div class="col-lg-4 mt-0">
                                        <a href="{{ asset('dokumen/'.$produk->produk_dokumen) }}"
                                            target="_blank" class="btn btn-success wrn-btn mb-2">Unduh Peraturan</a>
                                    </div>
                                    <br>
                                    <iframe width="100%" height="760"
                                        src="{{ asset('dokumen/'.$produk->produk_dokumen) }}"
                                        frameborder="0" allowfullscreen="" webkitallowfullscreen=""></iframe>
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                    aria-labelledby="nav-profile-tab">
                                    <div class="col-lg-4 mt-0">
                                        <a href="{{ asset('dokumen/'.$produk->produk_abstraks) }}" target="_blank"
                                            class="btn btn-success wrn-btn mb-2">Unduh Abstrak</a>
                                    </div>
                                    <br>
                                    <iframe width="100%" height="760"
                                        src="{{ asset('dokumen/'.$produk->produk_abstraks) }}"
                                        frameborder="0" allowfullscreen="" webkitallowfullscreen=""></iframe>
                                </div>
                                <div class="tab-pane fade" id="nav-english" role="tabpanel"
                                    aria-labelledby="nav-profile-tab">
                                    <br>
                                    <br>
                                    <iframe width="100%" height="760"
                                        src="https://jdih.pertanian.go.id/viewerjs/?zoom=page-width#../sources/files/"
                                        frameborder="0" allowfullscreen="" webkitallowfullscreen=""></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <style>
                        .scroll {
                            max-height: 300px;
                            overflow-y: auto;
                        }
                    </style>
                    <div><br></div>
                    <div class="card">
                        <div class="card-header text-white bg-danger">
                            <label>Lampiran Peraturan</label>
                        </div>
                        <div class="callout callout-info">
                            <div class="card-body scroll max-height:200px; background:red; overflow-y:auto">
                                <div class="row">
                                    No Data Found </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <section id="contact" class="contact">
        <div class="container aos-init aos-animate" data-aos="fade-up">
            <div class="row aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-5">
                    
                </div>
                
            </div>
        </div>
    </section> --}}

@endsection
