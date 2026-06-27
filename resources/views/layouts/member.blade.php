<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'VitaGuard') – VitaGuard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

    <style>
        :root {
            --vg-primary:   #0a6ebd;
            --vg-primary-light: #e8f4fd;
            --vg-teal:      #0d9488;
            --vg-teal-light:#e6faf8;
            --vg-surface:   #f6f9fc;
            --vg-card:      #ffffff;
            --vg-border:    #e8edf2;
            --vg-text:      #1a2332;
            --vg-muted:     #6b7a8d;
            --vg-nav-h:     68px;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--vg-surface);
            color: var(--vg-text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── NAVBAR ── */
        .vg-navbar {
            height: var(--vg-nav-h);
            background: #fff;
            border-bottom: 1px solid var(--vg-border);
            position: sticky;
            top: 0;
            z-index: 1030;
            box-shadow: 0 1px 12px rgba(10,110,189,0.07);
        }
        .vg-navbar .navbar-brand {
            font-weight: 800;
            font-size: 1.25rem;
            color: var(--vg-primary) !important;
            letter-spacing: -0.3px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .vg-navbar .navbar-brand .brand-dot {
            width: 28px; height: 28px;
            background: linear-gradient(135deg, var(--vg-primary), var(--vg-teal));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 0.85rem;
        }
        .vg-nav-link {
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--vg-muted) !important;
            padding: 0.4rem 0.85rem !important;
            border-radius: 8px;
            transition: all 0.16s;
        }
        .vg-nav-link:hover,
        .vg-nav-link.active {
            color: var(--vg-primary) !important;
            background: var(--vg-primary-light);
        }
        .vg-nav-link i { margin-right: 4px; }

        /* User avatar pill */
        .vg-user-pill {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.35rem 0.75rem 0.35rem 0.45rem;
            border-radius: 50px;
            border: 1.5px solid var(--vg-border);
            background: #fff;
            cursor: pointer;
            transition: all 0.16s;
            text-decoration: none;
        }
        .vg-user-pill:hover {
            border-color: var(--vg-primary);
            background: var(--vg-primary-light);
        }
        .vg-avatar {
            width: 30px; height: 30px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--vg-primary), var(--vg-teal));
            color: #fff;
            font-size: 0.72rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .vg-user-name {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--vg-text);
            max-width: 120px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* ── PAGE CONTENT ── */
        .vg-main {
            flex: 1;
            padding-top: 2rem;
            padding-bottom: 3rem;
        }

        /* ── FOOTER ── */
        .vg-footer {
            background: #fff;
            border-top: 1px solid var(--vg-border);
            padding: 1.25rem 0;
        }
        .vg-footer .footer-brand {
            font-weight: 800;
            font-size: 1rem;
            color: var(--vg-primary);
        }
        .vg-footer .footer-copy {
            font-size: 0.78rem;
            color: var(--vg-muted);
        }
        .vg-footer .footer-links a {
            font-size: 0.78rem;
            color: var(--vg-muted);
            text-decoration: none;
            margin-left: 1.25rem;
            transition: color 0.15s;
        }
        .vg-footer .footer-links a:hover { color: var(--vg-primary); }

        /* ── DROPDOWN ── */
        .vg-dropdown {
            border: 1px solid var(--vg-border);
            border-radius: 14px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
            padding: 0.5rem;
            min-width: 220px;
        }
        .vg-dropdown .dropdown-item {
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            padding: 0.55rem 0.9rem;
            color: var(--vg-text);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .vg-dropdown .dropdown-item:hover {
            background: var(--vg-primary-light);
            color: var(--vg-primary);
        }
        .vg-dropdown .dropdown-item.text-danger:hover {
            background: #fff0f0;
        }
        .vg-dropdown .dropdown-divider { margin: 0.35rem 0; }
        .vg-dropdown .user-info-header {
            padding: 0.6rem 0.9rem 0.5rem;
            border-bottom: 1px solid var(--vg-border);
            margin-bottom: 0.35rem;
        }
        .vg-dropdown .user-info-header .u-name {
            font-weight: 700;
            font-size: 0.88rem;
            color: var(--vg-text);
        }
        .vg-dropdown .user-info-header .u-email {
            font-size: 0.75rem;
            color: var(--vg-muted);
        }

        /* ── UTILITIES ── */
        .badge-member {
            background: var(--vg-teal-light);
            color: var(--vg-teal);
            font-size: 0.7rem;
            font-weight: 700;
            padding: 0.22rem 0.55rem;
            border-radius: 20px;
            letter-spacing: 0.3px;
        }

        @media (max-width: 768px) {
            .vg-user-name { display: none; }
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- ── NAVBAR ── --}}
    <nav class="vg-navbar">
        <div class="container d-flex align-items-center justify-content-between h-100">

            {{-- Brand --}}
            <a href="{{ route('dashboard') }}" class="navbar-brand text-decoration-none">
                <div class="brand-dot"><i class="bi bi-heart-pulse-fill"></i></div>
                VitaGuard
            </a>

            {{-- Nav links (desktop) --}}
            <ul class="nav d-none d-md-flex align-items-center gap-1">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                       class="vg-nav-link nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-house-door"></i> Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('articles.index') }}"
                       class="vg-nav-link nav-link {{ request()->routeIs('articles*') ? 'active' : '' }}">
                        <i class="bi bi-newspaper"></i> Artikel
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('transactions.index') }}"
                       class="vg-nav-link nav-link {{ request()->routeIs('transactions*') ? 'active' : '' }}">
                        <i class="bi bi-clock-history"></i> Riwayat
                    </a>
                </li>
                <li class="nav-item ms-1">
                    <a href="{{ route('transactions.create') }}" class="btn btn-sm px-3 py-2"
                       style="background: var(--vg-primary); color:#fff; border-radius: 10px; font-weight: 600; font-size: 0.84rem;">
                        <i class="bi bi-calendar-plus me-1"></i> Booking
                    </a>
                </li>
            </ul>

            {{-- User pill + dropdown --}}
            <div class="dropdown">
                <a href="#" class="vg-user-pill dropdown-toggle text-decoration-none"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="vg-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>
                    <span class="vg-user-name">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end vg-dropdown">
                    <li>
                        <div class="user-info-header">
                            <div class="u-name">{{ Auth::user()->name }}</div>
                            <div class="u-email">{{ Auth::user()->email }}</div>
                            <span class="badge-member mt-1 d-inline-block">Member</span>
                        </div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="bi bi-person-gear text-muted"></i> Edit Profil
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('transactions.index') }}">
                            <i class="bi bi-receipt text-muted"></i> Riwayat Konsultasi
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger w-100 border-0 bg-transparent text-start">
                                <i class="bi bi-box-arrow-right"></i> Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    {{-- ── MAIN CONTENT ── --}}
    <main class="vg-main">
        <div class="container">
            @yield('content')
        </div>
    </main>

    {{-- ── FOOTER ── --}}
    <footer class="vg-footer">
        <div class="container d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div>
                <div class="footer-brand">VitaGuard</div>
                <div class="footer-copy">© {{ date('Y') }} VitaGuard. All rights reserved.</div>
            </div>
            <div class="footer-links">
                <a href="{{ route('articles.index') }}">Artikel</a>
                <a href="{{ route('profile.edit') }}">Profil</a>
                <a href="{{ route('transactions.index') }}">Riwayat</a>
            </div>
        </div>
    </footer>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')

</body>
</html>