@php
    $user         = auth()->user();
    $isAdminDoc   = in_array($user->role, ['admin', 'doctor']);
    $layoutName   = $isAdminDoc ? 'layouts.adminlte' : 'layouts.member';
@endphp

@extends($layoutName)
@section('title', 'Detail Booking #' . $transaction->id)

@push('styles')
<style>
    /* ── Info Cards ── */
    .info-card { background:#fff; border:1px solid var(--vg-border, #e8edf2); border-radius:16px; overflow:hidden; margin-bottom:1.25rem; }
    .info-card .ic-header { padding:1rem 1.25rem; border-bottom:1px solid #f0f0f0; display:flex; align-items:center; gap:0.75rem; }
    .ic-icon { width:36px; height:36px; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:0.95rem; }
    .ic-title { font-weight:700; font-size:0.9rem; }
    .ic-body { padding:1rem 1.25rem; }

    .info-row { display:flex; align-items:flex-start; gap:0.75rem; padding:0.6rem 0; border-bottom:1px solid #f5f5f5; }
    .info-row:last-child { border-bottom:none; }
    .info-row .key { font-size:0.72rem; font-weight:600; color:#adb5bd; text-transform:uppercase; letter-spacing:0.3px; min-width:110px; }
    .info-row .val { font-size:0.85rem; font-weight:600; }

    .status-badge { display:inline-flex; align-items:center; gap:0.35rem; font-size:0.75rem; font-weight:700; padding:0.35rem 0.85rem; border-radius:20px; }
    .status-badge.pending   { background:#fff8e6; color:#ff8800; }
    .status-badge.active    { background:#e6faf8; color:#0073ff; }
    .status-badge.completed { background:#f0fdf4; color:#00ff5e; }
    .status-dot { width:7px; height:7px; border-radius:50%; display:inline-block; }
    .status-dot.pending   { background:#ff8800; }
    .status-dot.active    { background:#0073ff; animation:pulse 1.5s infinite; }
    .status-dot.completed { background:#00ff5e; }
    @keyframes pulse { 0%,100%{opacity:1} 50%{opacity:0.4} }

    .spec-badge { display:inline-block; background:#e6faf8; color:#0d9488; font-size:0.7rem; font-weight:600; padding:0.2rem 0.6rem; border-radius:20px; margin:0.1rem; }
    .svc-item { display:flex; align-items:center; justify-content:space-between; padding:0.6rem 0; border-bottom:1px solid #f5f5f5; font-size:0.85rem; }
    .svc-item:last-child { border-bottom:none; }

    /* ── Chat ── */
    .chat-container { background:#fff; border:1px solid var(--vg-border, #e8edf2); border-radius:16px; overflow:hidden; }
    .chat-header { padding:1rem 1.25rem; border-bottom:1px solid #f0f0f0; display:flex; align-items:center; justify-content:space-between; }
    .chat-messages { padding:1.25rem; min-height:300px; max-height:440px; overflow-y:auto; display:flex; flex-direction:column; gap:0.85rem; background:#f8f9fa; }
    .chat-input-area { padding:1rem 1.25rem; border-top:1px solid #f0f0f0; background:#fff; }

    .msg-bubble { max-width:75%; }
    .msg-bubble.mine { align-self:flex-end; }
    .msg-bubble.theirs { align-self:flex-start; }

    .bubble {
        padding:0.7rem 1rem; border-radius:14px; font-size:0.85rem; line-height:1.5;
        word-break:break-word;
    }
    .msg-bubble.mine   .bubble { background:#0d6efd; color:#fff; border-bottom-right-radius:4px; }
    .msg-bubble.theirs .bubble { background:#fff; border:1px solid #e9ecef; color:#1a2332; border-bottom-left-radius:4px; box-shadow:0 1px 4px rgba(0,0,0,0.06); }

    .msg-meta { font-size:0.68rem; color:#adb5bd; margin-top:0.3rem; display:flex; align-items:center; gap:0.4rem; }
    .msg-bubble.mine   .msg-meta { justify-content:flex-end; }
    .msg-bubble.theirs .msg-meta { justify-content:flex-start; }

    .msg-avatar { width:28px; height:28px; border-radius:50%; font-size:0.65rem; font-weight:700; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
    .msg-bubble.mine   .msg-avatar { background:#0d6efd; color:#fff; }
    .msg-bubble.theirs .msg-avatar { background:linear-gradient(135deg,#0d9488,#0a6ebd); color:#fff; }

    .chat-input { border-radius:12px; border:1.5px solid #e9ecef; font-size:0.88rem; padding:0.6rem 0.9rem; resize:none; transition:all 0.15s; }
    .chat-input:focus { border-color:#0d6efd; box-shadow:0 0 0 3px rgba(13,110,253,0.1); outline:none; }
    .send-btn { border-radius:12px; padding:0.6rem 1.25rem; font-weight:600; font-size:0.85rem; }

    .chat-disabled { text-align:center; padding:1.5rem; color:#adb5bd; font-size:0.85rem; }

    /* Status action */
    .status-action { display:flex; gap:0.5rem; flex-wrap:wrap; }
    .status-btn { padding:0.45rem 1rem; border-radius:10px; font-size:0.82rem; font-weight:600; border:1.5px solid transparent; cursor:pointer; transition:all 0.15s; }
</style>
@endpush

@section('content')

{{-- Header --}}
@if($isAdminDoc)
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h3 class="mb-0 fw-bold">Detail Booking #{{ $transaction->id }}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('transactions.index') }}">Transaksi</a></li>
                    <li class="breadcrumb-item active">#{{ $transaction->id }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="app-content"><div class="container-fluid">
@else
<div class="mb-3">
    <a href="{{ route('transactions.index') }}"
       style="color:var(--vg-muted);font-size:0.82rem;text-decoration:none;display:inline-flex;align-items:center;gap:0.3rem;">
        <i class="bi bi-arrow-left"></i> Riwayat Konsultasi
    </a>
</div>
@endif

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3 mb-3">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-3">
        <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row g-3">

    {{-- LEFT: Info + Services --}}
    <div class="col-lg-5">

        {{-- Status + Action --}}
        <div class="info-card">
            <div class="ic-header">
                <div class="ic-icon" style="background:#e8f4fd;color:#0d6efd;"><i class="bi bi-receipt"></i></div>
                <div class="flex-1">
                    <div class="ic-title">Booking #{{ $transaction->id }}</div>
                </div>
                <span class="status-badge {{ $transaction->status }}">
                    <span class="status-dot {{ $transaction->status }}"></span>
                    {{ ucfirst($transaction->status) }}
                </span>
            </div>
            <div class="ic-body">
                <div class="info-row">
                    <div class="key">Pasien</div>
                    <div class="val">{{ $transaction->user->name ?? '-' }}</div>
                </div>
                <div class="info-row">
                    <div class="key">Jadwal</div>
                    <div class="val">{{ \Carbon\Carbon::parse($transaction->scheduled_at)->format('d F Y, H:i') }}</div>
                </div>
                <div class="info-row">
                    <div class="key">Total</div>
                    <div class="val" style="color:#0d9488;">Rp{{ number_format($transaction->total, 0, ',', '.') }}</div>
                </div>
                <div class="info-row">
                    <div class="key">Dibuat</div>
                    <div class="val" style="font-weight:400;font-size:0.82rem;">{{ $transaction->created_at->format('d M Y, H:i') }}</div>
                </div>

                {{-- Status update (admin & doctor only) --}}
                @if($isAdminDoc && $transaction->status !== 'completed')
                    <div class="mt-3 pt-3 border-top">
                        <div style="font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;color:#adb5bd;margin-bottom:0.6rem;">
                            Ubah Status
                        </div>
                        <div class="status-action">
                            @if($transaction->status === 'pending')
                                <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="active">
                                    <button type="submit" class="status-btn" style="background:#e6faf8;color:#0d9488;border-color:#a7f3d0;">
                                        <i class="bi bi-play-circle me-1"></i>Mulai Konsultasi
                                    </button>
                                </form>
                            @endif
                            @if($transaction->status === 'active')
                                <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="completed">
                                    <button type="submit" class="status-btn" style="background:#f0fdf4;color:#16a34a;border-color:#bbf7d0;"
                                            onclick="return confirm('Tutup konsultasi ini?')">
                                        <i class="bi bi-check-circle me-1"></i>Selesaikan
                                    </button>
                                </form>
                            @endif
                            @if(auth()->user()->isAdmin() && $transaction->status === 'pending')
                                <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="status-btn" style="background:#ffeaea;color:#dc3545;border-color:#fca5a5;"
                                            onclick="return confirm('Hapus transaksi ini?')">
                                        <i class="bi bi-trash3 me-1"></i>Hapus
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- Dokter --}}
        <div class="info-card">
            <div class="ic-header">
                <div class="ic-icon" style="background:#e6faf8;color:#0d9488;"><i class="bi bi-person-badge-fill"></i></div>
                <div class="ic-title">Dokter</div>
            </div>
            <div class="ic-body">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div style="width:48px;height:48px;border-radius:14px;background:linear-gradient(135deg,#0d9488,#0a6ebd);color:#fff;font-size:1rem;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        {{ strtoupper(substr($transaction->doctor->name ?? 'D', 0, 2)) }}
                    </div>
                    <div>
                        <div style="font-weight:800;font-size:0.95rem;">{{ $transaction->doctor->name ?? '-' }}</div>
                        <div style="font-size:0.75rem;color:#6c757d;">{{ $transaction->doctor->email ?? '' }}</div>
                    </div>
                </div>
                @if($transaction->doctor->specializations->isNotEmpty())
                    <div>
                        @foreach($transaction->doctor->specializations as $spec)
                            <span class="spec-badge">{{ $spec->name }}</span>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        {{-- Layanan --}}
        <div class="info-card">
            <div class="ic-header">
                <div class="ic-icon" style="background:#fef9e7;color:#d97706;"><i class="bi bi-heart-pulse-fill"></i></div>
                <div class="ic-title">Layanan Dipilih</div>
            </div>
            <div class="ic-body">
                @foreach($transaction->services as $svc)
                    <div class="svc-item">
                        <div>
                            <div style="font-weight:600;font-size:0.85rem;">{{ $svc->service_name }}</div>
                            <div style="font-size:0.72rem;color:#6c757d;">{{ $svc->category->category_name ?? '' }}</div>
                        </div>
                        <div style="font-weight:700;color:#0d9488;font-size:0.85rem;">
                            Rp{{ number_format($svc->price, 0, ',', '.') }}
                        </div>
                    </div>
                @endforeach
                <div class="svc-item" style="font-weight:800;border-top:2px solid #e9ecef;margin-top:0.25rem;">
                    <span>Total</span>
                    <span style="color:#0d9488;">Rp{{ number_format($transaction->total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

    </div>

    {{-- RIGHT: Chat --}}
    <div class="col-lg-7">
        <div class="chat-container">
            <div class="chat-header">
                <div class="d-flex align-items-center gap-2">
                    <div style="width:36px;height:36px;border-radius:10px;background:#e8f4fd;color:#0d6efd;display:flex;align-items:center;justify-content:center;">
                        <i class="bi bi-chat-dots-fill"></i>
                    </div>
                    <div>
                        <div style="font-weight:700;font-size:0.9rem;">Konsultasi Online</div>
                        <div style="font-size:0.72rem;color:#adb5bd;">
                            {{ $transaction->messages->count() }} pesan
                        </div>
                    </div>
                </div>
                <span class="status-badge {{ $transaction->status }}">
                    <span class="status-dot {{ $transaction->status }}"></span>
                    {{ ucfirst($transaction->status) }}
                </span>
            </div>

            <div class="chat-messages" id="chatMessages">
                @forelse($transaction->messages as $msg)
                    @php $isMine = $msg->sender_id === auth()->id(); @endphp
                    <div class="msg-bubble {{ $isMine ? 'mine' : 'theirs' }}">
                        <div class="d-flex align-items-end gap-2 {{ $isMine ? 'flex-row-reverse' : '' }}">
                            <div class="msg-avatar">
                                {{ strtoupper(substr($msg->sender->name ?? 'U', 0, 2)) }}
                            </div>
                            <div>
                                <div class="bubble">{{ $msg->message }}</div>
                                <div class="msg-meta">
                                    @if(!$isMine)
                                        <span style="font-weight:600;">{{ $msg->sender->name }}</span> ·
                                    @endif
                                    {{ $msg->created_at->format('H:i') }} ·
                                    {{ $msg->created_at->format('d M') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5" style="color:#adb5bd;">
                        <i class="bi bi-chat-square d-block" style="font-size:2.5rem;margin-bottom:0.75rem;"></i>
                        <div style="font-weight:600;margin-bottom:0.25rem;">Belum ada pesan</div>
                        <div style="font-size:0.8rem;">
                            @if($transaction->status === 'active')
                                Mulai kirim pesan untuk berkonsultasi.
                            @elseif($transaction->status === 'pending')
                                Konsultasi belum dimulai. Menunggu konfirmasi dokter.
                            @else
                                Konsultasi telah selesai.
                            @endif
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Input Chat --}}
            <div class="chat-input-area">
                @if($transaction->status === 'active')
                    <form action="{{ route('transactions.messages.store', $transaction->id) }}"
                          method="POST" id="chatForm">
                        @csrf
                        <div class="d-flex gap-2 align-items-end">
                            <textarea name="message" class="form-control chat-input"
                                      rows="2" placeholder="Ketik pesan konsultasi..."
                                      id="messageInput" required
                                      maxlength="1000"></textarea>
                            <button type="submit" class="btn btn-primary send-btn" style="border-radius:12px;">
                                <i class="bi bi-send-fill"></i>
                            </button>
                        </div>
                        <div style="font-size:0.7rem;color:#adb5bd;margin-top:0.35rem;text-align:right;">
                            <span id="msgCharCount">0</span>/1000
                        </div>
                    </form>
                @elseif($transaction->status === 'pending')
                    <div class="chat-disabled">
                        <i class="bi bi-hourglass-split d-block mb-2" style="font-size:1.5rem;color:#d97706;"></i>
                        Menunggu dokter memulai konsultasi.
                    </div>
                @else
                    <div class="chat-disabled">
                        <i class="bi bi-check-circle-fill d-block mb-2" style="font-size:1.5rem;color:#16a34a;"></i>
                        Konsultasi telah selesai.
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>

@if($isAdminDoc)
</div></div>
@endif

@endsection

@push('script')
<script>
    // Scroll to bottom chat
    const chatEl = document.getElementById('chatMessages');
    if (chatEl) chatEl.scrollTop = chatEl.scrollHeight;

    // Char counter
    const msgInput = document.getElementById('messageInput');
    if (msgInput) {
        msgInput.addEventListener('input', () => {
            document.getElementById('msgCharCount').textContent = msgInput.value.length;
        });

        // Ctrl+Enter to send
        msgInput.addEventListener('keydown', e => {
            if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
                document.getElementById('chatForm').submit();
            }
        });
    }
</script>
@endpush