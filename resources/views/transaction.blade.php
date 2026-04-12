@extends('layouts.dataTable')

@section('Title', 'Data Transaction')

@section('headerTable')
    <th scope="col">id</th>
    <th scope="col">user</th>
    <th scope="col">service</th>
    <th scope="col">doctor</th>
    <th scope="col">created_at</th>
    <th scope="col">updated_at</th>
@endsection

@section('bodyTable')
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
@endsection