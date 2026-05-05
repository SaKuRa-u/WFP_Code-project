@extends('layouts.adminlte')

@section('content')
    <h4>Welcome To Data Category Page</h4>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allCategoryData as $cat)
                <tr>
                    <th scope="row">{{ $cat->id }}</th>
                    <td>{{ $cat->category_name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
