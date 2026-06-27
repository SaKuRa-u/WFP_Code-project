@extends('layouts.adminlte')
@section('title', 'Kategori Layanan')

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

        .cat-img {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            object-fit: cover;
        }

        .cat-img-placeholder {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: #fef9e7;
            color: #d97706;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .service-count {
            display: inline-block;
            background: #e8f4fd;
            color: #0d6efd;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 0.2rem 0.6rem;
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

        /* Modal styles */
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

        .form-control {
            border-radius: 10px;
            border: 1.5px solid #e9ecef;
            font-size: 0.88rem;
            padding: 0.6rem 0.9rem;
        }

        .form-control:focus {
            border-color: #d97706;
            box-shadow: 0 0 0 3px rgba(217, 119, 6, 0.1);
        }

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            font-size: 0.75rem;
        }

        /* Image upload */
        .img-upload-area {
            border: 2px dashed #e9ecef;
            border-radius: 12px;
            padding: 1.25rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            background: #fafafa;
        }

        .img-upload-area:hover {
            border-color: #d97706;
            background: #fef9e7;
        }

        .img-upload-area input[type=file] {
            display: none;
        }

        /* Detail modal */
        .detail-row {
            display: flex;
            align-items: center;
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
            background: #fef9e7;
            color: #d97706;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            flex-shrink: 0;
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
                    <h3 class="mb-0 fw-bold">Kategori Layanan</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Kategori</li>
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
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-3">
                    <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="page-card card">
                <div class="card-header">
                    <div class="d-flex align-items-center gap-2">
                        <div
                            style="width:36px;height:36px;border-radius:10px;background:#fef9e7;color:#d97706;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-tag-fill"></i>
                        </div>
                        <div>
                            <div style="font-weight:700;font-size:1rem;">Kategori</div>
                            <small class="text-muted" style="font-size:0.75rem;">Total {{ $categories->count() }} kategori
                                aktif</small>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm d-flex gap-1 ms-auto"
                        style="border-radius:10px;font-weight:600;font-size:0.82rem;padding:0.5rem 1rem;background:#d97706;color:#fff;"
                        data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="bi bi-plus-lg"></i> Tambah Kategori
                    </button>
                </div>

                {{-- Tab Navigation --}}
                <ul class="nav nav-tabs mb-0 px-3 pt-2 border-bottom-0">
                    <li class="nav-item">
                        <a href="#aktif" class="nav-link active" data-bs-toggle="tab">
                            Aktif
                            <span class="badge bg-primary ms-1">{{ $categories->count() }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#nonaktif" class="nav-link" data-bs-toggle="tab">
                            Nonaktif
                            <span class="badge bg-secondary ms-1">{{ $trashedCategories->count() }}</span>
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    {{-- TAB AKTIF --}}
                    <div class="tab-pane fade show active" id="aktif">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Gambar</th>
                                            <th>Nama Kategori</th>
                                            <th>Jumlah Layanan</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($categories as $category)
                                            <tr>
                                                <td class="text-muted" style="font-size:0.78rem;">{{ $loop->iteration }}
                                                </td>
                                                <td>
                                                    @if ($category->image && $category->image !== 'no-preview.jpg')
                                                        <img src="{{ asset('storage/categories/img/' . $category->image) }}"
                                                            alt="{{ $category->category_name }}" class="cat-img">
                                                    @else
                                                        <div class="cat-img-placeholder"><i class="bi bi-image"></i></div>
                                                    @endif
                                                </td>
                                                <td style="font-weight:600;">{{ $category->category_name }}</td>
                                                <td>
                                                    <span class="service-count">{{ $category->services_count }}
                                                        layanan</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                                        <button type="button" class="action-btn view btn-detail"
                                                            title="Detail" data-id="{{ $category->id }}"
                                                            data-name="{{ $category->category_name }}"
                                                            data-image="{{ $category->image !== 'no-preview.jpg' ? asset('storage/categories/img/' . $category->image) : '' }}"
                                                            data-services="{{ $category->services_count }}">
                                                            <i class="bi bi-eye"></i>
                                                        </button>
                                                        <button type="button" class="action-btn edit btn-edit"
                                                            title="Edit" data-id="{{ $category->id }}"
                                                            data-name="{{ $category->category_name }}"
                                                            data-image="{{ $category->image !== 'no-preview.jpg' ? asset('storage/categories/img/' . $category->image) : '' }}"
                                                            data-url="{{ route('admin.categories.update', $category->id) }}">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>
                                                        <form
                                                            action="{{ route('admin.categories.destroy', $category->id) }}"
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
                                                <td colspan="5" class="text-center py-5 text-muted">
                                                    <i class="bi bi-tag d-block"
                                                        style="font-size:2.5rem;margin-bottom:0.5rem;"></i>
                                                    Belum ada kategori.
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
                                            <th>Gambar</th>
                                            <th>Nama Kategori</th>
                                            <th>Jumlah Layanan</th>
                                            <th>Dihapus</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($trashedCategories as $category)
                                            <tr>
                                                <td class="text-muted" style="font-size:0.78rem;">{{ $loop->iteration }}
                                                </td>
                                                <td>
                                                    @if ($category->image && $category->image !== 'no-preview.jpg')
                                                        <img src="{{ asset('storage/categories/img/' . $category->image) }}"
                                                            alt="{{ $category->category_name }}" class="cat-img">
                                                    @else
                                                        <div class="cat-img-placeholder"><i class="bi bi-image"></i></div>
                                                    @endif
                                                </td>
                                                <td style="font-weight:600;">{{ $category->category_name }}</td>
                                                <td>
                                                    <span class="service-count">{{ $category->services_count }}
                                                        layanan</span>
                                                </td>
                                                <td style="font-size:0.82rem;">
                                                    {{ $category->deleted_at->format('d M Y') }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                                        <form
                                                            action="{{ route('admin.categories.restore', $category->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf @method('PATCH')
                                                            <button type="submit" class="action-btn restore"
                                                                title="Pulihkan">
                                                                <i class="bi bi-arrow-counterclockwise"></i>
                                                            </button>
                                                        </form>
                                                        <form
                                                            action="{{ route('admin.categories.forceDelete', $category->id) }}"
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
                                                    <i class="bi bi-tag d-block"
                                                        style="font-size:2.5rem;margin-bottom:0.5rem;"></i>
                                                    Tidak ada kategori yang dihapus.
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

    {{-- ===================== --}}
    {{-- MODAL: TAMBAH KATEGORI --}}
    {{-- ===================== --}}
    <div class="modal fade" id="createModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-card">
                <div class="modal-header">
                    <div class="d-flex align-items-center gap-2">
                        <div class="modal-icon" style="background:#fef9e7;color:#d97706;">
                            <i class="bi bi-tag-fill"></i>
                        </div>
                        <h6 class="modal-title fw-bold mb-0">Tambah Kategori</h6>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body px-4 py-3">

                        <div class="mb-3">
                            <label class="form-label">Nama Kategori</label>
                            <input type="text" name="category_name"
                                class="form-control @error('category_name') is-invalid @enderror"
                                value="{{ old('category_name') }}" placeholder="Contoh: General Consultation" required>
                            @error('category_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-1">
                            <label class="form-label">Gambar <span class="text-muted fw-normal">(opsional)</span></label>
                            <div class="img-upload-area" id="createUploadArea"
                                onclick="document.getElementById('createImageInput').click()">
                                <img id="createImgPreview"
                                    style="width:80px;height:80px;border-radius:10px;object-fit:cover;margin:0 auto 0.5rem;display:none;display:block;"
                                    class="d-none">
                                <div id="createUploadPrompt">
                                    <i class="bi bi-cloud-upload" style="font-size:1.75rem;color:#d97706;"></i>
                                    <div style="font-size:0.82rem;font-weight:600;margin-top:0.35rem;">Klik untuk upload
                                    </div>
                                    <div style="font-size:0.72rem;color:#adb5bd;">JPG, PNG, WEBP — maks 2MB</div>
                                </div>
                                <input type="file" id="createImageInput" name="image" accept="image/*">
                            </div>
                            @error('image')
                                <div class="text-danger mt-1" style="font-size:0.75rem;">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-secondary btn-sm" style="border-radius:9px;"
                            data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-sm"
                            style="border-radius:9px;font-weight:600;background:#d97706;color:#fff;padding:0.45rem 1.25rem;">
                            <i class="bi bi-check-lg me-1"></i>Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ===================== --}}
    {{-- MODAL: EDIT KATEGORI --}}
    {{-- ===================== --}}
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-card">
                <div class="modal-header">
                    <div class="d-flex align-items-center gap-2">
                        <div class="modal-icon" style="background:#e8f4fd;color:#0d6efd;">
                            <i class="bi bi-pencil-square"></i>
                        </div>
                        <h6 class="modal-title fw-bold mb-0">Edit Kategori</h6>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="modal-body px-4 py-3">

                        <div class="mb-3">
                            <label class="form-label">Nama Kategori</label>
                            <input type="text" name="category_name" id="editName" class="form-control"
                                placeholder="Nama kategori" required>
                        </div>

                        <div class="mb-1">
                            <label class="form-label">Gambar <span class="text-muted fw-normal">(opsional — kosongkan jika
                                    tidak ingin mengubah)</span></label>
                            <div class="img-upload-area" onclick="document.getElementById('editImageInput').click()">
                                <img id="editImgPreview"
                                    style="width:80px;height:80px;border-radius:10px;object-fit:cover;margin:0 auto 0.5rem;"
                                    class="d-none">
                                <div id="editUploadPrompt">
                                    <i class="bi bi-arrow-repeat" style="font-size:1.75rem;color:#0d6efd;"></i>
                                    <div style="font-size:0.82rem;font-weight:600;margin-top:0.35rem;">Klik untuk ganti
                                        gambar</div>
                                    <div style="font-size:0.72rem;color:#adb5bd;">JPG, PNG, WEBP — maks 2MB</div>
                                </div>
                                <input type="file" id="editImageInput" name="image" accept="image/*">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-secondary btn-sm" style="border-radius:9px;"
                            data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary btn-sm"
                            style="border-radius:9px;font-weight:600;padding:0.45rem 1.25rem;">
                            <i class="bi bi-check-lg me-1"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ===================== --}}
    {{-- MODAL: DETAIL KATEGORI --}}
    {{-- ===================== --}}
    <div class="modal fade" id="detailModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-card">
                <div class="modal-header">
                    <div class="d-flex align-items-center gap-2">
                        <div class="modal-icon" style="background:#e6faf8;color:#0d9488;">
                            <i class="bi bi-info-circle-fill"></i>
                        </div>
                        <h6 class="modal-title fw-bold mb-0">Detail Kategori</h6>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body px-4 py-2">

                    <div class="text-center py-3 border-bottom mb-2">
                        <img id="detailImg"
                            style="width:80px;height:80px;border-radius:14px;object-fit:cover;margin-bottom:0.75rem;"
                            class="d-none">
                        <div id="detailImgPlaceholder"
                            style="width:80px;height:80px;border-radius:14px;background:#fef9e7;color:#d97706;display:flex;align-items:center;justify-content:center;font-size:2rem;margin:0 auto 0.75rem;">
                            <i class="bi bi-tag-fill"></i>
                        </div>
                        <div id="detailName" style="font-weight:800;font-size:1.1rem;"></div>
                    </div>

                    <div class="detail-row">
                        <div class="detail-icon"><i class="bi bi-hash"></i></div>
                        <div>
                            <div class="detail-key">ID Kategori</div>
                            <div class="detail-val" id="detailId"></div>
                        </div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-icon"><i class="bi bi-heart-pulse"></i></div>
                        <div>
                            <div class="detail-key">Jumlah Layanan</div>
                            <div class="detail-val" id="detailServices"></div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-outline-secondary btn-sm" style="border-radius:9px;"
                        data-bs-dismiss="modal">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        // ── Image preview untuk Create
        document.getElementById('createImageInput').addEventListener('change', function() {
            previewImage(this, 'createImgPreview', 'createUploadPrompt');
        });

        // ── Image preview untuk Edit
        document.getElementById('editImageInput').addEventListener('change', function() {
            previewImage(this, 'editImgPreview', 'editUploadPrompt');
        });

        function previewImage(input, previewId, promptId) {
            const file = input.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = e => {
                const img = document.getElementById(previewId);
                img.src = e.target.result;
                img.classList.remove('d-none');
                document.getElementById(promptId).classList.add('d-none');
            };
            reader.readAsDataURL(file);
        }

        // ── Populate Edit Modal
        document.querySelectorAll('.btn-edit').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.dataset.id;
                const name = btn.dataset.name;
                const image = btn.dataset.image;
                const url = btn.dataset.url;

                document.getElementById('editForm').action = url;
                document.getElementById('editName').value = name;

                const imgEl = document.getElementById('editImgPreview');
                const promptEl = document.getElementById('editUploadPrompt');

                if (image) {
                    imgEl.src = image;
                    imgEl.classList.remove('d-none');
                    promptEl.classList.add('d-none');
                } else {
                    imgEl.classList.add('d-none');
                    promptEl.classList.remove('d-none');
                }

                new bootstrap.Modal(document.getElementById('editModal')).show();
            });
        });

        // ── Populate Detail Modal
        document.querySelectorAll('.btn-detail').forEach(btn => {
            btn.addEventListener('click', () => {
                const image = btn.dataset.image;
                const imgEl = document.getElementById('detailImg');
                const phEl = document.getElementById('detailImgPlaceholder');

                document.getElementById('detailId').textContent = '#' + btn.dataset.id;
                document.getElementById('detailName').textContent = btn.dataset.name;
                document.getElementById('detailServices').textContent = btn.dataset.services + ' layanan';

                if (image) {
                    imgEl.src = image;
                    imgEl.classList.remove('d-none');
                    phEl.style.display = 'none';
                } else {
                    imgEl.classList.add('d-none');
                    phEl.style.display = 'flex';
                }

                new bootstrap.Modal(document.getElementById('detailModal')).show();
            });
        });

        // ── Konfirmasi hapus
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (confirm('Hapus kategori ini? Tindakan ini tidak dapat dibatalkan.')) this.submit();
            });
        });

        // Konfirmasi hapus permanen
        document.querySelectorAll('.force-delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (confirm('Hapus permanen kategori ini? Tindakan ini tidak dapat dibatalkan.')) this
                    .submit();
            });
        });

        // ── Auto buka modal jika ada error validasi (saat create)
        @if ($errors->any() && old('_method') === null)
            new bootstrap.Modal(document.getElementById('createModal')).show();
        @endif
    </script>
@endpush
