@extends('layouts.app')
@section('content')

 <!-- Header-->
 <header class="bg-dark py-2">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">レンズ登録</h1>
        </div>
    </div>
</header>
 <!-- Section-->
 <div class="container px-4 px-lg-5 mt-3">
        <form action="{{ route('lens.confirm') }}" method="post">
            @csrf
            <div class="card py-4 px-4 mt-4">
                <h5 class="card-title">レンズ</h5>
                <label for="maker" class="form-label mt-2">メーカー</label>
                <input type="text" name="maker" class="form-control" placeholder="メーカー名を入力" value="{{ old('maker') }}">
                <label for="name" class="form-label mt-2">本体名</label>
                <input type="text" name="name" class="form-control" placeholder="本体名を入力" value="{{ old('name')}}">
                <button type="submit" class="btn btn-outline-primary mt-3">登録確認</button>
        </div>
        </form>

        <table class="table mt-4">
            <thead class="thead-light">
                <tr>
                    <th>メーカー</th>
                    <th>本体名</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($lenses as $lens)
                <tr>
                    <td>{{$lens['maker']}}</td>
                    <td>{{$lens['name']}}</td>
                    <td>
                       
                        <form action="{{ route('lens.edit',$lens['id']) }}">
                            @csrf
                            <input type="submit" value="編集" class="btn btn-secondary">
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('lens.destroy',$lens['id']) }}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" value="削除" class="btn btn-danger" onclick='return confirm("削除しますか？")';>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
