@extends('layouts.adminlte')
@section('title', 'Detail Dokter')

@push('styles')
    <style>
        .detail-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
            overflow: hidden;
        }

        .detail-card .card-header {
            background: #fff;
            border-bottom: 1px solid #f0f0f0;
            padding: 1.25rem 1.5rem;
        }

        .d-avatar {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            background: linear-gradient(135deg, #0d9488, #0a6ebd);
            color: #fff;
            font-size: 1.75rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .info-row {
            display: flex;
            align-items: center;
            padding: 0.85rem 0;
            border-bottom: 1px solid #f5f5f5;
            gap: 1rem;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: #e6faf8;
            color: #0d9488;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .info-key {
            font-size: 0.75rem;
            font-weight: 600;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .info-val {
            font-size: 0.9rem;
            font-weight: 600;
        }

        .spec-badge {
            display: inline-block;
            background: #e6faf8;
            color: #0d9488;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.3rem 0.75rem;
            border-radius: 20px;
            margin: 0.2rem;
        }
    </style>
@endpush

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0 fw-bold">Detail Dokter</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.doctors.index') }}">Dokter</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="detail-card card">
                        <div class="card-header d-flex align-items-center justify-content-between">

                            <div class="d-flex align-items-center gap-3">
                                <div class="d-avatar">{{ strtoupper(substr($doctor->name, 0, 2)) }}</div>
                                <div>
                                    <div style="font-weight:800;font-size:1.1rem;">{{ $doctor->name }}</div>
                                    <div class="text-muted" style="font-size:0.8rem;">ID #{{ $doctor->id }}</div>
                                    <span class="badge"
                                        style="background:#e6faf8;color:#0d9488;font-size:0.7rem;">Dokter</span>
                                </div>
                            </div>

                            <a href="{{ route('admin.doctors.edit', $doctor->id) }}" class="btn btn-sm ms-auto"
                                style="border-radius:10px;font-weight:600;background:#0d9488;color:#fff;">
                                <i class="bi bi-pencil me-1"></i>Edit
                            </a>

                        </div>

                        <div class="card-body px-4 py-2">
                            <div class="info-row">
                                <div class="info-icon"><i class="bi bi-person-fill"></i></div>
                                <div>
                                    <div class="info-key">Nama Lengkap</div>
                                    <div class="info-val">{{ $doctor->name }}</div>
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-icon"><i class="bi bi-envelope-fill"></i></div>
                                <div>
                                    <div class="info-key">Email</div>
                                    <div class="info-val">{{ $doctor->email }}</div>
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-icon"><i class="bi bi-telephone-fill"></i></div>
                                <div>
                                    <div class="info-key">No. Telepon</div>
                                    <div class="info-val">{{ $doctor->phone ?? '-' }}</div>
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-icon"><i class="bi bi-award-fill"></i></div>
                                <div style="flex:1;">
                                    <div class="info-key">Spesialisasi</div>
                                    <div class="mt-1">
                                        @forelse($doctor->specializations as $spec)
                                            <span class="spec-badge">{{ $spec->name }}</span>
                                        @empty
                                            <span class="text-muted" style="font-size:0.85rem;">Belum ada
                                                spesialisasi</span>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-icon"><i class="bi bi-calendar-fill"></i></div>
                                <div>
                                    <div class="info-key">Bergabung Sejak</div>
                                    <div class="info-val">{{ $doctor->created_at->format('d F Y, H:i') }}</div>
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-icon"><i class="bi bi-clock-fill"></i></div>
                                <div>
                                    <div class="info-key">Terakhir Diperbarui</div>
                                    <div class="info-val">{{ $doctor->updated_at->format('d F Y, H:i') }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-transparent border-top d-flex align-items-center px-4 py-3">
                            <a href="{{ route('admin.doctors.index') }}" class="btn btn-outline-secondary btn-sm"
                                style="border-radius:10px;">
                                <i class="bi bi-arrow-left me-1"></i>Kembali
                            </a>

                            <form action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="POST"
                                class="ms-auto">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm" style="border-radius:10px;"
                                    onclick="return confirm('Hapus dokter ini?')">
                                    <i class="bi bi-trash3 me-1"></i>Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
