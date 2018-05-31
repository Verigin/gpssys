@extends('layouts.admin') 
@section('content') @if (session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

<table class="table">
  <thead>
    <th>Id</th>
    <th>User</th>
    <th>Total</th>
    <th>Actions</th>
  </thead>
  <tbody>
    @foreach($data as $item)
    <tr>
      <td>{{ $item->id }}</td>
      <td>
        @if ($item->user) {{ $item->user->name }} @else guest @endif
      </td>
      <td>{{ $item->total }}</td>
      <td><a href="{{ route('orders.delete',['id'=>$item->id]) }}">delete</a> || <a href="{{ route('orders.show',['id'=>$item->id]) }}">view</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection