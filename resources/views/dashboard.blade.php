@extends('layouts.adminlte')

@section('title', 'Dashboard')

@push('styles')
    <style>
        .stat-card {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12) !important;
        }

        .stat-card .card-body {
            padding: 1.5rem;
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            line-height: 1;
            margin: 0.25rem 0;
        }

        .stat-label {
            font-size: 0.8rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            opacity: 0.65;
        }

        .stat-trend {
            font-size: 0.78rem;
            font-weight: 500;
        }

        .welcome-banner {
            background: linear-gradient(135deg, #0d6efd 0%, #0a4ebf 60%, #083a9a 100%);
            border-radius: 20px;
            padding: 2rem 2.5rem;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .welcome-banner::before {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.06);
            border-radius: 50%;
        }

        .welcome-banner::after {
            content: '';
            position: absolute;
            bottom: -60px;
            right: 80px;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.04);
            border-radius: 50%;
        }

        .welcome-banner .role-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.18);
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 20px;
            padding: 0.25rem 0.9rem;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-bottom: 0.75rem;
        }

        .welcome-banner h4 {
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 0.35rem;
        }

        .welcome-banner p {
            opacity: 0.8;
            margin: 0;
            font-size: 0.92rem;
        }

        .section-title {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #6c757d;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #f0f0f0;
        }

        .quick-action-btn {
            border-radius: 12px;
            padding: 0.75rem 1.25rem;
            font-weight: 500;
            font-size: 0.88rem;
            border: 1.5px solid transparent;
            transition: all 0.18s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .quick-action-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 6px;
        }

        .status-dot.pending {
            background: #ffc107;
        }

        .status-dot.active {
            background: #198754;
        }

        .status-dot.completed {
            background: #0d6efd;
        }

        .recent-card {
            border: none;
            border-radius: 16px;
            overflow: hidden;
        }

        .recent-card .card-header {
            background: transparent;
            border-bottom: 1px solid #f0f0f0;
            padding: 1.25rem 1.5rem 1rem;
            font-weight: 700;
            font-size: 0.95rem;
        }
    </style>
@endpush

