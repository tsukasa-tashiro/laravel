@extends('layouts.app')
@section('content')

<div class="row gx-3 gx-lg-5 row-cols-2 row-cols-md-2 row-cols-xl-2 justify-content-center">
    <form action="{{route('post.update',['post'=>$post['id']])}}" method="post"> 
        @csrf
        @method('PUT')
        <div class="form-group">
          <p class="font-weight-bold">タイトル</p><input type="text" name="title" class="form-control" value="{{ $post['title'] }}" disabled >
          <input type="hidden" name="title" value="{{ $post['title'] }}">
        </div>
        <div class="form-group">
          <p class="font-weight-bold">タグ</p><input type="text" name="tag" class="form-control" value="{{ $tag }}" disabled >
          <input type="hidden" name="tag" value="{{ $tag }}">
        </div>
        <div class="form-group">
          <p class="font-weight-bold">カメラ</p><input type="text"  class="form-control" value="{{ $camera->maker }}-{{ $camera->name }}" disabled >
          <input type="hidden" name="camera_id" value="{{ $post['camera_id'] }}">
        </div>
        <div class="form-group">
            <p class="font-weight-bold">レンズ</p><input type="text"  class="form-control" value="{{ $lens->maker }}-{{ $lens->name }}" disabled >
            <input type="hidden" name="lens_id" value="{{ $post['lens_id'] }}">
        </div>
        <div class="form-group">
          <p class="font-weight-bold">名称</p><input type="text" name="spot_name" class="form-control" value="{{ $post['spot_name'] }}" disabled >
          <input type="hidden" name="spot_name" value="{{ $post['spot_name'] }}">
        </div>
        <div class="form-group">
          <p class="font-weight-bold">所在地</p><input type="text" name="spot_address" class="form-control" value="{{ $post['spot_address'] }}" disabled >
          <input type="hidden" name="spot_address" value="{{ $post['spot_address'] }}">
        </div>
        <div class="form-group text-center">
            <img src="{{ asset('storage/images/'.$image_name1) }}" width="30%">
            <input type="hidden" name="image1" value="{{ $image_name1 }}">
        </div>
        @if($image_name2)
        <div class="form-group text-center">
            <img src="{{ asset('storage/images/'.$image_name2) }}" width="30%">
            <input type="hidden" name="image2" value="{{ $image_name2 }}">
        </div>
        @endif
        @if($image_name3)
        <div class="form-group text-center">
            <img src="{{ asset('storage/images/'.$image_name3) }}" width="30%">
            <input type="hidden" name="image3" value="{{ $image_name3 }}">
        </div>
        @endif
        <div class="text-center">
          <button type="submit" class="btn btn-primary mt-4">投稿</button>
        </div>
      </form>
</div>

@endsection