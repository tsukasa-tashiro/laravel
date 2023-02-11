@extends('layouts.app')
@section('content')

<form action="{{route('post.store')}}" method="post">
    @csrf
    <div class="form-group">
      <input type="text" name="title" class="form-control" value="{{ $post['title'] }}" disabled >
      <input type="hidden" name="title" value="{{ $post['title'] }}">
    </div>
    <div class="form-group">
      <input type="text" name="tag" class="form-control" value="{{ $post['tag'] }}" disabled >
      <input type="hidden" name="tag" value="{{ $post['tag'] }}">
    </div>
    <div class="form-group">
      <input type="text"  class="form-control" value="{{ $camera->maker }}-{{ $camera->name }}" disabled >
      <input type="hidden" name="camera_id" value="{{ $post['camera_id'] }}">
    </div>
    <div class="form-group">
        <input type="text"  class="form-control" value="{{ $lens->maker }}-{{ $lens->name }}" disabled >
        <input type="hidden" name="lens_id" value="{{ $post['lens_id'] }}">
    </div>
    <div class="form-group">
      <input type="text" name="spot_name" class="form-control" value="{{ $post['spot_name'] }}" disabled >
      <input type="hidden" name="spot_name" value="{{ $post['spot_name'] }}">
    </div>
    <div class="form-group">
      <input type="text" name="spot_address" class="form-control" value="{{ $post['spot_address'] }}" disabled >
      <input type="hidden" name="spot_address" value="{{ $post['spot_address'] }}">
    </div>
    <div class="form-group">
        <img src="{{ asset('storage/images/'.$image_name1) }}">
        <input type="hidden" name="image1" value="{{ $image_name1 }}">
    </div>
    @if($image_name2)
    <div class="form-group">
        <img src="{{ asset('storage/images/'.$image_name2) }}">
        <input type="hidden" name="image2" value="{{ $image_name2 }}">
    </div>
    @endif
    @if($image_name3)
    <div class="form-group">
        <img src="{{ asset('storage/images/'.$image_name3) }}">
        <input type="hidden" name="image3" value="{{ $image_name3 }}">
    </div>
    @endif
   
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

@endsection