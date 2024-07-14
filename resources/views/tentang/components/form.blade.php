<<form action="/update-tentang/1" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <p></p>

    <input type="hidden" name="tentang_id" value="{{ $tentang->tentang_id }}">

    @if($tentang->verifikasiTentangJDIHLatest !== null)
        <input type="hidden" name="verifikasi_id" value="{{ $tentang->verifikasiTentangJDIHLatest->id }}">
    @else
        <!-- Tangani kasus di mana verifikasiTentangJDIHLatest adalah null -->
        <input type="hidden" name="verifikasi_id" value="">
    @endif

    <div class="mb-3">
        <!-- Konten form lainnya -->
    </div>

        <label for="exampleFormControlTextarea1" class="form-label">Visi</label>
        <textarea class="form-control" id="tentang_visi" rows="5" name="tentang_visi"
            value="{{ old('tentang_visi', $tentang->tentang_visi) }}">{{ $tentang->tentang_visi }}</textarea>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Misi</label>
        <textarea class="form-control" id="tentang_misi" rows="5" name="tentang_misi"
            value="{{ old('tentang_misi', $tentang->tentang_misi) }}">{{ $tentang->tentang_misi }}</textarea>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Landasan</label>
        <textarea class="form-control" id="tentang_landasan" rows="5" name="tentang_landasan"
            value="{{ old('tentang_landasan', $tentang->tentang_landasan) }}">{{ $tentang->tentang_landasan }}</textarea>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Struktur</label>
        <textarea class="form-control" id="tentang_struktur" rows="5" name="tentang_struktur"
            value="{{ old('tentang_struktur', $tentang->tentang_struktur) }}">{{ $tentang->tentang_struktur }}</textarea>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">SOP JDIH</label>
        <textarea class="form-control" id="tentang_sop" rows="5" name="tentang_sop">{{ $tentang->tentang_sop }}</textarea>
    </div>
    <br>

    <div class="row">
        <div class="col my-2 mx-4 text-center">
            <button type="submit" class="btn btn-success" name="tambah" style="width: 30%">Simpan</button>
        </div>
    </div>

    <br>

</form>
