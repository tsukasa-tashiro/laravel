@extends('layouts.app')
@section('content')

<div class="row gx-3 gx-lg-5 row-cols-1 row-cols-md-1 row-cols-xl-2 justify-content-center">
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
        <div class="text-center">
          <button type="submit" class="btn btn-primary">更新</button>
        </div>
      </form>
</div>

@endsection