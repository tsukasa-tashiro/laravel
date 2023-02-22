@extends('layouts.app')
@section('content')
    
 <!-- Header-->
 <header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-2">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">View finders</h1>
            <p class="lead fw-normal text-white-50 mb-0">ロゴ</p>
        </div>
    </div>
</header>
 <!-- Section-->

 <section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-3 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-3 justify-content-center">
            
        
            <div class="col mb-5">
                <div class="card h-100">
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
                            <h5 class="fw-bolder">{{ $post->title }}</h5>
                            @php
                            $tags=$post->tags()->get(); 
                            
                            @endphp
                            @if(!is_null($tags))
                            @foreach($tags as $tag)
                            <span class=" text-decoration-line-through">{{ $tag->name }}</span>
                            @endforeach
                            @endif
                            <br>
                            <span class=" text-decoration-line-through ">カメラメーカー：{{ $camera->maker }}</span><br>
                            <span class=" text-decoration-line-through ">カメラ名：{{ $camera->name }}</span><br>

                            <span class=" text-decoration-line-through">レンズメーカー：{{ $lens->maker }}</span><br>
                            <span class=" text-decoration-line-through">レンズ名：{{ $lens->name }}</span><br>
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
                </div>
            </div>

           

        {{-- 投稿ここまで --}}

                 
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
   
   
</script>