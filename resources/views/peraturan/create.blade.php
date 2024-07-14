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

<div class="card shadow mx-4">
    <div class="card-body">
        <form action="/store-peraturan" method="post" enctype="multipart/form-data">
            @csrf
    
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Judul Peraturan</label>
                <textarea class="form-control" id="produk_judul" rows="2" name="produk_judul" placeholder="Contoh: Peraturan Menteri Pertanian Nomor 1b"></textarea>
                <label for=""><small>Format judul : Huruf Kapital di setiap awal kata saja</small></label>
            </div>

            <div class="row">
                <div class="col mb-3">
                    <label class="form-label" for="produk_cluster"><strong>Tematik Peraturan</strong></label>
                    <div class="col">
                        <select class="form-control chzn-select" multiple="true" id="produk_cluster" name="produk_cluster[]" multiple="" required>
                            <option value="">Pilih</option>
                            @foreach ($clusters as $item)
                                <option value="{{ $item->cluster_id }}">{{ $item->cluster_nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col mb-3">
                    <label class="form-label" for="produk_sumber"><strong>Sumber Peraturan</strong></label>
                    <input class="form-control" type="text" id="produk_sumber" name="produk_sumber"
                        value="{{ old('produk_sumber') }}" placeholder="Sumber Peraturan">
                    <span class="text-danger">@error('produk_sumber'){{ $message }}@enderror</span>
                </div>
            </div>

            <div class="row">
                <div class="col mb-3">
                    <label class="form-label" for="produk_tema_id"><strong>Jenis/Bentuk Peraturan</strong></label>
                    <div class="col">
                        <select class="form-control chzn-select" multiple="true" name="produk_tema_id[]" multiple required>
                            <option value="">Pilih</option>
                            @foreach ($temas as $item)
                                <option value="{{ $item->tema_id }}">{{ $item->tema_deskripsi }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label" for="produk_tahun"><strong>Tahun Peraturan</strong></label>
                    <input class="form-control" type="text" id="produk_tahun" name="produk_tahun"
                        value="{{ old('produk_tahun') }}" placeholder="Tahun Peraturan">
                    <span class="text-danger">@error('produk_tahun'){{ $message }}@enderror</span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="produk_jenis_id"><strong>Tipe Dokumen</strong></label>
                    <input class="form-control" type="text" value="{{ $jenis->jenis_tipedokumen }}" >
                    <input class="form-control" type="text" id="produk_jenis_id" name="produk_jenis_id"
                        value="{{ $jenis->jenis_id }}" hidden>
                    <span class="text-danger">@error('produk_jenis_id'){{ $message }}@enderror</span>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label" for="produk_tglterbit"><strong>Tanggal Ditetapkan</strong></label>
                    <input class="form-control" type="date" id="produk_tglterbit" name="produk_tglterbit"
                        value="{{ old('produk_tglterbit') }} ">
                    <span class="text-danger">@error('produk_tglterbit'){{ $message }}@enderror</span>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label" for="produk_tgldiundangkan"><strong>Tanggal Diundangkan</strong></label>
                    <input class="form-control" type="date" id="produk_tgldiundangkan" name="produk_tgldiundangkan"
                        value="{{ old('produk_tgldiundangkan') }} ">
                    <span class="text-danger">@error('produk_tgldiundangkan'){{ $message }}@enderror</span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="produk_tajuk"><strong>Tajuk Entri Utama</strong></label>
                    <input class="form-control" type="text" id="produk_tajuk" name="produk_tajuk"
                        value="{{ old('produk_tajuk') }}" placeholder="Tajuk Peraturan">
                    <span class="text-danger">@error('produk_tajuk'){{ $message }}@enderror</span>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label" for="produk_tempatterbit"><strong>Tempat Penetapan</strong></label>
                    <input class="form-control" type="text" id="produk_tempatterbit" name="produk_tempatterbit"
                        value="{{ old('produk_tempatterbit') }}" placeholder="mis : Jakarta">
                    <span class="text-danger">@error('produk_tempatterbit'){{ $message }}@enderror</span>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label" for="produk_pemrakarsa"><strong>Pemrakarsa</strong></label>
                    <input class="form-control" type="text" id="produk_pemrakarsa" name="produk_pemrakarsa"
                        value="{{ old('produk_pemrakarsa') }}" placeholder="">
                    <span class="text-danger">@error('produk_pemrakarsa'){{ $message }}@enderror</span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="produk_nomor"><strong>Nomor Peraturan</strong></label>
                    <input class="form-control" type="text" id="produk_nomor" name="produk_nomor"
                        value="{{ old('produk_nomor') }}" placeholder="Nomor Peraturan">
                    <span class="text-danger">@error('produk_nomor'){{ $message }}@enderror</span>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label" for="produk_ttd"><strong>Penandatangan</strong></label>
                    <input class="form-control" type="text" id="produk_ttd" name="produk_ttd"
                        value="{{ old('produk_ttd') }}" placeholder="">
                        <label for=""><small>Hanya nama, tanpa gelar</small></label>
                    <span class="text-danger">@error('produk_ttd'){{ $message }}@enderror</span>
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
                    <label class="form-label" for="produk_singkatan"><strong>Singkatan Jenis/Bentuk Peraturan*</strong></label>
                    <input class="form-control" type="text" id="produk_singkatan" name="produk_singkatan"
                        value="{{ old('produk_singkatan') }}" placeholder="Singkatan, mis : permentan kepmentan">
                    <span class="text-danger">@error('produk_singkatan'){{ $message }}@enderror</span>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label" for="produk_lokasi"><strong>Lokasi</strong></label>
                    <input class="form-control" type="text" id="produk_lokasi" name="produk_lokasi"
                        value="{{ old('produk_lokasi') }}" placeholder="Lokasi">
                    <span class="text-danger">@error('produk_lokasi'){{ $message }}@enderror</span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="produk_subjek"><strong>Subjek</strong></label>
                    <input class="form-control" type="text" id="produk_subjek" name="produk_subjek"
                        value="{{ old('produk_subjek') }}" placeholder="Subjek Peraturan">
                    <span class="text-danger">@error('produk_subjek'){{ $message }}@enderror</span>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="produk_bidanghukum"><strong>Bidang Hukum</strong></label>
                    <input class="form-control" type="text" id="produk_bidanghukum" name="produk_bidanghukum"
                        value="{{ old('produk_bidanghukum') }}" placeholder="mis : Hukum Administrasi Negara">
                    <span class="text-danger">@error('produk_bidanghukum'){{ $message }}@enderror</span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="produk_terkait"><strong>Peraturan Terkait: Melaksanakan:</strong></label>
                    <input class="form-control" type="text" id="produk_terkait" name="produk_terkait"
                        value="{{ old('produk_terkait') }}" placeholder="">
                    <span class="text-danger">@error('produk_terkait'){{ $message }}@enderror</span>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="produk_statusberlaku"><strong>Status</strong></label>
                    <div class="col">
                        <select class="form-control" id="produk_statusberlaku" name="produk_statusberlaku" required>
                            <option value="">Pilih</option>
                            <option value="berlaku">berlaku</option>
                            <option value="Dicabut">Dicabut</option>
                            <option value="Diubah">Diubah</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md mb-3">
                    <label class="form-label" for="produk_keyword"><strong>Keyword Pencarian</strong></label>
                    <input class="form-control" type="text" id="produk_keyword" name="produk_keyword"
                        value="{{ old('produk_keyword') }}" placeholder="">
                    <span class="text-danger">@error('produk_keyword'){{ $message }}@enderror</span>
                </div>
            </div>

            
            <div class="card border-left border-danger shadow mb-3" >
                <div class="card-body text-left">
                    <div class="col-md mb-3">
                        <h4>Status Peraturan</h4>
                        <label class="form-label" for="produk_diubah"><strong>Diubah</strong></label>
                         <select class="form-control chzn-select" multiple="true" id="produk_diubah" name="produk_diubah">
                            <option value="">Pilih</option>
                            @foreach ($produks as $item)
                                <option value="{{ $item->produk_id }}" {{ old('produk_diubah') == $item->produk_id ? 'selected' : '' }}>
                                    {{ $item->produk_judul }}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-danger">@error('produk_diubah'){{ $message }}@enderror</span>
                    </div>                 
                    <div class="col-md mb-3">
                        <label class="form-label" for="produk_mengubah"><strong>Mengubah</strong></label>
                         <select class="form-control chzn-select" multiple="true" id="produk_mengubah" name="produk_mengubah">
                            <option value="">Pilih</option>
                            @foreach ($produks as $item)
                                <option value="{{ $item->produk_id }}" {{ old('produk_mengubah') == $item->produk_id ? 'selected' : '' }}>
                                    {{ $item->produk_judul }}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-danger">@error('produk_mengubah'){{ $message }}@enderror</span>
                    </div>
                    <div class="col-md mb-3">
                        <label class="form-label" for="produk_dicabut"><strong>Dicabut</strong></label>
                         <select class="form-control chzn-select" multiple="true" id="produk_dicabut" name="produk_dicabut">
                            <option value="">Pilih</option>
                            @foreach ($produks as $item)
                                <option value="{{ $item->produk_id }}" {{ old('produk_dicabut') == $item->produk_id ? 'selected' : '' }}>
                                    {{ $item->produk_judul }}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-danger">@error('produk_dicabut'){{ $message }}@enderror</span>
                    </div>
                    <div class="col-md mb-3">
                        <label class="form-label" for="produk_mencabut"><strong>Mencabut</strong></label>
                        <select class="form-control chzn-select" multiple="true"  id="produk_mencabut" name="produk_mencabut">
                            <option value="">Pilih</option>
                            @foreach ($produks as $item)
                                <option value="{{ $item->produk_id }}" {{ old('produk_mencabut') == $item->produk_id ? 'selected' : '' }}>
                                    {{ $item->produk_judul }}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-danger">@error('produk_mencabut'){{ $message }}@enderror</span>
                    </div>
                       
                    {{-- <div class="col-md mb-3">
                        <label class="form-label" for="produk_diubah"><strong>Diubah</strong></label>
                        <input class="form-control" type="text" id="produk_diubah" name="produk_diubah"
                            value="{{ old('produk_diubah') }}" placeholder="">
                        <span class="text-danger">@error('produk_diubah'){{ $message }}@enderror</span>
                    </div> --}}
                    {{-- <div class="col-md mb-3">
                        <label class="form-label" for="produk_mengubah"><strong>Mengubah</strong></label>
                        <input class="form-control" type="text" id="produk_mengubah" name="produk_mengubah"
                            value="{{ old('produk_mengubah') }}" placeholder="">
                        <span class="text-danger">@error('produk_mengubah'){{ $message }}@enderror</span>
                    </div>
                    <div class="col-md mb-3">
                        <label class="form-label" for="produk_dicabut"><strong>Dicabut</strong></label>
                        <input class="form-control" type="text" id="produk_dicabut" name="produk_dicabut"
                            value="{{ old('produk_dicabut') }}" placeholder="">
                        <span class="text-danger">@error('produk_dicabut'){{ $message }}@enderror</span>
                    </div>
                    <div class="col-md mb-3">
                        <label class="form-label" for="produk_mencabut"><strong>Mencabut</strong></label>
                        <input class="form-control" type="text" id="produk_mencabut" name="produk_mencabut"
                            value="{{ old('produk_mencabut') }}" placeholder="">
                        <span class="text-danger">@error('produk_mencabut'){{ $message }}@enderror</span>
                    </div> --}}
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

            <div class="card border-left border-info shadow mb-3" >
                <div class="card-body text-left">
                    <div class="mb-3">
                        <label class="form-label" for="produk_abstrak"><strong>Abstrak</strong></label>
                        <input class="form-control" type="file" name="produk_abstrak">
                        <span class="text-danger">@error('produk_abstrak'){{ $message }}@enderror</span>
                    </div>
                </div>
            </div>

            <div class="card border-left border-info shadow mb-3" >
                <div class="card-body text-left">
                    <div class="mb-3">
                        <label class="form-label" for="produk_terjemah"><strong>Terjemahan</strong></label>
                        <input class="form-control" type="file" name="produk_terjemah">
                        <span class="text-danger">@error('produk_terjemah'){{ $message }}@enderror</span>
                    </div>
                </div>
            </div>
    
            {{-- can't null --}}
            {{-- <input class="form-control" type="text" name="produk_ttd" value="-" hidden>
            <input class="form-control" type="text" name="produk_pemrakarsa" value="-" hidden>
            <input class="form-control" type="text" name="produk_terkait" value="-" hidden>
            <input class="form-control" type="text" name="produk_keyword" value="-" hidden>
            <input class="form-control" type="text" name="produk_nomor" value="-" hidden> --}}
            <input class="form-control" type="text" name="produk_abstraks" value="-" hidden>
            <input class="form-control" type="text" name="produk_dibuat" value="{{ \Carbon\Carbon::now() }}" hidden>
            <br>
    
            <div class="row">
                <div class="col text-right my-2 mx-4">
                    <a href="{{ route('artikel') }}"type="button" class="btn btn-outline-danger" style="width: 60%">Batal</a>
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
