<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JDIH-Clone</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/summernote/summernote-bs4.min.css') }}">
</head>

<body>
    <!-- Navigation (Main Header) -->
    <nav class="main-header navbar navbar-expand navbar-green navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block"></li>
        </ul>
        {{-- <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul> --}}
    </nav>

    @include('layouts.sidebar')
    <!-- Sidebar -->
    {{-- <aside class="main-sidebar sidebar-dark-primary elevation-4 position-fixed">
        <a href="{{ url('/dashboard') }}" class="brand-link">
            <img src="/image/logo2.png" alt="MDB Logo" loading="lazy" height="50">
            <span class="brand-text font-weight-light" style="margin-left: 6px;">JDIH Kementan</span>
        </a>
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a href="#" class="d-block">JDIH</a>
                </div>
            </div>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false" id="sidebar-menu">
                    <!-- Sidebar Menu Items -->
                    @can('operator')
                        <li class="nav-item">
                            <a href="peraturan" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>Peraturan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="putusan" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>Putusan Pengadilan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="monografi" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>Monografi Hukum</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="artikel" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>Artikel Hukum</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="tentang" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>Tentang JDIH</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="linkterkait" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>Link Terkait</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="infografis" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>Infografis</p>
                            </a>
                        </li>
                    @endcan
                    @can('verifikator')
                        <li class="nav-item">
                            <a href="{{ route('verifikasi.peraturan.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>Verfikasi Peraturan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('verifikasi.peraturan.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>Verfikasi Peraturan</p>
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
                </ul>
            </nav>
        </div>
    </aside> --}}

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Statistics Boxes -->
                <div class="row">
                    <div class="col-lg-3 col-6 d-flex flex-column">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $count_putusan }}</h3>
                                <p>Putusan</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-ios-analytics"></i>
                            </div>
                            <a href="{{ route('add-putusan') }}" class="small-box-footer">Tambah Baru <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>

                        <div class="container rounded overflow-hidden mb-3">
                            <div class="row">
                                <div class="col-md-6 bg-danger p-2">
                                    <h3>{{ $cound_putusan_blm_verif }}</h3>
                                    <p>Putusan Belum Verifikasi</p>
                                </div>
                                <div class="col-md-6 bg-success p-2">
                                    <h3>{{ $count_putusan_verif }}</h3>
                                    <p>Putusan Terverifikasi</p>
                                </div>
                                <a href="{{ route('putusan') }}" class="col-12 bg-info text-center p-2">Putusan <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6 d-flex flex-column">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $count_peraturan }}</h3>
                                <p>Peraturan</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-ios-list-outline"></i>

                            </div>
                            <a href="{{ route('add-peraturan') }}" class="small-box-footer">Tambah Baru <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>

                        <div class="container rounded overflow-hidden mb-3">
                            <div class="row">
                                <div class="col-md-6 bg-danger p-2">
                                    <h3>{{ $count_perturan_blm_verif }}</h3>
                                    <p>Peraturan Belum Verifikasi</p>
                                </div>
                                <div class="col-md-6 bg-success p-2">
                                    <h3>{{ $count_perturan_verif }}</h3>
                                    <p>Peraturan Terverifikasi</p>
                                </div>
                                <a href="{{ route('peraturan') }}" class="col-12 bg-info text-center p-2">Peraturan <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6 d-flex flex-column">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $count_artikel }}</h3>
                                <p>Artikel</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-ios-mic-outline"></i>
                            </div>
                            <a href="#" class="small-box-footer">Tambah Baru <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                        <div class="container rounded overflow-hidden mb-3">
                            <div class="row">
                                <div class="col-md-6 bg-danger p-2">
                                    <h3>{{ $count_artikel_blm_verif }}</h3>
                                    <p>Artikel Belum Verifikasi</p>
                                </div>
                                <div class="col-md-6 bg-success p-2">
                                    <h3>{{ $count_artikel_verif }}</h3>
                                    <p>Artikel Terverifikasi</p>
                                </div>
                                <a href="{{ route('artikel') }}" class="col-12 bg-info text-center p-2">Artikel <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6 d-flex flex-column">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $count_monografi }}</h3>
                                <p>Monografi</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-arrow-graph-up-right"></i>
                            </div>
                            <a href="{{ route('add-monografi') }}" class="small-box-footer">Tambah Baru <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>

                        <div class="container rounded overflow-hidden mb-3">
                            <div class="row">
                                <div class="col-md-6 bg-danger p-2">
                                    <h3>{{ $count_monografi_blm_verif }}</h3>
                                    <p>Monografi Belum Verifikasi</p>
                                </div>
                                <div class="col-md-6 bg-success p-2">
                                    <h3>{{ $count_monografi_verif }}</h3>
                                    <p>Monografi Terverifikasi</p>
                                </div>
                                <a href="{{ route('monografi') }}" class="col-12 bg-info text-center p-2">Monografi
                                    <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- untuk tampilan user File Gambar -->
                <div class="container-fluid">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <form action="{{ route('upload-image') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card card-dark card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">Gambar Tema</h3>
                                        @if (session('success'))
                                            <div class="alert alert-success alert-dismissible fade show mx-4"
                                                role="alert">
                                                {{ session('success') }}
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                        @if (session('error'))
                                            <div class="alert alert-danger alert-dismissible fade show mx-4"
                                                role="alert">
                                                {{ session('error') }}
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <div style="max-width: 100%; overflow: hidden;">
                                            <img src="/gambar_tema/gambar_tema.webp" class="img-fluid"
                                                style="max-width: 100%; height: auto;" alt="Padi">
                                            <div class="card card-success">
                                                <div class="card-body">
                                                    <h3 class="card-title">Upload Gambar Baru</h3>
                                                    <div class="mb-3">
                                                        <input type="file" name="image" class="form-control"
                                                            aria-label="file example" required>
                                                    </div>
                                                    <button class="btn btn-success" type="submit">Simpan</button>
                                                </div>
                                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">

                {{-- <div class="card card-dark card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Peraturan</h3>
                    </div>

                    <div class="card-body row">
                        <div class="col-md-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $count_verif }}</h3>
                                    <p>Terverifikasi</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios-list-outline"></i>

                                </div>
                                <a href="{{ route('add-peraturan') }}" class="small-box-footer">Tambah Baru <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ $count_blm_verif }}</h3>
                                    <p>Belum Terverifikasi</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios-list-outline"></i>

                                </div>
                                <a href="{{ route('add-peraturan') }}" class="small-box-footer">Tambah Baru <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="card card-dark card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Rate</h3>
                    </div>
                    <div class="card-body">
                        <table id="studi" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="25%">Nama</th>
                                    <th width="25%">Email</th>
                                    <th width="25%">Saran</th>
                                    <th width="25%">Rate</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($survey as $item)
                                    <tr>
                                        <td>{{ $item->nama }}</td>
                                        <td><a href="mailto:{{ $item->email }}" class="__cf_email__"
                                                data-cfemail="2d455d594745494f475d5d03476d5f444a45594f41445e5e034f484c585954">[email&#160;protected]</a>
                                        </td>
                                        <td>{{ $item->saran }}</td>
                                        <td>
                                            @for ($i = 0; $i < $item->rate; $i++)
                                                <span class="fa fa-star"></span>
                                            @endfor
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
    </div>
    </div>
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark"></aside>

    <!-- Footer -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-inline">
            <b>Version</b> 3.2.0
        </div>
        <strong>Copyright &copy; 2024 <a href="https://jdih.pertanian.go.id/">JDIH KEMENTAN</a>.</strong> All rights
        reserved.
    </footer>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('lte/dist/js/adminlte.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('lte/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('lte/plugins/sparklines/sparkline.js') }}"></script>
    <!-- jQuery Knob -->
    <script src="{{ asset('lte/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- moment -->
    <script src="{{ asset('lte/plugins/moment/moment.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('lte/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('lte/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- AdminLTE for dashboard -->
    <script src="{{ asset('lte/dist/js/pages/dashboard.js') }}"></script>
    <!-- Bootstrap 5 (optional, if needed) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    </script>
</body>

</html>
