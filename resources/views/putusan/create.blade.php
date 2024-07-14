@extends('layouts.main')
@section('section-view')

<div class="mx-4 pt-3">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h2 class="m-0">Putusan Pengadilan</h2>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Putusan Pengadilan</li>
            </ol>
        </div><!-- /.col -->
    </div>
</div>

<div class="card shadow mx-4">
    <div class="card-body">
        <form action="/store-putusan" method="post" enctype="multipart/form-data">
            @csrf
    
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Judul Putusan</label>
                <textarea class="form-control" id="produk_judul" rows="2" name="produk_judul" placeholder="Judul Putusan"></textarea>
            </div>

            <div class="row">
                <div class="col mb-3">
                    <label class="form-label" for="produk_tema_id"><strong>Jenis/Bentuk Putusan</strong></label>
                    <div class="col">
                        <select class="form-control chzn-select" multiple="true" id="produk_tema_id" name="produk_tema_id[]" multiple required>
                            @foreach ($temas as $item)
                                <option value="{{ $item->tema_id }}">{{ $item->tema_deskripsi }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col mb-3">
                    <label class="form-label" for="produk_sumber"><strong>Sumber Putusan</strong></label>
                    <input class="form-control" type="text" id="produk_sumber" name="produk_sumber"
                        value="{{ old('produk_sumber') }}" placeholder="Sumber Putusan">
                    <span class="text-danger">@error('produk_sumber'){{ $message }}@enderror</span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="produk_jenis_id"><strong>Tipe Dokumen</strong></label>
                    <input class="form-control" type="text" value="{{ $jenis->jenis_tipedokumen }}" disabled>
                    <input class="form-control" type="text" id="produk_jenis_id" name="produk_jenis_id"
                        value="{{ $jenis->jenis_id }}" hidden>
                    <span class="text-danger">@error('produk_jenis_id'){{ $message }}@enderror</span>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label" for="produk_dibuat"><strong>Tanggal Dibacakan</strong></label>
                    <input class="form-control" type="date" id="produk_dibuat" name="produk_dibuat"
                        value="{{ old('produk_dibuat') }} ">
                    <span class="text-danger">@error('produk_dibuat'){{ $message }}@enderror</span>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label" for="produk_tgldiundangkan"><strong>Tanggal Diundangkan</strong></label>
                    <input class="form-control" type="date" id="produk_tgldiundangkan" name="produk_tgldiundangkan"
                        value="{{ old('produk_tgldiundangkan') }}">
                    <span class="text-danger">
                        @error('produk_tgldiundangkan')
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
                    <span class="text-danger">@error('produk_tajuk'){{ $message }}@enderror</span>
                </div>  

                <div class="col-md-3 mb-3">
                    <label class="form-label" for="produk_tempatterbit"><strong>Tempat Peradilan</strong></label>
                    <input class="form-control" type="text" id="produk_tempatterbit" name="produk_tempatterbit"
                        value="{{ old('produk_tempatterbit') }}" placeholder="mis : Jakarta">
                    <span class="text-danger">@error('produk_tempatterbit'){{ $message }}@enderror</span>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label" for="produk_bahasa"><strong>Bahasa</strong></label>
                    <input class="form-control" type="text" id="produk_bahasa" name="produk_bahasa"
                        value="{{ old('produk_bahasa') }}" placeholder="mis : Bahasa Indonesia">
                    <span class="text-danger">@error('produk_bahasa'){{ $message }}@enderror</span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="produk_nomor"><strong>Nomor Putusan</strong></label>
                    <input class="form-control" type="text" id="produk_nomor" name="produk_nomor"
                        value="{{ old('produk_nomor') }}" placeholder="Nomor Peraturan">
                    <span class="text-danger">@error('produk_nomor'){{ $message }}@enderror</span>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label" for="produk_lokasi"><strong>Lokasi</strong></label>
                    <input class="form-control" type="text" id="produk_lokasi" name="produk_lokasi"
                        value="{{ old('produk_lokasi') }}" placeholder="mis : Biro Hukum Kementrian Pertanian">
                    <span class="text-danger">@error('produk_lokasi'){{ $message }}@enderror</span>
                </div>
            </div>

            <div class="row">
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
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="produk_subjek"><strong>Subjek</strong></label>
                    <input class="form-control" type="text" id="produk_subjek" name="produk_subjek"
                        value="{{ old('produk_subjek') }}" placeholder="Subjek Peraturan">
                    <span class="text-danger">@error('produk_subjek'){{ $message }}@enderror</span>
                </div>

                <div class="col mb-3">
                    <label class="form-label" for="produk_statusberlaku"><strong>Status</strong></label>
                    <div class="col">
                        <select class="form-control" id="produk_statusberlaku" name="produk_statusberlaku" required>
                            <option value="">Pilih</option>
                            <option value="Tetap">Tetap</option>
                            <option value="Tidak Tetap">Tidak Tetap</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="card border-left border-danger shadow mb-3" >
                <div class="card-body text-left">
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Abstrak</label>
                        <textarea class="form-control" id="produk_abstrak" rows="10" name="produk_abstrak">
                            {{ old('produk_abstrak') }}
                        </textarea>
                        <span class="text-danger">@error('produk_abstrak'){{ $message }}@enderror</span>
                    </div>
                </div>
            </div>

            <div class="card border-left border-info shadow mb-3" >
                <div class="card-body text-left">
                    <div class="mb-3">
                        <label class="form-label" for="produk_dokumen"><strong>Dokumen</strong></label>
                        <input class="form-control" type="file" name="produk_dokumen">
                        <span class="text-danger">@error('produk_dokumen'){{ $message }}@enderror</span>
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
                    <a href="{{ route('putusan') }}"type="button" class="btn btn-outline-danger" style="width: 60%">Batal</a>
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
