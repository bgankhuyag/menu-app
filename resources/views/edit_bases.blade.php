@extends('layouts.app')

@section('style')
  <link href="{{ asset('css/editPage.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="container">
    <a href="{{route('adminPage')}}" class="link-back">< Back</a>
    <h3 class="title">Add Base</h3>
    <form action="{{route('newBase')}}" enctype="multipart/form-data" method="post">
      @csrf
      <div class="form-item">
        <label for="base">Base Name </label>
        <input type="text" id="base" name="base" /><br>
      </div>
      <div class="form-item">
        <label for="baseImage">Upload Image</label>
        <input type="file" accept="image/*" id="image" name="baseImage" />
      </div>
      <button type="submit">Add</button>
    </form>
    <h3 class="title">Bases</h3>
    <div class="bases">
      @foreach ($bases as $base)
      <div class="base-item">
        <div class="base-title">{{$base->base}}</div>
        <div><img src="{{asset('/storage/images/' . $base->images->name)}}" alt="{{$base->images->description}}" title="{{$base->images->description}}" width="200" /></div>
        <div class="removeButton"><a href="{{route('removeBase', ['id' => $base->id])}}" class="remove">Delete</a></div>
      </div>
      @endforeach
    </div>
  </div>
@endsection
