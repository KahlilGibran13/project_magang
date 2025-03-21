<div class="mb-3">
    <label for="exampleFormControlTextarea1" class="form-label">Judul Artikel (majalah, koran, dsb)</label>
    <textarea disabled class="form-control" id="produk_judul" rows="2" name="produk_judul"
        placeholder="Judul Artikel (majalah, koran, dsb)" value="{{ old('produk_judul', $produk->produk_judul) }} ">{{ $produk->produk_judul }}</textarea>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label"><strong>Jenis</strong></label>
        <div class="col">
            <select disabled class="form-control">
                <option value="Jurnal">Jurnal</option>
                <option value="Buletin">Buletin</option>
            </select>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <label class="form-label" for="produk_dibuat"><strong>Tanggal Terbit</strong></label>
        <input disabled class="form-control" type="date" id="produk_dibuat" name="produk_dibuat"
            value="{{ old('produk_dibuat', $produk->produk_dibuat) }}">
        <span class="text-danger">
            @error('produk_dibuat')
                {{ $message }}
            @enderror
        </span>
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label" for="produk_penerbit"><strong>Penerbit</strong></label>
        <input disabled class="form-control" type="text" id="produk_penerbit" name="produk_penerbit"
            value="{{ old('produk_penerbit', $produk->produk_penerbit) }}" placeholder="Penerbit Artikel">
        <span class="text-danger">
            @error('produk_penerbit')
                {{ $message }}
            @enderror
        </span>
    </div>
</div>

{{-- <div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label" for="produk_jenis_id"><strong>Tipe Dokumen</strong></label>
        <input disabled class="form-control" type="text" value="{{ $putusan->jenis_tipedokumen }}" disabled> --}}
<input disabled class="form-control" type="text" id="produk_jenis_id" name="produk_jenis_id"
    value="{{ $jenis->jenis_id }}" hidden>
{{-- <span class="text-danger">@error('produk_jenis_id'){{ $message }}@enderror</span>
    </div>
</div> --}}

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label" for="produk_tajuk"><strong>Tajuk Entri Utama</strong></label>
        <input disabled class="form-control" type="text" id="produk_tajuk" name="produk_tajuk"
            value="{{ old('produk_tajuk', $produk->produk_tajuk) }}" placeholder="Tajuk Artikel">
        <span class="text-danger">
            @error('produk_tajuk')
                {{ $message }}
            @enderror
        </span>
    </div>

    <div class="col-md-3 mb-3">
        <label class="form-label" for="produk_tempatterbit"><strong>Tempat Terbit</strong></label>
        <input disabled class="form-control" type="text" id="produk_tempatterbit" name="produk_tempatterbit"
            value="{{ old('produk_tempatterbit', $produk->produk_tempatterbit) }}" placeholder="mis : Jakarta">
        <span class="text-danger">
            @error('produk_tempatterbit')
                {{ $message }}
            @enderror
        </span>
    </div>

    <div class="col-md-3 mb-3">
        <label class="form-label" for="produk_bahasa"><strong>Bahasa</strong></label>
        <input disabled class="form-control" type="text" id="produk_bahasa" name="produk_bahasa"
            value="{{ old('produk_bahasa', $produk->produk_bahasa) }}" placeholder="mis : Bahasa Indonesia">
        <span class="text-danger">
            @error('produk_bahasa')
                {{ $message }}
            @enderror
        </span>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label" for="produk_bidanghukum"><strong>Bidang Hukum</strong></label>
        <input disabled class="form-control" type="text" id="produk_bidanghukum" name="produk_bidanghukum"
            value="{{ old('produk_bidanghukum', $produk->produk_bidanghukum) }}" placeholder="Bidang Hukum">
        <span class="text-danger">
            @error('produk_bidanghukum')
                {{ $message }}
            @enderror
        </span>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label" for="produk_lokasi"><strong>Lokasi</strong></label>
        <input disabled class="form-control" type="text" id="produk_lokasi" name="produk_lokasi"
            value="{{ old('produk_lokasi', $produk->produk_lokasi) }}" placeholder="Lokasi artikel">
        <span class="text-danger">
            @error('produk_lokasi')
                {{ $message }}
            @enderror
        </span>
    </div>
