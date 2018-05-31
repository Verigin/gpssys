@extends('layouts.admin') 
@section('content')

<table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Title</th>
      <th scope="col">Price</th>
      <th scope="col">Qty</th>
      <th scope="col">Total</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($data as $item)
    <tr>
      <th scope="row">{{ $item->id }}</th>
      <td>{{ $item->title }}</td>
      <td>{{ $item->price }}</td>
      <td>{{ $item->pivot->qty }}</td>
      <td>{{ $item->pivot->total }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
<div class="alert alert-dark" role="alert">
  Email: {{ $email }}
</div>
<div class="alert alert-dark" role="alert">
  Total: {{ $total }}
</div>
@endsection