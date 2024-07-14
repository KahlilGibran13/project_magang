@extends('layouts.main')

@section('section-view')
    <div class="mx-4 pt-3">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0">Link Terkait</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Link Terkait</li>
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
                <a href="/add-linkterkait" class="btn btn-primary btn-icon-split mx-3" role="button">
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
                            <th>Logo</th>
                            <th>Instansi</th>
                            <th>Link</th>
                            <th>Catatan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($linkterkaits as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td class="text-center">
                                    @if (is_null($item->link_logo))
                                        -
                                    @else
                                        <img src="{{ asset('assets/' . $item->link_logo) }}" class="card-img-top"
                                            alt="{{ $item->link_logo }}" style="height: 6rem; width: 6rem;">
                                    @endif
                                </td>
                                <td>{{ $item->link_instansi }}</td>
                                <td><a href="{{ $item->link_url }}" target="_blank">{{ $item->link_url }}</a></td>
                                <td>
                                    @if ($item->verifikasiLinkTerkaitLatest != null)
                                        {{ $item->verifikasiLinkTerkaitLatest->catatan }}
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($item->verifikasiLinkTerkaitLatest != null)
                                        @if ($item->verifikasiLinkTerkaitLatest->aksi == 1 || $item->verifikasiLinkTerkaitLatest->aksi == 3)
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('linkterkait.detail', $item->link_id) }}"
                                                    class="btn btn-primary btn-circle mx-1" role="button">Detail</a>
                                                <form action="{{ route('link.verifikasi.tarik') }}" method="POST" class="mx-1"
                                                    onsubmit="return confirm('Apakah kamu yakin untuk menarik ini?');">
                                                    @csrf
                                                    <input type="hidden" name="link_id" value="{{ $item->link_id }}">
                                                    <input type="hidden" name="verifikasi_id"
                                                        value="{{ $item->verifikasiLinkTerkaitLatest->id }}">
                                                    <button type="submit" class="btn btn-danger btn-circle">Tarik</button>
                                                </form>
                                            </div>
                                        @elseif($item->verifikasiLinkTerkaitLatest->aksi == 5)
                                            <div class="d-flex justify-content-center">
                                                <div class="btn btn-success btn-circle mx-1">Terverifikasi</div>
                                            </div>
                                        @else
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('edit-linkterkait/{id}', $item->link_id) }}"
                                                    class="btn btn-info btn-circle mx-1" role="button">Edit</a>
                                                <form action="{{ route('linkterkait.destroy', $item->link_id) }}"
                                                    method="POST" class="mx-1"
                                                    onsubmit="return confirm('Apakah kamu yakin untuk menghapus ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-circle">Delete</button>
                                                </form>
                                                @if (auth()->user()->user_role_id == '1')
                                                    <form action="{{ route('link.verifikasi.send') }}" method="POST"
                                                        class="mx-1"
                                                        onsubmit="return confirm('Apakah kamu yakin untuk mengirim ini?');">
                                                        @csrf
                                                        <input type="hidden" name="link_id"
                                                            value="{{ $item->link_id }}">
                                                        <input type="hidden" name="verifikasi_id"
                                                            value="{{ $item->verifikasiLinkTerkaitLatest->id }}">
                                                        <button type="submit"
                                                            class="btn btn-success btn-circle">Kirim</button>
                                                    </form>
                                                @endif
                                            </div>
                                        @endif
                                    @else
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('edit-linkterkait/{id}', $item->link_id) }}"
                                                class="btn btn-info btn-circle mx-1" role="button">Edit</a>
                                            <form action="{{ route('linkterkait.destroy', $item->link_id) }}" method="POST"
                                                class="mx-1"
                                                onsubmit="return confirm('Apakah kamu yakin untuk menghapus ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-circle">Delete</button>
                                            </form>
                                            @if (auth()->user()->user_role_id == '1')
                                                <form action="{{ route('link.verifikasi.send') }}" method="POST" class="mx-1"
                                                    onsubmit="return confirm('Apakah kamu yakin untuk mengirim ini?');">
                                                    @csrf
                                                    <input type="hidden" name="link_id" value="{{ $item->link_id }}">
                                                    <input type="hidden" name="verifikasi_id" value="{{ false }}">
                                                    <button type="submit" class="btn btn-success btn-circle">Kirim</button>
                                                </form>
                                            @endif
                                        </div>
                                    @endif
                                    {{-- <a href="/edit-linkterkait/{{ $item->link_id }}" class="btn btn-info btn-circle ms-1" role="button">Edit</a>
                            <form action="{{ route('linkterkait.destroy', $item->link_id) }}" method="POST" onsubmit="return confirm('Anda Yakin Mau Menghapus ini?');" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-circle ms-1">Delete</button>
                            </form> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-3">
                {{ $linkterkaits->links() }}
            </div>
        </div>
    </div>
@endsection
