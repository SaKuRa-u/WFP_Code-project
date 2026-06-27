@extends('layouts.member')

@section('title', 'Dashboard')

@push('styles')
<style>
    .hero-banner {
        background: linear-gradient(135deg, #0a6ebd 0%, #0d9488 100%);
        border-radius: 20px;
        padding: 2.25rem 2.5rem;
        color: #fff;
        position: relative;
        overflow: hidden;
        margin-bottom: 2rem;
    }
    .hero-banner::before {
        content: '';
        position: absolute;
        top: -50px; right: -30px;
        width: 220px; height: 220px;
        background: rgba(255,255,255,0.07);
        border-radius: 50%;
    }
    .hero-banner::after {
        content: '';
        position: absolute;
        bottom: -70px; right: 100px;
        width: 160px; height: 160px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
    }
    .hero-banner .greeting {
        font-size: 0.82rem;
        font-weight: 600;
        opacity: 0.8;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 0.4rem;
    }
    .hero-banner h3 {
        font-size: 1.75rem;
        font-weight: 800;
        margin-bottom: 0.4rem;
        line-height: 1.2;
    }
    .hero-banner p {
        opacity: 0.82;
        font-size: 0.9rem;
        margin-bottom: 1.25rem;
    }
    .hero-cta {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: #fff;
        color: #0a6ebd;
        font-weight: 700;
        font-size: 0.85rem;
        padding: 0.6rem 1.25rem;
        border-radius: 10px;
        text-decoration: none;
        transition: all 0.18s;
        box-shadow: 0 4px 12px rgba(0,0,0,0.12);
    }
    .hero-cta:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(0,0,0,0.15);
        color: #0a6ebd;
    }
    .hero-icon {
        font-size: 5rem;
        opacity: 0.12;
        position: absolute;
        bottom: -0.5rem;
        right: 2rem;
        line-height: 1;
    }

    /* Stat cards */
    .vg-stat {
        background: #fff;
        border: 1px solid var(--vg-border);
        border-radius: 16px;
        padding: 1.4rem;
        transition: all 0.2s;
    }
    .vg-stat:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(10,110,189,0.1);
        border-color: var(--vg-primary);
    }
    .vg-stat .s-icon {
        width: 48px; height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        margin-bottom: 1rem;
    }
    .vg-stat .s-value {
        font-size: 2rem;
        font-weight: 800;
        line-height: 1;
        margin-bottom: 0.2rem;
    }
    .vg-stat .s-label {
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--vg-muted);
        text-transform: uppercase;
        letter-spacing: 0.4px;
    }

    /* Section title */
    .vg-section-title {
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--vg-muted);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .vg-section-title::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--vg-border);
    }

    /* Feature cards */
    .vg-feature {
        background: #fff;
        border: 1px solid var(--vg-border);
        border-radius: 16px;
        padding: 1.5rem;
        height: 100%;
        transition: all 0.2s;
        text-decoration: none;
        color: inherit;
        display: block;
    }
    .vg-feature:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(10,110,189,0.1);
        border-color: var(--vg-primary);
        color: inherit;
    }
    .vg-feature .f-icon {
        width: 52px; height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        margin-bottom: 1rem;
    }
    .vg-feature h6 {
        font-weight: 700;
        font-size: 0.95rem;
        margin-bottom: 0.35rem;
    }
    .vg-feature p {
        font-size: 0.82rem;
        color: var(--vg-muted);
        margin: 0;
        line-height: 1.5;
    }
    .vg-feature .f-arrow {
        margin-top: 1rem;
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--vg-primary);
    }

    /* Profile card */
    .vg-profile-card {
        background: #fff;
        border: 1px solid var(--vg-border);
        border-radius: 16px;
        overflow: hidden;
    }
    .vg-profile-card .p-header {
        background: linear-gradient(135deg, var(--vg-primary-light), var(--vg-teal-light));
        padding: 1.5rem;
        text-align: center;
        border-bottom: 1px solid var(--vg-border);
    }
    .vg-profile-card .p-avatar {
        width: 64px; height: 64px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--vg-primary), var(--vg-teal));
        color: #fff;
        font-size: 1.4rem;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.75rem;
        box-shadow: 0 4px 12px rgba(10,110,189,0.25);
    }
    .vg-profile-card .p-name {
        font-weight: 800;
        font-size: 1rem;
        margin-bottom: 0.1rem;
    }
    .vg-profile-card .p-email {
        font-size: 0.78rem;
        color: var(--vg-muted);
    }
    .vg-profile-card .p-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.7rem 1.25rem;
        border-bottom: 1px solid var(--vg-border);
        font-size: 0.83rem;
    }
    .vg-profile-card .p-row:last-child { border-bottom: none; }
    .vg-profile-card .p-row .p-key { color: var(--vg-muted); font-weight: 500; }
    .vg-profile-card .p-row .p-val { font-weight: 600; }
