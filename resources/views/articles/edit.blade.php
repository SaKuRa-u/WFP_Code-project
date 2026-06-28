@extends('layouts.adminlte')
@section('title', 'Edit Artikel')

@push('styles')
<style>
    .form-card { border:none; border-radius:16px; box-shadow:0 2px 12px rgba(0,0,0,0.07); overflow:hidden; }
    .form-card .card-header { background:#fff; border-bottom:1px solid #f0f0f0; padding:1.25rem 1.5rem; }
    .form-label { font-size:0.75rem; font-weight:700; color:#495057; text-transform:uppercase; letter-spacing:0.4px; margin-bottom:0.4rem; }
    .form-control { border-radius:10px; border:1.5px solid #e9ecef; font-size:0.88rem; padding:0.6rem 0.9rem; transition:all 0.15s; }
    .form-control:focus { border-color:#0d6efd; box-shadow:0 0 0 3px rgba(13,110,253,0.1); }
    .form-control.is-invalid { border-color:#dc3545; }
    .invalid-feedback { font-size:0.75rem; }
    #content { min-height:320px; line-height:1.8; font-size:0.92rem; resize:vertical; }
    .char-count { font-size:0.72rem; color:#adb5bd; text-align:right; margin-top:0.25rem; }
    .article-info { background:#f8f9fa; border-radius:10px; padding:0.85rem 1rem; font-size:0.8rem; color:#6c757d; }
</style>
@endpush

@section('content')

<div class="app-content-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6"><h3 class="mb-0 fw-bold">Edit Artikel</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('articles.index') }}">Artikel</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row g-3">

            {{-- Form --}}
            <div class="col-lg-8">
                <div class="form-card card">
                    <div class="card-header d-flex align-items-center gap-2">
                        <div style="width:36px;height:36px;border-radius:10px;background:#e8f4fd;color:#0d6efd;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-pencil-square"></i>
                        </div>
                        <div>
                            <div style="font-weight:700;">Edit Artikel</div>
                            <div class="text-muted" style="font-size:0.75rem;">{{ Str::limit($article->title, 50) }}</div>
                        </div>
                    </div>
                    <form action="{{ route('articles.update', $article->slug) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="card-body px-4 py-3">

                            <div class="mb-3">
                                <label class="form-label">Judul Artikel</label>
                                <input type="text" name="title"
                                       class="form-control @error('title') is-invalid @enderror"
                                       value="{{ old('title', $article->title) }}" required>
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Penulis</label>
                                <input type="text" name="author"
                                       class="form-control @error('author') is-invalid @enderror"
                                       value="{{ old('author', $article->author) }}" required>
                                @error('author')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-1">
                                <label class="form-label">Konten Artikel</label>
                                <textarea name="content" id="content"
                                          class="form-control @error('content') is-invalid @enderror"
                                          required>{{ old('content', $article->content) }}</textarea>
                                <div class="char-count"><span id="charCount">0</span> karakter</div>
                                @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                        </div>
                        <div class="card-footer bg-transparent border-top d-flex justify-content-between px-4 py-3">
                            <a href="{{ route('articles.index') }}"
                               class="btn btn-outline-secondary btn-sm" style="border-radius:10px;">
                                <i class="bi bi-arrow-left me-1"></i>Batal
                            </a>
                            <div class="d-flex gap-2">
                                <a href="{{ route('articles.show', $article->slug) }}"
                                   class="btn btn-outline-primary btn-sm" style="border-radius:10px;" target="_blank">
                                    <i class="bi bi-eye me-1"></i>Preview
                                </a>
                                <button type="submit" class="btn btn-primary btn-sm"
                                        style="border-radius:10px;font-weight:600;padding:0.5rem 1.25rem;">
                                    <i class="bi bi-check-lg me-1"></i>Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Sidebar: Info --}}
            <div class="col-lg-4">
                <div class="card border-0 rounded-4 shadow-sm" style="overflow:hidden;">
                    <div class="card-header bg-white border-bottom" style="padding:1.25rem 1.5rem;">
                        <div style="font-weight:700;font-size:0.9rem;">
                            <i class="bi bi-info-circle-fill text-primary me-2"></i>Info Artikel
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between px-4 py-2" style="font-size:0.82rem;">
                                <span class="text-muted">Dibuat</span>
                                <span class="fw-600">{{ $article->created_at->format('d M Y') }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between px-4 py-2" style="font-size:0.82rem;">
                                <span class="text-muted">Diperbarui</span>
                                <span class="fw-600">{{ $article->updated_at->diffForHumans() }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between px-4 py-2" style="font-size:0.82rem;">
                                <span class="text-muted">Slug</span>
                                <span class="text-muted" style="font-size:0.72rem;word-break:break-all;">{{ $article->slug }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

                @if(auth()->user()->isAdmin())
                    <div class="card border-0 rounded-4 shadow-sm mt-3 border-danger" style="overflow:hidden;border:1px solid #ffd5d5 !important;">
                        <div class="card-body px-4 py-3">
                            <div style="font-weight:700;font-size:0.85rem;color:#dc3545;margin-bottom:0.5rem;">
                                <i class="bi bi-exclamation-triangle-fill me-1"></i>Zona Berbahaya
                            </div>
                            <p style="font-size:0.78rem;color:#6c757d;margin-bottom:0.75rem;">
                                Menghapus artikel bersifat permanen dan tidak dapat dibatalkan.
                            </p>
                            <form action="{{ route('articles.destroy', $article->slug) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="btn btn-outline-danger btn-sm w-100"
                                        style="border-radius:9px;font-weight:600;"
                                        onclick="return confirm('Hapus artikel ini secara permanen?')">
                                    <i class="bi bi-trash3 me-1"></i>Hapus Artikel
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    const contentEl = document.getElementById('content');
    const charCount = document.getElementById('charCount');
    contentEl.addEventListener('input', () => charCount.textContent = contentEl.value.length);
    charCount.textContent = contentEl.value.length;
</script>
@endpush