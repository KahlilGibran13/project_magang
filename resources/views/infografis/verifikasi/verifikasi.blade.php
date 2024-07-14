@extends('layouts.main')
@section('section-view')
    <div class="mx-4 pt-3">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0">Infografis</h2>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Infografis</li>
                </ol>
            </div><!-- /.col -->
        </div>
    </div>

    <div class="card border border-info shadow mx-4">
        <div class="card-body">
            <form action="/update-infografis/{{ $infografis->infografis_id }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label" for="infografis_nama"><strong>Nama Infografis</strong></label>
                    <input disabled class="form-control" type="text" id="infografis_nama" name="infografis_nama"
                        value="{{ old('infografis_nama', $infografis->infografis_nama) }} ">
                    <span class="text-danger">
                        @error('infografis_nama')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="card border-top border-primary shadow mb-3">
                    <div class="card-body text-center">
                        @if ($infografis->infografis_gambar == null)
                            <td>{{ $infografis->infografis_nama }}</td>
                        @else
                            <img src="{{ asset('assets/' . $infografis->infografis_gambar) }}"
                                class="card-img-top border border-dark" alt="{{ $infografis->infografis_gambar }}"
                                style="height: 10rem; width: 8rem">
                        @endif
                    </div>
                </div>

                <br>

            </form>

            <hr>
            <h5 class="w-100">Verifikasi</h5>
            <form action="{{ route('infografis.verifikasi.index') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="page" value="infografis.verifikasi.index">
                <input type="hidden" name="infografis_id" value="{{ $infografis->infografis_id }}">
                <input type="hidden" name="verifikasi_id" value="{{ $infografis->verifikasiInfografisLatest->id }}">
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
                <div class="d-flex justify-content-center" style="gap: 4px">
                    <a href="{{ route('infografis.verifikasi.index') }}" class="btn btn-danger" style="width: 60%">Kembali</a>
                    <button type="submit" class="btn btn-success" style="width: 60%">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
