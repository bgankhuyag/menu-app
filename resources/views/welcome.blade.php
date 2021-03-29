@extends('layouts.index')

@section('content')
<div class="container" style="text-align: center;">
  <h3 style="color: white; font-size: 5em">Welcome to a<br>restaurant near You</h3>
    @guest
      <div style="margin: auto; height: 100px; width: 320px">
        @if (Route::has('login'))
          <a class="main_bt_border" href="{{ route('login') }}" style="margin-right: 20px;">Login</a>

        @endif

        @if (Route::has('register'))
          <a class="main_bt_border" href="{{ route('register') }}">Register</a>

        @endif
      </div>
    @else
      <div style="margin: auto; height: 100px; width: 150px">
        <a class="main_bt_border" href="{{ route('home') }}">View Orders</a>
      </div>
    @endguest
</div>
@endsection
