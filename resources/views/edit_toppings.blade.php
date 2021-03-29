@extends('layouts.app')

@section('style')
  <link href="{{ asset('css/editPage.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
  <a href="{{route('adminPage')}}" class="link-back">< Back</a>
  <h3 class="title">Add Toppings</h3>
  <form action="{{route('newTopping')}}" method="post">
    @csrf
    <div class="form-item">
      <label for="topping">Topping Name </label>
      <input type="text" id="topping" name="topping" /><br>
    </div>
    <button type="submit">Add</button>
  </form>
  <h3 class="title">Toppings</h3>
  <div class="topping">
    @foreach ($toppings as $topping)
    <div class="topping-item">
      <div class="topping-title">{{$topping->topping}}</div>
      <div><a href="{{route('removeTopping', ['id' => $topping->id])}}" class="remove">Delete</a></div>
    </div>
    @endforeach
  </div>
</div>
@endsection
