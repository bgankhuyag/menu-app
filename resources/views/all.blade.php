@extends('layouts.app')

@section('style')
  <link href="{{ asset('css/all.css') }}" rel="stylesheet">

@endsection

@section('content')
  <div class="container">
    <h3 class="">All Orders</h3>
    <div class="orders-cards">
      @foreach($orders as $order)
      <div class="order-card">
        <div class="order-image">
          <img class="order-image-item" src="{{asset('/storage/images/' . $order->bases->images->name)}}" alt="{{$order->bases->images->description}}" title="{{$order->bases->images->description}}" width="250" />
        </div>
        <div class="order-card-item">
          <div class="order-card-label">Name:</div>
          <div class="">
            {{$order->users->name}}
          </div>
        </div>
        <div class="order-card-item">
          <div class="order-card-label">Email:</div>
          <div class="">
            {{$order->users->email}}
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
          <div class="order-card-label">Ordered At:</div>
          <div class="">
            {{date('m/d/Y H:i', strtotime($order->created_at))}}
          </div>
        </div>
        <div class="order-button">
          <a class="done-button" href="{{route('orderDone', ['id' => $order->id])}}">Done</a>
        </div>
      </div>
      @endforeach
    </div>
    {{ $orders->links() }}
    <!-- <div class="head">
      <h5>Name</h5>
      <h5>Email</h5>
      <h5>Base</h5>
      <h5>Condiments</h5>
      <h5>Toppings</h5>
      <h5>Ordered At</h5>
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
          {{$order->created_at}}
        </div>
        <div class="order-grid-item">
          <a class="done-button" style="float: right;" href="{{route('orderDone', ['id' => $order->id])}}">Done</a>
        </div>
      @endforeach
    </div> -->
  </div>
@endsection
