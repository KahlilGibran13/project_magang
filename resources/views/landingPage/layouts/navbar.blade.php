<section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
    </div>
</section>

<header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
        <h1 class="logo">
            <a href="/" target="_self">
                <img src="{{ asset('assets/jdihn.webp') }}">
            </a>
            <a href="/">
                <img src="{{ asset('assets/jdih.webp') }}">
            </a>
        </h1>


        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Beranda</a></li>
                <li class="dropdown">
                    <a href="#" class="
                    @if(request()->is('fp/tentangkami*'))
                        active
                    @endif">
                        <span>Tentang Kami</span> <i class="bi bi-chevron-down"></i>
                    </a>
                    <ul>
                        <li>
                            <a class="{{ url()->full() == route('fp-landasan') ? 'active' : '' }}" href="{{ route('fp-landasan') }}">Landasan Hukum</a>
                        </li>
                        <li>
                            <a class="{{ url()->full() == route('fp-visimisi') ? 'active' : '' }}" href="{{ route('fp-visimisi') }}">Visi Misi</a>
                        </li>
                        <li>
                            <a class="{{ url()->full() == route('fp-strukturorganisasi') ? 'active' : '' }}" href="{{ route('fp-strukturorganisasi') }}">Struktur Organisasi</a>
                        </li>
                        <li>
                            <a class="{{ url()->full() == route('fp-sop') ? 'active' : '' }}" href="{{ route('fp-sop') }}">SOP JDIH</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#"><span>Dokumen Hukum</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li class="dropdown">
                            <a href="">
                                <span>Peraturan</span>
                                <i class="bi bi-chevron-right"></i>
                            </a>
                            <ul>
                                @foreach ($tema as $item)
                                <li>
                                    <a href="{{ route('fp-dokumenhukum-peraturan', $item->tema_id) }}">{{ $item->tema_deskripsi }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="{{ route('fp-dokumenhukum-putusan') }}">Putusan Pengadilan</a></li>
                        <li><a href="{{ route('fp-dokumenhukum-monografi') }}">Monografi</a></li>
                        <li><a href="{{ route('fp-dokumenhukum-artikel') }}">Artikel</a></li>
                    </ul>
                </li>
            </ul>


            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
    </div>
</header>
