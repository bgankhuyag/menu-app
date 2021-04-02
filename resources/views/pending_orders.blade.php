@extends('layouts.app')

@section('style')
  <link href="{{ asset('css/orders.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
  <a href="{{route('new')}}" class="button">+ New Order</a>
  <h3>Pending Orders</h3>
  <div class="orders-cards">
    @foreach($orders as $order)
    <div class="order-card">
      <div class="order-image">
        <img src="{{asset('/storage/images/' . $order->bases->images->name)}}" alt="{{$order->bases->images->description}}" title="{{$order->bases->images->description}}" width="250" />
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
        <div class="order-card-label">Ordered At:</div>
        <div class="">
          {{date('m/d/Y H:i', strtotime($order->created_at))}}
        </div>
      </div>
      <!-- <div class="order-button">
        <a class="done-button" href="{{route('orderDone', ['id' => $order->id])}}">Delete</a>
      </div> -->
    </div>
    @endforeach
  </div>
  {{ $orders->links() }}
  <!-- <div class="head">
    <h5>Order ID</h5>
    <h5>Base</h5>
    <h5>Condiments</h5>
    <h5>Toppings</h5>
    <h5>Ordered At</h5>
    <h5></h5>
  </div>
  <div class="orders">
    @foreach ($orders as $order)
      <div class="order-grid">
        <div class="order-grid-item">
          {{$order->id}}
        </div>
        <div class="order-grid-item">
          {{$order->order}}
        </div>
        <div class="order-grid-item">
          @foreach ($order->condiments as $condiment)
            <div>{{$condiment->condiment}}</div>
          @endforeach
        </div>
        <div class="order-grid-item">
          @foreach ($order->toppings as $topping)
            <div>{{$topping->topping}}</div>
          @endforeach
        </div>
        <div class="order-grid-item">
          <div>{{$order->created_at}}</div>
        </div>
        <div class="order-grid-item">
          <a href="{{route('remove', ['id' => $order->id])}}" class="delete" style="text-decoration: none">Delete</a>
        </div>

      </div>
    @endforeach
  </div> -->
  <div>
      <!-- <div class="col-md-8">
          <div class="card">
              <div class="card-header">{{ __('Dashboard') }}</div>

              <div class="card-body">
                  @if (session('status'))
                      <div class="alert alert-success" role="alert">
                          {{ session('status') }}
                      </div>
                  @endif

                  {{ __('You are logged in!') }}
              </div>
          </div>
      </div> -->
  </div>
</div>
@endsection
