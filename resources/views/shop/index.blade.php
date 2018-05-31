@extends('layouts.shop')

@section('content')

<div class="row">
        @foreach ($data as $item)
        <div class="col-md-4">
        <div class="card mb-4">
            {{-- src="/img/nofoto.svg" --}}
            <a href="{{ route('shop.item', ['id' => $item->id]) }}">
                {{-- @if (str_contains($item->image,'lorempixel.com'))
                <img class="card-img-top" src="{{ $item->image }}" alt="Card image cap">
                    <!--<img class="card-img-top" src="/img/nofoto.svg" alt="Card image cap">-->
                @else
                    <img class="card-img-top" src="{{ $path }}{{ $item->image }}" alt="Card image cap">
                @endif --}}
                <img class="card-img-top" src="{{ $item->image_small }}" alt="Card image cap">
            </a>
            <div class="card-body">
                <h5 class="card-title">{{ $item->title }}</h5>
                <p class="card-text">{{ $item->description }}</p>  
                <p class="card-text">Price: {{ $item->price }}</p>  
                <a href="#" v-on:click="addItem({{ $item->id }})"  class="btn btn-primary">Add to cart</a>          
            </div>
       
        </div>
      </div>
        @endforeach
     

    </div>     

    <div class="row">
        <div class="col-md-12">
        {{ $data->render() }}
        </div>
    </div>
@endsection

