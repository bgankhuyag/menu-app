@extends('layouts.app')

@section('style')
  <link href="{{ asset('css/new.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="container">
    <form action="{{route('addNewOrder')}}" method="post">
      @csrf
      @if($errors->any())
        <div>
          <h4 class="error">{{$errors->first()}}</h4>
        </div>
      @endif
      <h5>Base</h5>
      <div class="base-grid">
        @foreach ($bases as $base)
        <div class="base-item">
          <input type="radio" class="input radio" name="base" value="{{$base->base}}" id="{{$base->base}}" onClick="clicked(this.id)">
          <label for="{{$base->base}}" class="input-label {{$base->base}} radio-label" >
          <div class="image-container" for="{{$base->base}}"><img src="{{asset('/storage/images/' . $base->images->getRawOriginal('name'))}}" alt="{{$base->images->description}}" title="{{$base->images->description}}" width="200" /></div>
        </label>
        <div class="name">{{$base->base}}</div>
        <div class="name">₮{{$base->price}}</div>
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
          document.getElementsByClassName(item[i].id)[0].style.border = "4px solid #e3d105";
        } else {
          document.getElementsByClassName(item[i].id)[0].style.border = "4px solid #212020";
        }
      }
      console.log(item);
      console.log(base);
    }
  </script>
@endsection
