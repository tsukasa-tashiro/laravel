@extends('layouts.app')
@section('content')
    
 <!-- Header-->
 <header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">View finders</h1>
            <p class="lead fw-normal text-white-50 mb-0">ロゴ</p>
        </div>
    </div>
</header>
 <!-- Section-->
 <div class="text-center"><a class="btn btn-outline-dark mt-1" href="{{ route('post.search') }}">投稿検索</a></div>
 <div class="text-center"><a class="btn btn-outline-dark mt-1" href="{{ route('camera.create') }}">カメラ登録</a></div>
 <div class="text-center"><a class="btn btn-outline-dark mt-1" href="{{ route('lens.create') }}">レンズ登録</a></div>

 <section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            
        
        @foreach($posts as $post)
            <div class="col mb-5">
                <div class="card h-100">
                    @if($post->image1)
                    <img class="card-img-top" src="{{ asset('storage/images/'.$post->image1) }}" alt="..." />
                    @else
                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
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
                        </div>
                    </div>
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center">
                            <a class="btn btn-outline-dark mt-auto" href="{{ route('post.show',['post'=>$post->id]) }}">投稿詳細</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- 投稿ここまで --}}
        
        </div>
        <div class="d-flex justify-content-center">{{ $posts->links() }}
    </div>
    
</section>
<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p></div>
</footer>
@endsection
