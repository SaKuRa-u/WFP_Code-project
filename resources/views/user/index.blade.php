@extends('layouts.adminlte')

@section('title', 'Daftar Member')

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

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
            color: #fff;
            font-size: 0.75rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .badge-role {
            font-size: 0.7rem;
            font-weight: 600;
            padding: 0.3rem 0.65rem;
            border-radius: 20px;
            text-transform: capitalize;
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
                    <h3 class="mb-0 fw-bold">Daftar Member</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Member</li>
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
                            style="width:36px;height:36px;border-radius:10px;background:#e8f4fd;color:#0d6efd;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div>
                            <h5>Member</h5>
                            <small class="text-muted" style="font-size:0.75rem;">
                                Total {{ $users->total() }} member terdaftar
                            </small>
                        </div>
                    </div>

                    <div class="ms-auto">
                        <a href="{{ route('admin.users.create') }}"
                            class="btn btn-primary btn-sm d-flex align-items-center gap-1">
                            <i class="bi bi-plus-lg"></i> Tambah Member
                        </a>
                    </div>
                </div>

                {{-- Tab Navigasi --}}
                <ul class="nav nav-tabs mb-0 px-3 pt-2 border-bottom-0">
                    <li class="nav-item">
                        <a href="#aktif" class="nav-link active" data-bs-toggle="tab">
                            Aktif
                            <span class="badge bg-primary ms-1">
                                {{ $users->total() }}
                            </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#nonaktif" class="nav-link" data-bs-toggle="tab">
                            Nonaktif
                            <span class="badge bg-secondary ms-1">
                                {{ $trashedUsers->total() }}
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
                                    <table class="table table-hover mb-0" id="userTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Member</th>
                                                <th>Email</th>
                                                <th>No. Telepon</th>
                                                <th>Bergabung</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($users as $user)
                                                <tr>
                                                    <td class="text-muted" style="font-size:0.78rem;">
                                                        {{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <div class="user-avatar">
                                                                US
                                                            </div>
                                                            <div>
                                                                <div style="font-weight:600;font-size:0.875rem;">
                                                                    {{ $user->name }}
                                                                </div>
                                                                <div class="text-muted" style="font-size:0.75rem;">
                                                                    ID #{{ $user->id }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->phone ?? '-' }}</td>
                                                    <td>
                                                        <span style="font-size:0.82rem;">
                                                            {{ $user->created_at->format('d M Y') }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                                            <a href="{{ route('admin.users.show', $user->id) }}"
                                                                class="action-btn view" title="Detail">
                                                                <i class="bi bi-eye"></i>
                                                            </a>
                                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                                                class="action-btn edit" title="Edit">
                                                                <i class="bi bi-pencil"></i>
                                                            </a>
                                                            <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                                method="POST" class="d-inline delete-form">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="action-btn delete"
                                                                    title="Hapus">
                                                                    <i class="bi bi-trash3"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6">
                                                        <div class="empty-state">
                                                            <i class="bi bi-people d-block"></i>
                                                            <div style="font-weight:600;">Belum ada member</div>
                                                            <small>Tambahkan member baru untuk memulai.</small>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- Pagination --}}
                            @if ($users->hasPages())
                                <div class="card-footer bg-transparent border-top-0 pt-0 pb-3 px-3">
                                    {{ $users->links() }}
                                </div>
                            @endif

                    </div>

                    {{-- TAB NONAKTIF --}}
                    <div class="tab-pane fade" id="nonaktif">

                        <div class="card-body p-0">

                            <!-- TABEL TRASHED USERS -->
                            <div class="table-responsive">
                                <table class="table table-hover mb-0" id="trashedUserTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Member</th>
                                            <th>Email</th>
                                            <th>No. Telepon</th>
                                            <th>Dihapus</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($trashedUsers as $user)
                                            <tr>
                                                <td class="text-muted" style="font-size:0.78rem;">
                                                    {{ $loop->iteration + ($trashedUsers->currentPage() - 1) * $trashedUsers->perPage() }}
                                                </td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone ?? '-' }}</td>
                                                <td>
                                                    <span style="font-size:0.82rem;">
                                                        {{ $user->deleted_at->format('d M Y') }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                                        <form action="{{ route('admin.users.restore', $user->id) }}" method="POST" class="d-inline restore-form">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="action-btn restore" title="Pulihkan">
                                                                <i class="bi bi-arrow-counterclockwise"></i>
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('admin.users.forceDelete', $user->id) }}" method="POST" class="d-inline delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="action-btn delete" title="Hapus Permanen">
                                                                <i class="bi bi-trash3"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6">
                                                    <div class="empty-state">
                                                        <i class="bi bi-people d-block"></i>
                                                        <div style="font-weight:600;">Belum ada member yang dihapus</div>
                                                        <small>Member yang dihapus akan muncul di sini.</small>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- Pagination --}}
                            @if ($users->hasPages())
                                <div class="card-footer bg-transparent border-top-0 pt-0 pb-3 px-3">
                                    {{ $users->links() }}
                                </div>
                            @endif

                        </div>

                    </div>

                </div>
            </div>
        </div>

    @endsection

    @push('scripts')
        <script>
            // Konfirmasi hapus
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    if (confirm('Hapus member ini? Tindakan ini tidak dapat dibatalkan.')) {
                        this.submit();
                    }
                });
            });
        </script>
    @endpush
