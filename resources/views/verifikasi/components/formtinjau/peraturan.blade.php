<div class="mb-3">
    <label for="produk_judul" class="form-label">Judul Peraturan</label>
    <textarea disabled class="form-control" id="produk_judul" rows="2" name="produk_judul"
        placeholder="Contoh: Peraturan Menteri Pertanian Nomor 1b">{{ old('produk_judul', $produk->produk_judul) }}</textarea>
    <label><small>Format judul: Huruf Kapital di setiap awal kata saja</small></label>
</div>

<div class="row">
    <div class="col mb-3">
        <label for="produk_cluster" class="form-label"><strong>Klaster</strong></label>
        <select class="form-control chzn-select" multiple ="true" id="produk_cluster" name="produk_cluster[]" multiple
            disabled>
            <option value="">Pilih</option>
            @foreach ($clusters as $item)
                @foreach ($produk->clusters as $pcluster)
                    @if ($item->cluster_id == $pcluster->cluster_id)
                        <option value="{{ $item->cluster_id }}" selected>{{ $item->cluster_nama }}
                        </option>
                        @continue(2)
                    @endif
                @endforeach
                <option value="{{ $item->cluster_id }}">{{ $item->cluster_nama }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col mb-3">
        <label for="produk_sumber" class="form-label"><strong>Sumber Peraturan</strong></label>
        <input class="form-control" type="text" id="produk_sumber" name="produk_sumber"
            value="{{ old('produk_sumber', $produk->produk_sumber) }}" placeholder="Sumber Peraturan" disabled>
        <span class="text-danger">
            @error('produk_sumber')
                {{ $message }}
            @enderror
        </span>
    </div>
</div>

<div class="row">
    <div class="col mb-3">
        <div class="col mb-3">
            <label for="produk_tema_id" class="form-label"><strong>Jenis/Bentuk Peraturan</strong></label>
            <select class="form-control chzn-select" multiple="true" id="produk_tema_id" name="produk_tema_id" required
                disabled>
                <option value="">Pilih</option>
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

    <div class="col-md-6 mb-3">
        <label for="produk_tahun" class="form-label"><strong>Tahun Peraturan</strong></label>
        <input class="form-control" type="text" id="produk_tahun" name="produk_tahun"
            value="{{ old('produk_tahun', $produk->produk_tahun) }}" placeholder="Tahun Peraturan" disabled>
        <span class="text-danger">
            @error('produk_tahun')
                {{ $message }}
            @enderror
        </span>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="produk_jenis_id" class="form-label"><strong>Tipe Dokumen</strong></label>
        <input class="form-control" type="text" value="{{ $jenis->jenis_tipedokumen }}" disabled>
        <input class="form-control" type="hidden" id="produk_jenis_id" name="produk_jenis_id"
            value="{{ $jenis->jenis_id }}" disabled>
        <span class="text-danger">
            @error('produk_jenis_id')
                {{ $message }}
            @enderror
        </span>
    </div>

    <div class="col-md-3 mb-3">
        <label for="produk_tglterbit" class="form-label"><strong>Tanggal Ditetapkan</strong></label>
        <input class="form-control" type="date" id="produk_tglterbit" name="produk_tglterbit"
            value="{{ old('produk_tglterbit', $produk->produk_tglterbit) }}" disabled>
        <span class="text-danger">
            @error('produk_tglterbit')
                {{ $message }}
            @enderror
        </span>
    </div>
    <div class="col-md-3 mb-3">
        <label for="produk_tgldiundangkan" class="form-label"><strong>Tanggal Diundangkan</strong></label>
        <input class="form-control" type="date" id="produk_tgldiundangkan" name="produk_tgldiundangkan"
            value="{{ old('produk_tgldiundangkan', $produk->produk_tgldiundangkan) }}" disabled>
        <span class="text-danger">
            @error('produk_tgldiundangkan')
                {{ $message }}
            @enderror
        </span>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="produk_tajuk" class="form-label"><strong>Tajuk Entri Utama</strong></label>
        <input class="form-control" type="text" id="produk_tajuk" name="produk_tajuk"
            value="{{ old('produk_tajuk', $produk->produk_tajuk) }}" placeholder="Tajuk Peraturan" disabled>
        <span class="text-danger" disabled>
            @error('produk_tajuk')
                {{ $message }}
            @enderror
        </span>
    </div>

    <div class="col-md-3 mb-3">
        <label for="produk_tempatterbit" class="form-label"><strong>Tempat Penetapan</strong></label>
        <input class="form-control" type="text" id="produk_tempatterbit" name="produk_tempatterbit"
            value="{{ old('produk_tempatterbit', $produk->produk_tempatterbit) }}" placeholder="mis : Jakarta"
            disabled>
        <span class="text-danger">
            @error('produk_tempatterbit')
                {{ $message }}
            @enderror
        </span>
    </div>

    <div class="col-md-3 mb-3">
        <label for="produk_pemrakarsa" class="form-label"><strong>Pemrakarsa</strong></label>
        <input class="form-control" type="text" id="produk_pemrakarsa" name="produk_pemrakarsa"
            value="{{ old('produk_pemrakarsa', $produk->produk_pemrakarsa) }}" placeholder="" disabled>
        <span class="text-danger" disabled>
            @error('produk_pemrakarsa')
                {{ $message }}
            @enderror
        </span>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="produk_nomor" class="form-label"><strong>Nomor Peraturan</strong></label>
        <input class="form-control" type="text" id="produk_nomor" name="produk_nomor"
            value="{{ old('produk_nomor', $produk->produk_nomor) }}" placeholder="Nomor Peraturan" disabled>
        <span class="text-danger" disabled>
            @error('produk_nomor')
                {{ $message }}
            @enderror
        </span>
    </div>

    <div class="col-md-3 mb-3">
        <label for="produk_ttd" class="form-label"><strong>Penandatangan</strong></label>
        <input class="form-control" type="text" id="produk_ttd" name="produk_ttd"
            value="{{ old('produk_ttd', $produk->produk_ttd) }}" placeholder="" disabled>
        <label><small>Hanya nama, tanpa gelar</small></label>
        <span class="text-danger">
            @error('produk_ttd')
                {{ $message }}
            @enderror
        </span>
    </div>

    <div class="col-md-3 mb-3">
        <label for="produk_bahasa" class="form-label"><strong>Bahasa</strong></label>
        <input class="form-control" type="text" id="produk_bahasa" name="produk_bahasa"
            value="{{ old('produk_bahasa', $produk->produk_bahasa) }}" disabled>
        <span class="text-danger">
            @error('produk_bahasa')
                {{ $message }}
            @enderror
        </span>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label" for="produk_singkatan"><strong>Singkatan Jenis/Bentuk
                Produk*</strong></label>
        <input class="form-control" type="text" id="produk_singkatan" name="produk_singkatan"
            value="{{ old('produk_singkatan', $produk->produk_singkatan) }}"
            placeholder="Singkatan, mis : permentan kepmentan" disabled>
        <span class="text-danger">
            @error('produk_singkatan')
                {{ $message }}
            @enderror
        </span>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label" for="produk_lokasi"><strong>Lokasi</strong></label>
        <input class="form-control" type="text" id="produk_lokasi" name="produk_lokasi"
            value="{{ old('produk_lokasi', $produk->produk_lokasi) }}" placeholder="Lokasi" disabled>
        <span class="text-danger">
            @error('produk_lokasi')
                {{ $message }}
            @enderror
        </span>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label" for="produk_subjek"><strong>Subjek</strong></label>
        <input class="form-control" type="text" id="produk_subjek" name="produk_subjek"
            value="{{ old('produk_subjek', $produk->produk_subjek) }}" placeholder="Subjek Produk" disabled>
        <span class="text-danger">
            @error('produk_subjek')
                {{ $message }}
            @enderror
        </span>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label" for="produk_bidanghukum"><strong>Bidang Hukum</strong></label>
        <input class="form-control" type="text" id="produk_bidanghukum" name="produk_bidanghukum"
            value="{{ old('produk_bidanghukum', $produk->produk_bidanghukum) }}"
            placeholder="mis : Hukum Administrasi Negara" disabled>
        <span class="text-danger">
            @error('produk_bidanghukum')
                {{ $message }}
            @enderror
        </span>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label" for="produk_terkait"><strong>Peraturan Terkait:
                Melaksanakan:</strong></label>
        <input class="form-control" type="text" id="produk_terkait" name="produk_terkait"
            value="{{ old('produk_terkait', $produk->produk_terkait) }}" placeholder="" disabled>
        <span class="text-danger">
            @error('produk_terkait')
                {{ $message }}
            @enderror
        </span>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label" for="produk_statusberlaku"><strong>Status</strong></label>
        <div class="col">
            <select class="form-control" id="produk_statusberlaku" name="produk_statusberlaku" required disabled>
                <option value="">Pilih</option>
                <option value="Berlaku"
                    {{ old('produk_statusberlaku', $produk->produk_statusberlaku) == 'Berlaku' ? 'selected' : '' }}>
                    Berlaku</option>
                <option value="Dicabut"
                    {{ old('produk_statusberlaku', $produk->produk_statusberlaku) == 'Dicabut' ? 'selected' : '' }}>
                    Dicabut</option>
                <option value="Diubah"
                    {{ old('produk_statusberlaku', $produk->produk_statusberlaku) == 'Diubah' ? 'selected' : '' }}>
                    Diubah</option>
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md mb-3">
        <label class="form-label" for="produk_keyword"><strong>Keyword Pencarian</strong></label>
        <input class="form-control" type="text" id="produk_keyword" name="produk_keyword"
            value="{{ old('produk_keyword', $produk->produk_keyword) }}" placeholder="" disabled>
        <span class="text-danger">
            @error('produk_keyword')
                {{ $message }}
            @enderror
        </span>
    </div>
</div>

<div class="card border-left border-danger shadow mb-3">
    <div class="card-body text-left">
        <div class="col-md mb-3">
            <label class="form-label" for="produk_diubah"><strong>Diubah</strong></label>
            <select class="form-control chzn-select" multiple="true" id="produk_diubah" name="produk_diubah"
                disabled>
                <option value="">Pilih</option>
                @foreach ($produks as $item)
                    <option value="{{ $item->produk_id }}"
                        {{ $item->produk_id == $produk->produk_diubah ? 'selected' : '' }}>
                        {{ $item->produk_judul }}
                    </option>
                @endforeach
            </select>
            <span class="text-danger">
                @error('produk_diubah')
                    {{ $message }}
                @enderror
            </span>
        </div>
        <div class="col-md mb-3">
            <label class="form-label" for="produk_mengubah"><strong>Mengubah</strong></label>
            <select class="form-control chzn-select" multiple="true" id="produk_mengubah" name="produk_mengubah"
                disabled>
                <option value="">Pilih</option>
                @foreach ($produks as $item)
                    <option value="{{ $item->produk_id }}"
                        {{ $item->produk_id == $produk->produk_mengubah ? 'selected' : '' }}>
                        {{ $item->produk_judul }}
                    </option>
                @endforeach
            </select>
            <span class="text-danger">
                @error('produk_mengubah')
                    {{ $message }}
                @enderror
            </span>
        </div>
        <div class="col-md mb-3">
            <label class="form-label" for="produk_dicabut"><strong>Dicabut</strong></label>
            <select class="form-control chzn-select" multiple="true"id="produk_dicabut" name="produk_dicabut"
                disabled>
                <option value="">Pilih</option>
                @foreach ($produks as $item)
                    <option value="{{ $item->produk_id }}"
                        {{ $item->produk_id == $produk->produk_dicabut ? 'selected' : '' }}>
                        {{ $item->produk_judul }}
                    </option>
                @endforeach
            </select>
            <span class="text-danger">
                @error('produk_dicabut')
                    {{ $message }}
                @enderror
            </span>
        </div>
        <div class="col-md mb-3">
            <label class="form-label" for="produk_mencabut"><strong>Mencabut</strong></label>
            <select class="form-control chzn-select" multiple="true" id="produk_mencabut" name="produk_mencabut"
                disabled>
                <option value="">Pilih</option>
                @foreach ($produks as $item)
                    <option value="{{ $item->produk_id }}"
                        {{ $item->produk_id == $produk->produk_mencabut ? 'selected' : '' }}>
                        {{ $item->produk_judul }}
                    </option>
                @endforeach
            </select>
            <span class="text-danger">
                @error('produk_mencabut')
                    {{ $message }}
                @enderror
            </span>
        </div>
    </div>
</div>

<div class="card border-left border-info shadow mb-3">
    <div class="card-body text-left">
        <label class="form-label" for="produk_dokumen"><strong>Dokumen</strong></label>
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
            <label class="form-label" for="produk_dokumen"><strong>Upload</strong> <small> Biarkan kosong
                    jika tidak diganti</small></label>
            <input class="form-control" type="file" name="produk_dokumen" id="produk_dokumen" disabled>
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

<div class="card border-left border-info shadow mb-3">
    <div class="card-body text-left">
        <label class="form-label" for="produk_abstrak"><strong>Abstrak</strong></label>
        @if ($produk->produk_abstrak)
            <div class="card border-top border-primary shadow mb-3" style="width: 18rem;">
                <div class="card-header text-center">
                    @if ($produk->produk_abstrak == null)
                        <p>{{ $produk->produk_abstrak }}</p>
                    @else
                        <img src="{{ asset('assets/pdf.png') }}" class="card-img-top"
                            alt="{{ $produk->produk_abstrak }}" style="height: 7rem; width: 6rem">
                    @endif
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        <a href="{{ route('pdf.view', ['filename' => $produk->produk_abstrak]) }}"
                            target="_blank">Lihat</a>
                    </div>
                </div>
            </div>
        @endif


        <div class="mb-3">
            <label class="form-label" for="produk_abstrak"><strong>Upload</strong> <small> Biarkan kosong
                    jika tidak diganti</small></label>
            <input class="form-control" type="file" name="produk_abstrak" id="produk_abstrak" disabled>
            @if ($produk->produk_abstrak)
                <p>Dokumen saat ini: <a href="{{ asset('dokumen/' . $produk->produk_abstrak) }}"
                        target="_blank">{{ $produk->produk_abstrak }}</a></p>
            @endif
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
        <label class="form-label" for="produk_terjemah"><strong>Terjemahan</strong></label>
        @if ($produk->produk_terjemah)
            <div class="card border-top border-primary shadow mb-3" style="width: 18rem;">
                <div class="card-header text-center">
                    @if ($produk->produk_terjemah == null)
                        <p>{{ $produk->produk_terjemah }}</p>
                    @else
                        <img src="{{ asset('assets/pdf.png') }}" class="card-img-top"
                            alt="{{ $produk->produk_terjemah }}" style="height: 7rem; width: 6rem">
                    @endif
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        <a href="{{ route('pdf.view', ['filename' => $produk->produk_terjemah]) }}"
                            target="_blank">Lihat</a>
                    </div>
                </div>
            </div>
        @endif


        <div class="mb-3">
            <label class="form-label" for="produk_terjemah"><strong>Upload</strong> <small> Biarkan kosong
                    jika tidak diganti</small></label>
            <input class="form-control" type="file" name="produk_terjemah" id="produk_terjemah" disabled>
            @if ($produk->produk_terjemah)
                <p>Dokumen saat ini: <a href="{{ asset('dokumen/' . $produk->produk_terjemah) }}"
                        target="_blank">{{ $produk->produk_terjemah }}</a></p>
            @endif
            <span class="text-danger">
                @error('produk_terjemah')
                    {{ $message }}
                @enderror
            </span>
        </div>


    </div>
</div>

<div class="card border-left border-info shadow mb-3">
    <div class="card-body text-left">
        <label class="form-label" for="lampiran_nama"><strong>Lampiran</strong></label>
        @if ($lampiran)
            <div class="card border-top border-primary shadow mb-3" style="width: 18rem;">
                <div class="card-header text-center">
                    @if ($lampiran->lampiran_nama == null)
                        <p>Data Not Found</p>
                    @else
                        <img src="{{ asset('assets/pdf.png') }}" class="card-img-top"
                            alt="{{ $lampiran->lampiran_nama }}" style="height: 7rem; width: 6rem">
                    @endif
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        <a href="{{ route('pdf.view', ['filename' => $lampiran->lampiran_nama]) }}"
                            target="_blank">Lihat</a>
                    </div>
                </div>
            </div>
        @endif


        <div class="mb-3">
            <label class="form-label" for="produk_dokumen"><strong>Upload</strong> <small> Biarkan kosong
                    jika tidak diganti</small></label>
            <input class="form-control" type="file" name="lampiran_nama" id="lampiran_nama" disabled>
            @if ($lampiran)
                <p>Dokumen saat ini: <a href="{{ asset('dokumen/' . $lampiran->lampiran_nama) }}"
                        target="_blank">{{ $lampiran->lampiran_nama }}</a></p>
            @endif
            <span class="text-danger">
                @error('lampiran_nama')
                    {{ $message }}
                @enderror
            </span>
        </div>


    </div>
</div>
