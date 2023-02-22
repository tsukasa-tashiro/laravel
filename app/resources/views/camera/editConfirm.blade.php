@extends('layouts.app')
@section('content')

<form action="{{route('camera.update',['camera'=>$camera['id']])}}" method="post">
    @csrf
    @method('PUT')
    <div class="form-group">
      <input type="text" name="maker" class="form-control" value="{{ $camera['maker'] }}" disabled >
      <input type="hidden" name="maker" value="{{ $camera['maker'] }}">
    </div>
    <div class="form-group">
      <input type="text" name="name" class="form-control" value="{{ $camera['name'] }}" disabled >
      <input type="hidden" name="name" value="{{ $camera['name'] }}">
    </div>
    
    
   
    <button type="submit" class="btn btn-primary">更新</button>
  </form>

@endsection