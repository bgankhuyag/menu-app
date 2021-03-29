@extends('layouts.app')

@section('style')
  <link href="{{ asset('css/orders.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
  <a href="{{route('new')}}" class="button">+ New Order</a>
  <h3>Pending Orders</h3>
  <div class="head">
    <h5>Order ID</h5>
    <h5>Base</h5>
    <h5>Condiments</h5>
    <h5>Toppings</h5>
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
          <a href="{{route('remove', ['id' => $order->id])}}" class="delete" style="text-decoration: none">Delete</a>
        </div>

      </div>
    @endforeach
  </div>
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
