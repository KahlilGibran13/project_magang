<aside class="main-sidebar sidebar-dark-primary elevation-4 position-fixed">
    <!-- Brand Logo -->
    <a href="{{ url('/dashboard') }}" class="brand-link">
        <img src="/image/logo2.png" alt="MDB Logo" loading="lazy" height="50">
        <span class="brand-text font-weight-light" style="margin-left: 4px;">JDIH Kementan</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                {{-- <img src="{{ asset('lte') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" --}}
                    
            </div>
            <div class="info">
                <a href="#" class="d-block">JDIH </a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
                @can('operator')
                    <li class="nav-item">
                        <a href="{{ route('peraturan') }}" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Peraturan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('putusan') }}" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Putusan Pengadilan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('monografi') }}" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Monografi Hukum</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('artikel') }}" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Artikel Hukum</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('tentang') }}" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Tentang JDIH</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('linkterkait') }}" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Link Terkait</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('infografis') }}" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Infografis</p>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('verifikasi.peraturan.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Verfikasi Peraturan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('verifikasi.putusan.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Verfikasi Putusan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('verifikasi.monografi.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Verfikasi Monografi</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('verifikasi.artikel.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Verfikasi Artikel</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('tentang.verifikasi.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Verfikasi Tentang JDIH</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('link.verifikasi.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Verfikasi Link Terkait</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('infografis.verifikasi.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Verfikasi Infografis</p>
                        </a>
                    </li>
                @endcan
                <li class="nav-item">
                    <form method="post" action="/logout" class="gap-2 nav-link d-flex align-items-center"
                        style="color: #c2c7d0 !important;gap:5px">
                        @csrf
                        <i class="nav-icon fas fa-edit"></i>
                        <button type="submit" class="p-0 btn text-body-secondary w-100 text-start"
                            style="color: #c2c7d0 !important;text-align:start;">Logout</button>
                    </form>
                </li>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
