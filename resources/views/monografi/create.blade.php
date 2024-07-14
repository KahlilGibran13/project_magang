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

    <div class="card shadow mx-4">
        <div class="card-body">
            <form action="/store-monografi" method="post" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Judul Monografi</label>
                    <textarea class="form-control" id="produk_judul" rows="2" name="produk_judul" placeholder="Judul Monografi"></textarea>
                </div>

                <div class="row">
                    <div class="col mb-3">
                        <label class="form-label" for="produk_tema_id"><strong>Jenis/Bentuk Dokumen</strong></label>
                        <div class="col">
                            <select class="form-control chzn-select" multiple="true" id="produk_tema_id"
                                name="produk_tema_id[]" multiple required>
                                {{-- <option value="">Pilih</option> --}}
                                @foreach ($temas as $item)
                                    <option value="{{ $item->tema_id }}">{{ $item->tema_deskripsi }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md mb-3">
                        <label class="form-label" for="produk_bidanghukum"><strong>Bidang Hukum</strong></label>
                        <input class="form-control" type="text" id="produk_bidanghukum" name="produk_bidanghukum"
                            value="{{ old('produk_bidanghukum') }}" placeholder="mis : Hukum Administrasi Negara">
                        <span class="text-danger">
                            @error('produk_bidanghukum')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="produk_jenis_id"><strong>Tipe Dokumen</strong></label>
                        <input class="form-control" type="text" value="{{ $jenis->jenis_tipedokumen }}" disabled>
                        <input class="form-control" type="text" id="produk_jenis_id" name="produk_jenis_id"
                            value="{{ $jenis->jenis_id }}" hidden>
                        <span class="text-danger">
                            @error('produk_jenis_id')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>


                    <div class="col mb-3">
                        <label class="form-label" for="produk_deskripsifisik"><strong>Deskripsi Fisik</strong></label>
                        <input class="form-control" type="text" id="produk_deskripsifisik" name="produk_deskripsifisik"
                            value="{{ old('produk_deskripsifisik') }}" placeholder="Deskripsi Fisik">
                        <span class="text-danger">
                            @error('produk_deskripsifisik')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="produk_tajuk"><strong>Tajuk Entri Utama</strong></label>
                        <input class="form-control" type="text" id="produk_tajuk" name="produk_tajuk"
                            value="{{ old('produk_tajuk') }} ">
                        <span class="text-danger">
                            @error('produk_tajuk')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="produk_dibuat"><strong>Tanggal Terbit</strong></label>
                        <input class="form-control" type="date" id="produk_dibuat" name="produk_dibuat"
                            value="{{ old('produk_dibuat') }} ">
                        <span class="text-danger">
                            @error('produk_dibuat')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="produk_penerbit"><strong>Penerbit</strong></label>
                        <input class="form-control" type="text" id="produk_penerbit" name="produk_penerbit"
                            value="{{ old('produk_penerbit') }} ">
                        <span class="text-danger">
                            @error('produk_penerbit')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="produk_nomor"><strong>Nomor Panggil</strong></label>
                        <input class="form-control" type="text" id="produk_nomor" name="produk_nomor"
                            value="{{ old('produk_nomor') }}" placeholder="Nomor Peraturan">
                        <span class="text-danger">
                            @error('produk_nomor')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="produk_tempatterbit"><strong>Tempat Terbit</strong></label>
                        <input class="form-control" type="text" id="produk_tempatterbit" name="produk_tempatterbit"
                            value="{{ old('produk_tempatterbit') }}" placeholder="mis : Jakarta">
                        <span class="text-danger">
                            @error('produk_tempatterbit')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="produk_bahasa"><strong>Bahasa</strong></label>
                        <input class="form-control" type="text" id="produk_bahasa" name="produk_bahasa"
                            value="{{ old('produk_bahasa') }}" placeholder="mis : Bahasa Indonesia">
                        <span class="text-danger">
                            @error('produk_bahasa')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>

                {{-- <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label" for="produk_singkatan"><strong>Singkatan Jenis Peradilan</strong></label>
                <input class="form-control" type="text" id="produk_singkatan" name="produk_singkatan"
                    value="{{ old('produk_singkatan') }}" placeholder="Singkatan, mis : permentan kepmentan">
                <span class="text-danger">@error('produk_singkatan'){{ $message }}@enderror</span>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label" for="produk_bidanghukum"><strong>Bidang Hukum/Jenis Perkara</strong></label>
                <input class="form-control" type="text" id="produk_bidanghukum" name="produk_bidanghukum"
                    value="{{ old('produk_bidanghukum') }}" placeholder="mis : Hukum Administrasi Negara">
                <span class="text-danger">@error('produk_bidanghukum'){{ $message }}@enderror</span>
            </div>
        </div> --}}

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="produk_subjek"><strong>Subjek</strong></label>
                        <input class="form-control" type="text" id="produk_subjek" name="produk_subjek"
                            value="{{ old('produk_subjek') }}" placeholder="Subjek Peraturan">
                        <span class="text-danger">
                            @error('produk_subjek')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="produk_lokasi"><strong>Lokasi</strong></label>
                        <input class="form-control" type="text" id="produk_lokasi" name="produk_lokasi"
                            value="{{ old('produk_lokasi') }}" placeholder="mis : Biro Hukum Kementrian Pertanian">
                        <span class="text-danger">
                            @error('produk_lokasi')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="produk_nomor"><strong>No Induk Buku</strong></label>
                        <input class="form-control" type="text" id="produk_nomor" name="produk_nomor"
                            value="{{ old('produk_nomor') }}" placeholder="No Induk Buku">
                        <span class="text-danger">
                            @error('produk_nomor')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="produk_cetakan"><strong>Cetakan/Edisi</strong></label>
                        <input class="form-control" type="text" id="produk_cetakan" name="produk_cetakan"
                            value="{{ old('produk_cetakan') }}" placeholder="Cetakan/Edisi">
                        <span class="text-danger">
                            @error('produk_cetakan')
                                {{ $message }}
                            @enderror
                        </span>

                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="produk_isbn"><strong>ISBN</strong></label>
                        <input class="form-control" type="text" id="produk_isbn" name="produk_isbn"
                            value="{{ old('produk_isbn') }}" placeholder="Nomor ISBN">
                        <span class="text-danger">
                            @error('produk_isbn')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                </div>

                <div class="card border-left border-danger shadow mb-3">
                    <div class="card-body text-left">
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Abstrak</label>
                            <textarea class="form-control" id="produk_abstrak" rows="10" name="produk_abstrak"></textarea>
                            <span class="text-danger">
                                @error('produk_abstrak')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card border-left border-info shadow mb-3">
                    <div class="card-body text-left">
                        <div class="mb-3">
                            <label class="form-label" for="produk_dokumen"><strong>Dokumen</strong></label>
                            <input class="form-control" type="file" name="produk_dokumen">
                            <span class="text-danger">
                                @error('produk_dokumen')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>

                {{-- can't null --}}
                <input class="form-control" type="text" name="produk_ttd" value="-" hidden>
                <input class="form-control" type="text" name="produk_pemrakarsa" value="-" hidden>
                <input class="form-control" type="text" name="produk_terkait" value="-" hidden>
                <input class="form-control" type="text" name="produk_keyword" value="-" hidden>
                <input class="form-control" type="text" name="produk_abstraks" value="-" hidden>
                {{-- <input class="form-control" type="text" name="produk_date" value="0000-00-00" hidden> --}}
                <br>

                <div class="row">
                    <div class="col text-right my-2 mx-4">
                        <a href="{{ route('monografi') }}"type="button" class="btn btn-outline-danger"
                            style="width: 60%">Batal</a>
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
@section('scripts')
    <script type="text/javascript">
        $(function() {
            $(".chzn-select").chosen();
        });
    </script>
@endsection
