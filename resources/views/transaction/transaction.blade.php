@extends('layouts.adminlte')

@section('content')
    <h4>Welcome To Data Transaction Page</h4>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">user</th>
                <th scope="col">service</th>
                <th scope="col">doctor</th>
                <th scope="col">created_at</th>
                <th scope="col">updated_at</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allTransactionData as $transaction)
                <tr>
                    <th scope="row">{{ $transaction->id }}</th>
                    <td>{{ $transaction->user?->name }}</td>
                    <td>{{ $transaction->service?->service_name }}</td>
                    <td>{{ $transaction->doctor?->name }}</td>
                    <td>{{ $transaction->created_at }}</td>
                    <td>{{ $transaction->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
