@extends('layouts.main')
@section('section-view')
    <div class="mx-4 pt-3">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0">Peraturan</h2>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Peraturan</li>
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
                <a href="/add-peraturan" class="btn btn-primary btn-icon-split mx-3 d-inline-block" role="button">
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
                            <th>Nomor</th>
                            <th>Lokasi</th>
                            <th>Tahun</th>
                            <th>Status</th>
                            <th>Catatan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($peraturans->items() as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->produk_judul }}</td>
                                <td>{{ $item->produk_nomor }}</td>
                                <td>{{ $item->produk_lokasi }}</td>
                                <td>{{ $item->produk_tahun }}</td>
                                <td>{{ $item->produk_statusberlaku }}</td>

                                <td>
                                    @if ($item->verifikasiPeraturanLatest != null)
                                        {{ $item->verifikasiPeraturanLatest->catatan }}
                                    @endif
                                </td>

                                <td class="text-center">
                                    @if ($item->verifikasiPeraturanLatest != null)
                                        @if ($item->verifikasiPeraturanLatest->aksi == 1 || $item->verifikasiPeraturanLatest->aksi == 3)
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('peraturan.detail', $item->produk_id) }}"
                                                    class="btn btn-primary btn-circle mx-1" role="button">Detail</a>
                                                <form action="{{ route('verifikasi.tarik') }}" method="POST" class="mx-1"
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
                                                <a href="/edit-peraturan/{{ $item->produk_id }}"
                                                    class="btn btn-info btn-circle mx-1" role="button">Edit</a>
                                                <form action="{{ route('peraturan.destroy', $item->produk_id) }}"
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
                                            <a href="/edit-peraturan/{{ $item->produk_id }}"
                                                class="btn btn-info btn-circle mx-1" role="button">Edit</a>
                                            <form action="{{ route('peraturan.destroy', $item->produk_id) }}"
                                                method="POST" class="mx-1"
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
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            <div class="d-flex justify-content-end">
                {{ $peraturans->links() }}
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

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
@endsection
