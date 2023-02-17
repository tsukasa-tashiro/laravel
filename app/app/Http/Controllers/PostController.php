<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Camera;
use App\Lens;
use App\Post;
use App\Tag;
use App\Like;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('home',[
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $camera = new camera;
        $all_camera = $camera->all()->toArray();

        $lens = new lens;
        $all_lens = $lens->all()->toArray();



        return view('post.create',[
            'cameras' => $all_camera,
            'lenses' => $all_lens,
        ]);
    }

    public function search()
    {
        $camera = new camera;
        $all_camera = $camera->all()->toArray();

        $lens = new lens;
        $all_lens = $lens->all()->toArray();



        return view('post.search',[
            'cameras' => $all_camera,
            'lenses' => $all_lens,
        ]);
    }

    public function confirm(Request $request){

        $validatedData = $request->validate([
            'title' => 'required|max:30',
            'tag' => 'required',
            'image1' => 'required|mimes:jpg,jpeg,png,gif',
            'image2' => 'mimes:jpg,jpeg,png,gif',
            'image3' => 'mimes:jpg,jpeg,png,gif',
            'camera_id' => 'required',
            'lens_id' => 'required',
            'spot_name' => 'required',
            'spot_address' => 'required',
        ]);

        if($request->hasFile('image1')){
            $image_name1 = $this->confirmImage($request->image1);
        }
        if($request->hasFile('image2')){
            $image_name2 = $this->confirmImage($request->image2);
        }
        if($request->hasFile('image3')){
            $image_name3 = $this->confirmImage($request->image3);
        }

        // 全角スペースを半角に変換
        $spaceConversion = mb_convert_kana($request->tag, 's');

        // 単語を半角スペースで区切り、配列にする（例："山田 翔" → ["山田", "翔"]）
        $array = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);

        $camera = Camera::find($request->camera_id);
        $lens= Lens::find($request->lens_id);
        return view('post.confirm',[
            'post'=>$request->all(),
            'tag'=>implode(',',$array),
            'image_name1'=>$image_name1,
            'image_name2'=>$image_name2 ?? null,
            'image_name3'=>$image_name3 ?? null,
            'camera'=>$camera,
            'lens'=>$lens,
        ]);
    }

    public function confirmImage($image){
     
        // アップロードされたファイル名を取得
        $file_name = $image->getClientOriginalName();

        // 取得したファイル名で保存
        $image->storeAs('public/images' , $file_name);
        return $file_name;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post;
        $post->title = $request->title;
        $post->camera_id = $request->camera_id;
        $post->lens_id = $request->lens_id;
        $post->user_id = Auth::id();
        $post->spot_name = $request->spot_name;
        $post->spot_address = $request->spot_address;
        $post->image1 = $request->image1;
        $post->image2 = $request->image2 ?? null;
        $post->image3 = $request->image3 ?? null;
        $post->save();

        // タグの保存
        $tags = explode(',',$request->tag);
        $tags_id = [];
        foreach ($tags as $tag) {
            $record = Tag::create(['name' => $tag]); 
            array_push($tags_id, $record['id']);
        };
        $post->tags()->attach($tags_id); // 投稿ににタグ付するために、attachメソッドをつかい、モデルを結びつけている中間テーブルにレコードを挿入します。

        return redirect()->route('home');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $post_likes_count = $post->likes()->count();
        return view('post.show',[
            'post' => $post,
            'post_likes_count' => $post_likes_count,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function like(Request $request)
    {
        $user_id = Auth::id(); //1.ログインユーザーのid取得
        $post_id = $request->post_id; //2.投稿idの取得
        $already_liked = Like::where('user_id', $user_id)->where('post_id', $post_id)->first(); //3.

        if (!$already_liked) { //もしこのユーザーがこの投稿にまだいいねしてなかったら
            $like = new Like; //4.Likeクラスのインスタンスを作成
            $like->post_id = $post_id; //Likeインスタンスにpost_id,user_idをセット
            $like->user_id = $user_id;
            $like->save();
        } else { //もしこのユーザーがこの投稿に既にいいねしてたらdelete
            Like::where('post_id', $post_id)->where('user_id', $user_id)->delete();
        }
        //5.この投稿の最新の総いいね数を取得
        $post = Post::findOrFail($post_id);
        $post_likes_count = $post->likes()->count();
        $param = [
            'post_likes_count' => $post_likes_count,
        ];
        return response()->json($param); //6.JSONデータをjQueryに返す
    }
}
