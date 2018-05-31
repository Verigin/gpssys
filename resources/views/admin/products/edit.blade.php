@extends('layouts.admin') 
@section('content') @if (count($errors) > 0)
<div class="alert alert-danger">
  @foreach ($errors->all() as $error)
  <li>{{ $error }}</li>
  @endforeach
</div>
@endif

<form action="" method="POST" class="form-control" enctype="multipart/form-data">
  @csrf
  <div class="form-group">
    <label>Title</label>
    <input type="text" name="title" value={{ $data->title }} class="form-control">
  </div>
  <div class="form-group">
    <label>Description</label>
    <textarea name="description" class="form-control" id="" cols="30" rows="10">{{ $data->description }}</textarea>
  </div>
  <div class="form-group">
    <label>Price</label>
    <input type="text" name="price" value={{ $data->price }} class="form-control">
  </div>
  <div class="form-group">
    <label>Category</label>
    <select name="category_id" class="form-control" id="">
        @foreach ($categories as $item)
            <option @if ($data->category_id == $item->id) selected @endif value="{{ $item->id }}">{{ $item->title }}</option>
        @endforeach
      </select>
  </div>

  <div class="form-group">
    <label>Image</label>
    <div class="image-preview-block">
      <div class="image-preview-image">
        <img src="{{ $data->image_small }}" />
      </div>
      <input type="file" name="image" accept="image/*" class="image-preview-input">
    </div>
  </div>

  <input type="submit" class="btn btn-primary" value="Edit">
</form>
@endsection