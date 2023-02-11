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
 <div class="text-center"><a class="btn btn-outline-dark mt-1" href="{{ url('search') }}">投稿検索</a></div>
 <div class="text-center"><a class="btn btn-outline-dark mt-1" href="{{ url('camera_add') }}">カメラ登録</a></div>
 <div class="text-center"><a class="btn btn-outline-dark mt-1" href="{{ url('lens_add') }}">レンズ登録</a></div>

 <section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            
        {{-- 投稿表示１枚目 --}}
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Product image-->
                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name　タイトルに変更-->
                            <h5 class="fw-bolder">タイトル</h5>
                            <!-- Product price　タグに変更-->
                            タグ
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                            </div>
                        </div>
                    </div>
                    <!-- 投稿詳細ボタン-->
                    
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{ url('detail') }}">投稿詳細</a></div>
                    </div>
                </div>
            </div>
        {{-- 投稿１枚目　ここまで --}}
        {{-- 投稿２枚目　ここから --}}
        {{-- @foreach($posts as $post) --}}
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Product image-->
                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">TEST</h5>
                            <!-- Product reviews-->
                            
                            <!-- Product price-->
                            <span class=" text-decoration-line-through">タグ</span>
                        </div>
                    </div>
                    <!-- 投稿詳細ボタン-->
                    
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{ url('detail') }}">投稿詳細</a></div>
                    </div>
                </div>
            </div>
        {{-- @endforeach --}}
        {{-- 投稿２枚目　ここまで --}}

           

        {{-- 投稿ここまで --}}

                 
    </div>
</section>
<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p></div>
</footer>
@endsection
