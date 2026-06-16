@extends('layouts.adminlte')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Halaman Daftar Kategori</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kategori</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="app-content">
        <div class="container-fluid">
            @if (@session('sukses'))
                <div class="alert alert-success">
                    {{ session('sukses') }}
                </div>
            @endif
            @if (@session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="card">

                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#btnFormModal">+
                    New Category (With Modals)</button>


                <div class="card-body p-0">
                    <div class="table-responsive">

                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">gambar</th>
                                    <th scope="col">name</th>
                                    <th scope="col" class="text-center">jumlah layanan</th>
                                    <th scope="col" class="text-center">aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allCategoryData as $cat)
                                    <tr>
                                        <th scope="row">{{ $cat->id }}</th>

                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#imageModal-{{ $cat->id }}">
                                                Show
                                            </button>
                                        </td>
                                        @push('modals')
                                            {{-- * ini untuk tampilin gambar kategori --}}
                                            <!-- Modal {{ $cat->id }} -->
                                            <div class="modal fade" id="imageModal-{{ $cat->id }}" tabindex="-1"
                                                aria-labelledby="imageModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="imageModalLabel">Gambar untuk
                                                                Kategori {{ $cat->id }} </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img class="img-responsive" style="max-height:250px;"
                                                                src="{{ asset('storage/categories/img/' . $cat->image) }}"
                                                                alt="{{ $cat->image }}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endpush

                                        <td>{{ $cat->category_name }}</td>
                                        <td class="text-center">
                                            <span
                                                class="badge bg-primary rounded-pill">{{ $cat->services->count() }}</span>
                                        </td>

                                        <td>
                                            <div class="d-flex flex-wrap gap-2 align-items-center">
                                                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                    data-bs-target="#detailModal" onclick="showDetail({{ $cat->id }})">
                                                    Details
                                                </button>

                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#modalEditA" onclick="getEditForm({{ $cat->id }})">
                                                    Edit Type A
                                                </button>

                                                <form method="POST" action="{{ route('category.destroy', $cat->id) }}" class="m-0">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Are you sure to delete {{ $cat->id }} - {{ $cat->category_name }}?');">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>

                                    

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
    {{-- * untuk daftar service berdasarkan kategori --}}
    <!-- Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="detail-title">List of </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="detail-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    {{-- form untuk add category pake modal --}}
    <div class="modal fade" id="btnFormModal" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Category</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('category.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nama Kategori</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}" placeholder="Masukkan nama kategori">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-1"></i>Simpan
                    </button>
                    </form>
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('script')
    <script>
        function showInfo() {
            $.ajax({
                type: 'POST',
                url: '{{ route('category.showinfo') }}',
                data: '_token=<?php echo csrf_token(); ?>',
                success: function(data) {
                    $('#showinfo').html(data.msg);
                }
            });
        }

        function showDetail(id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('category.showListServices') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'idcat': id,
                },
                success: function(data) {
                    $('#detail-title').html(data.title);
                    $('#detail-body').html(data.body);
                }
            });
        }
    </script>
@endpush
