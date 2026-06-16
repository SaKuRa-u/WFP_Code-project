@extends('layouts.adminlte')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Halaman Daftar Transaksi</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
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
                                    <th scope="col">user</th>
                                    <th scope="col">Detail Transalsi</th>
                                    <th scope="col">Total Transaksi</th>
                                    <th scope="col">created_at</th>
                                    <th scope="col">updated_at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allTransactionData as $transaction)
                                    <tr>
                                        <th scope="row">{{ $transaction->id }}</th>
                                        <td>{{ $transaction->user?->name }}</td>

                                        <td>
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                data-bs-target="#detailModal" onclick="showDetail({{ $transaction->id }})">
                                                Details
                                            </button>
                                        </td>
                                        <td>Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>


                                        <td>{{ $transaction->created_at }}</td>
                                        <td>{{ $transaction->updated_at }}</td>
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
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="detail-title">Detail Transaction id- </h1>
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
        function showDetail(id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('transaction.showDetailTransaction') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'idtrans': id,
                },
                success: function(data) {
                    $('#detail-title').html(data.title);
                    $('#detail-body').html(data.body);
                }
            });
        }
    </script>
@endpush
