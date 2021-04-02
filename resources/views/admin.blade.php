@extends('layouts.app')

@section('style')
  <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="container">
    <h3 class="admin-title">Bases</h3>
    <a href="{{route('editBasesPage')}}" class="button">Edit Bases</a>
    <div class="bases parts">
      @foreach($bases as $base)
      <div class="base-item">
        <img src="{{asset('/storage/images/' . $base->images->name)}}" class="base-image" alt="{{$base->images->description}}" title="{{$base->images->description}}" width="200" />
        <div class="base-title">{{$base->base}}</div>
        <div class="base-title">₮{{$base->price}}</div>
      </div>
      @endforeach
    </div>
    <h3 class="admin-title">Condiments</h3>
    <a href="{{route('editCondimentsPage')}}" class="button">Edit Condiments</a>
    <ul class="condiments parts">
      @foreach ($condiments as $condiment)
      <li class="condiment-item">
        <div class="condiment-title">{{$condiment->condiment}}</div>
      </li>
      @endforeach
    </ul>
    <h3 class="admin-title">Toppings</h3>
    <a href="{{route('editToppingsPage')}}" class="button">Edit Toppings</a>
    <ul class="toppings parts">
      @foreach ($toppings as $topping)
      <li class="topping-item">
        <div class="topping-title">{{$topping->topping}}</div>
      </li>
      @endforeach
    </ul>
  </div>
@endsection
