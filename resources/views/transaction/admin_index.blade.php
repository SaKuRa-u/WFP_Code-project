@extends('layouts.adminlte')
@section('title', 'Daftar Transaksi')

@push('styles')
    <style>
        .page-card {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
        }

        .page-card .card-header {
            background: #fff;
            border-bottom: 1px solid #f0f0f0;
            padding: 1rem 1.5rem;
        }

        .stat-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1.1rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.15s;
            border: 1.5px solid transparent;
        }

        .stat-pill.all {
            background: #f0f4ff;
            color: #0d6efd;
            border-color: #d4e3ff;
        }

        .stat-pill.pending {
            background: #fff8e6;
            color: #d97706;
            border-color: #fde68a;
        }

        .stat-pill.active {
            background: #e6faf8;
            color: #0d9488;
            border-color: #a7f3d0;
        }

        .stat-pill.completed {
            background: #f0fdf4;
            color: #16a34a;
            border-color: #bbf7d0;
        }

        .stat-pill.active-filter {
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.12);
            transform: translateY(-1px);
        }

        .table thead th {
            background: #f8f9fa;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            color: #6c757d;
            padding: 0.85rem 1rem;
            white-space: nowrap;
            border-bottom: 1px solid #e9ecef;
        }

        .table tbody td {
            padding: 0.85rem 1rem;
            vertical-align: middle;
            font-size: 0.875rem;
            border-bottom: 1px solid #f5f5f5;
        }

        .table tbody tr:hover {
            background: #fafcff;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 0.3rem 0.75rem;
            border-radius: 20px;
        }

        .status-badge.pending {
            background: #fff8e6;
            color: #ff8800;
        }

        .status-badge.active {
            background: #e6faf8;
            color: #0073ff;
        }

        .status-badge.completed {
            background: #f0fdf4;
            color: #00ff5e;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            display: inline-block;
        }

        .status-dot.pending {
            background: #ff8800;
        }

        .status-dot.active {
            background: #0073ff;
            animation: pulse 1.5s infinite;
        }

        .status-dot.completed {
            background: #00ff5e;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1
            }

            50% {
                opacity: 0.4
            }
        }

        .action-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            transition: all 0.15s;
            text-decoration: none;
            cursor: pointer;
        }

        .action-btn:hover {
            transform: translateY(-1px);
        }

        .action-btn.view {
            background: #e6faf8;
            color: #0d9488;
        }

        .action-btn.delete {
            background: #ffeaea;
            color: #dc3545;
        }
    </style>
@endpush

