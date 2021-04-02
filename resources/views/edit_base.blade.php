@extends('layouts.app')

@section('style')
  <link href="{{ asset('css/editPage.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="container">
    <div class="edit-base">
      <img src="{{asset('/storage/images/' . $base->images->name)}}" class="base-image" alt="{{$base->images->description}}" title="{{$base->images->description}}" />
    </div>
  </div>
@endsection
