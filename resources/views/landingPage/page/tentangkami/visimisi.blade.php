@extends('landingPage.layouts.main')

@section('title', 'Visi Misi')

@section('content')
    @include('landingPage.layouts.breadcrumbs', ['title' => 'Visi Misi'])
    @if ($tentang)
    <section class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <div class="row aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                        <div class="col">
                            <h5>Visi</h5>
                            <p></p>
                            {!!  $tentang->tentang_visi !!}
                            <p></p>
                            <h5>Misi</h5>
                            <p></p>
                            {!!  $tentang->tentang_misi !!}
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
@endsection
