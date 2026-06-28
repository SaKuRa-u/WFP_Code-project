@extends('layouts.adminlte')
@section('title', 'Tulis Artikel')

@push('styles')
<style>
    .form-card { border:none; border-radius:16px; box-shadow:0 2px 12px rgba(0,0,0,0.07); overflow:hidden; }
    .form-card .card-header { background:#fff; border-bottom:1px solid #f0f0f0; padding:1.25rem 1.5rem; }
    .form-label { font-size:0.75rem; font-weight:700; color:#495057; text-transform:uppercase; letter-spacing:0.4px; margin-bottom:0.4rem; }
    .form-control { border-radius:10px; border:1.5px solid #e9ecef; font-size:0.88rem; padding:0.6rem 0.9rem; transition:all 0.15s; }
    .form-control:focus { border-color:#0d6efd; box-shadow:0 0 0 3px rgba(13,110,253,0.1); }
    .form-control.is-invalid { border-color:#dc3545; }
    .invalid-feedback { font-size:0.75rem; }
    #content { min-height: 320px; line-height: 1.8; font-size: 0.92rem; resize: vertical; }
    .char-count { font-size: 0.72rem; color: #adb5bd; text-align: right; margin-top: 0.25rem; }
    .preview-box {
        background: #fafafa;
        border: 1.5px solid #e9ecef;
        border-radius: 10px;
        padding: 1.25rem;
        min-height: 100px;
        font-size: 0.88rem;
        line-height: 1.8;
        color: #495057;
    }
    .preview-box.empty { color: #adb5bd; font-style: italic; }
</style>
@endpush

@section('content')

<div class="app-content-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6"><h3 class="mb-0 fw-bold">Tulis Artikel</h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('articles.index') }}">Artikel</a></li>
                    <li class="breadcrumb-item active">Tulis</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row g-3">

            {{-- Form --}}
                <div class="form-card card">
                    <div class="card-header d-flex align-items-center gap-2">
                        <div style="width:36px;height:36px;border-radius:10px;background:#e8f4fd;color:#0d6efd;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-pencil-square"></i>
                        </div>
                        <div style="font-weight:700;">Artikel Baru</div>
                    </div>
                    <form action="{{ route('articles.store') }}" method="POST">
                        @csrf
                        <div class="card-body px-4 py-3">

                            <div class="mb-3">
                                <label class="form-label">Judul Artikel</label>
                                <input type="text" name="title" id="titleInput"
                                       class="form-control @error('title') is-invalid @enderror"
                                       value="{{ old('title') }}"
                                       placeholder="Masukkan judul artikel yang menarik..." required>
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Penulis</label>
                                <input type="text" name="author"
                                       class="form-control @error('author') is-invalid @enderror"
                                       value="{{ old('author', auth()->user()->name) }}"
                                       placeholder="Nama penulis" required readonly>
                                @error('author')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-1">
                                <label class="form-label">Konten Artikel</label>
                                <textarea name="content" id="content"
                                          class="form-control @error('content') is-invalid @enderror"
                                          placeholder="Tulis konten artikel di sini..." required>{{ old('content') }}</textarea>
                                @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                        </div>
                        <div class="card-footer bg-transparent border-top d-flex justify-content-between px-4 py-3">
                            <a href="{{ route('articles.index') }}"
                               class="btn btn-outline-secondary btn-sm" style="border-radius:10px;">
                                <i class="bi bi-arrow-left me-1"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary btn-sm ms-auto"
                                    style="border-radius:10px;font-weight:600;padding:0.5rem 1.25rem;">
                                <i class="bi bi-send me-1"></i>Publikasikan
                            </button>
                        </div>
                    </form>
                </div>

           

        </div>
    </div>
</div>
@endsection