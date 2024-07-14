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


@if ($infografis->verifikasiInfografisLatest != null)
<div class="card mx-4">
    <div class="card-body">
        <div class="">
            <label for="produk_judul" class="form-label">Catatan Perbaikan</label>
            <textarea class="form-control" id="produk_judul" rows="2" disabled>{{ $infografis->verifikasiInfografisLatest->catatan }}</textarea>
        </div>
    </div>
</div>
@endif

<div class="card border border-info shadow mx-4">
    <div class="card-body">
        <form action="/update-infografis/{{ $infografis->infografis_id }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label" for="infografis_nama"><strong>Nama Infografis</strong></label>
                <input class="form-control" type="text" id="infografis_nama" name="infografis_nama"
                    value="{{ old('infografis_nama', $infografis->infografis_nama) }} ">
                <span class="text-danger">@error('infografis_nama'){{ $message }}@enderror</span>
            </div>

            <div class="card border-top border-primary shadow mb-3" >
                <div class="card-body text-center">
                    @if ($infografis->infografis_gambar == NULL)
                        <td>{{ $infografis->infografis_nama }}</td>
                    @else
                        <img src="{{ asset('assets/'.$infografis->infografis_gambar) }}" class="card-img-top border border-dark" alt="{{ $infografis->infografis_gambar }}"
                        style="height: 10rem; width: 8rem">
                    @endif
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label" for="infografis_gambar"><strong>Infografis</strong></label>
                <input class="form-control" type="file" name="infografis_gambar">
                <span class="text-danger">@error('infografis_gambar'){{ $message }}@enderror</span>
            </div>
            <br>

            <div class="row">
                <div class="col text-right my-2 mx-4">
                    <a href="/infografis " type="button" class="btn btn-outline-danger" style="width: 60%">Batal</a>
                </div>
                <div class="col my-2 mx-4">
                    <button type="submit" class="btn btn-success" name="tambah" style="width: 60%">Simpan</button>
                </div>
            </div>

            <br>

        </form>
    </div>
</div>

@endsection
