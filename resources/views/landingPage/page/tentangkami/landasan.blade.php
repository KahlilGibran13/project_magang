@extends('landingPage.layouts.main')

@section('title', 'Landasan Hukum')

@section('content')

    @include('landingPage.layouts.breadcrumbs', ['title' => 'Landasan Hukum'])

    @if ($tentang)
        <section class="inner-page">
            <div class="container">
                <div class="row">
                    <div class="col-8">
                        <div class="row aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                            <div class="col">
                                <p></p>
                                {!! $tentang->tentang_landasan !!}
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
