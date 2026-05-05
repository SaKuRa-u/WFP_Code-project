@extends('layouts.adminlte')

@section('content')
    <h4>Welcome To Data Doctor Page</h4>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">name</th>
                <th scope="col">specialization</th>
                <th scope="col">email</th>
                <th scope="col">phone</th>
                <th scope="col">created_at</th>
                <th scope="col">updated_at</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allDoctorData as $doc)
                <tr>
                    <th scope="row">{{ $doc->id }}</th>
                    <td>{{ $doc->name }}</td>
                    <td>{{ $doc->specialization }}</td>
                    <td>{{ $doc->email }}</td>
                    <td>{{ $doc->phone }}</td>
                    <td>{{ $doc->created_at }}</td>
                    <td>{{ $doc->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
