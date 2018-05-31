@extends('layouts.home') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    You are logged in! <br/> @endif @if (Auth::user()->isAdmin == 1 )
                    <a href={{ route( 'admin') }}>Admin panel</a> @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection