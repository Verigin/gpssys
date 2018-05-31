@extends('layouts.admin') 
@section('content') @if (count($errors) > 0)
<div class="alert alert-danger">
  @foreach ($errors->all() as $error)
  <li>{{ $error }}</li>
  @endforeach
</div>
@endif

<form action="" method="POST" class="form-control">
  @csrf
  <div class="form-group">
    <label>Title</label>
    <input type="text" name="title" value={{ $data->title }} class="form-control">
  </div>
  <div class="form-group">
    <label>Description</label>
    <textarea name="description" class="form-control" id="" cols="30" rows="10">{{ $data->description }}</textarea>
  </div>
  <input type="submit" class="btn btn-primary" value="Edit">
</form>
@endsection