</div>

{{-- <div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label" for="produk_singkatan"><strong>Singkatan Jenis Peradilan</strong></label>
        <input disabled class="form-control" type="text" id="produk_singkatan" name="produk_singkatan"
            value="{{ old('produk_singkatan') }}" placeholder="Singkatan, mis : permentan kepmentan">
        <span class="text-danger">@error('produk_singkatan'){{ $message }}@enderror</span>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label" for="produk_bidanghukum"><strong>Bidang Hukum/Jenis Perkara</strong></label>
        <input disabled class="form-control" type="text" id="produk_bidanghukum" name="produk_bidanghukum"
            value="{{ old('produk_bidanghukum') }}" placeholder="mis : Hukum Administrasi Negara">
        <span class="text-danger">@error('produk_bidanghukum'){{ $message }}@enderror</span>
    </div>
</div> --}}

<div class="row">
    <div class="col mb-6">
        <label class="form-label" for="produk_sumber"><strong>Sumber Artikel</strong></label>
        <input disabled class="form-control" type="text" id="produk_sumber" name="produk_sumber"
            value="{{ old('produk_sumber', $produk->produk_sumber) }}" placeholder="Sumber Artikel">
        <span class="text-danger">
            @error('produk_sumber')
                {{ $message }}
            @enderror
        </span>
    </div>

    <div class="col-md-3 mb-3">
        <label class="form-label" for="produk_cetakan"><strong>Cetakan/Edisi</strong></label>
        <input disabled class="form-control" type="text" id="produk_cetakan" name="produk_cetakan"
            value="{{ old('produk_cetakan', $produk->produk_cetakan) }}" placeholder="Cetakan/Edisi">
        <span class="text-danger">
            @error('produk_cetakan')
                {{ $message }}
            @enderror
        </span>

    </div>

    <div class="col-md-3 mb-3">
        <label class="form-label" for="produk_subjek"><strong>Subjek</strong></label>
        <input disabled class="form-control" type="text" id="produk_subjek" name="produk_subjek"
            value="{{ old('produk_subjek', $produk->produk_subjek) }}" placeholder="Subjek Hukum Artikel">
        <span class="text-danger">
            @error('produk_subjek')
                {{ $message }}
            @enderror
        </span>
    </div>
</div>

<div class="card border-left border-danger shadow mb-3">
    <div class="card-body text-left">
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Abstrak</label>
            <textarea disabled class="form-control" id="produk_abstrak" rows="10" name="produk_abstrak"
                value="{{ old('produk_abstrak', $produk->produk_abstrak) }}">{{ $produk->produk_abstrak }}</textarea>
        </div>
    </div>
</div>

<div class="card border-left border-info shadow mb-3">
    <div class="card-body text-left">
        @if ($produk->produk_dokumen)
            <div class="card border-top border-primary shadow mb-3" style="width: 18rem;">
                <div class="card-header text-center">
                    @if ($produk->produk_dokumen == null)
                        <p>{{ $produk->produk_dokumen }}</p>
                    @else
                        <img src="{{ asset('assets/pdf.png') }}" class="card-img-top"
                            alt="{{ $produk->produk_dokumen }}" style="height: 7rem; width: 6rem">
                    @endif
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        <a href="{{ route('pdf.view', ['filename' => $produk->produk_dokumen]) }}"
                            target="_blank">Lihat</a>
                    </div>
                </div>
            </div>
        @endif


        <div class="mb-3">
            <label class="form-label" for="produk_dokumen"><strong>Dokumen</strong></label>
            <input disabled class="form-control" type="file" name="produk_dokumen" id="produk_dokumen">
            @if ($produk->produk_dokumen)
                <p>Dokumen saat ini: <a href="{{ asset('dokumen/' . $produk->produk_dokumen) }}"
                        target="_blank">{{ $produk->produk_dokumen }}</a></p>
            @endif
            <span class="text-danger">
                @error('produk_dokumen')
                    {{ $message }}
                @enderror
            </span>
        </div>
    </div>
</div>
