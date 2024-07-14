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

<div class="card shadow mx-4">
    <div class="card-body">
        <form action="/store-infografis" method="post" enctype="multipart/form-data">
            @csrf
    
            <div class="mb-3">
                <label class="form-label" for="infografis_nama"><strong>Nama Infografis</strong></label>
                <input class="form-control" type="text" id="infografis_nama" name="infografis_nama"
                    value="{{ old('infografis_nama') }} ">
                <span class="text-danger">@error('infografis_nama'){{ $message }}@enderror</span>
            </div>
    
            <div class="mb-3">
                <label class="form-label" for="infografis_gambar"><strong>Infografis</strong></label>
                <input class="form-control" type="file" name="infografis_gambar">
                <span class="text-danger">@error('infografis_gambar'){{ $message }}@enderror</span>
            </div>
            <br>
    
            <div class="row">
                <div class="col text-right my-2 mx-4">
                    <a href="/infografis "type="button" class="btn btn-outline-danger" style="width: 60%">Batal</a>
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
