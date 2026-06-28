@extends('layouts.member')
@section('title', 'Riwayat Konsultasi')

@push('styles')
<style>
    .page-hero { background:linear-gradient(135deg,#0a6ebd,#0d9488); border-radius:20px; padding:2rem 2.5rem; color:#fff; margin-bottom:1.5rem; position:relative; overflow:hidden; }
    .page-hero::before { content:''; position:absolute; top:-40px; right:-30px; width:180px; height:180px; background:rgba(255,255,255,0.06); border-radius:50%; }
    .page-hero h3 { font-size:1.4rem; font-weight:800; margin-bottom:0.2rem; }
    .page-hero p  { opacity:.8; font-size:0.85rem; margin:0; }

    .trx-card { background:#fff; border:1px solid var(--vg-border); border-radius:16px; overflow:hidden; transition:all 0.2s; margin-bottom:1rem; }
    .trx-card:hover { box-shadow:0 6px 24px rgba(10,110,189,0.1); border-color:var(--vg-primary); }
    .trx-card .trx-header { padding:1.1rem 1.25rem; display:flex; align-items:center; justify-content:space-between; border-bottom:1px solid #f5f5f5; }
    .trx-card .trx-body   { padding:1rem 1.25rem; }
    .trx-card .trx-footer { padding:0.85rem 1.25rem; background:#fafafa; border-top:1px solid #f5f5f5; display:flex; align-items:center; justify-content:space-between; }

    .status-badge { display:inline-flex; align-items:center; gap:0.35rem; font-size:0.72rem; font-weight:700; padding:0.3rem 0.75rem; border-radius:20px; }
    .status-badge.pending   { background:#fff8e6; color:#d97706; }
    .status-badge.active    { background:#e6faf8; color:#0d9488; }
    .status-badge.completed { background:#f0fdf4; color:#16a34a; }
    .status-dot { width:6px; height:6px; border-radius:50%; display:inline-block; }
    .status-dot.pending   { background:#d97706; }
    .status-dot.active    { background:#0d9488; animation:pulse 1.5s infinite; }
    .status-dot.completed { background:#16a34a; }
    @keyframes pulse { 0%,100%{opacity:1} 50%{opacity:0.4} }

    .doctor-chip { display:inline-flex; align-items:center; gap:0.5rem; background:var(--vg-teal-light); color:var(--vg-teal); padding:0.35rem 0.8rem; border-radius:20px; font-size:0.78rem; font-weight:600; }
    .doctor-chip .chip-avatar { width:22px; height:22px; border-radius:50%; background:var(--vg-teal); color:#fff; font-size:0.6rem; font-weight:700; display:flex; align-items:center; justify-content:center; }

    .vg-section-title { font-size:0.72rem; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:var(--vg-muted); margin-bottom:1rem; display:flex; align-items:center; gap:0.5rem; }
    .vg-section-title::after { content:''; flex:1; height:1px; background:var(--vg-border); }
</style>
@endpush

@section('content')

    <div class="page-hero">
        <h3><i class="bi bi-clock-history me-2"></i>Riwayat Konsultasi</h3>
        <p>Lihat semua booking dan riwayat konsultasi Anda.</p>
        <i class="bi bi-receipt" style="position:absolute;right:2rem;bottom:-0.5rem;font-size:5rem;opacity:0.1;"></i>
    </div>

    <div class="d-flex align-items-center justify-content-between mb-3">
        <div class="vg-section-title" style="flex:1;margin-bottom:0;">
            {{ $transactions->count() }} Transaksi
        </div>
        <a href="{{ route('transactions.create') }}"
           class="btn btn-sm ms-3"
           style="background:var(--vg-primary);color:#fff;border-radius:10px;font-weight:600;font-size:0.82rem;padding:0.45rem 1rem;white-space:nowrap;">
            <i class="bi bi-plus-lg me-1"></i>Booking Baru
        </a>
    </div>

    @forelse($transactions as $trx)
        <div class="trx-card">
            <div class="trx-header">
                <div class="d-flex align-items-center gap-2">
                    <div style="width:38px;height:38px;border-radius:10px;background:linear-gradient(135deg,#e8f4fd,#e6faf8);color:var(--vg-teal);display:flex;align-items:center;justify-content:center;font-size:1rem;">
                        <i class="bi bi-receipt"></i>
                    </div>
                    <div>
                        <div style="font-weight:700;font-size:0.88rem;">Booking #{{ $trx->id }}</div>
                        <div style="font-size:0.72rem;color:var(--vg-muted);">
                            {{ \Carbon\Carbon::parse($trx->scheduled_at)->format('d F Y, H:i') }}
                        </div>
                    </div>
                </div>
                <span class="status-badge {{ $trx->status }}">
                    <span class="status-dot {{ $trx->status }}"></span>
                    {{ ucfirst($trx->status) }}
                </span>
            </div>

            <div class="trx-body">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="doctor-chip">
                        <div class="chip-avatar">{{ strtoupper(substr($trx->doctor->name ?? 'D', 0, 2)) }}</div>
                        {{ $trx->doctor->name ?? '-' }}
                    </div>
                    <div style="font-size:0.78rem;color:var(--vg-muted);">
                        {{ $trx->services->count() }} layanan dipilih
                    </div>
                </div>
                <div class="mt-2">
                    @foreach($trx->services->take(3) as $svc)
                        <span style="display:inline-block;background:#f8f9fa;border:1px solid #e9ecef;font-size:0.72rem;padding:0.2rem 0.6rem;border-radius:6px;margin:0.15rem;">
                            {{ $svc->service_name }}
                        </span>
                    @endforeach
                    @if($trx->services->count() > 3)
                        <span style="font-size:0.72rem;color:var(--vg-muted);">+{{ $trx->services->count()-3 }} lainnya</span>
                    @endif
                </div>
            </div>

            <div class="trx-footer">
                <div style="font-weight:800;color:var(--vg-teal);font-size:0.95rem;">
                    Rp{{ number_format($trx->total, 0, ',', '.') }}
                </div>
                <a href="{{ route('transactions.show', $trx->id) }}"
                   class="btn btn-sm"
                   style="border-radius:9px;font-weight:600;font-size:0.78rem;padding:0.35rem 0.9rem;
                          background:{{ $trx->status === 'active' ? 'var(--vg-teal)' : 'var(--vg-primary-light)' }};
                          color:{{ $trx->status === 'active' ? '#fff' : 'var(--vg-primary)' }};">
                    @if($trx->status === 'active')
                        <i class="bi bi-chat-dots me-1"></i>Lanjut Chat
                    @else
                        <i class="bi bi-eye me-1"></i>Lihat Detail
                    @endif
                </a>
            </div>
        </div>
    @empty
        <div class="text-center py-5" style="background:#fff;border-radius:16px;border:1px solid var(--vg-border);">
            <i class="bi bi-receipt" style="font-size:3rem;color:#ced4da;display:block;margin-bottom:0.75rem;"></i>
            <div style="font-weight:700;margin-bottom:0.35rem;">Belum ada booking</div>
            <p style="font-size:0.85rem;color:var(--vg-muted);margin-bottom:1rem;">Mulai konsultasi dengan dokter pilihan Anda.</p>
            <a href="{{ route('transactions.create') }}"
               class="btn btn-sm" style="background:var(--vg-primary);color:#fff;border-radius:10px;font-weight:600;">
                <i class="bi bi-calendar-plus me-1"></i>Booking Sekarang
            </a>
        </div>
    @endforelse

@endsection