@extends('layouts.main')
@section('section-view')

<div class="mx-4 pt-3">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h2 class="m-0">Tentang Kami</h2>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Tentang Kami</li>
            </ol>
        </div><!-- /.col -->
    </div>
</div>

<div class="card shadow border border-info mx-4">
    <div class="card-header pt-3">
        <h5>Profil JDIH</h5>
    </div>

    <div class="card-body">
        <form action="/store-tentang" method="post" enctype="multipart/form-data">
            @csrf
            {{-- @method('PUT') --}}
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Visi</label>
                <textarea class="form-control" id="tentang_visi" rows="5" name="tentang_visi"></textarea>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Misi</label>
                <textarea class="form-control" id="tentang_misi" rows="5" name="tentang_misi"></textarea>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Landasan</label>
                <textarea class="form-control" id="tentang_landasan" rows="5" name="tentang_landasan"></textarea>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Struktur</label>
                <textarea class="form-control" id="tentang_struktur" rows="5" name="tentang_struktur"></textarea>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">SOP JDIH</label>
                <textarea class="form-control" id="tentang_sop" rows="5" name="tentang_sop"></textarea>
            </div>
            <br>

            <div class="row">
                <div class="col text-right my-2 mx-4">
                    <a href="/tentang " type="button" class="btn btn-outline-danger" style="width: 60%">Batal</a>
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
<script>
    ClassicEditor
        .create(document.querySelector('#tentang_visi'))
        .catch(error => {
            console.error(error);
        });
    ClassicEditor
        .create(document.querySelector('#tentang_misi'))
        .catch(error => {
            console.error(error);
        });
    ClassicEditor
        .create(document.querySelector('#tentang_landasan'))
        .catch(error => {
            console.error(error);
        });
    ClassicEditor
        .create(document.querySelector('#tentang_struktur'))
        .catch(error => {
            console.error(error);
        });
    ClassicEditor
        .create(document.querySelector('#tentang_sop'))
        .catch(error => {
            console.error(error);
        });

</script>
@endsection
{{-- @section('scripts')
<script>
    ClassicEditor
        .create(document.querySelector('#tentang_visi'), {
            simpleUpload: {
                uploadUrl: '{{ route('store-tentang') }}',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        })
        .catch(error => {
            console.error(error);
        });
    ClassicEditor
        .create(document.querySelector('#tentang_misi'), {
            simpleUpload: {
                uploadUrl: '{{ route('store-tentang') }}',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        })
        .catch(error => {
            console.error(error);
        });
    ClassicEditor
        .create(document.querySelector('#tentang_landasan'), {
            simpleUpload: {
                uploadUrl: '{{ route('store-tentang') }}',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        })
        .catch(error => {
            console.error(error);
        });
    ClassicEditor
        .create(document.querySelector('#tentang_struktur'), {
            simpleUpload: {
                uploadUrl: '{{ route('store-tentang') }}',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        })
        .catch(error => {
            console.error(error);
        });
    ClassicEditor
        .create(document.querySelector('#tentang_sop'), {
            simpleUpload: {
                uploadUrl: '{{ route('store-tentang') }}',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endsection --}}

