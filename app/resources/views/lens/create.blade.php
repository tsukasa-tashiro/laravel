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
                
            </ul>
            
        </div>
    </div>
</nav>

 <!-- Header-->
 <header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">レンズ登録</h1>
            <p class="lead fw-normal text-white-50 mb-0">ロゴ</p>
        </div>
    </div>
</header>
 <!-- Section-->

 <form action="{{ route('lens.confirm') }}" method="post">
    @csrf
    <div class="card py-4 px-4 mt-4">
        <h5 class="fw-bolder">レンズ</h5>
        <label for="maker" class="form-label mt-2">メーカー</label>
        <input type="text" name="maker" class="form-control" placeholder="メーカー名を入力" value="{{ old('maker') }}">
        <label for="name" class="form-label mt-2">本体名</label>
        <input type="text" name="name" class="form-control" placeholder="本体名を入力" value="{{ old('name')}}">
        <button type="submit" class="btn btn-outline-primary mt-3">登録確認</button>
</div>
</form>

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
