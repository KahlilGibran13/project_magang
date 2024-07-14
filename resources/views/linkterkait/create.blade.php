@extends('layouts.main')
@section('section-view')

<div class="mx-4 pt-3">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h2 class="m-0">Link Terkait</h2>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Link Terkait</li>
            </ol>
        </div><!-- /.col -->
    </div>
</div>

<div class="card shadow mx-4">
    <div class="card-body">
        <form action="/store-linkterkait" method="post" enctype="multipart/form-data">
            @csrf
    
            <div class="mb-3">
                <label class="form-label" for="link_instansi"><strong>Nama Instansi</strong></label>
                <input class="form-control" type="text" id="link_instansi" name="link_instansi"
                    value="{{ old('link_instansi') }} ">
                <span class="text-danger">@error('link_instansi'){{ $message }}@enderror</span>
            </div>

            <div class="mb-3">
                <label class="form-label" for="link_url"><strong>Link Tautan</strong></label>
                <input class="form-control" type="text" id="link_url" name="link_url"
                    value="{{ old('link_url') }} ">
                <span class="text-danger">@error('link_url'){{ $message }}@enderror</span>
            </div>
    
            <div class="mb-3">
                <label class="form-label" for="link_logo"><strong>Logo</strong></label>
                <input class="form-control" type="file" name="link_logo">
                <span class="text-danger">@error('link_logo'){{ $message }}@enderror</span>
            </div>
            <br>
    
            <div class="row">
                <div class="col text-right my-2 mx-4">
                    <a href="/linkterkait "type="button" class="btn btn-outline-danger" style="width: 60%">Batal</a>
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
