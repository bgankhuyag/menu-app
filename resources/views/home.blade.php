@extends('layouts.app')

@section('style')
  <link href="{{ asset('css/orders.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
  <a href="{{route('new')}}" class="button">+ New Order</a>
  <h3>Done Orders</h3>
  <div class="orders-cards">
    @foreach($orders as $order)
    <div class="order-card">
      <div class="order-image">
        <img class="order-image-item" src="{{asset('/storage/images/' . $order->bases->images->name)}}" alt="{{$order->bases->images->description}}" title="{{$order->bases->images->description}}" width="250" />
      </div>
      <div class="order-card-item">
        <div class="order-card-label">Order ID:</div>
        <div class="">
          {{$order->id}}
        </div>
      </div>
      <div class="order-card-item">
        <div class="order-card-label">Order:</div>
        <div class="">
          {{$order->bases->base}}
        </div>
      </div>
      <div class="order-card-item">
        <div class="order-card-label">Condiments:</div>
        <div class="">
          @foreach($order->condiments as $condiment)
            <div>{{$condiment->condiment}}</div>
            @endforeach
        </div>
      </div>
      <div class="order-card-item">
        <div class="order-card-label">Toppings:</div>
        <div class="">
          @foreach($order->toppings as $topping)
            <div>{{$topping->topping}}</div>
            @endforeach
        </div>
      </div>
      <div class="order-card-item">
        <div class="order-card-label">Done At:</div>
        <div class="">
          {{date('m/d/Y H:i', strtotime($order->updated_at))}}
        </div>
      </div>
      <div class="order-button">
        <a class="done-button" href="{{route('orderDone', ['id' => $order->id])}}">Delete</a>
      </div>
    </div>
    @endforeach
  </div>
  {{ $orders->links() }}
</div>
<div id="example">

</div>
 <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
@endsection
