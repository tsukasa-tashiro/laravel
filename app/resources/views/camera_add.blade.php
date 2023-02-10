<!DOCTYPE html>
<html lang="ja">
    @extends('layouts.app')

@section('content')
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />

        @isset($title)
        <title>{{ $title }} Shop Homepage - Start Bootstrap Template</title>
            
        @else
        <title>Viewfinders</title>
        @endisset
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        
    </head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="#!">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('account') }}">マイページ</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">All Products</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                        <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex">
                <button class="btn btn-outline-dark" type="submit">
                    <i class="bi-cart-fill me-1"></i>
                    Cart
                    <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                </button>
            </form>
        </div>
    </div>
</nav>

 <!-- Header-->
 <header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">camera登録</h1>
            <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
        </div>
    </div>
</header>
 <!-- Section-->

 
 <div class="card py-4 px-4 mt-4">
    <h5 class="fw-bolder">カメラ</h5>
    <label for="formControlInput" class="form-label mt-2">メーカー</label>
    <input type="email" class="form-control" id="formControlInput" placeholder="タイトルを入力">
    <label for="formControlInput" class="form-label mt-2">本体名</label>
    <input type="email" class="form-control" id="formControlInput" placeholder="タグを入力">
    <button type="button" class="btn btn-outline-primary mt-3">Primary</button>
</div>
 

 <div class="text-center"><a class="btn btn-outline-dark mt-2" href="{{ url('detail') }}">投稿詳細</a></div>
 <div class="text-center"><a class="btn btn-outline-dark mt-2" href="{{ url('account') }}">マイページ</a></div>
 <div class="text-center"><a class="btn btn-outline-dark mt-2" href="{{ url('add_post') }}">新規投稿</a></div>
 <section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
         
            
            
            {{-- <div class="col mb-5">
                
                <div class="card h-100">
                    <!-- Product image-->
                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name　タイトルに変更-->
                            <h5 class="fw-bolder">タイトル</h5>
                            <!-- Product price　タグに変更-->
                            ハッシュタグ
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Product actions-->
                    
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{ url('search') }}">投稿検索</a></div>
                    </div>
                </div>
            </div> --}}
            
        </div>
    </div>
</section>
<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p></div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>
@endsection