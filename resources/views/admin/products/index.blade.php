@extends('layouts.admin')

@section('content')


@if (session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
@endif


<a class="btn btn-primary" href="{{ route('products.create') }}" role="button">Create product</a>
<br/><br/>
<table class="table">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Title</th>
        <th scope="col">Description</th>
        <th scope="col">Price</th>
        <th scope="col">Category</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
  <tbody>
@foreach ($data as $item)
<tr>
    <th scope="row">{{ $item->id }}</th>
    <td>{{ $item->title }}</td>
    <td>{{ $item->description }}</td>
    <td>{{ $item->price }}</td>
    <td>{{ $item->category->title }}</td>
    <td><a href="{{ route('products.delete', ['id' => $item->id]) }}">delete</a> || <a href="{{ route('products.edit', ['id' => $item->id]) }}">edit</a></td>
  </tr>
    
@endforeach
    </tbody>
  </table>
{{ $data->render() }}

@endsection
