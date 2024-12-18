<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Virtus Mart Retail</title>
    {{-- @vite([
        // 'resources/css/app.css',
        'resources/fontawesome-free/css/all.min.css',
        'resources/css/sb-admin-2.min.css',
    ]) --}}
    <link href="{{ asset('assets/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    {{-- {{-- <link rel="stylesheet" href="{{ asset('assets/css/dashlite.css?ver=2.4.0') }}"> --}}
    {{-- <link id="skin-default" rel="stylesheet" href="{{ asset('assets/css/theme.css?ver=2.4.0') }}"> --}}
</head>

<body id="page-top" style="height: auto;">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset('img/virtusmart.png') }}" alt="Retail" width="100%" class="img-fluid">
                </div>
                <div class="sidebar-brand-text mx-3">Virtus Mart Retail</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdmin"
                    aria-expanded="false" aria-controls="collapseAdmin">
                    <i class="fas fa-fw fa-cogs"></i>
                    <span>User Menu</span>
                </a>
                <div id="collapseAdmin" class="collapse" aria-labelledby="headingAdmin" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Admin Options:</h6>
                        <a class="collapse-item" href="{{ route('absensi.index') }}">Absen</a>
                        <a class="collapse-item" href="{{ route('ganti-password') }}">Ganti Password</a>
                    </div>
                </div>
            </li>
            @if (Auth::check() && (Auth::user()->role->id_role == 1 || Auth::user()->role->id_role == 3))
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="false" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-users"></i> <!-- Updated icon -->
                        <span>SDM</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Menu SDM</h6>
                            <a class="collapse-item" href="{{ route('karyawan.index') }}">Data Karyawan</a>
                            <a class="collapse-item" href="{{ route('manageAbsensi.index') }}">Manajemen Absensi</a>
                            <a class="collapse-item" href="{{ route('shift.index') }}">Manajemen Shift</a>
                        </div>
                    </div>
                </li>
            @endif

            <!-- Nav Item - Utilities Collapse Menu -->
            @if(session('user_role')->id_role == 2 || session('user_role')->id_role == 3)
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-boxes"></i> <!-- Updated icon -->
                    <span>Manajemen Inventori</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Manajemen Inventori:</h6>
                        <a class="collapse-item" href="{{ route('produks.index') }}">Daftar Produk</a>
                        <a class="collapse-item" href="{{ route('stokopnames.create') }}">Stokopname</a>
                        {{-- <a class="collapse-item" href="utilities-animation.html">Penerimaan Barang</a> --}}
                        <a class="collapse-item" href="{{ route('stokrequests.index') }}">Restock Produk</a>
                        {{-- <a class="collapse-item" href="utilities-other.html">Retur Barang</a> --}}
                    </div>
                </li>
            @endif

            @if(session('user_role')->id_role == 4 || session('user_role')->id_role == 3)
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKeuangan"
                    aria-expanded="true" aria-controls="collapseKeuangan">
                    <i class="fas fa-fw fa-money-bill-wave"></i> <!-- Updated icon -->
                    <span>Keuangan</span>
                </a>
                <div id="collapseKeuangan" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Keuangan:</h6>
                        <a class="collapse-item" href="{{ route('akuns.index') }}">Akun</a>
                        <a class="collapse-item" href="{{ route('suppliers.index') }}">Supplier</a>
                        {{-- <a class="collapse-item" href="utilities-color.html">Buku Besar</a> --}}
                        {{-- <a class="collapse-item" href="utilities-border.html">Hutang</a> --}}
                        <a class="collapse-item" href="{{ route('beli') }}">Pembelian</a>
                        <a class="collapse-item" href="{{ route('penggajian.index') }}">Penggajian</a>
                        <a class="collapse-item" href="{{ route('jurnals.index') }}">Jurnal</a>
                        {{-- <a class="collapse-item" href="utilities-other.html">Laporan Keuangan</a> --}}
                    </div>
                </li>
            @endif

            <!-- Nav Item - Pages Collapse Menu -->
            @if (session('user_role')->id_role == 5 || session('user_role')->id_role == 3)
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                        aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-shopping-cart"></i> <!-- Updated icon -->
                        <span>Penjualan</span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Penjualan (Sales)</h6>
                            <a class="collapse-item" href="{{ route('pos.index') }}">Point of Sale (POS)</a>
                            <a class="collapse-item" href="{{ route('pelanggan.data') }}">Pengelolaan Pelanggan</a>
                            <a class="collapse-item" href="{{ route('laporan.index') }}">Laporan Penjualan</a>
                        </div>
                    </div>
                </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <div id="content" style="width: 100%">
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Topbar Clock -->
                <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div id="clock" class="text-gray-600 small" style="font-weight:bold"></div>
                </div>

                <script>
                    function updateClock() {
                        var now = new Date();
                        var hours = now.getHours();
                        var minutes = now.getMinutes();
                        var seconds = now.getSeconds();
                        var day = now.getDate();
                        var month = now.getMonth() + 1; // Months are zero-based
                        var year = now.getFullYear();

                        // Add leading zeros
                        hours = (hours < 10 ? "0" : "") + hours;
                        minutes = (minutes < 10 ? "0" : "") + minutes;
                        seconds = (seconds < 10 ? "0" : "") + seconds;
                        day = (day < 10 ? "0" : "") + day;
                        month = (month < 10 ? "0" : "") + month;

                        // Month names
                        var monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",
                            "Oktober", "November", "Desember"
                        ];
                        var monthName = monthNames[now.getMonth()];

                        var timeString = hours + ":" + minutes + ":" + seconds;
                        var dateString = day + " " + monthName + " " + year;

                        document.getElementById('clock').innerHTML = dateString + " " + timeString;
                    }

                    setInterval(updateClock, 1000);
                    updateClock(); // initial call
                </script>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                            aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                        placeholder="Search for..." aria-label="Search"
                                        aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>


                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->nama }}</span>
                            {{-- <img class="img-profile rounded-circle"
                                src="img/undraw_profile.svg"> --}}
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Anda yakin untuk keluar</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">Jika yakin keluar maka klik logout.</div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <a class="btn btn-primary" href="{{ route('login') }}">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>
    {{-- <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> --}}
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets/js/demo/chart-pie-demo.js') }}"></script>
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
    @stack('scripts')

    {{-- <script src="{{ asset('assets/js/bundle.js?ver=2.4.0') }}"></script>
    <script src="{{ asset('assets/js/scripts.js?ver=2.4.0') }}"></script>
    <script src="{{ asset('assets/js/charts/gd-analytics.js?ver=2.4.0') }}"></script>
    <script src="{{ asset('assets/js/libs/jqvmap.js?ver=2.4.0') }}"></script> --}}
</body>

</html>
