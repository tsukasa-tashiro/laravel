@extends('layouts.app')
@section('content')
    
 <!-- Header-->
 <header class="bg-dark py-1">
    <div class="container px-4 px-lg-5 my-2">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">投稿詳細</h1>
        </div>
    </div>
</header>
 <!-- Section-->

 <section class="py-2">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-3 gx-lg-5 row-cols-1 row-cols-md-1 row-cols-xl-2 justify-content-center">
            
        
            <div class="col mb-5">
                <div class="card">
                    @if($post->image1)
                    <img class="card-img-top" src="{{ asset('storage/images/'.$post->image1) }}" alt="..." />
                    @else
                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                    @endif

                    @if($post->image2)
                    <img class="card-img-top mt-2" src="{{ asset('storage/images/'.$post->image2) }}" alt="..." />
                    @endif

                    @if($post->image3)
                    <img class="card-img-top mt-2" src="{{ asset('storage/images/'.$post->image3) }}" alt="..." />
                    @endif

                    <div class="card-body p-4">
                        <div class="text-center">
                            <h5 class="fw-bolder">タイトル：{{ $post->title }}</h5>
                            @php
                            $tags=$post->tags()->get(); 
                            
                            @endphp
                            @if(!is_null($tags))
                            @foreach($tags as $tag)
                            <p class=" text-center">タグ：{{ $tag->name }}</p>
                            @endforeach
                            @endif
                            <br>
                            <p class=" text-left mt-2">撮影地：{{ $post->spot_name }}</p>
                            <p class=" text-left mt-2">カメラメーカー：{{ $camera->maker }}</p>
                            <p class=" text-left ">カメラ名：{{ $camera->name }}</p>
                            <p class=" text-left">レンズメーカー：{{ $lens->maker }}</p>
                            <p class=" text-left">レンズ名：{{ $lens->name }}</p>
                            
                            
                        </div>
                    </div>

                    @auth
                    <!-- Review.phpに作ったisLikedByメソッドをここで使用 -->
                    <div class="text-center">
                        @if (!$post->isLikedBy(Auth::user()))
                        <span class="likes">
                            <i class="fas fa-star like-toggle" data-post-id="{{ $post->id }}"></i>
                            <span class="like-counter">{{$post_likes_count}}</span>
                        </span><!-- /.likes -->
                        @else
                        <span class="likes">
                            <i class="fas fa-star heart like-toggle liked" data-post-id="{{ $post->id }}"></i>
                            <span class="like-counter">{{$post_likes_count}}</span>
                        </span><!-- /.likes -->
                        @endif
                    @endauth
                    @guest
                        <span class="likes">
                            <i class="fas fa-star heart"></i>
                        <span class="like-counter">{{$post_likes_count}}</span>
                        </span><!-- /.likes -->
                    @endguest
                    </div>

                    @if(Auth::id()==$post->user_id)
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent ">
                        <div class="text-center mt-2">
                            <a class="btn btn-secondary mt-auto" href="{{ route('post.edit',['post'=>$post->id]) }}">編集</a>
                        </div>
                        
                        <form action="{{route('post.destroy', $post->id)}}" method="post" class="text-center mt-2">
                            @csrf
                            @method('delete')
                            <input type="submit" value="削除" class="btn btn-danger" onclick='return confirm("削除しますか？");'>
                        </form>

                    </div>
                    @endif
                    @if(Auth::id()!=$post->user_id)
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent ">

                        <form action="{{route('post.reportUpdate', $post->id)}}" method="post" class="text-center mt-2">
                            @csrf
                            <input type="hidden" name="id" value="{{$post->id}}">
                            <input type="hidden" name="report" value="{{$post->report}}">
                            <input type="submit" value="不適切投稿として報告" class="btn btn-secondary" onclick='return confirm("報告しますか？");'>
                        </form>
                        
                    </div>
                    @endif
                </div>
                
            </div>
            <div class="col" id="map" style="width: 600px; height: 500px;"></div>
            <input type="hidden"  id="spot_address" value="{{$post->spot_address}}">
        </div>
    
</section>
<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p></div>
</footer>
@endsection
<style>
.liked {
    color: red;
  }
</style>
<script>
     
    // Google Mapを表示する関数
function initMap() {
  const address = "{!! $address !!}"; 
  const geocoder = new google.maps.Geocoder();
  // ここでaddressのvalueに住所のテキストを指定する
  geocoder.geocode( { address: address}, function(results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
      const latlng = {
        lat: results[0].geometry.location.lat(),
        lng: results[0].geometry.location.lng()
      }
      const opts = {
        zoom: 15,
        center: new google.maps.LatLng(latlng)
      }
      const map = new google.maps.Map(document.getElementById('map'), opts)
      new google.maps.Marker({
        position: latlng,
        map: map 
      })
    } else {
      console.error('Geocode was not successful for the following reason: ' + status)
    }
  })
}
     
      
    
</script>
