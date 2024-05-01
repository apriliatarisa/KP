<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon" style="background-color: white; padding: 5px; border-radius: 50%; margin-top: 20px;">
            <img src="{{ asset('logo/asabri.png') }}" alt="Logo Perusahaan" style="max-width: 100%; height: auto;">
        </div>
    </a>    
    <center>
        <div class="sidebar-brand-text mx-1" style="color: white; font-weight: bold; margin-top: 15px; font-family: 'Arial', sans-serif;">SIAP SURAT</div>
    </center>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

   <!-- Nav Item - Beranda -->
    <li class="nav-item">
    {{-- <a class="nav-link" href="index.html">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Beranda</span></a> --}}
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
    <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="fas fa-fw fa-home"></i>
        <span>Beranda</span>
    </a>
    </li>

    <!-- Nav Item - Surat Masuk -->
    <li class="nav-item">
    <a class="nav-link" href="{{ route('surat_masuk.index') }}">
        <i class="fas fa-envelope"></i>
        <span>Surat Masuk</span>
    </a>
    </li>

    <!-- Nav Item - Disposisi Surat Masuk -->
    <li class="nav-item">
    <a class="nav-link" href="{{ route('disposisi_sm.index') }}">
        <i class="fas fa-fw fa-envelope"></i>
        <span>Disposisi Surat Masuk</span>
    </a>
    </li>

    <!-- Nav Item - Surat Masuk -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('surat_keluar.index') }}">
            <i class="fas fa-envelope"></i>
            <span>Surat Keluar</span>
        </a>
        </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>