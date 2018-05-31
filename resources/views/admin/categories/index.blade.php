@extends('layouts.admin')

@section('content')


@if (session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
@endif


<a class="btn btn-primary" href="{{ route('categories.create') }}" role="button">Create category</a>
<br/><br/>
<table class="table">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Title</th>
        <th scope="col">Description</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
  <tbody>
@foreach ($data as $item)
<tr>
    <th scope="row">{{ $item->id }}</th>
    <td>{{ $item->title }}</td>
    <td>{{ $item->description }}</td>
    <td><a href="{{ route('categories.delete', ['id' => $item->id]) }}">delete</a> || <a href="{{ route('categories.edit', ['id' => $item->id]) }}">edit</a></td>
  </tr>
    
@endforeach
    </tbody>
  </table>
{{ $data->render() }}

@endsection
