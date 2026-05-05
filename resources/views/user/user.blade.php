@extends('layouts.adminlte')

@section('content')
    <h4>Welcome To Data User Page</h4>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">name</th>
                <th scope="col">email</th>
                <th scope="col">password</th>
                <th scope="col">created_at</th>
                <th scope="col">updated_at</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allUserData as $usr)
                <tr>
                    <th scope="row">{{ $usr->id }}</th>
                    <td>{{ $usr->name }}</td>
                    <td>{{ $usr->email }}</td>
                    <td>{{ $usr->password }}</td>
                    <td>{{ $usr->created_at }}</td>
                    <td>{{ $usr->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
