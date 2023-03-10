@extends('layouts.app')
@section('content')
 <!-- Header-->
 <header class="bg-dark py-1">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-5 fw-bolder">投稿検索画面</h1>
        </div>
    </div>
</header>
 <!-- Section-->
<div class="row gx-3 gx-lg-5 row-cols-1 row-cols-md-1 row-cols-xl-2 justify-content-center">
    <form action="{{ route('post.search') }}" method="get"> 
        <div class="card py-3 px-3 m-4">
                <h5 class="">カメラ</h5>
                <select class="form-select" name="camera" aria-label="Default select">
                    <option disabled selected>メーカー名　ー　本体名</option>
                    @foreach($cameras as $camera)
                        <option value="{{$camera['id']}} ">{{$camera['maker']}}-{{$camera['name']}}</option>
                    @endforeach
                </select>
        </div>
        <div class="card py-3 px-3 m-4">
            <h5 class="">レンズ</h5>
            <select class="form-select" name="lens" aria-label="Default select">
                <option disabled selected>メーカー名　ー　本体名</option>
                @foreach($lenses as $lens)
                    <option value="{{$lens['id']}}">{{$lens['maker']}}-{{$lens['name']}}</option>
                @endforeach
            </select>
        </div>
        <div class="card py-3 px-3 m-4">
            <h5 class="">タグ</h5>
           <input type="text" name="tags" id="tags" placeholder="山、海、東京" >
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">検索</button>
        </div>
    </form>  
</div>
 
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
        
        </div>
        <div class="d-flex justify-content-center">
            {{$posts->appends(request()->input())->links()}}
    </div>
</section>
<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p></div>
</footer>
@endsection
