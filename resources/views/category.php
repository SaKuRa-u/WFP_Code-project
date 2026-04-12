@extends('layouts.dataTable')

@section('Title', 'Data Category')

@section('headerTable')
    <th scope="col">id</th>
    <th scope="col">name</th>
@endsection

@section('bodyTable')
    @foreach ($allCategoryData as $cat)
        <tr>
            <th scope="row">{{ $cat->id }}</th>
            <td>{{ $cat->category_name }}</td>
        </tr>
    @endforeach
@endsection