@extends('layouts.main')
@section('section-view')

    <div class="mx-4 pt-3">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0">Infografis</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Infografis</li>
                </ol>
            </div>
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
        <div class="card-header py-3">
            <div class="row">
                <a href="/add-infografis" class="btn btn-primary btn-icon-split mx-3" role="button">
                    <span class="text-white">Tambah</span>
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table table-bordered my-0" id="dataTable">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Gambar</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($infografis as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->infografis_nama }}</td>
                                <td class="text-center">
                                    @if (is_null($item->infografis_gambar))
                                        -
                                    @else
                                        <img src="{{ asset('assets/' . $item->infografis_gambar) }}" class="card-img-top"
                                            alt="{{ $item->infografis_gambar }}" style="height: 7rem; width: 6rem;">
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('infografis.verifikasi.verifikasi', $item->infografis_id) }}"
                                            class="btn btn-primary btn-circle mx-1" role="button">Tinjau Peraturan</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-3">
                {{ $infografis->links() }}
            </div>
        </div>
    </div>

@endsection
