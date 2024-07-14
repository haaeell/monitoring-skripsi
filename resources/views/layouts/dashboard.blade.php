<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('assets/') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard | Monitoring Skripsi</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon"
        href="https://almaata.ac.id/wp-content/uploads/2017/05/logo-alma-ata.jpg" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/theme-default.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
   
    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('assets') }}/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets') }}/js/config.js"></script>
</head>
<style>
    @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css");
</style>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="index.html" class="app-brand-link">

                        <span class="app-brand-text demo menu-text fw-bold ms-2">Skripsi</span>
                    </a>

                    <a href="javascript:void(0);"
                        class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Apps -->

                    <li class="menu-item {{ request()->is('home') ? 'active' : '' }}">
                        <a href="{{ route('home') }}" class="menu-link">
                            <i class="menu-icon bx bx-home-circle"></i>
                            <div data-i18n="Dashboards">Dashboards</div>
                        </a>
                    </li>

                    @if (Auth::user()->role == 'admin')
                        <li class="menu-header small text-uppercase">
                            <span class="menu-header-text">Data Master</span>
                        </li>
                        <li class="menu-item {{ request()->is('users*') ? 'active' : '' }}">
                            <a href="{{ route('users.index') }}" class="menu-link">
                                <i class="menu-icon bx bx-envelope"></i>
                                <div data-i18n="Email">Data Users</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('judul-skripsi*') ? 'active' : '' }}">
                            <a href="{{ route('judul-skripsi.index') }}" class="menu-link">
                                <i class="menu-icon bx bx-chat"></i>
                                <div data-i18n="Chat">Setujui Judul</div>
                            </a>
                        </li>
                    
                        <li class="menu-item {{ request()->is('jadwal-ujian') ? 'active' : '' }}">
                            <a href="{{ route('jadwal-ujian.index') }}" class="menu-link">
                                <i class="menu-icon bx bx-calendar"></i>
                                <div data-i18n="Email"> Jadwal Ujian</div>
                            </a>
                        </li>
                    @endif

                    @if (Auth::user()->role == 'pembimbing')
                        <li class="menu-item {{ request()->is('bimbingan') ? 'active' : '' }}">
                            <a href="{{ route('bimbingan.index') }}" class="menu-link">
                                <i class="menu-icon bx bx-group"></i>
                                <div data-i18n="Mahasiswa Bimbingan">Mahasiswa Bimbingan</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('bimbingan-skripsi*') ? 'active' : '' }}">
                            <a href="{{ route('bimbingan-skripsi.index') }}" class="menu-link">
                                <i class="menu-icon bx bx-chat"></i>
                                <div data-i18n="Chat">Bimbingan Skripsi</div>
                            </a>
                        </li>
                       
                        <li class="menu-item {{ request()->is('judul-skripsi*') ? 'active' : '' }}">
                            <a href="{{ route('judul-skripsi.index') }}" class="menu-link">
                                <i class="menu-icon bx bx-chat"></i>
                                <div data-i18n="Chat"> Judul Skripsi</div>
                            </a>
                        </li>
                    @endif

                    @if (Auth::user()->role == 'mahasiswa')
                        <li class="menu-item {{ request()->is('judul-skripsi*') ? 'active' : '' }}">
                            <a href="{{ route('judul-skripsi.index') }}" class="menu-link">
                                <i class="menu-icon bx bx-message"></i>
                                <div data-i18n="judul-skripsi">Judul Skripsi</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('bimbingan-skripsi*') ? 'active' : '' }}">
                            <a href="{{ route('bimbingan-skripsi.index') }}" class="menu-link">
                                <i class="menu-icon bx bx-chat"></i>
                                <div data-i18n="Chat">Bimbingan</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('pesan*') ? 'active' : '' }}">
                            <a href="{{ route('pesan.index') }}" class="menu-link">
                                <i class="menu-icon bx bx-message"></i>
                                <div data-i18n="Pesan">Pesan</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('riwayat*') ? 'active' : '' }}">
                            <a href="{{ route('riwayat.index') }}" class="menu-link">
                                <i class="menu-icon bx bx-history"></i>
                                <div data-i18n="Riwayat Bimbingan">Riwayat Bimbingan</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('jadwal-ujian') ? 'active' : '' }}">
                            <a href="{{ route('jadwal-ujian.index') }}" class="menu-link">
                                <i class="menu-icon bx bx-calendar"></i>
                                <div data-i18n="Email"> Jadwal Ujian</div>
                            </a>
                        </li>
                    @endif
                    <li class="menu-item {{ request()->is('profile*') ? 'active' : '' }}">
                        <a href="{{ route('profile.index') }}" class="menu-link">
                            <i class="menu-icon bx bx-user"></i>
                            <div data-i18n="Riwayat Bimbingan">Profile</div>
                        </a>
                    </li>


                </ul>

            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center">
                                <i class="bx bx-search fs-4 lh-0"></i>
                                <input type="text" class="form-control border-0 shadow-none ps-1 ps-sm-2"
                                    placeholder="Search..." aria-label="Search..." />
                            </div>
                        </div>
                        <!-- /Search -->

                        <ul class="navbar-nav flex-row align-items-center ms-auto">

                            <!-- User -->
                            <!-- Notification -->
                            @php
                            $notifications = Auth::user()->unreadNotifications;
                        @endphp
                        
                        <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                               data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                <i class="bx bx-bell bx-sm"></i>
                                <span class="badge bg-danger rounded-pill badge-notifications">{{ $notifications->count() }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end py-0">
                                <li class="dropdown-menu-header border-bottom">
                                    <div class="dropdown-header d-flex align-items-center py-3">
                                        <h5 class="text-body mb-0 me-auto">Notifikasi</h5>
                                        <form action="{{ route('notifications.markAllAsRead') }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="dropdown-notifications-all text-body"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Tandai semua sebagai sudah dibaca">
                                                <i class="bx fs-4 bx-envelope-open"></i>
                                            </button>
                                        </form>
                                    </div>
                                </li>
                                <li class="dropdown-notifications-list scrollable-container">
                                    <ul class="list-group list-group-flush">
                                        @if (Auth::user()->role == 'mahasiswa')
                                            @foreach ($notifications as $notification)
                                                <div>
                                                    <a href="{{ route('pesan.index') }}" class="notification-link" data-id="{{ $notification->id }}">
                                                        <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                                            <div class="d-flex">
                                                                <div class="flex-grow-1">
                                                                    <p class="mb-0">{{ $notification->data['message'] }}</p>
                                                                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </a>
                                                </div>
                                            @endforeach
                                        @else
                                            @foreach ($notifications as $notification)
                                                <a href="{{ url('/bimbingan-skripsi?mahasiswa_id=' . $notification->data['mahasiswa_id']) }}" class="notification-link" data-id="{{ $notification->id }}">
                                                    <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                                        <div class="d-flex">
                                                            <div class="flex-grow-1">
                                                                <p class="mb-0">{{ $notification->data['message'] }}</p>
                                                                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                                            </div>
                                                            <div class="flex-shrink-0 dropdown-notifications-actions">
                                                                <a href="{{ url('/bimbingan-skripsi?mahasiswa_id=' . $notification->data['mahasiswa_id']) }}" class="dropdown-notifications-read">
                                                                    <span class="badge badge-dot"></span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </a>
                                            @endforeach
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                document.querySelector('.nav-link.dropdown-toggle').addEventListener('click', function () {
                                    fetch('{{ route('notifications.markAllAsRead') }}', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: JSON.stringify({})
                                    }).then(response => {
                                        if (!response.ok) {
                                            throw new Error('Network response was not ok ' + response.statusText);
                                        }
                                        return response.json();
                                    }).then(data => {
                                        if (data.status === 'success') {
                                            document.querySelector('.badge-notifications').textContent = '0';
                                        } else {
                                            console.error('Error:', data);
                                        }
                                    }).catch(error => console.error('Fetch error:', error));
                                });
                            });
                        </script>
                        

                            <!--/ Notification -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{ Auth::user()->photo ? Auth::user()->photo : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSt9ISaBFDC88ejiGrYACSt81CFq21QsZ6bow&s' }}" 
                                        alt="User Photo" class="w-px-30 h-auto rounded-circle" />
                                    </div>
                                    
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{ Auth::user()->photo ? Auth::user()->photo : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSt9ISaBFDC88ejiGrYACSt81CFq21QsZ6bow&s' }}" 
                                                        alt="User Photo" class="w-px-30 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-medium d-block">{{ Auth::user()->name }}</span>
                                                    <small class="text-muted">{{ Auth::user()->role }}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile.index') }}">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">My Profile</span>
                                        </a>
                                    </li>

                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Log Out</span>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>

                <div class="container py-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    @if (Session::has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ Session::get('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    @yield('content')
                </div>
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->


    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js ') }}"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('.datatable').DataTable();
        });
    </script>
     <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
     <script>
         $(document).ready(function() {
             $('.select2').select2();
         });
     </script>
    @yield('scripts')
    <script src="{{ asset('assets') }}/vendor/libs/popper/popper.js"></script>
    <script src="{{ asset('assets') }}/vendor/js/bootstrap.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="{{ asset('assets') }}/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets') }}/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets') }}/js/main.js"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets') }}/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
