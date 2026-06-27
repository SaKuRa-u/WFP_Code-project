@extends('layouts.adminlte')
@section('title', 'Layanan Kesehatan')

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

        .cat-badge {
            display: inline-block;
            background: #fef9e7;
            color: #d97706;
            font-size: 0.72rem;
            font-weight: 600;
            padding: 0.22rem 0.65rem;
            border-radius: 20px;
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

        .search-box {
            position: relative;
            max-width: 240px;
        }

        .search-box input {
            padding-left: 2.25rem;
            border-radius: 10px;
            border: 1.5px solid #e9ecef;
            font-size: 0.85rem;
            height: 38px;
        }

        .search-box input:focus {
            border-color: #0d9488;
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.1);
        }

        .search-box i {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #adb5bd;
        }

        /* Modal */
        .modal-card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
        }

        .modal-card .modal-header {
            border-bottom: 1px solid #f0f0f0;
            padding: 1.25rem 1.5rem;
        }

        .modal-card .modal-footer {
            border-top: 1px solid #f0f0f0;
            padding: 1rem 1.5rem;
        }

        .modal-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .form-label {
            font-size: 0.75rem;
            font-weight: 700;
            color: #495057;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 0.4rem;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            border: 1.5px solid #e9ecef;
            font-size: 0.88rem;
            padding: 0.6rem 0.9rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0d9488;
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.1);
        }

        .form-control.is-invalid,
        .form-select.is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            font-size: 0.75rem;
        }

        .input-group-text {
            border-radius: 10px 0 0 10px;
            border: 1.5px solid #e9ecef;
            border-right: none;
            background: #f8f9fa;
            font-size: 0.85rem;
            color: #6c757d;
        }

        .input-group .form-control {
            border-radius: 0 10px 10px 0;
        }

        /* Detail modal */
        .detail-row {
            display: flex;
            align-items: flex-start;
            padding: 0.7rem 0;
            border-bottom: 1px solid #f5f5f5;
            gap: 0.75rem;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-icon {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            background: #e6faf8;
            color: #0d9488;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .detail-key {
            font-size: 0.72rem;
            font-weight: 600;
            color: #adb5bd;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .detail-val {
            font-size: 0.88rem;
            font-weight: 600;
        }

        .availability-preset {
            display: inline-block;
            padding: 0.25rem 0.65rem;
            border: 1.5px solid #e9ecef;
            border-radius: 8px;
            font-size: 0.74rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.15s;
            margin: 0.12rem;
        }

        .availability-preset:hover {
            border-color: #0d9488;
            background: #e6faf8;
            color: #0d9488;
        }

        .action-btn.restore {
            background: #e6faf8;
            color: #0d9488;
        }
    </style>
@endpush

@section('content')

    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0 fw-bold">Layanan Kesehatan</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Layanan</li>
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

            <div class="page-card card">
                <div class="card-header">
                    <div class="d-flex align-items-center gap-2">
                        <div
                            style="width:36px;height:36px;border-radius:10px;background:#e6faf8;color:#0d9488;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-heart-pulse-fill"></i>
                        </div>
                        <div>
                            <div style="font-weight:700;font-size:1rem;">Layanan</div>
                            <small class="text-muted" style="font-size:0.75rem;">Total {{ $services->count() }} layanan
                                aktif</small>
                        </div>
                    </div>

                    <button type="button" class="btn btn-sm d-flex gap-1 ms-auto"
                        style="border-radius:10px;font-weight:600;font-size:0.82rem;padding:0.5rem 1rem;background:#0d9488;color:#fff;"
                        data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="bi bi-plus-lg"></i> Tambah Layanan
                    </button>
                </div>

                {{-- Tab Navigation --}}
                <ul class="nav nav-tabs mb-0 px-3 pt-2 border-bottom-0">
                    <li class="nav-item">
                        <a href="#aktif" class="nav-link active" data-bs-toggle="tab">
                            Aktif
                            <span class="badge bg-primary ms-1">{{ $services->count() }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#nonaktif" class="nav-link" data-bs-toggle="tab">
                            Nonaktif
                            <span class="badge bg-secondary ms-1">{{ $trashedServices->count() }}</span>
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    {{-- TAB AKTIF --}}
                    <div class="tab-pane fade show active" id="aktif">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0" id="serviceTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Layanan</th>
                                            <th>Kategori</th>
                                            <th>Ketersediaan</th>
                                            <th>Harga</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($services as $service)
                                            <tr>
                                                <td class="text-muted" style="font-size:0.78rem;">{{ $loop->iteration }}
                                                </td>
                                                <td>
                                                    <div style="font-weight:600;">{{ $service->service_name }}</div>
                                                    <div class="text-muted" style="font-size:0.75rem;">
                                                        {{ Str::limit($service->description, 48) }}</div>
                                                </td>
                                                <td><span
                                                        class="cat-badge">{{ $service->category->category_name ?? '-' }}</span>
                                                </td>
                                                <td style="font-size:0.82rem;">
                                                    <i class="bi bi-clock text-muted me-1"></i>{{ $service->availability }}
                                                </td>
                                                <td style="font-weight:700;color:#0d9488;">
                                                    Rp{{ number_format($service->price, 0, ',', '.') }}
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                                        <button type="button" class="action-btn view btn-detail"
                                                            title="Detail" data-id="{{ $service->id }}"
                                                            data-name="{{ $service->service_name }}"
                                                            data-description="{{ $service->description }}"
                                                            data-category="{{ $service->category->category_name ?? '-' }}"
                                                            data-availability="{{ $service->availability }}"
                                                            data-price="Rp{{ number_format($service->price, 0, ',', '.') }}">
                                                            <i class="bi bi-eye"></i>
                                                        </button>
                                                        <button type="button" class="action-btn edit btn-edit"
                                                            title="Edit" data-id="{{ $service->id }}"
                                                            data-name="{{ $service->service_name }}"
                                                            data-description="{{ $service->description }}"
                                                            data-category="{{ $service->category_id }}"
                                                            data-availability="{{ $service->availability }}"
                                                            data-price="{{ $service->price }}"
                                                            data-url="{{ route('admin.services.update', $service->id) }}">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>
                                                        <form action="{{ route('admin.services.destroy', $service->id) }}"
                                                            method="POST" class="d-inline delete-form">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="action-btn delete" title="Hapus">
                                                                <i class="bi bi-trash3"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center py-5 text-muted">
                                                    <i class="bi bi-heart-pulse d-block"
                                                        style="font-size:2.5rem;margin-bottom:0.5rem;"></i>
                                                    Belum ada layanan.
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
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Layanan</th>
                                            <th>Kategori</th>
                                            <th>Harga</th>
                                            <th>Dihapus</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($trashedServices as $service)
                                            <tr>
                                                <td class="text-muted" style="font-size:0.78rem;">{{ $loop->iteration }}
                                                </td>
                                                <td>
                                                    <div style="font-weight:600;">{{ $service->service_name }}</div>
                                                    <div class="text-muted" style="font-size:0.75rem;">
                                                        {{ Str::limit($service->description, 48) }}</div>
                                                </td>
                                                <td><span
                                                        class="cat-badge">{{ $service->category->category_name ?? '-' }}</span>
                                                </td>
                                                <td style="font-weight:700;color:#0d9488;">
                                                    Rp{{ number_format($service->price, 0, ',', '.') }}
                                                </td>
                                                <td style="font-size:0.82rem;">{{ $service->deleted_at->format('d M Y') }}
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                                        <form action="{{ route('admin.services.restore', $service->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf @method('PATCH')
                                                            <button type="submit" class="action-btn restore"
                                                                title="Pulihkan">
                                                                <i class="bi bi-arrow-counterclockwise"></i>
                                                            </button>
                                                        </form>
                                                        <form
                                                            action="{{ route('admin.services.forceDelete', $service->id) }}"
                                                            method="POST" class="d-inline force-delete-form">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="action-btn delete"
                                                                title="Hapus Permanen">
                                                                <i class="bi bi-trash3"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center py-5 text-muted">
                                                    <i class="bi bi-heart-pulse d-block"
                                                        style="font-size:2.5rem;margin-bottom:0.5rem;"></i>
                                                    Tidak ada layanan yang dihapus.
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
    </div>

    {{-- ==================== --}}
    {{-- MODAL: TAMBAH LAYANAN --}}
    {{-- ==================== --}}
    <div class="modal fade" id="createModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content modal-card">
                <div class="modal-header">
                    <div class="d-flex align-items-center gap-2">
                        <div class="modal-icon" style="background:#e6faf8;color:#0d9488;">
                            <i class="bi bi-heart-pulse-fill"></i>
                        </div>
                        <h6 class="modal-title fw-bold mb-0">Tambah Layanan</h6>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.services.store') }}" method="POST">
                    @csrf
                    <div class="modal-body px-4 py-3">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="form-label">Nama Layanan</label>
                                <input type="text" name="service_name"
                                    class="form-control @error('service_name') is-invalid @enderror"
                                    value="{{ old('service_name') }}" placeholder="Contoh: Konsultasi Dokter Umum"
                                    required>
                                @error('service_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Kategori</label>
                                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror"
                                    required>
                                    <option value="">-- Pilih --</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="description" rows="2" class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Deskripsi singkat layanan..." required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Ketersediaan</label>
                                <input type="text" name="availability" id="createAvailInput"
                                    class="form-control @error('availability') is-invalid @enderror"
                                    value="{{ old('availability') }}" placeholder="09.00 - 17.00" required>
                                <div class="mt-1">
                                    @foreach (['08.00 - 16.00', '09.00 - 17.00', '10.00 - 14.00', '24 Jam'] as $p)
                                        <span class="availability-preset"
                                            onclick="document.getElementById('createAvailInput').value='{{ $p }}'">{{ $p }}</span>
                                    @endforeach
                                </div>
                                @error('availability')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Harga</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="price"
                                        class="form-control @error('price') is-invalid @enderror"
                                        value="{{ old('price') }}" placeholder="150000" min="0" required>
                                </div>
                                @error('price')
                                    <div class="invalid-feedback mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-secondary btn-sm" style="border-radius:9px;"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm"
                            style="border-radius:9px;font-weight:600;background:#0d9488;color:#fff;padding:0.45rem 1.25rem;">
                            <i class="bi bi-check-lg me-1"></i>Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ==================== --}}
    {{-- MODAL: EDIT LAYANAN --}}
    {{-- ==================== --}}
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content modal-card">
                <div class="modal-header">
                    <div class="d-flex align-items-center gap-2">
                        <div class="modal-icon" style="background:#e8f4fd;color:#0d6efd;">
                            <i class="bi bi-pencil-square"></i>
                        </div>
                        <h6 class="modal-title fw-bold mb-0">Edit Layanan</h6>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editForm" method="POST">
                    @csrf @method('PUT')
                    <div class="modal-body px-4 py-3">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="form-label">Nama Layanan</label>
                                <input type="text" name="service_name" id="editName" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Kategori</label>
                                <select name="category_id" id="editCategory" class="form-select" required>
                                    <option value="">-- Pilih --</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="description" id="editDescription" rows="2" class="form-control" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Ketersediaan</label>
                                <input type="text" name="availability" id="editAvailInput" class="form-control"
                                    required>
                                <div class="mt-1">
                                    @foreach (['08.00 - 16.00', '09.00 - 17.00', '10.00 - 14.00', '24 Jam'] as $p)
                                        <span class="availability-preset"
                                            onclick="document.getElementById('editAvailInput').value='{{ $p }}'">{{ $p }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Harga</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="price" id="editPrice" class="form-control"
                                        min="0" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-secondary btn-sm" style="border-radius:9px;"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm"
                            style="border-radius:9px;font-weight:600;padding:0.45rem 1.25rem;">
                            <i class="bi bi-check-lg me-1"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ==================== --}}
    {{-- MODAL: DETAIL LAYANAN --}}
    {{-- ==================== --}}
    <div class="modal fade" id="detailModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-card">
                <div class="modal-header">
                    <div class="d-flex align-items-center gap-2">
                        <div class="modal-icon" style="background:#e6faf8;color:#0d9488;">
                            <i class="bi bi-info-circle-fill"></i>
                        </div>
                        <h6 class="modal-title fw-bold mb-0">Detail Layanan</h6>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body px-4 py-2">

                    <div class="detail-row">
                        <div class="detail-icon"><i class="bi bi-hash"></i></div>
                        <div>
                            <div class="detail-key">ID</div>
                            <div class="detail-val" id="detailId"></div>
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-icon"><i class="bi bi-heart-pulse"></i></div>
                        <div>
                            <div class="detail-key">Nama Layanan</div>
                            <div class="detail-val" id="detailName"></div>
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-icon"><i class="bi bi-tag-fill"></i></div>
                        <div>
                            <div class="detail-key">Kategori</div>
                            <div class="detail-val" id="detailCategory"></div>
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-icon"><i class="bi bi-card-text"></i></div>
                        <div>
                            <div class="detail-key">Deskripsi</div>
                            <div class="detail-val" id="detailDescription"
                                style="font-weight:400;font-size:0.85rem;line-height:1.5;"></div>
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-icon"><i class="bi bi-clock-fill"></i></div>
                        <div>
                            <div class="detail-key">Ketersediaan</div>
                            <div class="detail-val" id="detailAvailability"></div>
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-icon"><i class="bi bi-cash-stack"></i></div>
                        <div>
                            <div class="detail-key">Harga</div>
                            <div class="detail-val" id="detailPrice" style="color:#0d9488;"></div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-outline-secondary btn-sm" style="border-radius:9px;"
                        data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        // ── Search
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const q = this.value.toLowerCase();
            document.querySelectorAll('#serviceTable tbody tr').forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
            });
        });

        // ── Populate Edit Modal
        document.querySelectorAll('.btn-edit').forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('editForm').action = btn.dataset.url;
                document.getElementById('editName').value = btn.dataset.name;
                document.getElementById('editDescription').value = btn.dataset.description;
                document.getElementById('editAvailInput').value = btn.dataset.availability;
                document.getElementById('editPrice').value = btn.dataset.price;

                const catSelect = document.getElementById('editCategory');
                catSelect.value = btn.dataset.category;

                new bootstrap.Modal(document.getElementById('editModal')).show();
            });
        });

        // ── Populate Detail Modal
        document.querySelectorAll('.btn-detail').forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('detailId').textContent = '#' + btn.dataset.id;
                document.getElementById('detailName').textContent = btn.dataset.name;
                document.getElementById('detailCategory').textContent = btn.dataset.category;
                document.getElementById('detailDescription').textContent = btn.dataset.description;
                document.getElementById('detailAvailability').textContent = btn.dataset.availability;
                document.getElementById('detailPrice').textContent = btn.dataset.price;

                new bootstrap.Modal(document.getElementById('detailModal')).show();
            });
        });

        // ── Konfirmasi hapus
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (confirm('Hapus layanan ini?')) this.submit();
            });
        });

        // Konfirmasi hapus permanen
        document.querySelectorAll('.force-delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (confirm('Hapus permanen layanan ini? Tindakan ini tidak dapat dibatalkan.')) this
                    .submit();
            });
        });

        // ── Auto buka modal jika ada error validasi
        @if ($errors->any() && old('_method') === null)
            new bootstrap.Modal(document.getElementById('createModal')).show();
        @endif
    </script>
@endpush
