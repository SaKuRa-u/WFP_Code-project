@extends('layouts.adminlte')
@section('title', 'Tambah Dokter')

@push('styles')
    <style>
        .form-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
            overflow: hidden;
        }

        .form-card .card-header {
            background: #fff;
            border-bottom: 1px solid #f0f0f0;
            padding: 1.25rem 1.5rem;
        }

        .form-label {
            font-size: 0.78rem;
            font-weight: 700;
            color: #495057;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 0.4rem;
        }

        .form-control {
            border-radius: 10px;
            border: 1.5px solid #e9ecef;
            font-size: 0.88rem;
            padding: 0.6rem 0.9rem;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        .form-control:focus {
            border-color: #0d9488;
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.1);
        }

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            font-size: 0.78rem;
        }

        .section-divider {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #adb5bd;
            border-bottom: 1px solid #f0f0f0;
            padding-bottom: 0.5rem;
            margin-bottom: 1.25rem;
        }

        .hint {
            font-size: 0.75rem;
            color: #adb5bd;
            margin-top: 0.25rem;
        }

        /* Specialization checkboxes */
        .spec-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 0.5rem;
        }

        .spec-item {
            position: relative;
        }

        .spec-item input[type="checkbox"] {
            display: none;
        }

        .spec-item label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.55rem 0.85rem;
            border: 1.5px solid #e9ecef;
            border-radius: 10px;
            cursor: pointer;
            font-size: 0.82rem;
            font-weight: 500;
            transition: all 0.15s;
            background: #fff;
            color: #495057;
        }

        .spec-item label:hover {
            border-color: #0d9488;
            background: #e6faf8;
            color: #0d9488;
        }

        .spec-item input:checked+label {
            border-color: #0d9488;
            background: #e6faf8;
            color: #0d9488;
            font-weight: 600;
        }

        .spec-item input:checked+label::before {
            content: '\F26B';
            /* bi-check-circle-fill */
            font-family: 'bootstrap-icons';
            font-size: 0.9rem;
        }

        .spec-item input:not(:checked)+label::before {
            content: '\F1F8';
            /* bi-circle */
            font-family: 'bootstrap-icons';
            font-size: 0.9rem;
            color: #ced4da;
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
            color: #000000;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            font-weight: bold;
        }
    </style>
@endpush

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0 fw-bold">Tambah Dokter</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.doctors.index') }}">Dokter</a></li>
                        <li class="breadcrumb-item active">Tambah</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="form-card card">
                        <div class="card-header d-flex align-items-center justify-content-between">

                            <div class="d-flex align-items-center gap-3">

                                <div class="d-avatar">
                                    <i class="bi bi-person-plus-fill"></i>
                                </div>

                                <div>
                                    <div style="font-weight:800;font-size:1.1rem;">
                                        Tambah Dokter Baru
                                    </div>

                                    <div class="text-muted" style="font-size:0.8rem;">
                                        Lengkapi informasi dokter
                                    </div>

                                    <span class="badge" style="background:#d1fae5;color:#065f46;font-size:0.7rem;">
                                        Dokter Baru
                                    </span>
                                </div>

                            </div>

                        </div>

                        <form action="{{ route('admin.doctors.store') }}" method="POST">
                            @csrf @method('POST')
                            <div class="card-body px-4 py-3">

                                <div class="section-divider">Informasi Dasar</div>

                                <div class="row g-3 mb-1">
                                    <div class="col-md-6">
                                        <div class="mb-1 d-flex align-items-center gap-2">
                                            <div class="info-icon"><i class="bi bi-person-fill"></i></div>

                                            <label class="form-label">Nama Lengkap</label>
                                        </div>

                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-1 d-flex align-items-center gap-2">
                                            <div class="info-icon"><i class="bi bi-telephone-fill"></i></div>
                                            <label class="form-label">No. Telepon</label>
                                        </div>

                                        <input type="text" name="phone"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            value="{{ old('phone') }}" required>
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 d-flex align-items-center gap-2">
                                            <div class="info-icon"><i class="bi bi-envelope-fill"></i></div>

                                            <label class="form-label">Email</label>
                                        </div>

                                        <input type="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <hr class="my-3">
                                <div class="section-divider">Spesialisasi</div>

                                @error('specializations')
                                    <div class="alert alert-danger py-2 px-3 mb-3"
                                        style="border-radius:10px;font-size:0.82rem;">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <div class="spec-grid mb-2">
                                    @foreach ($specializations as $spec)
                                        <div class="spec-item">
                                            <input type="checkbox" name="specializations[]" id="spec_{{ $spec->id }}"
                                                value="{{ $spec->id }}"
                                                {{ in_array($spec->id, old('specializations', [])) ? 'checked' : '' }}>
                                            <label for="spec_{{ $spec->id }}">{{ $spec->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="hint mb-3">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Pilih satu atau lebih spesialisasi dokter.
                                </div>

                                <hr class="my-3">
                                <div class="section-divider">Ganti Password</div>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="mb-1 d-flex align-items-center gap-2">
                                            <div class="info-icon"><i class="bi bi-lock-fill"></i></div>
                                            <label class="form-label">Password Baru</label>
                                        </div>
                                        <input type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Masukkan password" required>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-1 d-flex align-items-center gap-2">
                                            <div class="info-icon"><i class="bi bi-lock-fill"></i></div>
                                            <label class="form-label">Konfirmasi Password</label>
                                        </div>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            placeholder="Ulangi password baru" required>
                                    </div>
                                </div>
                                <div class="hint mt-1">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Password minimal 8 karakter.
                                </div>

                            </div>
                            <div
                                class="card-footer bg-transparent border-top d-flex justify-content-between align-items-center px-4 py-3">
                                <a href="{{ route('admin.doctors.index') }}" class="btn btn-outline-secondary btn-sm"
                                    style="border-radius:10px;">
                                    <i class="bi bi-arrow-left me-1"></i>Batal
                                </a>
                                <button type="submit" class="btn btn-sm ms-auto"
                                    style="border-radius:10px;font-weight:600;padding:0.5rem 1.25rem;background:#0d9488;color:#fff;">
                                    <i class="bi bi-check-lg me-1"></i>Tambah Dokter
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
