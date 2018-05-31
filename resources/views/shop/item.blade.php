@extends('layouts.shop')

@section('content')

<div class="row">
 
    <div class="col-md-8">

            <a href="{{ route('shop.item', ['id' => $item->id]) }}"><img class="card-img-top" src="{{ $item->image_large }}" alt="Card image cap"></a>

       
    </div>

    <div class="col-md-4">
               
                <h5 class="card-title">{{ $item->title }}</h5>
                <p class="card-text">{{ $item->description }}</p>  
                <p class="card-text">Price: {{ $item->price }}</p>  
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <button v-on:click="minus()" class="btn btn-primary">-</button>
                    </div>
                    <input class="form-control" type="text" :value="item.qty">
                    <div class="input-group-append">
                         <button v-on:click="plus()" class="btn btn-primary">+</button>
                    </div>
                </div>
                <a href="#" v-on:click="addItem({{ $item->id }})" class="btn btn-primary">Add to cart</a>          

    </div>
  
</div>     

 
@endsection