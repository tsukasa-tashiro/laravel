@extends('layouts.app')
@section('content')

<form action="{{route('camera.store')}}" method="post">
    @csrf
    <div class="form-group">
      <input type="text" name="maker" class="form-control" value="{{ $post['maker'] }}" disabled >
      <input type="hidden" name="maker" value="{{ $post['maker'] }}">
    </div>
    <div class="form-group">
      <input type="text" name="name" class="form-control" value="{{ $post['name'] }}" disabled >
      <input type="hidden" name="name" value="{{ $post['name'] }}">
    </div>
    
    
   
    <button type="submit" class="btn btn-primary">登録</button>
  </form>

@endsection