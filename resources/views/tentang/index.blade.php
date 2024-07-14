@extends('layouts.main')
@section('section-view')
    <div class="mx-4 pt-3">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0">Tentang Kami</h2>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Tentang Kami</li>
                </ol>
            </div><!-- /.col -->
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mx-4" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mx-4" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow border border-info mx-4">
        <div class="card-header pt-3">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="w-100">
                        Profil JDIH
                        @if ($tentang->verifikasiTentangJDIHLatest != null)
                            @if ($tentang->verifikasiTentangJDIHLatest->aksi == 5)
                                <span class="badge badge-success">Terverifikasi</span>
                            @else
                                <span class="badge badge-danger">Belum Terverifikasi</span>
                            @endif
                        @else
                            <span class="badge badge-danger">Belum Terverifikasi</span>
                        @endif
                    </h5>
                </div>
                <div class="col-md-6 d-flex justify-content-end">

                    @if ($tentang->verifikasiTentangJDIHLatest != null)
                        @if (
                            $tentang->verifikasiTentangJDIHLatest->aksi == 2 ||
                                $tentang->verifikasiTentangJDIHLatest->aksi == 4 ||
                                $tentang->verifikasiTentangJDIHLatest->aksi == 6 ||
                                $tentang->verifikasiTentangJDIHLatest->aksi == 5 ||
                                $tentang->verifikasiTentangJDIHLatest->aksi == 0)
                            <form action="{{ route('tentang.verifikasi.send') }}" method="post">
                                @csrf
                                <input type="hidden" name="verifikasi_id"
                                    value="
                        @if ($tentang->verifikasiTentangJDIHLatest != null) {{ $tentang->verifikasiTentangJDIHLatest->id }} @endif
                        ">
                                <input type="hidden" name="tentang_id" value="{{ $tentang->tentang_id }}">
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </form>
                        @else
                            <form action="{{ route('tentang.verifikasi.tarik') }}" method="post">
                                @csrf
                                <input type="hidden" name="verifikasi_id"
                                    value="
                            @if ($tentang->verifikasiTentangJDIHLatest != null) {{ $tentang->verifikasiTentangJDIHLatest->id }} @endif
                            ">
                                <input type="hidden" name="tentang_id" value="{{ $tentang->tentang_id }}">
                                <button type="submit" class="btn btn-danger">Tarik</button>
                            </form>
                        @endif
                    @else
                        <form action="{{ route('tentang.verifikasi.send') }}" method="post">
                            @csrf
                            <input type="hidden" name="verifikasi_id"
                                value="
                    @if ($tentang->verifikasiTentangJDIHLatest != null) {{ $tentang->verifikasiTentangJDIHLatest->id }} @endif
                    ">
                            <input type="hidden" name="tentang_id" value="{{ $tentang->tentang_id }}">
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>


        @if ($tentang->verifikasiTentangJDIHLatest != null)
            <div class="card">
                <div class="card-body">
                    <div class="">
                        <label for="produk_judul" class="form-label">Catatan Perbaikan</label>
                        <textarea class="form-control" id="produk_judul" rows="2" disabled>
                            {{ $tentang->verifikasiTentangJDIHLatest->catatan }}
                        </textarea>
                    </div>
                </div>
            </div>
        @endif

        <div class="card-body">
            @if ($tentang->verifikasiTentangJDIHLatest != null)
                @if (
                    $tentang->verifikasiTentangJDIHLatest->aksi == 2 ||
                        $tentang->verifikasiTentangJDIHLatest->aksi == 4 ||
                        $tentang->verifikasiTentangJDIHLatest->aksi == 6 ||
                        $tentang->verifikasiTentangJDIHLatest->aksi == 5 ||
                        $tentang->verifikasiTentangJDIHLatest->aksi == 0)
                    @include('tentang.components.form', ['tentang' => $tentang])
                @else
                    @include('tentang.components.detail', ['tentang' => $tentang])
                @endif
            @else
                @include('tentang.components.form', ['tentang' => $tentang])
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        ClassicEditor
            .create(document.querySelector('#tentang_visi'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#tentang_misi'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#tentang_landasan'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#tentang_struktur'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#tentang_sop'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
