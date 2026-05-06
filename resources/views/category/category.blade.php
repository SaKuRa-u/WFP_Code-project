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
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">

                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">gambar</th>
                                    <th scope="col">name</th>
                                    <th scope="col">jumlah layanan</th>
                                    <th scope="col">daftar layanan</th>
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
                                        @push('modals') {{--* ini untuk tampilin gambar kategori --}}
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
                                                                src="{{ asset('storage/categories/img/' . $cat->image) }}" alt="{{ $cat->image }}">
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
                                            <span class="badge bg-primary rounded-pill">{{ $cat->services->count() }}</span>
                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                data-bs-target="#detailModal" onclick="showDetail({{ $cat->id }})">
                                                Details
                                            </button>
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

@push('modals') {{--* untuk daftar service berdasarkan kategori --}}
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
@endpush

@push('script')
    <script>
        function showInfo() {
            $.ajax({
                type: 'POST',
                url: '{{ route('category.showinfo') }}',
                data: '_token=<?php echo csrf_token(); ?>',
                success: function (data) {
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
                success: function (data) {
                    $('#detail-title').html(data.title);
                    $('#detail-body').html(data.body);
                }
            });
        }
    </script>
@endpush