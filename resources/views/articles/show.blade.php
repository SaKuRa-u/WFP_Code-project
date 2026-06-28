@extends('layouts.member')
@section('title', $article->title)

@push('styles')
<style>
    .article-wrapper {
        max-width: 760px;
        margin: 0 auto;
    }
    .article-header {
        background: #fff;
        border: 1px solid var(--vg-border);
        border-radius: 20px;
        padding: 2rem 2.5rem;
        margin-bottom: 1.5rem;
    }
    .article-label {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: var(--vg-teal-light);
        color: var(--vg-teal);
        font-size: 0.72rem;
        font-weight: 700;
        padding: 0.3rem 0.75rem;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 1rem;
    }
    .article-title {
        font-size: 1.65rem;
        font-weight: 800;
        line-height: 1.3;
        color: var(--vg-text);
        margin-bottom: 1.25rem;
    }
    .article-meta {
        display: flex;
        align-items: center;
        gap: 1.25rem;
        flex-wrap: wrap;
        padding-top: 1.25rem;
        border-top: 1px solid var(--vg-border);
    }
    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.82rem;
        color: var(--vg-muted);
    }
    .meta-avatar {
        width: 32px; height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--vg-primary), var(--vg-teal));
        color: #fff;
        font-size: 0.72rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .meta-author { font-weight: 700; color: var(--vg-text); font-size: 0.88rem; }

    .article-body {
        background: #fff;
        border: 1px solid var(--vg-border);
        border-radius: 20px;
        padding: 2rem 2.5rem;
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
        line-height: 1.8;
        color: var(--vg-text);
    }
    .article-body p { margin-bottom: 1.25rem; }
    .article-body p:last-child { margin-bottom: 0; }

    /* Related articles */
    .related-card {
        background: #fff;
        border: 1px solid var(--vg-border);
        border-radius: 14px;
        padding: 1rem 1.25rem;
        text-decoration: none;
        color: inherit;
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        transition: all 0.2s;
    }
    .related-card:hover {
        border-color: var(--vg-primary);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(10,110,189,0.1);
        color: inherit;
    }
    .related-icon {
        width: 44px; height: 44px;
        border-radius: 10px;
        background: linear-gradient(135deg, #e8f4fd, #e6faf8);
        color: var(--vg-teal);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }
    .related-title { font-weight: 700; font-size: 0.85rem; line-height: 1.4; margin-bottom: 0.2rem; }
    .related-meta  { font-size: 0.72rem; color: var(--vg-muted); }

    .vg-section-title {
        font-size: 0.72rem; font-weight: 700; text-transform: uppercase;
        letter-spacing: 1px; color: var(--vg-muted); margin-bottom: 1rem;
        display: flex; align-items: center; gap: 0.5rem;
    }
    .vg-section-title::after { content: ''; flex: 1; height: 1px; background: var(--vg-border); }

    @media (max-width: 768px) {
        .article-header, .article-body { padding: 1.5rem; }
        .article-title { font-size: 1.3rem; }
    }
</style>
@endpush

@section('content')

    <div class="row">
        <div class="col-lg-8">

            {{-- Back button --}}
            <a href="{{ route('articles.index') }}"
               style="display:inline-flex;align-items:center;gap:0.4rem;font-size:0.82rem;font-weight:600;color:var(--vg-muted);text-decoration:none;margin-bottom:1rem;">
                <i class="bi bi-arrow-left"></i> Kembali ke Artikel
            </a>

            {{-- Article Header --}}
            <div class="article-header">
                <div class="article-label">
                    <i class="bi bi-file-earmark-medical-fill"></i> Artikel Kesehatan
                </div>
                <h1 class="article-title">{{ $article->title }}</h1>
                <div class="article-meta">
                    <div class="d-flex align-items-center gap-2">
                        <div class="meta-avatar">
                            {{ strtoupper(substr($article->author, 0, 2)) }}
                        </div>
                        <div>
                            <div class="meta-author">{{ $article->author }}</div>
                            <div style="font-size:0.72rem;color:var(--vg-muted);">Penulis</div>
                        </div>
                    </div>
                    <div class="meta-item">
                        <i class="bi bi-calendar3"></i>
                        {{ $article->created_at->format('d F Y') }}
                    </div>
                    <div class="meta-item">
                        <i class="bi bi-clock"></i>
                        {{ $article->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>

            {{-- Article Content --}}
            <div class="article-body">
                {!! nl2br(e($article->content)) !!}
            </div>

            {{-- Edit button (admin/doctor only) --}}
            @auth
                @if(auth()->user()->isAdmin() || auth()->user()->isDoctor())
                    <div class="d-flex gap-2 mb-4">
                        <a href="{{ route('articles.edit', $article->slug) }}"
                           class="btn btn-sm btn-outline-primary" style="border-radius:10px;font-weight:600;">
                            <i class="bi bi-pencil me-1"></i>Edit Artikel
                        </a>
                        @if(auth()->user()->isAdmin())
                            <form action="{{ route('articles.destroy', $article->slug) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                        style="border-radius:10px;font-weight:600;"
                                        onclick="return confirm('Hapus artikel ini?')">
                                    <i class="bi bi-trash3 me-1"></i>Hapus
                                </button>
                            </form>
                        @endif
                    </div>
                @endif
            @endauth

        </div>

        {{-- Sidebar: Related Articles --}}
        <div class="col-lg-4">
            <div class="position-sticky" style="top: 88px;">
                <div class="vg-section-title">Artikel Lainnya</div>

                @forelse($related as $rel)
                    <a href="{{ route('articles.show', $rel->slug) }}" class="related-card mb-2">
                        <div class="related-icon">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <div>
                            <div class="related-title">{{ $rel->title }}</div>
                            <div class="related-meta">
                                <i class="bi bi-person me-1"></i>{{ $rel->author }} ·
                                {{ $rel->created_at->format('d M Y') }}
                            </div>
                        </div>
                    </a>
                @empty
                    <div style="font-size:0.82rem;color:var(--vg-muted);text-align:center;padding:2rem 0;">
                        Tidak ada artikel lainnya.
                    </div>
                @endforelse

                {{-- CTA Booking --}}
                @auth
                    @if(auth()->user()->role === 'member')
                        <div class="mt-4 p-3 text-center"
                             style="background:linear-gradient(135deg,#e8f4fd,#e6faf8);border-radius:14px;border:1px solid var(--vg-border);">
                            <i class="bi bi-calendar-heart" style="font-size:1.75rem;color:var(--vg-teal);margin-bottom:0.5rem;display:block;"></i>
                            <div style="font-weight:700;font-size:0.9rem;margin-bottom:0.35rem;">
                                Punya keluhan?
                            </div>
                            <div style="font-size:0.78rem;color:var(--vg-muted);margin-bottom:0.75rem;">
                                Konsultasikan langsung dengan dokter kami.
                            </div>
                            <a href="{{ route('transactions.create') }}"
                               class="btn btn-sm w-100"
                               style="background:var(--vg-teal);color:#fff;border-radius:9px;font-weight:600;font-size:0.82rem;">
                                <i class="bi bi-calendar-plus me-1"></i>Booking Sekarang
                            </a>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>

@endsection