@extends('layouts.adminlte')
@section('title', 'Edit Member')

@push('styles')

<style>
    .detail-card {
        border:none;
        border-radius:16px;
        box-shadow:0 2px 12px rgba(0,0,0,0.07);
        overflow:hidden;
    }

    .detail-card .card-header {
        background:#fff;
        border-bottom:1px solid #f0f0f0;
        padding:1.25rem 1.5rem;
    }

    .u-avatar {
        width:80px;
        height:80px;
        border-radius:20px;
        background:linear-gradient(135deg,#0d6efd,#0a58ca);
        color:#fff;
        font-size:1.75rem;
        font-weight:800;
        display:flex;
        align-items:center;
        justify-content:center;
    }

    .info-row {
        display:flex;
        align-items:flex-start;
        gap:1rem;
        padding:1rem 0;
        border-bottom:1px solid #f5f5f5;
    }

    .info-row:last-child {
        border-bottom:none;
    }

    .info-icon {
        width:36px;
        height:36px;
        border-radius:10px;
        background:#f0f4ff;
        color:#0d6efd;
        display:flex;
        align-items:center;
        justify-content:center;
        flex-shrink:0;
    }

    .info-key {
        font-size:0.75rem;
        font-weight:600;
        color:#6c757d;
        text-transform:uppercase;
        letter-spacing:0.4px;
        margin-bottom:0.4rem;
    }

    .form-control {
        border-radius:10px;
        border:1.5px solid #e9ecef;
        font-size:0.9rem;
        padding:0.65rem 0.9rem;
    }

    .form-control:focus {
        border-color:#0d6efd;
        box-shadow:0 0 0 3px rgba(13,110,253,0.1);
    }

    .invalid-feedback {
        display:block;
    }

    .section-title {
        font-size:0.75rem;
        font-weight:700;
        text-transform:uppercase;
        letter-spacing:1px;
        color:#adb5bd;
        margin:1.5rem 0 0.75rem;
    }

    .hint {
        font-size:0.75rem;
        color:#adb5bd;
        margin-top:0.35rem;
    }
</style>

@endpush

@section('content')

<div class="app-content-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h3 class="mb-0 fw-bold">Edit Member</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.users.index') }}">Member</a>
                    </li>
                    <li class="breadcrumb-item active">Edit</li>
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

                        <div class="u-avatar">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>

                        <div>
                            <div style="font-weight:800;font-size:1.1rem;">
                                {{ $user->name }}
                            </div>

                            <div class="text-muted" style="font-size:0.8rem;">
                                ID #{{ $user->id }}
                            </div>

                            <span class="badge bg-warning text-dark mt-1">
                                Mode Edit
                            </span>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body px-4 py-2">

                        <div class="section-title">
                            Informasi Member
                        </div>

                        <div class="info-row">
                            <div class="info-icon">
                                <i class="bi bi-person-fill"></i>
                            </div>

                            <div class="w-100">
                                <div class="info-key">Nama Lengkap</div>

                                <input
                                    type="text"
                                    name="name"
                                    value="{{ old('name', $user->name) }}"
                                    class="form-control @error('name') is-invalid @enderror">

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-icon">
                                <i class="bi bi-envelope-fill"></i>
                            </div>

                            <div class="w-100">
                                <div class="info-key">Email</div>

                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email', $user->email) }}"
                                    class="form-control @error('email') is-invalid @enderror">

                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-icon">
                                <i class="bi bi-telephone-fill"></i>
                            </div>

                            <div class="w-100">
                                <div class="info-key">No. Telepon</div>

                                <input
                                    type="text"
                                    name="phone"
                                    value="{{ old('phone', $user->phone) }}"
                                    class="form-control @error('phone') is-invalid @enderror">

                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="section-title">
                            Ganti Password
                        </div>

                        <div class="info-row">
                            <div class="info-icon">
                                <i class="bi bi-lock-fill"></i>
                            </div>

                            <div class="w-100">
                                <div class="info-key">Password Baru</div>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror">

                                <div class="hint">
                                    Kosongkan jika tidak ingin mengubah password.
                                </div>

                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-icon">
                                <i class="bi bi-shield-lock-fill"></i>
                            </div>

                            <div class="w-100">
                                <div class="info-key">Konfirmasi Password</div>

                                <input
                                    type="password"
                                    name="password_confirmation"
                                    class="form-control">
                            </div>
                        </div>

                    </div>

                    <div class="card-footer bg-transparent border-top d-flex justify-content-between align-items-center px-4 py-3">

                        <a href="{{ route('admin.users.show', $user->id) }}"
                           class="btn btn-outline-secondary btn-sm"
                           style="border-radius:10px;">
                            <i class="bi bi-arrow-left me-1"></i>
                            Batal
                        </a>

                        <button type="submit"
                                class="btn btn-primary btn-sm"
                                style="border-radius:10px;font-weight:600;">
                            <i class="bi bi-check-lg me-1"></i>
                            Simpan Perubahan
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>
</div>

</div>

@endsection
