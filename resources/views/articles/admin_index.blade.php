@extends('layouts.adminlte')
@section('title', 'Artikel Kesehatan')

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

        .article-thumb {
            width: 52px;
            height: 52px;
            border-radius: 10px;
            background: linear-gradient(135deg, #e8f4fd, #e6faf8);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0d9488;
            font-size: 1.25rem;
            flex-shrink: 0;
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
            border-color: #0d6efd;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
        }

        .search-box i {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #adb5bd;
        }
    </style>
@endpush

@section('content')

    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0 fw-bold">Artikel Kesehatan</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Artikel</li>
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
                <div class="card-header d-flex align-items-center">
                    <!-- Left -->
                    <div class="d-flex align-items-center gap-2">
                        <div
                            style="width:36px;height:36px;border-radius:10px;background:#e8f4fd;color:#0d6efd;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-newspaper"></i>
                        </div>
                        <div>
                            <div style="font-weight:700;font-size:1rem;">Artikel</div>
                            <small class="text-muted" style="font-size:0.75rem;">
                                Total {{ $articles->count() }} artikel
                            </small>
                        </div>
                    </div>

                    <!-- Center -->
                    <div class="flex-grow-1 d-flex justify-content-center mx-3">
                        <form method="GET" action="{{ route('articles.index') }}" class="search-box"
                            style="max-width:400px;width:100%;">
                            <i class="bi bi-search"></i>
                            <input type="text" name="search" class="form-control" placeholder="Cari artikel..."
                                value="{{ request('search') }}">
                        </form>
                    </div>

                    <!-- Right -->
                    <a href="{{ route('articles.create') }}" class="btn btn-primary btn-sm"
                        style="border-radius:10px;font-weight:600;font-size:0.82rem;padding:0.5rem 1rem;">
                        <i class="bi bi-plus-lg"></i> Tulis Artikel
                    </a>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Artikel</th>
                                    <th>Penulis</th>
                                    <th>Tanggal</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($articles as $article)
                                    <tr>
                                        <td class="text-muted" style="font-size:0.78rem;">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="article-thumb">
                                                    <i class="bi bi-file-earmark-text"></i>
                                                </div>
                                                <div>
                                                    <div style="font-weight:600;font-size:0.875rem;">
                                                        {{ $article->title }}
                                                    </div>
                                                    <div class="text-muted" style="font-size:0.75rem;">
                                                        {{ Str::limit(strip_tags($article->content), 60) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div style="font-size:0.82rem;font-weight:500;">{{ $article->author }}</div>
                                        </td>
                                        <td style="font-size:0.82rem;color:#6c757d;">
                                            {{ $article->created_at->format('d M Y') }}
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center gap-1">
                                                <a href="{{ route('articles.show', $article->slug) }}"
                                                    class="action-btn view" title="Lihat" target="_blank">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('articles.edit', $article->slug) }}"
                                                    class="action-btn edit" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                @if (auth()->user()->isAdmin())
                                                    <form action="{{ route('articles.destroy', $article->slug) }}"
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
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            <i class="bi bi-newspaper d-block"
                                                style="font-size:2.5rem;margin-bottom:0.5rem;"></i>
                                            @if (request('search'))
                                                Tidak ada artikel dengan kata kunci "{{ request('search') }}".
                                            @else
                                                Belum ada artikel.
                                            @endif
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
                if (confirm('Hapus artikel ini?')) this.submit();
            });
        });
    </script>
@endpush
