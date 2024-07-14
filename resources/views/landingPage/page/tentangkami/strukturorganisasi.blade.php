@extends('landingPage.layouts.main')

@section('title', 'Struktur Organisasi')

@section('content')

    @include('landingPage.layouts.breadcrumbs', ['title' => 'Struktur Organisasi'])
    @if ($tentang)
        <section class="inner-page">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="row aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                            <div class="col">
                                <p></p>
                                {!! $tentang->tentang_struktur !!}
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