@section('content')

    {{-- App Content Header --}}
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0 fw-bold">Dashboard</h3>
                </div>
                <div class="col-sm-6 text-end">
                    <small class="text-muted">
                        <i class="bi bi-calendar3 me-1"></i>
                        {{ now()->translatedFormat('l, d F Y') }}
                    </small>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            {{-- =============================== --}}
            {{-- WELCOME BANNER --}}
            {{-- =============================== --}}
            <div class="row mb-4">
                <div class="col-12">
                    <div class="welcome-banner shadow-sm">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                            <div>
                                <div class="role-badge">
                                    <i class="bi bi-shield-check me-1"></i>
                                    {{ ucfirst(Auth::user()->role) }}
                                </div>
                                <h4>Selamat datang, {{ Auth::user()->name }}!</h4>
                                <p>
                                    @if (Auth::user()->isAdmin())
                                        Pantau seluruh aktivitas sistem VitaGuard dari sini.
                                    @elseif(Auth::user()->isDoctor())
                                        Kelola jadwal konsultasi dan pasien Anda hari ini.
                                    @else
                                        Temukan dokter terbaik dan mulai konsultasi Anda.
                                    @endif
                                </p>
                            </div>
                            <div class="text-end">
                                <i class="bi bi-heart-pulse" style="font-size: 4rem; opacity: 0.15;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- =============================== --}}
            {{-- ADMIN DASHBOARD --}}
            {{-- =============================== --}}
            @if (Auth::user()->isAdmin())

                <p class="section-title">Ringkasan Sistem</p>

                <div class="row g-3 mb-4">

                    <div class="row g-3 mb-4">

                        {{-- Dokter --}}
                        <div class="col-6 col-lg-3">
                            <div class="card stat-card shadow-sm h-100">
                                <div class="card-body">
                                    <div class="stat-icon bg-primary bg-opacity-10 text-primary mb-3">
                                        <i class="bi bi-person-badge-fill"></i>
                                    </div>
                                    <div class="stat-value text-dark">{{ $totalDoctors }}</div>
                                    <div class="stat-label">Dokter</div>
                                </div>
                            </div>
                        </div>

                        {{-- Member --}}
                        <div class="col-6 col-lg-3">
                            <div class="card stat-card shadow-sm h-100">
                                <div class="card-body">
                                    <div class="stat-icon bg-success bg-opacity-10 text-success mb-3">
                                        <i class="bi bi-people-fill"></i>
                                    </div>
                                    <div class="stat-value text-dark">{{ $totalMembers }}</div>
                                    <div class="stat-label">Member</div>
                                </div>
                            </div>
                        </div>

                        {{-- Artikel --}}
                        <div class="col-6 col-lg-3">
                            <div class="card stat-card shadow-sm h-100">
                                <div class="card-body">
                                    <div class="stat-icon bg-warning bg-opacity-10 text-warning mb-3">
                                        <i class="bi bi-newspaper"></i>
                                    </div>
                                    <div class="stat-value text-dark">{{ $totalArticles }}</div>
                                    <div class="stat-label">Artikel</div>
                                </div>
                            </div>
                        </div>

                        {{-- Transaction --}}
                        <div class="col-6 col-lg-3">
                            <div class="card stat-card shadow-sm h-100">
                                <div class="card-body">
                                    <div class="stat-icon bg-info bg-opacity-10 text-info mb-3">
                                        <i class="bi bi-receipt"></i>
                                    </div>
                                    <div class="stat-value text-dark">{{ $totalTransactions }}</div>
                                    <div class="stat-label">Transaksi</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Quick Actions Admin --}}
                <p class="section-title">Aksi Cepat</p>
                <div class="row g-2 mb-4">
                    <div class="col-auto">
                        <a href="{{ route('admin.doctors.create') }}" class="btn btn-outline-primary quick-action-btn">
                            <i class="bi bi-person-plus-fill"></i> Tambah Dokter
                        </a>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary quick-action-btn">
                            <i class="bi bi-people-fill"></i> Kelola Member
                        </a>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('articles.create') }}" class="btn btn-outline-warning quick-action-btn">
                            <i class="bi bi-file-earmark-plus-fill"></i> Tulis Artikel
                        </a>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('transactions.index') }}" class="btn btn-outline-info quick-action-btn">
                            <i class="bi bi-receipt"></i> Lihat Transaksi
                        </a>
                    </div>
                </div>

                <div class="row g-3">

                    <div class="col-md-6">
                        <div class="card recent-card shadow-sm">
                            <div class="card-header">
                                <i class="bi bi-info-circle me-2 text-info"></i>Info Sistem
                            </div>
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between px-3 py-2">
                                        <small class="text-muted">Total Pengguna</small>
                                        <span class="fw-bold">{{ $totalDoctors + $totalMembers }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between px-3 py-2">
                                        <small class="text-muted">Rata-rata Transaksi/Dokter</small>
                                        <span
                                            class="fw-bold">{{ $totalDoctors ? round($totalTransactions / $totalDoctors, 1) : 0 }}</span>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- =============================== --}}
                {{-- DOCTOR DASHBOARD --}}
                {{-- =============================== --}}
            @elseif(Auth::user()->isDoctor())
                <p class="section-title">Statistik Praktik Anda</p>

                <div class="row g-3 mb-4">

                    <div class="col-sm-6 col-lg-4">
                        <div class="card stat-card shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <div class="stat-label mb-2">Menunggu Konfirmasi</div>
                                        <div class="stat-value text-warning">{{ $pendingBookings }}</div>
                                    </div>
                                    <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                                        <i class="bi bi-hourglass-split"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="card stat-card shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <div class="stat-label mb-2">Konsultasi Aktif</div>
                                        <div class="stat-value text-success">{{ $activeConsult }}</div>
                                    </div>
                                    <div class="stat-icon bg-success bg-opacity-10 text-success">
                                        <i class="bi bi-activity"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="card stat-card shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <div class="stat-label mb-2">Total Selesai</div>
                                        <div class="stat-value text-primary">{{ $completedConsult }}</div>
                                    </div>
                                    <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                                        <i class="bi bi-patch-check-fill"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Quick Actions Doctor --}}
                <p class="section-title">Aksi Cepat</p>
                <div class="row g-2 mb-4">
                    <div class="col-auto">
                        <a href="{{ route('transactions.index') }}" class="btn btn-success quick-action-btn">
                            <i class="bi bi-calendar-check"></i> Lihat Booking Masuk
                        </a>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('articles.create') }}" class="btn btn-outline-warning quick-action-btn">
                            <i class="bi bi-pencil-square"></i> Tulis Artikel
                        </a>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary quick-action-btn">
                            <i class="bi bi-person-gear"></i> Update Profil
                        </a>
                    </div>
                </div>

                {{-- Info Spesialisasi --}}
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="card recent-card shadow-sm">
                            <div class="card-header">
                                <i class="bi bi-award-fill me-2 text-warning"></i>Spesialisasi Anda
                            </div>
                            <div class="card-body p-0">
                                @forelse(Auth::user()->specializations as $spec)
                                    <div class="list-group-item px-3 py-2 border-bottom">
                                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                                        {{ $spec->name }}
                                    </div>
                                @empty
                                    <div class="px-3 py-3 text-muted text-center">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Belum ada spesialisasi terdaftar.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card recent-card shadow-sm">
                            <div class="card-header">
                                <i class="bi bi-bar-chart me-2 text-primary"></i>Ringkasan Konsultasi
                            </div>
                            <div class="card-body">
                                @php $totalDoc = $pendingBookings + $activeConsult + $completedConsult ?: 1; @endphp
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-1">
                                        <small><span class="status-dot pending"></span>Pending</small>
                                        <small class="fw-bold">{{ $pendingBookings }}</small>
                                    </div>
                                    <div class="progress" style="height: 8px; border-radius: 4px;">
                                        <div class="progress-bar bg-warning"
                                            style="width: {{ ($pendingBookings / $totalDoc) * 100 }}%"></div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-1">
                                        <small><span class="status-dot active"></span>Aktif</small>
                                        <small class="fw-bold">{{ $activeConsult }}</small>
                                    </div>
                                    <div class="progress" style="height: 8px; border-radius: 4px;">
                                        <div class="progress-bar bg-success"
                                            style="width: {{ ($activeConsult / $totalDoc) * 100 }}%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <small><span class="status-dot completed"></span>Selesai</small>
                                        <small class="fw-bold">{{ $completedConsult }}</small>
                                    </div>
                                    <div class="progress" style="height: 8px; border-radius: 4px;">
                                        <div class="progress-bar bg-primary"
                                            style="width: {{ ($completedConsult / $totalDoc) * 100 }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endif

        </div>
    </div>

@endsection
