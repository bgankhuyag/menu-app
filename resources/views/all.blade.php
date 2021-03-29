@extends('layouts.app')

@section('style')
  <link href="{{ asset('css/all.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="container">
    <h3>All Orders</h3>
    <div class="head">
      <h5>Name</h5>
      <h5>Email</h5>
      <h5>Base</h5>
      <h5>Condiments</h5>
      <h5>Toppings</h5>
      <h5></h5>
    </div>
    <div class="order-grid">
      @foreach($orders as $order)
        <div class="order-grid-item">
          {{$order->users->name}}
        </div>
        <div class="order-grid-item">
          {{$order->users->email}}
        </div>
        <div class="order-grid-item">
          {{$order->order}}
        </div>
        <div class="order-grid-item">
          @foreach($order->condiments as $condiment)
            <div>{{$condiment->condiment}}</div>
          @endforeach
        </div>
        <div class="order-grid-item">
          @foreach($order->toppings as $topping)
            <div>{{$topping->topping}}</div>
          @endforeach
        </div>
        <div class="order-grid-item">
          <a class="done-button" href="{{route('orderDone', ['id' => $order->id])}}">Done</a>
        </div>
      @endforeach
    </div>
  </div>
@endsection
