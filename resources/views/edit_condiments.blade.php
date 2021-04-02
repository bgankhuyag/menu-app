@extends('layouts.app')

@section('style')
  <link href="{{ asset('css/editPage.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
  <a href="{{route('adminPage')}}" class="link-back">Back</a>
  <h3 class="title">Add Condiment</h3>
  <form action="{{route('newCondiment')}}" method="post">
    @csrf
    <div class="form-item">
      <label for="condiment">Condiment Name: </label>
      <input type="text" id="condiment" name="condiment" /><br>
    </div>
    <button type="submit" class="float-right add-button">Add</button>
  </form>
  <h3 class="title">Condiments</h3>
  <div class="condiments">
    @foreach ($condiments as $condiment)
    <div class="condiment-item">
      <div class="condiment-title">{{$condiment->condiment}}</div>
      <div><a href="{{route('removeCondiment', ['id' => $condiment->id])}}" class="remove">Delete</a></div>
    </div>
    @endforeach
  </div>
</div>
@endsection
