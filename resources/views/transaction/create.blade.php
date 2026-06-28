@extends('layouts.member')
@section('title', 'Booking Konsultasi')

@push('styles')
<style>
    .form-card { background:#fff; border:1px solid var(--vg-border); border-radius:20px; overflow:hidden; margin-bottom:1.5rem; }
    .form-card .fc-header { padding:1.25rem 1.5rem; border-bottom:1px solid var(--vg-border); display:flex; align-items:center; gap:0.75rem; }
    .fc-icon { width:40px; height:40px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.1rem; }
    .fc-title { font-weight:700; font-size:0.95rem; }
    .fc-body { padding:1.5rem; }

    .form-label { font-size:0.75rem; font-weight:700; color:#495057; text-transform:uppercase; letter-spacing:0.4px; margin-bottom:0.5rem; }
    .form-control, .form-select { border-radius:10px; border:1.5px solid #e9ecef; font-size:0.88rem; padding:0.65rem 0.9rem; transition:all 0.15s; }
    .form-control:focus, .form-select:focus { border-color:var(--vg-primary); box-shadow:0 0 0 3px rgba(10,110,189,0.1); }
    .form-control.is-invalid, .form-select.is-invalid { border-color:#dc3545; }
    .invalid-feedback { font-size:0.75rem; }

    /* Doctor card select */
    .doctor-options { display:grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap:0.75rem; }
    .doctor-option input[type=radio] { display:none; }
    .doctor-option label {
        display:flex; align-items:center; gap:0.75rem;
        padding:0.85rem 1rem; border:1.5px solid #e9ecef; border-radius:12px;
        cursor:pointer; transition:all 0.15s; background:#fff;
    }
    .doctor-option label:hover { border-color:var(--vg-primary); background:var(--vg-primary-light); }
    .doctor-option input:checked + label { border-color:var(--vg-primary); background:var(--vg-primary-light); }
    .doctor-option input:checked + label .d-check { display:flex !important; }
    .d-avatar { width:40px; height:40px; border-radius:50%; background:linear-gradient(135deg,var(--vg-primary),var(--vg-teal)); color:#fff; font-size:0.78rem; font-weight:700; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
    .d-name  { font-weight:700; font-size:0.85rem; }
    .d-spec  { font-size:0.72rem; color:var(--vg-muted); }
    .d-check { width:20px; height:20px; border-radius:50%; background:var(--vg-primary); color:#fff; display:none; align-items:center; justify-content:center; font-size:0.65rem; margin-left:auto; flex-shrink:0; }

    /* Service checkboxes */
    .service-group-title { font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:0.8px; color:var(--vg-muted); margin:1rem 0 0.5rem; padding-bottom:0.35rem; border-bottom:1px solid var(--vg-border); }
    .service-options { display:grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap:0.5rem; }
    .service-option input[type=checkbox] { display:none; }
    .service-option label {
        display:flex; align-items:flex-start; gap:0.65rem;
        padding:0.75rem 0.9rem; border:1.5px solid #e9ecef; border-radius:10px;
        cursor:pointer; transition:all 0.15s; background:#fff; height:100%;
    }
    .service-option label:hover { border-color:var(--vg-teal); background:var(--vg-teal-light); }
    .service-option input:checked + label { border-color:var(--vg-teal); background:var(--vg-teal-light); }
    .svc-check { width:18px; height:18px; border-radius:5px; border:1.5px solid #ced4da; display:flex; align-items:center; justify-content:center; flex-shrink:0; margin-top:1px; transition:all 0.15s; }
    .service-option input:checked + label .svc-check { background:var(--vg-teal); border-color:var(--vg-teal); color:#fff; }
    .svc-name  { font-size:0.82rem; font-weight:600; line-height:1.3; }
    .svc-price { font-size:0.72rem; color:var(--vg-teal); font-weight:700; margin-top:0.1rem; }

    /* Summary card */
    .summary-card { background:linear-gradient(135deg,var(--vg-primary),var(--vg-teal)); border-radius:16px; padding:1.5rem; color:#fff; position:sticky; top:88px; }
    .summary-card h6 { font-weight:700; margin-bottom:1rem; opacity:.85; font-size:0.8rem; text-transform:uppercase; letter-spacing:0.5px; }
    .summary-row { display:flex; justify-content:space-between; font-size:0.82rem; margin-bottom:0.5rem; }
    .summary-row.total { font-weight:800; font-size:1rem; border-top:1px solid rgba(255,255,255,0.2); padding-top:0.75rem; margin-top:0.5rem; }
    .summary-empty { text-align:center; opacity:.6; font-size:0.82rem; padding:1rem 0; }
</style>
@endpush

@section('content')

    <div class="d-flex align-items-center gap-2 mb-3">
        <a href="{{ route('transactions.index') }}"
           style="color:var(--vg-muted);font-size:0.82rem;text-decoration:none;display:flex;align-items:center;gap:0.3rem;">
            <i class="bi bi-arrow-left"></i> Riwayat
        </a>
        <span style="color:var(--vg-border);">/</span>
        <span style="font-size:0.82rem;font-weight:600;">Booking Baru</span>
    </div>

    <form action="{{ route('transactions.store') }}" method="POST" id="bookingForm">
        @csrf
        <div class="row g-3">

            {{-- Left: Form --}}
            <div class="col-lg-8">

                {{-- Step 1: Pilih Dokter --}}
                <div class="form-card">
                    <div class="fc-header">
                        <div class="fc-icon" style="background:var(--vg-primary-light);color:var(--vg-primary);">
                            <i class="bi bi-person-badge-fill"></i>
                        </div>
                        <div>
                            <div class="fc-title">Pilih Dokter</div>
                            <div style="font-size:0.75rem;color:var(--vg-muted);">Pilih dokter yang akan menangani konsultasi</div>
                        </div>
                    </div>
                    <div class="fc-body">
                        @error('doctor_id')
                            <div class="alert alert-danger py-2 px-3 mb-3 rounded-3" style="font-size:0.82rem;">{{ $message }}</div>
                        @enderror
                        <div class="doctor-options">
                            @foreach($doctors as $doctor)
                                <div class="doctor-option">
                                    <input type="radio" name="doctor_id"
                                           id="doctor_{{ $doctor->id }}"
                                           value="{{ $doctor->id }}"
                                           {{ old('doctor_id') == $doctor->id ? 'checked' : '' }}>
                                    <label for="doctor_{{ $doctor->id }}">
                                        <div class="d-avatar">
                                            {{ strtoupper(substr($doctor->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <div class="d-name">{{ $doctor->name }}</div>
                                            <div class="d-spec">
                                                {{ $doctor->specializations->pluck('name')->join(', ') ?: 'Umum' }}
                                            </div>
                                        </div>
                                        <div class="d-check"><i class="bi bi-check"></i></div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Step 2: Pilih Layanan --}}
                <div class="form-card">
                    <div class="fc-header">
                        <div class="fc-icon" style="background:var(--vg-teal-light);color:var(--vg-teal);">
                            <i class="bi bi-heart-pulse-fill"></i>
                        </div>
                        <div>
                            <div class="fc-title">Pilih Layanan</div>
                            <div style="font-size:0.75rem;color:var(--vg-muted);">Bisa memilih lebih dari satu layanan</div>
                        </div>
                    </div>
                    <div class="fc-body">
                        @error('services')
                            <div class="alert alert-danger py-2 px-3 mb-3 rounded-3" style="font-size:0.82rem;">{{ $message }}</div>
                        @enderror
                        @php $currentCat = null; @endphp
                        @foreach($services as $svc)
                            @if($currentCat !== $svc->category->category_name)
                                @if($currentCat !== null)</div>@endif
                                @php $currentCat = $svc->category->category_name; @endphp
                                <div class="service-group-title">{{ $currentCat }}</div>
                                <div class="service-options">
                            @endif
                            <div class="service-option">
                                <input type="checkbox" name="services[]"
                                       id="svc_{{ $svc->id }}"
                                       value="{{ $svc->id }}"
                                       data-price="{{ $svc->price }}"
                                       data-name="{{ $svc->service_name }}"
                                       class="svc-checkbox"
                                       {{ in_array($svc->id, old('services', [])) ? 'checked' : '' }}>
                                <label for="svc_{{ $svc->id }}">
                                    <div class="svc-check"><i class="bi bi-check" style="font-size:0.75rem;"></i></div>
                                    <div>
                                        <div class="svc-name">{{ $svc->service_name }}</div>
                                        <div class="svc-price">Rp{{ number_format($svc->price, 0, ',', '.') }}</div>
                                        <div style="font-size:0.7rem;color:var(--vg-muted);margin-top:0.1rem;">
                                            <i class="bi bi-clock me-1"></i>{{ $svc->availability }}
                                        </div>
                                    </div>
                                </label>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>

                {{-- Step 3: Pilih Jadwal --}}
                <div class="form-card">
                    <div class="fc-header">
                        <div class="fc-icon" style="background:#fef9e7;color:#d97706;">
                            <i class="bi bi-calendar-event-fill"></i>
                        </div>
                        <div>
                            <div class="fc-title">Pilih Jadwal</div>
                            <div style="font-size:0.75rem;color:var(--vg-muted);">Pilih tanggal dan waktu konsultasi</div>
                        </div>
                    </div>
                    <div class="fc-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Tanggal & Waktu Konsultasi</label>
                                <input type="datetime-local" name="scheduled_at"
                                       class="form-control @error('scheduled_at') is-invalid @enderror"
                                       value="{{ old('scheduled_at') }}"
                                       min="{{ now()->addHour()->format('Y-m-d\TH:i') }}"
                                       required>
                                @error('scheduled_at')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div style="font-size:0.72rem;color:var(--vg-muted);margin-top:0.35rem;">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Jadwal minimal 1 jam dari sekarang.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Right: Summary --}}
            <div class="col-lg-4">
                <div class="summary-card">
                    <h6><i class="bi bi-receipt me-2"></i>Ringkasan Booking</h6>

                    <div id="summaryEmpty" class="summary-empty">
                        <i class="bi bi-cart d-block mb-2" style="font-size:1.5rem;"></i>
                        Pilih layanan untuk melihat ringkasan
                    </div>

                    <div id="summaryItems" style="display:none;">
                        <div id="serviceList" style="margin-bottom:0.75rem;"></div>
                        <div class="summary-row total">
                            <span>Total</span>
                            <span id="totalPrice">Rp0</span>
                        </div>
                    </div>

                    <button type="submit" class="btn w-100 mt-3 fw-bold"
                            style="background:rgba(255,255,255,0.2);border:1.5px solid rgba(255,255,255,0.4);color:#fff;border-radius:12px;padding:0.7rem;font-size:0.9rem;transition:all 0.2s;"
                            onmouseover="this.style.background='rgba(255,255,255,0.3)'"
                            onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                        <i class="bi bi-calendar-check me-2"></i>Konfirmasi Booking
                    </button>
                </div>
            </div>

        </div>
    </form>

@endsection

@push('script')
<script>
    const checkboxes   = document.querySelectorAll('.svc-checkbox');
    const summaryEmpty = document.getElementById('summaryEmpty');
    const summaryItems = document.getElementById('summaryItems');
    const serviceList  = document.getElementById('serviceList');
    const totalPrice   = document.getElementById('totalPrice');

    function updateSummary() {
        const selected = [...checkboxes].filter(c => c.checked);
        if (selected.length === 0) {
            summaryEmpty.style.display = 'block';
            summaryItems.style.display = 'none';
            return;
        }

        summaryEmpty.style.display = 'none';
        summaryItems.style.display = 'block';

        let total = 0;
        serviceList.innerHTML = selected.map(c => {
            const price = parseInt(c.dataset.price);
            total += price;
            return `<div class="summary-row">
                <span style="font-size:0.78rem;opacity:.9;max-width:65%;word-break:break-word;">${c.dataset.name}</span>
                <span style="font-size:0.78rem;">Rp${price.toLocaleString('id-ID')}</span>
            </div>`;
        }).join('');

        totalPrice.textContent = 'Rp' + total.toLocaleString('id-ID');
    }

    checkboxes.forEach(c => c.addEventListener('change', updateSummary));
    updateSummary(); // init
</script>
@endpush