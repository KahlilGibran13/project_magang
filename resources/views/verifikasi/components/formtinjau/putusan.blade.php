<div class="mb-3">
    <label for="exampleFormControlTextarea1" class="form-label">Judul Putusan</label>
    <textarea disabled class="form-control" id="produk_judul" rows="2" name="produk_judul" placeholder="Judul Putusan"
        value="{{ old('produk_judul', $produk->produk_judul) }}">{{ $produk->produk_judul }}</textarea>
</div>

<div class="row">
    <div class="col mb-3">
        <label class="form-label" for="produk_cluster"><strong>Klaster {{ $produk->produk_cluster }}</strong></label>
        {{ $produk->produk_cluster }}
        <div class="col">
            <select disabled disabled class="form-control" id="produk_cluster" name="produk_cluster">
                @if ($produk->produk_cluster == null)
                    <option selected hidden></option>
                @endif

                @foreach ($clusters as $item)
                    @if ($item->cluster_id == $produk->produk_cluster)
                        <option value="{{ $item->cluster_id }}" selected>{{ $item->cluster_nama }}</option>
                    @else
                        <option value="{{ $item->cluster_id }}">{{ $item->cluster_nama }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="col mb-3">
        <label class="form-label" for="produk_sumber"><strong>Sumber Peraturan</strong></label>
        <input disabled disabled class="form-control" type="text" id="produk_sumber" name="produk_sumber"
            value="{{ old('produk_judul', $produk->produk_judul) }}" placeholder="Sumber Putusan">
        <span class="text-danger">
            @error('produk_sumber')
                {{ $message }}
            @enderror
        </span>
    </div>
</div>

<div class="row">
    <div class="col mb-3">
        <label class="form-label" for="produk_tema_id"><strong>Jenis/Bentuk Putusan</strong></label>
        <div class="col">
            <select disabled disabled class="form-control chzn-select" multiple="true" id="produk_tema_id"
                name="produk_tema_id[]" multiple required>
                @foreach ($temas as $item)
                    @foreach ($produk->temas as $ptema)
                        @if ($item->tema_id == $ptema->tema_id)
                            <option value="{{ $item->tema_id }}" selected>{{ $item->tema_deskripsi }}
                            </option>
                            @continue(2)
                        @endif
                    @endforeach
                    <option value="{{ $item->tema_id }}">{{ $item->tema_deskripsi }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col mb-3">
        <label class="form-label" for="produk_penerbit"><strong>Penerbit</strong></label>
        <input disabled class="form-control" type="text" id="produk_penerbit" name="produk_penerbit"
            value="{{ old('produk_penerbit', $produk->produk_penerbit) }}">
        <span class="text-danger">
            @error('produk_penerbit')
                {{ $message }}
            @enderror
        </span>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label" for="produk_jenis_id"><strong>Tipe Dokumen</strong></label>
        <input disabled class="form-control" type="text" value="{{ $jenis->jenis_tipedokumen }}" disabled>
        <input disabled class="form-control" type="text" id="produk_jenis_id" name="produk_jenis_id"
            value="{{ $jenis->jenis_id }}" hidden>
        <span class="text-danger">
            @error('produk_jenis_id')
                {{ $message }}
            @enderror
        </span>
    </div>

    <div class="col-md-3 mb-3">
        <label class="form-label" for="produk_dibuat"><strong>Tanggal Ditetapkan</strong></label>
        <input disabled class="form-control" type="date" id="produk_dibuat" name="produk_dibuat"
            value="{{ old('produk_dibuat', $produk->produk_dibuat) }}">
        <span class="text-danger">
            @error('produk_dibuat')
                {{ $message }}
            @enderror
        </span>
    </div>

    <div class="col-md-3 mb-3">
        <label class="form-label" for="produk_tgldiundangkan"><strong>Tanggal Diundangkan</strong></label>
        <input disabled class="form-control" type="date" id="produk_tgldiundangkan" name="produk_tgldiundangkan"
            value="{{ old('produk_tgldiundangkan', $produk->produk_tgldiundangkan) }}">
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
        <input disabled class="form-control" type="text" id="produk_tajuk" name="produk_tajuk"
            value="{{ old('produk_tajuk', $produk->produk_tajuk) }}">
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
        <label class="form-label" for="produk_nomor"><strong>Nomor Peraturan</strong></label>
        <input disabled class="form-control" type="text" id="produk_nomor" name="produk_nomor"
            value="{{ old('produk_nomor', $produk->produk_nomor) }}" placeholder="Nomor Peraturan">
        <span class="text-danger">
            @error('produk_nomor')
                {{ $message }}
            @enderror
        </span>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label" for="produk_lokasi"><strong>Lokasi</strong></label>
        <input disabled class="form-control" type="text" id="produk_lokasi" name="produk_lokasi"
            value="{{ old('produk_lokasi', $produk->produk_lokasi) }}"
            placeholder="mis : Biro Hukum Kementrian Pertanian">
        <span class="text-danger">
            @error('produk_lokasi')
                {{ $message }}
            @enderror
        </span>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label" for="produk_singkatan"><strong>Singkatan Jenis Bentuk
                Peraturan</strong></label>
        <input disabled class="form-control" type="text" id="produk_singkatan" name="produk_singkatan"
            value="{{ old('produk_singkatan', $produk->produk_singkatan) }}"
            placeholder="Singkatan, mis : permentan kepmentan">
        <span class="text-danger">
            @error('produk_singkatan')
                {{ $message }}
            @enderror
        </span>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label" for="produk_bidanghukum"><strong>Bidang Hukum</strong></label>
        <input disabled class="form-control" type="text" id="produk_bidanghukum" name="produk_bidanghukum"
            value="{{ old('produk_bidanghukum', $produk->produk_bidanghukum) }}"
            placeholder="mis : Hukum Administrasi Negara">
        <span class="text-danger">
            @error('produk_bidanghukum')
                {{ $message }}
            @enderror
        </span>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label" for="produk_subjek"><strong>Subjek</strong></label>
        <input disabled class="form-control" type="text" id="produk_subjek" name="produk_subjek"
            value="{{ old('produk_subjek', $produk->produk_subjek) }}" placeholder="Subjek Peraturan">
        <span class="text-danger">
            @error('produk_subjek')
                {{ $message }}
            @enderror
        </span>
    </div>

    <div class="col mb-3">
        <label class="form-label" for="produk_statusberlaku"><strong>Status</strong></label>
        <div class="col">
            <select disabled class="form-control" id="produk_statusberlaku" name="produk_statusberlaku" required>
                @if ($produk->produk_statusberlaku == 'Tetap')
                    <option value="Tetap">Tetap</option>
                    <option value="Tidak Tetap">Tidak Tetap</option>
                @else
                    <option value="Tidak Tetap">Tidak Tetap</option>
                    <option value="Tetap">Tetap</option>
                @endif

            </select>
        </div>
    </div>
</div>

<div class="card border-left border-danger shadow mb-3">
    <div class="card-body text-left">
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Abstrak</label>
            <textarea class="form-control" id="produk_abstrak" rows="10" name="produk_abstrak"
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
