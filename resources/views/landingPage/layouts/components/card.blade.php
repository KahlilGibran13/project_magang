<div class="card mb-3">
    <div class="card-header">
        Nomor : {{ $produk->produk_nomor }}
    </div>
    <div class="card-body">
        <h5 class="card-title">Judul : {{ $produk->produk_judul }}</h5>
        <a href="{{ route($route, $produk->produk_id) }}" class="btn btn-primary">Lihat Detail</a>
    </div>
    <div class="card-footer text-muted">
        Dilihat :
    </div>
</div>
