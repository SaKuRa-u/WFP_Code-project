@extends('layouts.adminlte')

@section('title', 'Daftar Dokter')

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
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .page-card .card-header h5 {
            font-weight: 700;
            font-size: 1rem;
            margin: 0;
        }

        .table thead th {
            background: #f8f9fa;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            color: #6c757d;
            border-bottom: 1px solid #e9ecef;
            padding: 0.85rem 1rem;
            white-space: nowrap;
        }

        .table tbody td,
        .table tbody th {
            padding: 0.85rem 1rem;
            vertical-align: middle;
            font-size: 0.875rem;
            border-bottom: 1px solid #f5f5f5;
        }

        .table tbody tr:hover {
            background: #fafcff;
        }

        .table tbody tr:last-child td,
        .table tbody tr:last-child th {
            border-bottom: none;
        }

        .doctor-avatar {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: linear-gradient(135deg, #0d9488, #0a6ebd);
            color: #fff;
            font-size: 0.78rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .spec-badge {
            display: inline-block;
            background: #e6faf8;
            color: #0d9488;
            font-size: 0.7rem;
            font-weight: 600;
            padding: 0.22rem 0.6rem;
            border-radius: 20px;
            margin: 0.1rem;
            white-space: nowrap;
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

        .action-btn.edit {
            background: #e8f4fd;
            color: #0d6efd;
        }

        .action-btn.delete {
            background: #ffeaea;
            color: #dc3545;
        }

        .action-btn.view {
            background: #e6faf8;
            color: #0d9488;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #adb5bd;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .search-box {
            position: relative;
            max-width: 260px;
        }

        .search-box input {
            padding-left: 2.25rem;
            border-radius: 10px;
            border: 1.5px solid #e9ecef;
            font-size: 0.85rem;
            height: 38px;
        }

        .search-box input:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
        }

        .search-box i {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #adb5bd;
            font-size: 0.85rem;
        }
    </style>
@endpush

@section('content')

    {{-- Header --}}
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0 fw-bold">Daftar Dokter</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Dokter</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            {{-- Flash Message --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3 mb-3" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="page-card card">

                {{-- Card Header --}}
                <div class="card-header">
                    <div class="d-flex align-items-center gap-2">
                        <div
                            style="width:36px;height:36px;border-radius:10px;background:#e6faf8;color:#0d9488;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-person-badge-fill"></i>
                        </div>
                        <div>
                            <h5>Dokter</h5>
                            <small class="text-muted" style="font-size:0.75rem;">
                                Total {{ $doctors->count() }} dokter terdaftar
                            </small>
                        </div>
                    </div>
                    <div class="ms-auto">
                        <a href="{{ route('admin.doctors.create') }}" class="btn btn-sm d-flex align-items-center gap-1"
                            style="border-radius:10px; font-weight:600; font-size:0.82rem; padding:0.5rem 1rem; background:#0d9488; color:#fff;">
                            <i class="bi bi-plus-lg"></i> Tambah Dokter
                        </a>
                    </div>
                </div>

                {{-- Tab Navigasi --}}
                <ul class="nav nav-tabs mb-0 px-3 pt-2 border-bottom-0">
                    <li class="nav-item">
                        <a href="#aktif" class="nav-link active" data-bs-toggle="tab">
                            Aktif
                            <span class="badge bg-primary ms-1">
                                {{ $doctors->count() }}
                            </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#nonaktif" class="nav-link" data-bs-toggle="tab">
                            Nonaktif
                            <span class="badge bg-secondary ms-1">
                                {{ $trashedDoctors->count() }}
                            </span>
                        </a>
                    </li>
                </ul>

                <div class="tab-content">

                    {{-- TAB AKTIF --}}
                    <div class="tab-pane fade show active" id="aktif">

                        {{-- Table --}}
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0" id="doctorTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Dokter</th>
                                            <th>Spesialisasi</th>
                                            <th>Email</th>
                                            <th>No. Telepon</th>
                                            <th>Bergabung</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($doctors as $doctor)
                                            <tr>
                                                <td class="text-muted" style="font-size:0.78rem;">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="doctor-avatar">
                                                            {{ strtoupper(substr($doctor->name, 0, 2)) }}
                                                        </div>
                                                        <div>
                                                            <div style="font-weight:600;font-size:0.875rem;">
                                                                {{ $doctor->name }}
                                                            </div>
                                                            <div class="text-muted" style="font-size:0.75rem;">
                                                                ID #{{ $doctor->id }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @forelse($doctor->specializations as $spec)
                                                        <span class="spec-badge">{{ $spec->name }}</span>
                                                    @empty
                                                        <span class="text-muted" style="font-size:0.8rem;">–</span>
                                                    @endforelse
                                                </td>
                                                <td>{{ $doctor->email }}</td>
                                                <td>{{ $doctor->phone ?? '-' }}</td>
                                                <td>
                                                    <span style="font-size:0.82rem;">
                                                        {{ $doctor->created_at->format('d M Y') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                                        <a href="{{ route('admin.doctors.show', $doctor->id) }}"
                                                            class="action-btn view" title="Detail">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <a href="{{ route('admin.doctors.edit', $doctor->id) }}"
                                                            class="action-btn edit" title="Edit">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        <form action="{{ route('admin.doctors.destroy', $doctor->id) }}"
                                                            method="POST" class="d-inline delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="action-btn delete" title="Hapus">
                                                                <i class="bi bi-trash3"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7">
                                                    <div class="empty-state">
                                                        <i class="bi bi-person-badge d-block"></i>
                                                        <div style="font-weight:600;">Belum ada dokter</div>
                                                        <small>Tambahkan dokter baru untuk memulai.</small>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </div>

                    {{-- TAB NONAKTIF --}}
                    <div class="tab-pane fade" id="nonaktif">

                        <div class="card-body p-0">

                            <!-- TABEL TRASHED DOCTORS -->
                            <div class="table-responsive">
                                <table class="table table-hover mb-0" id="trashedDoctorTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Dokter</th>
                                            <th>Spesialisasi</th>
                                            <th>Email</th>
                                            <th>No. Telepon</th>
                                            <th>Dihapus</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($trashedDoctors as $doctor)
                                            <tr>
                                                <td class="text-muted" style="font-size:0.78rem;">
                                                    {{ $loop->iteration}}
                                                </td>
                                                <td>{{ $doctor->name }}</td>
                                                <td>{{ $doctor->specialization }}</td>
                                                <td>{{ $doctor->email }}</td>
                                                <td>{{ $doctor->phone ?? '-' }}</td>
                                                <td>
                                                    <span style="font-size:0.82rem;">
                                                        {{ $doctor->deleted_at->format('d M Y') }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                                        <form action="{{ route('admin.doctors.restore', $doctor->id) }}" method="POST" class="d-inline restore-form">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="action-btn restore" title="Pulihkan">
                                                                <i class="bi bi-arrow-counterclockwise"></i>
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('admin.doctors.forceDelete', $doctor->id) }}" method="POST" class="d-inline delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="action-btn delete" title="Hapus Permanen" onclick="return confirm('Hapus dokter ini? Tindakan ini tidak dapat dibatalkan.')">
                                                                <i class="bi bi-trash3"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7">
                                                    <div class="empty-state">
                                                        <i class="bi bi-person-badge d-block"></i>
                                                        <div style="font-weight:600;">Belum ada dokter yang dihapus</div>
                                                        <small>Dokter yang dihapus akan muncul di sini.</small>
                                                    </div>
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
        </div>

    @endsection

