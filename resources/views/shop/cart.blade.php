@extends('layouts.shop') 
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
@endif @if ($count>0)
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>


        <tr v-for="item in items">
            <td>@{{ item.id }}</td>
            <td>@{{ item.name }}</td>
            <!--<td>@{{ item.quantity }}</td>-->
            <td>
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <button v-on:click="updateItem(item.id,-1)" class="btn btn-primary">-</button>
                    </div>
                    <input class="form-control" type="text" :value="item.quantity">
                    <div class="input-group-append">
                        <button v-on:click="updateItem(item.id,1)" class="btn btn-primary">+</button>
                    </div>
                </div>
            </td>
            <td>@{{ item.price }}</td>
            <td>
                <button v-on:click="removeItem(item.id)" class="btn btn-sm btn-danger">remove</button>
            </td>
        </tr>
        {{--
        <div class="col-md-4">
            <div class="card mb-4">

                <a href="{{ route('shop.item', ['id' => $item->id]) }}"><img class="card-img-top" src="/img/nofoto.svg" alt="Card image cap"></a>
                <div class="card-body">
                    <h5 class="card-title">{{ $item->title }}</h5>
                    <p class="card-text">{{ $item->description }}</p>
                    <p class="card-text">Price: {{ $item->price }}</p>
                    <a href="#" v-on:click="addItem({{ $item->id }})" class="btn btn-primary">Add to cart1</a>
                </div>

            </div> --}}


    </tbody>
</table>

<table class="table">
    {{--
    <tr>
        <td>Items on Cart:</td>
        <td>@{{itemCount}}</td>
    </tr> --}}
    <tr>
        <td>Total Qty:</td>
        <td>@{{ details.total_quantity }}</td>
    </tr>
    {{--
    <tr>
        <td>Sub Total:</td>
        <td>@{{ '$' + details.sub_total.toFixed(2) }}</td>
    </tr> --}}
    <tr>
        <td>Total:</td>
        <td>@{{ '$' + details.total.toFixed(2) }}</td>
    </tr>
</table>

<div class="row">
    <div class="col-md-4">
        <form action="{{ route('cart.order') }}" method="GET">
            <div class="form-group">
                <label>E-mail</label>
                <input type="text" name="email" value="@if ($data!=null)  {{ $data->email }} @endif" class="form-control">
            </div>
            <Button class="btn btn-primary">Order</Button>
        </form>
    </div>


</div>
@else
<div class="alert alert-danger">
    Cart is empty
</div>
@endif {{--
<div class="row">
    <div class="col-md-12">
        {{ $data->render() }}
    </div>
</div> --}}
@endsection