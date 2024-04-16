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
    <a class="nav-link" href="index.html">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Beranda</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    {{-- <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item ">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse " aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="login.html">Login</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item " href="blank.html">Blank Page</a>
            </div>
        </div>
    </li> --}}

    <!-- Nav Item - Surat Masuk -->
    <li class="nav-item">
    <a class="nav-link" href="{{ route('surat_masuk.index') }}">
        <i class="fas fa-envelope"></i>
        <span>Surat Masuk</span>
    </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>