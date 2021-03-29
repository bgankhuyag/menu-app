@extends('layouts.app')

@section('style')
  <link href="{{ asset('css/new.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="container">
    <form action="{{route('addNewOrder')}}" method="post">
      @csrf
      @if($errors->any())
        <div class="error">
          <h4>{{$errors->first()}}</h4>
        </div>
      @endif
      <h5>Base</h5>
      <div class="base-grid">
        @foreach ($bases as $base)
        <div class="base-item">
          <input type="radio" id="{{$base->base}}" class="input" name="base" value="{{$base->base}}">
          <label for="{{$base->base}}" class="input-label">{{$base->base}}</label><br>
          <!-- <div class="base-title">{{$base->base}}</div> -->
          <div for="{{$base->base}}"><img src="{{asset('/storage/images/' . $base->images->name)}}" alt="{{$base->images->description}}" title="{{$base->images->description}}" width="200" /></div>
        </div>
        @endforeach
      </div>
      <div class="new-grid">
        <div class="new-grid-item">
          <h5>Condiments</h5>
          @foreach ($condiments as $condiment)
            <input type="checkbox" id="{{$condiment->condiment}}" name="condiments[]" value="{{$condiment->condiment}}">
            <label for="{{$condiment->condiment}}" class="input-label">{{$condiment->condiment}}</label><br>
          @endforeach
        </div>
        <div class="new-grid-item">
          <h5>Toppings</h5>
          @foreach ($toppings as $topping)
            <input type="checkbox" id="{{$topping->topping}}" name="toppings[]" value="{{$topping->topping}}">
            <label for="{{$topping->topping}}" class="input-label">{{$topping->topping}}</label><br>
          @endforeach
        </div>
      </div>
      <button type="submit" class="submit-button">Add Order</button>
    </form>
  </div>
@endsection
