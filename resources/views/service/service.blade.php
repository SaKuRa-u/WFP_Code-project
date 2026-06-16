@extends('layouts.adminlte')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Halaman Daftar Layanan</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Layanan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            <div class="card">

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#serviceModal">
                    <i class="bi bi-plus-circle"></i> Tambah Servis
                </button>

                <div class="card-body p-0">
                    <div class="table-responsive">

                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Service name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Availability</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">created_at</th>
                                    <th scope="col">updated_at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allServiceData as $service)
                                    <tr>
                                        <th scope="row">{{ $service->id }}</th>
                                        <td>
                                            <a href="{{ route('service.show', $service->id) }}"
                                                class="fw-semibold text-decoration-none">
                                                {{ $service->service_name }}
                                            </a>
                                        </td>
                                        <td>{{ $service->description }}</td>
                                        <td>{{ $service->availability }}</td>
                                        <td>{{ number_format($service->price, 0, ',', '.') }} </td>
                                        <td>{{ $service->created_at }}</td>
                                        <td>{{ $service->updated_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('modals')
    <!-- Modal -->
    <div class="modal fade" id="serviceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <form method="POST" action="{{ route('service.store') }}">
                    @csrf

                    <div class="modal-header">
                        <h4 class="modal-title">
                            <i class="bi bi-plus-circle me-2"></i>Tambah Servis
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">
                                Nama Servis
                            </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}" placeholder="Masukkan nama servis">

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label fw-semibold">
                                Pilih Kategori Servis
                            </label>

                            <select class="form-control @error('SelectedCategory') is-invalid @enderror" id="category"
                                name="SelectedCategory">

                                <option value="">Pilih kategori</option>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('SelectedCategory') == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach

                            </select>

                            @error('SelectedCategory')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">
                                Deskripsi
                            </label>

                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                rows="3" placeholder="Masukkan deskripsi servis">{{ old('description') }}</textarea>

                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label fw-semibold">
                                Harga
                            </label>

                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                                name="price" value="{{ old('price') }}" min="0" placeholder="Masukkan harga">

                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Jam Tersedia
                            </label>

                            <div class="row">
                                <div class="col-md-5">
                                    <input type="time" class="form-control @error('open_hour') is-invalid @enderror"
                                        name="open_hour" value="{{ old('open_hour') }}">

                                    @error('open_hour')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-2 text-center align-self-center">
                                    s/d
                                </div>

                                <div class="col-md-5">
                                    <input type="time" class="form-control @error('close_hour') is-invalid @enderror"
                                        name="close_hour" value="{{ old('close_hour') }}">

                                    @error('close_hour')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i>
                            Simpan
                        </button>

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let modal = new bootstrap.Modal(document.getElementById('serviceModal'));
                modal.show();
            });
        </script>
    @endif


@endpush
