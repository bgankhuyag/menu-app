@extends('layouts.app')

@section('style')
  <link href="{{ asset('css/editPage.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="container">
    <a href="{{route('adminPage')}}" class="link-back">Back</a>
    <h3 class="title">Add Base</h3>
    <form action="{{route('newBase')}}" enctype="multipart/form-data" method="post" class="newBaseForm">
      @csrf
      <div class="form-item">
        <label for="base">Base Name: </label>
        <input type="text" id="base" name="base" /><br>
      </div>
      <div class="form-item">
        <label for="price">Price: </label>
        <input type="number" id="price" name="price" /><br>
      </div>
      <div class="form-item">
        <label for="baseImage">Upload Image: </label>
        <input type="file" accept="image/*" id="image" name="baseImage" />
      </div>
      <button type="submit" class="add-button float-right">Add</button>
    </form>
    <h3 class="title">Bases</h3>
    <div class="bases">
      @foreach ($bases as $base)
      <div class="base-item">
        <div><img class="base-image" src="{{asset('/storage/images/' . $base->images->name)}}" alt="{{$base->images->description}}" title="{{$base->images->description}}" /></div>
        <div class="base-title">{{$base->base}}</div>
        <div class="base-title">₮{{$base->price}}</div>
        <div class="removeButton"><a href="{{route('editSelectedBase', ['id' => $base->id])}}" class="edit">Edit</a><a href="{{route('removeBase', ['id' => $base->id])}}" class="remove">Delete</a></div>
      </div>
      @endforeach
    </div>
  </div>
@endsection
