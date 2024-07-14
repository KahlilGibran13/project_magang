@extends('layouts.main')
@section('section-view')
    <div class="mx-4 pt-3">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0">Monografi Hukum</h2>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Monografi Hukum</li>
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
        <div class="card-header py-3">
            <div class="row">
                <a href="{{ url('/add-monografi') }}" class="btn btn-primary btn-icon-split mx-3" role="button">
                    <span class="text-white text">Tambah</span>
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Tajuk</th>
                            <th>Nomor Panggil</th>
                            <th>Subjek</th>
                            <th>Catatan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($monografis as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->produk_judul }}</td>
                                <td>{{ $item->produk_tajuk }}</td>
                                <td>{{ $item->produk_nomor }}</td>
                                <td>{{ $item->produk_subjek }}</td>
                                <td>
                                    @if ($item->verifikasiPeraturanLatest != null)
                                        {{ $item->verifikasiPeraturanLatest->catatan }}
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($item->verifikasiPeraturanLatest != null)
                                        @if ($item->verifikasiPeraturanLatest->aksi == 1 || $item->verifikasiPeraturanLatest->aksi == 3)
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('monografi.detail', $item->produk_id) }}"
                                                    class="btn btn-primary btn-circle mx-1" role="button">Detail</a>
                                                <form action="{{ route('verifikasi.tarik') }}" method="POST"
                                                    class="mx-1"
                                                    onsubmit="return confirm('Apakah kamu yakin untuk menarik ini?');">
                                                    @csrf
                                                    <input type="hidden" name="produk_id" value="{{ $item->produk_id }}">
                                                    <input type="hidden" name="verifikasi_id"
                                                        value="{{ $item->verifikasiPeraturanLatest->id }}">
                                                    <button type="submit" class="btn btn-danger btn-circle">Tarik</button>
                                                </form>
                                            </div>
                                        @elseif($item->verifikasiPeraturanLatest->aksi == 5)
                                            <div class="d-flex justify-content-center">
                                                <div class="btn btn-success btn-circle mx-1">Terverifikasi</div>
                                            </div>
                                        @else
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('edit-monografi', $item->produk_id) }}"
                                                    class="btn btn-info btn-circle mx-1" role="button">Edit</a>
                                                <form action="{{ route('delete-monografi', $item->produk_id) }}"
                                                    method="POST" class="mx-1"
                                                    onsubmit="return confirm('Apakah kamu yakin untuk menghapus ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-circle">Delete</button>
                                                </form>
                                                @if (auth()->user()->user_role_id == '1')
                                                    <form action="{{ route('verifikasi.send') }}" method="POST"
                                                        class="mx-1"
                                                        onsubmit="return confirm('Apakah kamu yakin untuk mengirim ini?');">
                                                        @csrf
                                                        <input type="hidden" name="produk_id"
                                                            value="{{ $item->produk_id }}">
                                                        <input type="hidden" name="verifikasi_id"
                                                            value="{{ $item->verifikasiPeraturanLatest->id }}">
                                                        <button type="submit"
                                                            class="btn btn-success btn-circle">Kirim</button>
                                                    </form>
                                                @endif
                                            </div>
                                        @endif
                                    @else
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('edit-monografi', $item->produk_id) }}"
                                                class="btn btn-info btn-circle mx-1" role="button">Edit</a>
                                            <form action="{{ route('delete-monografi', $item->produk_id) }}" method="POST"
                                                class="mx-1"
                                                onsubmit="return confirm('Apakah kamu yakin untuk menghapus ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-circle">Delete</button>
                                            </form>
                                            @if (auth()->user()->user_role_id == '1')
                                                <form action="{{ route('verifikasi.send') }}" method="POST" class="mx-1"
                                                    onsubmit="return confirm('Apakah kamu yakin untuk mengirim ini?');">
                                                    @csrf
                                                    <input type="hidden" name="produk_id" value="{{ $item->produk_id }}">
                                                    <input type="hidden" name="verifikasi_id" value="{{ false }}">
                                                    <button type="submit" class="btn btn-success btn-circle">Kirim</button>
                                                </form>
                                            @endif
                                        </div>
                                    @endif
                                    {{-- <a href="{{ route('edit-monografi', $item->produk_id) }}"
                                        class="btn btn-info btn-circle mx-1" role="button">Edit</a>
                                    <form action="{{ route('delete-monografi', $item->produk_id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Anda yakin ingin menghapus item ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-circle mx-1">Hapus</button>
                                    </form> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            <div class="d-flex justify-content-end">
                {{ $monografis->links() }}
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        /* Tambahkan garis antar baris untuk tampilan lebih rapi */
        .table-bordered,
        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6;
        }
    </style>
@endsection
