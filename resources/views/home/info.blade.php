@extends('layouts.home') 
@section('content') @if (count($errors) > 0)
<div class="alert alert-danger">
  @foreach ($errors->all() as $error)
  <li>{{ $error }}</li>
  @endforeach
</div>
@endif @if (session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif @if (session('error'))
<div class="alert alert-danger">
  {{ session('error') }}
</div>
@endif

<form action="{{ route('home.info') }}" method="POST" class="form-control">
  @csrf
  <div class="form-group">
    <label>Name</label>
    <input type="text" name="name" value="{{ $user->name }}" class="form-control">
  </div>
  <div class="form-group">
    <label>E-mail</label>
    <input type="text" name="email" required="required" value="{{ $user->email }}" class="form-control">
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" name="password" value="" class="form-control">
  </div>
  <div class="form-group">
    <label>Confirm Password</label>
    <input type="password" name="password_confirmation" value="" class="form-control">
  </div>
  <input type="submit" class="btn btn-primary" value="Save">
</form>
@endsection