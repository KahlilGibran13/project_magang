@extends('layouts.main')
@section('section-view')

    <div class="mx-4 pt-3">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0">Artikel Hukum</h2>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Artikel Hukum</li>
                </ol>
            </div><!-- /.col -->
        </div>
    </div>

    <div class="card shadow border border-info mx-4">
        <div class="card-header py-3">
            <div class="row">
                <a href="/add-artikel" class="btn btn-primary btn-icon-split mx-3" role="button">
                    <span class="text-white text">Tambah</span>
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0" id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Tajuk</th>
                            <th>Bidang</th>
                            <th>Subjek</th>
                            <th>Catatan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($artikels as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->produk_judul }}</td>
                                <td>{{ $item->produk_tajuk }}</td>
                                <td>{{ $item->produk_bidanghukum }}</td>
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
                                                <a href="{{ route('artikel.detail', $item->produk_id) }}"
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
                                                <a href="{{ route('edit-artikel', $item->produk_id) }}"
                                                    class="btn btn-info btn-circle mx-1" role="button">Edit</a>
                                                <form action="{{ route('delete-artikel', $item->produk_id) }}"
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
                                            <a href="{{ route('edit-artikel', $item->produk_id) }}"
                                                class="btn btn-info btn-circle mx-1" role="button">Edit</a>
                                            <form action="{{ route('delete-artikel', $item->produk_id) }}" method="POST"
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
                                    {{-- <a href="/edit-artikel/{{ $item->produk_id }}" class="btn btn-info btn-circle ms-1"
                                role="button">Edit</a> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            <div class="col">
                <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                    {{ $artikels->links() }}
                </nav>
            </div>
        </div>
    </div>

@endsection
