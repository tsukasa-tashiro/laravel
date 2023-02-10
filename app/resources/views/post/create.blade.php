@extends('layouts.app')
@section('content')
 <!-- Header-->
 <header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">新規投稿</h1>
            <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
        </div>
    </div>
</header>
 <!-- Section-->

{{-- タイトル・タグ入力 --}}


        <div class="card py-4 px-4 mt-4">
            <h5 class="fw-bolder">タイトル・タグ</h5>
            <label for="formControlInput" class="form-label mt-2">タイトル</label>
            <input type="email" class="form-control" id="title" placeholder="タイトルを入力">
            <label for="formControlInput" class="form-label mt-2">タグ</label>
            <input type="email" class="form-control" id="tag" placeholder="タグを入力">
        </div>
        
    {{-- 撮影場所入力 --}}
        <div class="card py-4 px-4 mt-4">
            <h5 class="fw-bolder">撮影場所</h5>
            <label for="formControlInput" class="form-label mt-2">名称</label>
            <input type="email" class="form-control" id="formControlInput" placeholder="名称を入力">
            <label for="formControlInput" class="form-label mt-2">所在地</label>
            <input type="email" class="form-control" id="formControlInput" placeholder="所在地を入力">

           
            <button type="button" class="btn btn-outline-primary mt-3">地図検索</button>
        </div>
    {{-- マップ表示 --}}
        <div id="map" style="width: 600px; height: 500px;"></div>



        
    {{-- 画像データ選択 --}}
        <div class="card py-4 px-4 mt-4">
            <h5 class="fw-bolder">画像データ</h5>
            {{-- @csrf --}}
            <label for="formFile" class="form-label mt-3">画像を選択</label>
            <input class="form-control" type="file" name="image1">
            <img class="card-img-top mt-5 pt-5" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
        </div>
    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
    <button type="submit" class="btn btn-outline-primary mt-5">投稿確認</button> 
    
</form>



 <div class="text-center"><a class="btn btn-outline-dark mt-2" href="{{ url('detail') }}">投稿詳細</a></div>
 <div class="text-center"><a class="btn btn-outline-dark mt-2" href="{{ url('account') }}">マイページ</a></div>
 <div class="text-center"><a class="btn btn-outline-dark mt-2" href="{{ url('add_post') }}">新規投稿</a></div>
 
<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p></div>
</footer>

{{-- MAP表示 --}}
<script>
    function initMap() {
     
      var target = document.getElementById('map'); //マップを表示する要素を指定
      var address = '東京都新宿区西新宿2-8-1'; //住所を指定
      var geocoder = new google.maps.Geocoder();  
    
      geocoder.geocode({ address: address }, function(results, status){
        if (status === 'OK' && results[0]){
    
          console.log(results[0].geometry.location);
    
           var map = new google.maps.Map(target, {  
             center: results[0].geometry.location,
             zoom: 18
           });
    
           var marker = new google.maps.Marker({
             position: results[0].geometry.location,
             map: map,
             animation: google.maps.Animation.DROP
           });
    
        }else{ 
          //住所が存在しない場合の処理
          alert('住所が正しくないか存在しません。');
          target.style.display='none';
        }
      });
    }
    </script>


@endsection
