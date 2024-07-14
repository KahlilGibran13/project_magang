@extends('layouts.main')
@section('section-view')
    <div class="mx-4 pt-3">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0">Verifikasi</h2>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Verifikasi</li>
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

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Peraturan</th>
                            <th>Catatan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($produks->items() as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->produk_judul }}</td>
                                <td>{{ $item->verifikasiPeraturanLatest->catatan }}</td>

                                <td class="text-center">
                                    @can('operator')
                                        @if ($item->produk_jenis_id == 1)
                                            @include('verifikasi.components.aksi.peraturan', [
                                                'item' => $item,
                                            ])
                                        @endif
                                        @if ($item->produk_jenis_id == 2)
                                            @include('verifikasi.components.aksi.putusan', [
                                                'item' => $item,
                                            ])
                                        @endif
                                        @if ($item->produk_jenis_id == 3)
                                            @include('verifikasi.components.aksi.monografi', [
                                                'item' => $item,
                                            ])
                                        @endif
                                        @if ($item->produk_jenis_id == 4)
                                            @include('verifikasi.components.aksi.artikel', [
                                                'item' => $item,
                                            ])
                                        @endif
                                    @else
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('verifikasi.verifikasi', $item->produk_id) }}"
                                                class="btn btn-primary btn-circle mx-1" role="button">Tinjau Peraturan</a>
                                        </div>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            <div class="d-flex justify-content-end">
                {{ $produks->links() }}
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
@endsection
