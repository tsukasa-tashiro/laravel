@extends('layouts.app')
@section('content')

<div class="row gx-3 gx-lg-5 row-cols-1 row-cols-md-1 row-cols-xl-2 justify-content-center">
  <form action="{{route('camera.store')}}" method="post">
      @csrf
      <div class="form-group">
        <input type="text" name="maker" class="form-control" value="{{ $camera['maker'] }}" disabled >
        <input type="hidden" name="maker" value="{{ $camera['maker'] }}">
      </div>
      <div class="form-group">
        <input type="text" name="name" class="form-control" value="{{ $camera['name'] }}" disabled >
        <input type="hidden" name="name" value="{{ $camera['name'] }}">
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-primary">登録</button>
      </div>
    </form>
</div>

@endsection