@extends('landingPage.layouts.main')

@section('title', 'SOP')

@section('content')

    @include('landingPage.layouts.breadcrumbs', ['title' => 'SOP'])
    @if ($tentang)
    <section class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <iframe
                        src="https://docs.google.com/spreadsheets/d/e/2PACX-1vTYlrWhyTWaN0YV8KzCvQxh0rblo1tYjfmpnfxQuHoexVu8DE8ZSUl3H3NNdhEgXQ/pubhtml?gid=2075232402&amp;single=true&amp;widget=true&amp;headers=false"
                        width="100%" height="150%"></iframe>
                    <p>&nbsp;</p>
                    <p>{!!  $tentang->tentang_sop !!}</p>
                    <p>&nbsp;</p>
                </div>
            </div>
        </div>
    </section>
    @endif
@endsection
