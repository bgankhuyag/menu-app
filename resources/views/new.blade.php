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
          <input type="radio" class="input radio" name="base" value="{{$base->base}}" id="{{$base->base}}" onClick="clicked(this.id)">
          <label for="{{$base->base}}" class="input-label {{$base->base}} radio-label" >
          <div for="{{$base->base}}"><img src="{{asset('/storage/images/' . $base->images->name)}}" alt="{{$base->images->description}}" title="{{$base->images->description}}" width="200" /></div>
          <div style="text-align: center;">{{$base->base}}</div>
        </label>
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

  <script>
    function clicked(base) {
      var item = document.getElementsByClassName('radio');
      for (var i = 0; i < item.length; i++) {
        if (item[i].checked) {
          console.log(item[i].id);
          document.getElementsByClassName(item[i].id)[0].style.border = "2px solid red";
        } else {
          document.getElementsByClassName(item[i].id)[0].style.border = "none";
        }
      }
      console.log(item);
      console.log(base);
    }
  </script>
@endsection
