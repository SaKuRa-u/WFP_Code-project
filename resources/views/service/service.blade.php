@extends('layouts.adminlte')

@section('content')
    <h4>Welcome To Data Service Page</h4>
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
                    <td>{{ $service->service_name }}</td>
                    <td>{{ $service->description }}</td>
                    <td>{{ $service->availability }}</td>
                    <td>{{ $service->price }}</td>
                    <td>{{ $service->created_at }}</td>
                    <td>{{ $service->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