</style>
@endpush

@section('content')

    {{-- ── HERO BANNER ── --}}
    <div class="hero-banner">
        <div class="greeting">Member Portal</div>
        <h3>Halo, {{ explode(' ', Auth::user()->name)[0] }}! 👋</h3>
        <p>Kelola kesehatan Anda bersama dokter terpercaya VitaGuard.</p>
        <a href="{{ route('transactions.create') }}" class="hero-cta">
            <i class="bi bi-calendar-plus-fill"></i> Booking Konsultasi
        </a>
        <i class="bi bi-heart-pulse hero-icon"></i>
    </div>

    {{-- ── STAT CARDS ── --}}
    <div class="vg-section-title">Ringkasan Aktivitas Saya</div>

    <div class="row g-3 mb-4">
        <div class="col-4">
            <div class="vg-stat">
                <div class="s-icon" style="background:#e8f4fd; color:#0a6ebd;">
                    <i class="bi bi-receipt"></i>
                </div>
                <div class="s-value" style="color:#0a6ebd;">{{ $myTransactions }}</div>
                <div class="s-label">Total Booking</div>
            </div>
        </div>
        <div class="col-4">
            <div class="vg-stat">
                <div class="s-icon" style="background:#e6faf8; color:#0d9488;">
                    <i class="bi bi-chat-dots-fill"></i>
                </div>
                <div class="s-value" style="color:#0d9488;">{{ $activeConsult }}</div>
                <div class="s-label">Aktif</div>
            </div>
        </div>
        <div class="col-4">
            <div class="vg-stat">
                <div class="s-icon" style="background:#f0fdf4; color:#16a34a;">
                    <i class="bi bi-check2-circle"></i>
                </div>
                <div class="s-value" style="color:#16a34a;">{{ $completedConsult }}</div>
                <div class="s-label">Selesai</div>
            </div>
        </div>
    </div>

    {{-- ── QUICK FEATURES ── --}}
    <div class="vg-section-title">Layanan</div>

    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-lg-3">
            <a href="{{ route('transactions.create') }}" class="vg-feature">
                <div class="f-icon" style="background:#e8f4fd; color:#0a6ebd;">
                    <i class="bi bi-calendar-plus-fill"></i>
                </div>
                <h6>Booking Konsultasi</h6>
                <p>Pilih dokter dan jadwal yang sesuai kebutuhan Anda.</p>
                <div class="f-arrow">Mulai booking <i class="bi bi-arrow-right"></i></div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-3">
            <a href="{{ route('transactions.index') }}" class="vg-feature">
                <div class="f-icon" style="background:#e6faf8; color:#0d9488;">
                    <i class="bi bi-clock-history"></i>
                </div>
                <h6>Riwayat Konsultasi</h6>
                <p>Lihat semua riwayat dan percakapan konsultasi Anda.</p>
                <div class="f-arrow">Lihat riwayat <i class="bi bi-arrow-right"></i></div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-3">
            <a href="{{ route('articles.index') }}" class="vg-feature">
                <div class="f-icon" style="background:#fef9e7; color:#d97706;">
                    <i class="bi bi-newspaper"></i>
                </div>
                <h6>Artikel Kesehatan</h6>
                <p>Baca artikel dari dokter ahli kami seputar kesehatan.</p>
                <div class="f-arrow">Baca artikel <i class="bi bi-arrow-right"></i></div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-3">
            <a href="{{ route('profile.edit') }}" class="vg-feature">
                <div class="f-icon" style="background:#f5f3ff; color:#7c3aed;">
                    <i class="bi bi-person-gear"></i>
                </div>
                <h6>Edit Profil</h6>
                <p>Perbarui data diri dan informasi kontak Anda.</p>
                <div class="f-arrow">Kelola profil <i class="bi bi-arrow-right"></i></div>
            </a>
        </div>
    </div>

    {{-- ── PROFILE + TIPS ── --}}
    <div class="vg-section-title">Profil & Info</div>

    <div class="row g-3">
        <div class="col-md-5">
            <div class="vg-profile-card">
                <div class="p-header">
                    <div class="p-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>
                    <div class="p-name">{{ Auth::user()->name }}</div>
                    <div class="p-email">{{ Auth::user()->email }}</div>
                </div>
                <div class="p-row">
                    <span class="p-key"><i class="bi bi-telephone me-1"></i>Telepon</span>
                    <span class="p-val">{{ Auth::user()->phone ?? '-' }}</span>
                </div>
                <div class="p-row">
                    <span class="p-key"><i class="bi bi-calendar me-1"></i>Bergabung</span>
                    <span class="p-val">{{ Auth::user()->created_at->format('d M Y') }}</span>
                </div>
                <div class="p-row">
                    <span class="p-key"><i class="bi bi-shield-check me-1"></i>Status</span>
                    <span class="p-val" style="color:#0d9488;">
                        <i class="bi bi-check-circle-fill me-1"></i>Aktif
                    </span>
                </div>
                <div class="p-row">
                    <a href="{{ route('profile.edit') }}"
                       class="btn btn-sm w-100 fw-600"
                       style="background: var(--vg-primary-light); color: var(--vg-primary); border-radius: 8px; font-weight: 600; font-size:0.82rem;">
                        <i class="bi bi-pencil me-1"></i> Edit Profil
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="vg-profile-card h-100">
                <div class="p-header text-start" style="padding: 1.25rem 1.5rem;">
                    <div style="font-weight: 700; font-size: 0.95rem;">
                        <i class="bi bi-lightbulb-fill me-2" style="color:#d97706;"></i>
                        Tips Kesehatan Hari Ini
                    </div>
                </div>
                @php
                    $tips = [
                        ['icon'=>'bi-droplet-fill',    'color'=>'#0a6ebd', 'bg'=>'#e8f4fd', 'title'=>'Cukup Minum Air', 'desc'=>'Minumlah minimal 8 gelas air putih per hari untuk menjaga hidrasi tubuh Anda.'],
                        ['icon'=>'bi-moon-stars-fill',  'color'=>'#7c3aed', 'bg'=>'#f5f3ff', 'title'=>'Tidur yang Cukup', 'desc'=>'Usahakan tidur 7–8 jam setiap malam untuk pemulihan dan kesehatan optimal.'],
                        ['icon'=>'bi-bicycle',          'color'=>'#0d9488', 'bg'=>'#e6faf8', 'title'=>'Aktif Bergerak',  'desc'=>'Lakukan aktivitas fisik ringan 30 menit sehari untuk menjaga kebugaran.'],
                    ];
                @endphp

                <div style="padding: 0.75rem 1.25rem;">
                    @foreach($tips as $tip)
                        <div class="d-flex align-items-start gap-3 mb-3 pb-3"
                             style="{{ !$loop->last ? 'border-bottom: 1px solid var(--vg-border);' : '' }}">
                            <div style="width:38px; height:38px; border-radius:10px;
                                        background:{{ $tip['bg'] }}; color:{{ $tip['color'] }};
                                        display:flex; align-items:center; justify-content:center;
                                        font-size:1rem; flex-shrink:0;">
                                <i class="{{ $tip['icon'] }}"></i>
                            </div>
                            <div>
                                <div style="font-weight:700; font-size:0.85rem; margin-bottom:0.15rem;">
                                    {{ $tip['title'] }}
                                </div>
                                <div style="font-size:0.78rem; color:var(--vg-muted); line-height:1.5;">
                                    {{ $tip['desc'] }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection