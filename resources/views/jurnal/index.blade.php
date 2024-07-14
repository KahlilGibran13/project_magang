<!doctype html>
<html lang="en">
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JDIH-Clone</title>
  <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('lte')}}/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('lte')}}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('lte')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('lte')}}/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('lte')}}/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('lte')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('lte')}}/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('lte')}}/plugins/summernote/summernote-bs4.min.css">
  </head>
  <body>
    <!-- Your HTML content here -->
    
  
    <!-- Your content here -->
    
  
   <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ url('/dashboard') }}" class="brand-link">
    <img src="/Image/logo2.png" alt="MDB Logo" loading="lazy" height="50">
    <span class="brand-text font-weight-light" style="margin-left: 4px;">JDIH Kementan</span>
</a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <imgsrc="{{asset('lte')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">JDIH </a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

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
            <a href="tentangkami/visimisi" class="nav-link">
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
          <li class="nav-item">
            <a href="jurnal" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>Jurnal</p>
            </a>
          </li>
          <p>
            <p>
              
            </p>
          </p>
          <li class="nav-item">
            <a href="logout" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>Logout</p>
            </a>
          </li>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  
  
{{-- <body style="background-color: #0d52e77c;">  --}}
    <body  Navbar -->
        <nav class="main-header navbar navbar-expand navbar-green navbar-light">
           <!-- Left navbar links -->
           <ul class="navbar-nav">
             <li class="nav-item">
               <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
             </li>
             <li class="nav-item d-none d-sm-inline-block">
             </li>
           </ul>
       
           <!-- Right navbar links -->
           <ul class="navbar-nav ml-auto">
             <li class="nav-item">
               <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
                 <i class="fas fa-th-large"></i>
               </a>
             </li>
           </ul>
         </nav>
         <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0">Jurnal</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Jurnal</li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>