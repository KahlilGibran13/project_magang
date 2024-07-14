@extends('landingPage.layouts.main')

@section('title', $title)

@section('content')

    @include('landingPage.layouts.breadcrumbs', ['title' => $title, 'route' => $route])

    <div class="container mt-5 border-dark border-bottom pb-2">
        <div class="d-flex justify-content-end">
            <label class="d-flex">
                <span>Search:</span>
                <input type="search" class="form-control form-control-sm" placeholder="" aria-controls="dtm">
            </label>
        </div>
    </div>

    <div class="container mt-3">
        @foreach ($produks as $produk)
            @include('landingPage.layouts.components.card', ['produk' => $produk])
        @endforeach
        <div class="d-flex justify-content-end">
            {{ $produks->links() }}
        </div>
    </div>

@endsection
