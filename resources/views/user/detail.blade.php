@extends('layouts.adminlte')
@section('title', 'Detail Member')

@push('styles')
<style>
    .detail-card { border:none; border-radius:16px; box-shadow:0 2px 12px rgba(0,0,0,0.07); overflow:hidden; }
    .detail-card .card-header { background:#fff; border-bottom:1px solid #f0f0f0; padding:1.25rem 1.5rem; }
    .u-avatar { width:80px; height:80px; border-radius:20px; background:linear-gradient(135deg,#0d6efd,#0a58ca); color:#fff; font-size:1.75rem; font-weight:800; display:flex; align-items:center; justify-content:center; }
    .info-row { display:flex; align-items:center; padding:0.85rem 0; border-bottom:1px solid #f5f5f5; gap:1rem; }
    .info-row:last-child { border-bottom:none; }
    .info-icon { width:36px; height:36px; border-radius:10px; background:#f0f4ff; color:#0d6efd; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
    .info-key { font-size:0.75rem; font-weight:600; color:#6c757d; text-transform:uppercase; letter-spacing:0.4px; }
    .info-val { font-size:0.9rem; font-weight:600; }
</style>
@endpush

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6"><h3 class="mb-0 fw-bold">Detail Member</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Member</a></li>
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
                            <div class="u-avatar">{{ strtoupper(substr($user->name, 0, 2)) }}</div>
                            <div>
                                <div style="font-weight:800;font-size:1.1rem;">{{ $user->name }}</div>
                                <div class="text-muted" style="font-size:0.8rem;">ID #{{ $user->id }}</div>
                                <span class="badge bg-primary bg-opacity-10 text-primary" style="font-size:0.7rem;">Member</span>
                            </div>
                        </div>

                        <div class="d-flex gap-2 ms-auto">
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                               class="btn btn-sm btn-primary" style="border-radius:10px;font-weight:600;">
                                <i class="bi bi-pencil me-1"></i>Edit
                            </a>
                        </div>
                    </div>
                    <div class="card-body px-4 py-2">
                        <div class="info-row">
                            <div class="info-icon"><i class="bi bi-person-fill"></i></div>
                            <div>
                                <div class="info-key">Nama Lengkap</div>
                                <div class="info-val">{{ $user->name }}</div>
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-icon"><i class="bi bi-envelope-fill"></i></div>
                            <div>
                                <div class="info-key">Email</div>
                                <div class="info-val">{{ $user->email }}</div>
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-icon"><i class="bi bi-telephone-fill"></i></div>
                            <div>
                                <div class="info-key">No. Telepon</div>
                                <div class="info-val">{{ $user->phone ?? '-' }}</div>
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-icon"><i class="bi bi-calendar-fill"></i></div>
                            <div>
                                <div class="info-key">Bergabung Sejak</div>
                                <div class="info-val">{{ $user->created_at->format('d F Y, H:i') }}</div>
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-icon"><i class="bi bi-clock-fill"></i></div>
                            <div>
                                <div class="info-key">Terakhir Diperbarui</div>
                                <div class="info-val">{{ $user->updated_at->format('d F Y, H:i') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-top d-flex align-items-center px-4 py-3">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm" style="border-radius:10px;">
                            <i class="bi bi-arrow-left me-1"></i>Kembali
                        </a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="ms-auto">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" style="border-radius:10px;"
                                    onclick="return confirm('Hapus member ini?')">
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