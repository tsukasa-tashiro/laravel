@extends('layouts.app')
@section('content')

 <!-- Header-->
 <header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">カメラ編集</h1>
            <p class="lead fw-normal text-white-50 mb-0">ロゴ</p>
        </div>
    </div>
</header>
 <!-- Section-->
 <div class="container px-4 px-lg-5 mt-3">

            <form action="{{ route('camera.editConfirm') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$camera->id}}">
                <div class="card py-4 px-4 mt-4">
                    <h5 class="card-title">カメラ</h5>
                    <label for="maker" class="form-label mt-2">メーカー</label>
                    <input type="text" name="maker" class="form-control" placeholder="メーカー名を入力" value="{{ old('maker')?? $camera->maker }}">
                    <label for="name" class="form-label mt-2">本体名</label>
                    <input type="text" name="name" class="form-control" placeholder="本体名を入力" value="{{ old('name')?? $camera->name }}">
                    <button type="submit" class="btn btn-outline-primary mt-3">更新確認</button>
                </div>
            </form>
 </div>
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
