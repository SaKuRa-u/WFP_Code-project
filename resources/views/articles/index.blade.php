@extends('layouts.member')
@section('title', 'Artikel Kesehatan')

@push('styles')
<style>
    .page-hero {
        background: linear-gradient(135deg, #0a6ebd 0%, #0d9488 100%);
        border-radius: 20px;
        padding: 2.5rem;
        color: #fff;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }
    .page-hero::before {
        content: '';
        position: absolute;
        top: -50px; right: -30px;
        width: 200px; height: 200px;
        background: rgba(255,255,255,0.06);
        border-radius: 50%;
    }
    .page-hero h2 { font-weight: 800; font-size: 1.75rem; margin-bottom: 0.35rem; }
    .page-hero p  { opacity: 0.8; font-size: 0.9rem; margin: 0; }

    .search-form {
        display: flex;
        gap: 0.5rem;
        max-width: 420px;
        margin-top: 1.25rem;
    }
    .search-form input {
        flex: 1;
        border: none;
        border-radius: 10px;
        padding: 0.6rem 1rem;
        font-size: 0.88rem;
        outline: none;
    }
    .search-form button {
        border: none;
        border-radius: 10px;
        padding: 0.6rem 1.25rem;
        background: rgba(255,255,255,0.2);
        color: #fff;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        transition: background 0.15s;
    }
    .search-form button:hover { background: rgba(255,255,255,0.3); }

    .article-card {
        background: #fff;
        border: 1px solid var(--vg-border);
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.2s;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .article-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(10,110,189,0.12);
        border-color: var(--vg-primary);
    }
    .article-card .card-thumb {
        height: 140px;
        background: linear-gradient(135deg, #e8f4fd, #e6faf8);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: #0d9488;
        position: relative;
        overflow: hidden;
    }
    .article-card .card-thumb::after {
        content: '';
        position: absolute;
        bottom: -20px; right: -20px;
        width: 80px; height: 80px;
        background: rgba(13,148,136,0.08);
        border-radius: 50%;
    }
    .article-card .card-body {
        padding: 1.25rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .article-card .card-meta {
        font-size: 0.72rem;
        color: var(--vg-muted);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .article-card h6 {
        font-weight: 700;
        font-size: 0.95rem;
        line-height: 1.4;
        margin-bottom: 0.5rem;
        flex: 1;
    }
    .article-card .card-excerpt {
        font-size: 0.8rem;
        color: var(--vg-muted);
        line-height: 1.6;
        margin-bottom: 1rem;
    }
    .article-card .read-more {
        font-size: 0.8rem;
        font-weight: 700;
        color: var(--vg-primary);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.3rem;
        margin-top: auto;
    }
    .article-card .read-more:hover { gap: 0.5rem; }

    .vg-section-title {
        font-size: 0.72rem; font-weight: 700; text-transform: uppercase;
        letter-spacing: 1px; color: var(--vg-muted); margin-bottom: 1rem;
        display: flex; align-items: center; gap: 0.5rem;
    }
    .vg-section-title::after { content: ''; flex: 1; height: 1px; background: var(--vg-border); }

    .empty-state {
        text-align: center;
        padding: 4rem 1rem;
        background: #fff;
        border-radius: 16px;
        border: 1px solid var(--vg-border);
    }
</style>
@endpush

@section('content')

    {{-- Hero + Search --}}
    <div class="page-hero">
        <h2><i class="bi bi-newspaper me-2"></i>Artikel Kesehatan</h2>
        <p>Baca tips dan informasi kesehatan terpercaya dari dokter ahli kami.</p>
        <form method="GET" action="{{ route('articles.index') }}" class="search-form">
            <input type="text" name="search"
                   placeholder="Cari artikel..."
                   value="{{ request('search') }}">
            <button type="submit"><i class="bi bi-search me-1"></i>Cari</button>
        </form>
    </div>

    {{-- Result info --}}
    @if(request('search'))
        <div class="mb-3 d-flex align-items-center justify-content-between">
            <div style="font-size:0.85rem;color:var(--vg-muted);">
                Menampilkan <strong>{{ $articles->total() }}</strong> hasil untuk
                "<strong>{{ request('search') }}</strong>"
            </div>
            <a href="{{ route('articles.index') }}" style="font-size:0.82rem;color:var(--vg-primary);">
                <i class="bi bi-x-circle me-1"></i>Hapus filter
            </a>
        </div>
    @else
        <div class="vg-section-title">Semua Artikel</div>
    @endif

    {{-- Article Grid --}}
    @if($articles->count())
        <div class="row g-3 mb-4">
            @foreach($articles as $article)
                <div class="col-sm-6 col-lg-4">
                    <div class="article-card">
                        <div class="card-thumb">
                            <i class="bi bi-file-earmark-medical-fill"></i>
                        </div>
                        <div class="card-body">
                            <div class="card-meta">
                                <span><i class="bi bi-person me-1"></i>{{ $article->author }}</span>
                                <span><i class="bi bi-calendar me-1"></i>{{ $article->created_at->format('d M Y') }}</span>
                            </div>
                            <h6>{{ $article->title }}</h6>
                            <p class="card-excerpt">
                                {{ Str::limit(strip_tags($article->content), 100) }}
                            </p>
                            <a href="{{ route('articles.show', $article->slug) }}" class="read-more">
                                Baca selengkapnya <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    @else
        <div class="empty-state">
            <i class="bi bi-newspaper" style="font-size:3rem;color:#ced4da;margin-bottom:1rem;display:block;"></i>
            <div style="font-weight:700;margin-bottom:0.35rem;">
                @if(request('search'))
                    Artikel tidak ditemukan
                @else
                    Belum ada artikel
                @endif
            </div>
            <p style="font-size:0.85rem;color:var(--vg-muted);margin:0;">
                @if(request('search'))
                    Coba kata kunci lain.
                @else
                    Artikel kesehatan akan segera hadir.
                @endif
            </p>
        </div>
    @endif

@endsection