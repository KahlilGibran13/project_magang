@if ($item->verifikasiPeraturanLatest != null)
    @if ($item->verifikasiPeraturanLatest->aksi == 1 || $item->verifikasiPeraturanLatest->aksi == 3)
        <div class="d-flex justify-content-center">
            <a href="{{ route('putusan.detail', $item->produk_id) }}" class="btn btn-primary btn-circle mx-1"
                role="button">Detail</a>
            <form action="{{ route('verifikasi.tarik') }}" method="POST" class="mx-1"
                onsubmit="return confirm('Apakah kamu yakin untuk menarik ini?');">
                @csrf
                <input type="hidden" name="produk_id" value="{{ $item->produk_id }}">
                <input type="hidden" name="verifikasi_id" value="{{ $item->verifikasiPeraturanLatest->id }}">
                <button type="submit" class="btn btn-danger btn-circle">Tarik</button>
            </form>
        </div>
    @elseif($item->verifikasiPeraturanLatest->aksi == 5)
        <div class="d-flex justify-content-center">
            <div class="btn btn-success btn-circle mx-1">Terverifikasi</div>
        </div>
    @else
        <div class="d-flex justify-content-center">
            <a href="{{ route('putusan.edit', $item->produk_id) }}" class="btn btn-info btn-circle mx-1"
                role="button">Edit</a>
            <form action="{{ route('putusan.destroy', $item->produk_id) }}" method="POST" class="mx-1"
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
                    <input type="hidden" name="verifikasi_id" value="{{ $item->verifikasiPeraturanLatest->id }}">
                    <button type="submit" class="btn btn-success btn-circle">Kirim</button>
                </form>
            @endif
        </div>
    @endif
@else
    <div class="d-flex justify-content-center">
        <a href="{{ route('putusan.edit', $item->produk_id) }}" class="btn btn-info btn-circle mx-1"
            role="button">Edit</a>
        <form action="{{ route('putusan.destroy', $item->produk_id) }}" method="POST" class="mx-1"
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