@section('content')

    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0 fw-bold">
                        {{ auth()->user()->isDoctor() ? 'Booking Saya' : 'Semua Transaksi' }}
                    </h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Transaksi</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3 mb-3">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Status Filter Pills --}}
            <div class="d-flex align-items-center gap-2 flex-wrap mb-3">
                <a href="{{ route('transactions.index') }}"
                    class="stat-pill all {{ !request('status') ? 'active-filter' : '' }}">
                    <i class="bi bi-list-ul"></i> Semua
                    <span style="background:rgba(13,110,253,0.12);padding:0.1rem 0.5rem;border-radius:10px;">
                        {{ $statusCounts['all'] }}
                    </span>
                </a>
                <a href="{{ route('transactions.index', ['status' => 'pending']) }}"
                    class="stat-pill pending {{ request('status') === 'pending' ? 'active-filter' : '' }}">
                    <i class="bi bi-hourglass-split"></i> Pending
                    <span style="background:rgba(217,119,6,0.12);padding:0.1rem 0.5rem;border-radius:10px;">
                        {{ $statusCounts['pending'] }}
                    </span>
                </a>
                <a href="{{ route('transactions.index', ['status' => 'active']) }}"
                    class="stat-pill active {{ request('status') === 'active' ? 'active-filter' : '' }}">
                    <i class="bi bi-activity"></i> Aktif
                    <span style="background:rgba(13,148,136,0.12);padding:0.1rem 0.5rem;border-radius:10px;">
                        {{ $statusCounts['active'] }}
                    </span>
                </a>
                <a href="{{ route('transactions.index', ['status' => 'completed']) }}"
                    class="stat-pill completed {{ request('status') === 'completed' ? 'active-filter' : '' }}">
                    <i class="bi bi-check-circle-fill"></i> Selesai
                    <span style="background:rgba(22,163,74,0.12);padding:0.1rem 0.5rem;border-radius:10px;">
                        {{ $statusCounts['completed'] }}
                    </span>
                </a>
            </div>

            <div class="page-card card">
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                    <div class="fw-bold" style="font-size:0.9rem;">
                        <i class="bi bi-receipt me-2 text-primary"></i>
                        Daftar Booking{{ request('status') ? ' — ' . ucfirst(request('status')) : '' }}
                        <small class="text-muted ms-2">
                            ({{ $transactions->count() }} transaksi)
                        </small>
                    </div>

                    {{--!! <a href="{{ route('transactions.create') }}" class="btn btn-primary btn-sm ms-auto">
                        <i class="bi bi-plus-circle me-1"></i>
                        Tambah Transaksi
                    </a> --}}   {{--? INI KALO ADMIN BISA BIKIN TRANSAKSI JUGA (KONTEKS UNTUK BANTU MEMBER BIKIN TRANSAKSI) --}}
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Pasien</th>
                                    <th>Dokter</th>
                                    <th>Layanan</th>
                                    <th>Jadwal</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transactions as $trx)
                                    <tr>
                                        <td class="text-muted" style="font-size:0.78rem;">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            <div style="font-weight:600;font-size:0.85rem;">{{ $trx->user->name ?? '-' }}
                                            </div>
                                            <div class="text-muted" style="font-size:0.72rem;">
                                                {{ $trx->user->email ?? '' }}</div>
                                        </td>
                                        <td>
                                            <div style="font-weight:600;font-size:0.85rem;">{{ $trx->doctor->name ?? '-' }}
                                            </div>
                                            <div class="text-muted" style="font-size:0.72rem;">
                                                {{ $trx->doctor->specializations->pluck('name')->join(', ') }}
                                            </div>
                                        </td>
                                        <td>
                                            @foreach ($trx->services->take(2) as $svc)
                                                <div style="font-size:0.75rem;">• {{ $svc->service_name }}</div>
                                            @endforeach
                                            @if ($trx->services->count() > 2)
                                                <div class="text-muted" style="font-size:0.72rem;">
                                                    +{{ $trx->services->count() - 2 }} lainnya
                                                </div>
                                            @endif
                                        </td>
                                        <td style="font-size:0.82rem;">
                                            <div>{{ \Carbon\Carbon::parse($trx->scheduled_at)->format('d M Y') }}</div>
                                            <div class="text-muted">
                                                {{ \Carbon\Carbon::parse($trx->scheduled_at)->format('H:i') }}</div>
                                        </td>
                                        <td style="font-weight:700;color:#0d9488;font-size:0.85rem;">
                                            Rp{{ number_format($trx->total, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            <span class="status-badge {{ $trx->status }}">
                                                <span class="status-dot {{ $trx->status }}"></span>
                                                {{ ucfirst($trx->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center gap-1">
                                                <a href="{{ route('transactions.show', $trx->id) }}"
                                                    class="action-btn view" title="Lihat Detail">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                @if (auth()->user()->isAdmin())
                                                    <form action="{{ route('transactions.destroy', $trx->id) }}"
                                                        method="POST" class="d-inline delete-form">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="action-btn delete" title="Hapus">
                                                            <i class="bi bi-trash3"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-5 text-muted">
                                            <i class="bi bi-receipt d-block"
                                                style="font-size:2.5rem;margin-bottom:0.5rem;"></i>
                                            Tidak ada
                                            transaksi{{ request('status') ? ' dengan status ' . request('status') : '' }}.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (confirm('Hapus transaksi ini?')) this.submit();
            });
        });
    </script>
@endpush
