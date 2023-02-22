@extends('layouts.app')
@section('content')

<form action="{{route('lens.store')}}" method="post">
    @csrf
    <div class="form-group">
      <input type="text" name="maker" class="form-control" value="{{ $lens['maker'] }}" disabled >
      <input type="hidden" name="maker" value="{{ $lens['maker'] }}">
    </div>
    <div class="form-group">
      <input type="text" name="name" class="form-control" value="{{ $lens['name'] }}" disabled >
      <input type="hidden" name="name" value="{{ $lens['name'] }}">
    </div>
    
    
   
    <button type="submit" class="btn btn-primary">登録</button>
  </form>

@endsection