<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('title', 'AdminLTE v4 | Dashboard')</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="AdminLTE v4 | Dashboard" />
    <meta name="author" content="ColorlibHQ" />
    <!--end::Primary Meta Tags-->
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
        integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous" />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('AdminLTE4/css/adminlte.css') }}" />
    <!--end::Required Plugin(AdminLTE)-->
    <!--begin::Required Plugin(Bootstrap 5)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />
    <!--end::Required Plugin(Bootstrap 5)-->
    @stack('styles')
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

    <!--begin::App Wrapper-->
    <div class="app-wrapper">

        <!--begin::Header-->
        <nav class="app-header navbar navbar-expand bg-body">
            <div class="container-fluid">
                <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                </ul>
                <!--end::Start Navbar Links-->

                <!--begin::End Navbar Links-->
                <ul class="navbar-nav ms-auto">
                   
                    <!--begin::Fullscreen Toggle-->
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                            <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                            <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                        </a>
                    </li>
                    <!--end::Fullscreen Toggle-->

                    <!--begin::User Menu Dropdown-->
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle d-flex align-items-center"
                            data-bs-toggle="dropdown" style="padding: 0.5rem 0.75rem;">
                            <div class="rounded-circle shadow-sm d-flex align-items-center justify-content-center bg-gradient-info text-white font-weight-bold border border-white"
                                style="width: 32px; height: 32px; font-size: 0.85rem; letter-spacing: 0.5px;">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                            <span class="d-none d-md-inline ml-2 font-weight-semibold text-dark"
                                style="font-size: 0.95rem;">
                                {{ Auth::user()->name }}
                            </span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end shadow-lg border-0"
                            style="border-radius: 16px; overflow: hidden; min-width: 280px; margin-top: 10px;">

                            <li class="user-header text-center p-4 d-flex flex-column align-items-center justify-content-center"
                                style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">

                                <div class="bg-white rounded-circle d-flex align-items-center justify-content-center text-primary shadow-sm mb-3"
                                    style="width: 72px; height: 72px; box-shadow: 0 4px 15px rgba(255,255,255,0.2) !important;">
                                    <i class="fas fa-user-md" style="font-size: 2.2rem;"></i>
                                </div>

                                <h6 class="text-white font-weight-bold mb-1"
                                    style="font-size: 1.1rem; letter-spacing: 0.3px;">
                                    {{ Auth::user()->name }}
                                </h6>
                                <p class="text-white mb-3"
                                    style="font-size: 0.85rem; opacity: 0.85; font-weight: 300;">
                                    {{ Auth::user()->email }}
                                </p>

                                <span
                                    class="badge bg-white text-primary px-3 py-2 rounded-pill font-weight-semibold shadow-sm"
                                    style="font-size: 0.75rem; letter-spacing: 0.3px;">
                                    <i class="far fa-calendar-alt mr-1"></i> Bergabung:
                                    {{ Auth::user()->created_at->format('d M Y') }}
                                </span>
                            </li>

                            <li
                                class="user-footer bg-white p-3 d-flex justify-content-between align-items-center border-top border-light">
                                <a href="{{ route('profile.edit') }}"
                                    class="btn btn-light btn-sm text-secondary font-weight-medium px-3 py-2 rounded-lg transition-all"
                                    style="border-radius: 10px; font-size: 0.85rem; border: 1px solid #e2e8f0;">
                                    <i class="fas fa-user-cog text-muted mr-1.5"></i> Pengaturan
                                </a>

                                <form method="POST" action="{{ route('logout') }}" class="m-0">
                                    @csrf
                                    <button type="submit"
                                        class="btn btn-danger btn-sm font-weight-semibold px-3 py-2 shadow-sm transition-all"
                                        style="border-radius: 10px; font-size: 0.85rem; background-color: #dc3545; border: none;"
                                        onclick="return confirm('Apakah Anda yakin ingin keluar dari sistem?')">
                                        <i class="fas fa-sign-out-alt mr-1.5"></i> Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    <!--end::User Menu Dropdown-->
                </ul>
                <!--end::End Navbar Links-->
            </div>
        </nav>
        <!--end::Header-->

        <!--begin::Sidebar-->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <!--begin::Sidebar Brand-->
            <div class="sidebar-brand">
                <a href="{{ route('dashboard') }}" class="brand-link">
                    <img src="{{ asset('AdminLTE4/assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                        class="brand-image opacity-75 shadow" />
                    <span class="brand-text fw-light">WFP Admin</span>
                </a>
            </div>
            <!--end::Sidebar Brand-->

            <!--begin::Sidebar Wrapper-->
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link {{ activeRoute('dashboard') }}">
                                <i class="nav-icon bi bi-speedometer"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        @if (Auth::user()->isAdmin())
                            <li class="nav-item">
                                <a href="{{ route('admin.users.index') }}"
                                    class="nav-link {{ activeRoute('admin.users*') }}">
                                    <i class="nav-icon bi bi-people-fill"></i>
                                    <p>Users</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.doctors.index') }}"
                                    class="nav-link {{ activeRoute('admin.doctors*') }}">
                                    <i class="nav-icon bi bi-person-badge"></i>
                                    <p>Doctors</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.categories.index') }}"
                                    class="nav-link {{ activeRoute('admin.categories*') }}">
                                    <i class="nav-icon bi bi-tag-fill"></i>
                                    <p>Categories</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.services.index') }}"
                                    class="nav-link {{ activeRoute('admin.services*') }}">
                                    <i class="nav-icon bi bi-palette"></i>
                                    <p>Services</p>
                                </a>
                            </li>
                        @endif

                        {{-- Admin & Doctor --}}
                        @if (Auth::user()->isAdmin() || Auth::user()->isDoctor())
                            <li class="nav-item">
                                <a href="{{ route('articles.index') }}"
                                    class="nav-link {{ activeRoute('articles*') }}">
                                    <i class="nav-icon bi bi-newspaper"></i>
                                    <p>Articles</p>
                                </a>
                            </li>
                        @endif

                        {{-- Semua role (auth) --}}
                        <li class="nav-item">
                            <a href="{{ route('transactions.index') }}"
                                class="nav-link {{ activeRoute('transactions*') }}">
                                <i class="nav-icon bi bi-receipt"></i>
                                <p>Transactions</p>
                            </a>
                        </li>

                        {{-- logout --}}
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="nav-icon bi bi-box-arrow-right"></i>
                                <p>Logout</p>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>

                    </ul>
                </nav>
            </div>
            <!--end::Sidebar Wrapper-->
        </aside>
        <!--end::Sidebar-->

        <!--begin::App Main-->
        <main class="app-main">
            @yield('content')
            @stack('modals')
        </main>
        <!--end::App Main-->

        <!--begin::Footer-->
        <footer class="app-footer">
            <div class="float-end d-none d-sm-inline">WFP Admin Panel</div>
            <strong>
                Copyright &copy; 2014-2024&nbsp;
                <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.
            </strong>
            All rights reserved.
        </footer>
        <!--end::Footer-->

    </div>
    <!--end::App Wrapper-->

    <!--begin::Scripts-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
        integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)-->
    <!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
    <!--end::Required Plugin(Bootstrap 5)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <script src="{{ asset('AdminLTE4/js/adminlte.js') }}"></script>
    <!--end::Required Plugin(AdminLTE)-->
    <!--begin::OverlayScrollbars Configure-->
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true,
        };
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script>
    <!--end::OverlayScrollbars Configure-->
    @stack('script')
    <!--end::Scripts-->

</body>

</html>
