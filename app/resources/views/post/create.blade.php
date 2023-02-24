@extends('layouts.app')
@section('content')
 <!-- Header-->
 <header class="bg-dark py-2">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">新規投稿</h1>
        </div>
    </div>
</header>
 <!-- Section-->
 @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- タイトル・タグ入力 --}}
<div class="row gx-3 gx-lg-5 row-cols-1 row-cols-md-1 row-cols-xl-2 justify-content-center">
    <form action="{{route('post.confirm')}}" method="post" enctype="multipart/form-data">
    @csrf
            <div class="card py-4 px-4 mt-2">
                <h5 class="fw-bolder">タイトル・タグ</h5>
                <label for="title" class="form-label mt-2">タイトル</label>
                <input type="text" name="title" value="{{ old('title') }}" class="form-control" id="title" placeholder="タイトルを入力">
                <label for="tag" class="form-label mt-2">タグ</label>
                <input type="tag" name="tag" value="{{ old('tag') }}" class="form-control" id="tag" placeholder="タグを入力">
            </div>
            
        {{-- 撮影場所入力 --}}
            <div class="card py-4 px-4 mt-2">
                <h5 class="fw-bolder">撮影場所</h5>
                <label for="spot_name" class="form-label mt-2">名称</label>
                <input type="text" name="spot_name" value="{{ old('spot_name') }}" class="form-control" id="spot_name" placeholder="名称を入力">

                <label for="spot_address" class="form-label mt-2">所在地</label>
                <input type="text" name="spot_address" value="{{ old('spot_address') }}" class="form-control" id="spot_address" placeholder="所在地を入力">
                <input type="hidden" name="longitude">
                <input type="hidden" name="latitude">
                <button type="button" class="btn btn-outline-primary mt-3" id="checkButton" onclick="initMap()">地図検索</button>
            </div>
        {{-- マップ表示 --}}
            <div id="map" style="width: 600px; height: 500px;"></div>



            
        {{-- 画像データ選択 --}}
            <div class="card py-4 px-4 mt-2">
                <h5 class="fw-bolder">画像データ</h5>
                {{-- @csrf --}}
                <label for="image1" class="form-label mt-3">画像を選択　</label>
                <input class="form-control" type="file" name="image1">
                <input class="form-control" type="file" name="image2">
                <input class="form-control" type="file" name="image3">

                {{-- <img class="card-img-top mt-5 pt-5" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." /> --}}
            </div>

        {{-- カメラ選択 --}}
        <div class="card py-4 px-4 mt-2">
            <h5 class="card-header">カメラ</h5>
            <select name="camera_id" class="form-select" aria-label="Default select">
            
                <option selected="">メーカー名 - 本体名</option>
                @foreach($cameras as $camera)
                <option value="{{$camera['id']}}">{{$camera['maker']}}-{{$camera['name']}}</option>
                @endforeach

            </select>
        
        </div>  

        {{-- レンズ選択 --}}
        <div class="card py-4 px-4 mt-2">
            <h5 class="card-header">レンズ</h5>
            <select name="lens_id" class="form-select" aria-label="Default select">
            
                <option selected="">メーカー名 - レンズ名</option>
                @foreach($lenses as $lens)
                <option value="{{$lens['id']}}">{{$lens['maker']}}-{{$lens['name']}}</option>
                @endforeach

            </select>
        </div>


        <button type="submit" class="btn btn-outline-primary mt-5">投稿確認</button> 
        
    </form>
</div>

<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p></div>
</footer>


<script>
    
    function initMap() {
     
      var target = document.getElementById('map'); //マップを表示する要素を指定
      var address = document.getElementById('spot_address').value; //住所を指定
      var geocoder = new google.maps.Geocoder();  
   
      geocoder.geocode({ address: address }, function(results, status){
        if (status === 'OK' && results[0]){
    
           var map = new google.maps.Map(target, {  
             center: results[0].geometry.location,
             zoom: 18
           });
    
           var marker = new google.maps.Marker({
             position: results[0].geometry.location,
             map: map,
             animation: google.maps.Animation.DROP
           });
    
        }
        // else{ 
        //   //住所が存在しない場合の処理
        //   alert('住所が正しくないか存在しません。');
        //   target.style.display='none';
        // }
      });
    }
    </script>


@endsection
