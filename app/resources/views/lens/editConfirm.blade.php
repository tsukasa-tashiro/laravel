@extends('layouts.app')
@section('content')

<form action="{{route('lens.update',$lens['id'])}}" method="post">
    @csrf
    @method('PUT')
    <div class="form-group">
      <input type="text" name="maker" class="form-control" value="{{ $lens['maker'] }}" disabled >
      <input type="hidden" name="maker" value="{{ $lens['maker'] }}">
    </div>
    <div class="form-group">
      <input type="text" name="name" class="form-control" value="{{ $lens['name'] }}" disabled >
      <input type="hidden" name="name" value="{{ $lens['name'] }}">
    </div>
    
    
   
    <button type="submit" class="btn btn-primary">更新</button>
  </form>

@endsection