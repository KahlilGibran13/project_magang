@extends('layouts.main')
@section('section-view')
    <div class="mx-4 pt-3">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0">Verifikasi Tentang Kami</h2>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Verifikasi Tentang Kami</li>
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
                    <h5 class="w-100">Profil JDIH</h5>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                </div>
            </div>
        </div>

        <div class="card-body">
            @if ($tentang)
                @include('tentang.components.detail', ['tentang' => $tentang])
                <hr>
                <h5 class="w-100">Verifikasi</h5>
                <form action="{{ route('tentang.verifikasi.index') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="page" value="tentang.verifikasi.index">
                    <input type="hidden" name="tentang_id" value="{{ $tentang->tentang_id }}">
                    <input type="hidden" name="verifikasi_id" value="{{ $tentang->verifikasiTentangJDIHLatest->id }}">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="produk_judul" class="form-label">Catatan</label>
                            <textarea class="form-control" id="catatan" rows="2" name="catatan" placeholder="Catatan"></textarea>
                        </div>
                        <div class="col mb-3">
                            <label for="aksi" class="form-label">Aksi</label>
                            <select class="form-control" name="aksi" id="aksi" required>
                                <option value="">pilih</option>
                                <option value="1">Setuju</option>
                                <option value="2">Tolak</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success" style="width: 60%">Simpan</button>
                    </div>
                </form>
            @else
                <div class="alert alert-warning" role="alert">
                    Data kosong
                </div>
            @endif
        </div>
    </div>
@endsection
