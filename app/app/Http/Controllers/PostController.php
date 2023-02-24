<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        // $posts = Post::all();
        $posts = Post::paginate(8);

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

    public function search(Request $request)
    {
        if($request->hasAny(['camera','lens','tags'])){

            $cameraId = $request->input('camera') ?? null;
            $lensId = $request->input('lens') ?? null;
            $tags = $request->input('tags') ?? null;
            $query = Post::query();
    
            // テーブル結合
            $query->join('post_tag', 'posts.id', '=', 'post_tag.post_id')
            ->join('tags', 'post_tag.tag_id', '=', 'tags.id');
    
            if(!empty($cameraId)){
                $query->where('posts.camera_id', $cameraId);
            }
           
            if(!empty($lensId)){
                $query->where('posts.lens_id', $lensId);
            }

            if (!empty($tags)) {
    
                // カンマが入力された場合
                $tags = str_replace(',', '', $tags);
                // 全角スペースを半角に変換
                $spaceConversion = mb_convert_kana($tags, 's');
    
                // 単語を半角スペースで区切り、配列にする（例："山田 翔" → ["山田", "翔"]）
                $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
                
                // 単語をループで回し、タグと部分一致するものがあれば、$queryとして保持される
                foreach($wordArraySearched as $value) {
                    $query->orWhere('tags.name', 'like', '%'.$value.'%');
                }  
            }
             // 上記で取得した$queryをページネートにし、変数$usersに代入
             $posts = $query->distinct()->select(
                 'posts.id as id',
                 'posts.title',
                 'posts.image1', 
             )->paginate(12);
        }else{
            $posts = Post::paginate(12);
        }

     

        $camera = new camera;
        $all_camera = $camera->all()->toArray();

        $lens = new lens;
        $all_lens = $lens->all()->toArray();


        return view('post.search',[
            'cameras' => $all_camera,
            'lenses' => $all_lens,
            'posts' => $posts,
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
        $address = $post->spot_address;

        $camera = Camera::find($post->camera_id);
        $lens = Lens::find($post->lens_id);

        return view('post.show',[
            'post' => $post,
            'post_likes_count' => $post_likes_count,
            'camera' => $camera,
            'lens' => $lens,
            'address' => $address,
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
        $post = Post::find($id);
        $camera = new camera;
        $all_camera = $camera->all()->toArray();
        
        
        $lens = new lens;
        $all_lens = $lens->all()->toArray();
        
        $tags = $post->tags()->pluck('name');
        $arr = [];
        foreach($tags as $tag){
            $arr[] = $tag;
        }
        $tags = implode(' ', $arr);

        return view('post.edit',[
            'cameras' => $all_camera,
            'lenses' => $all_lens,
            'post' => $post,
            'tag'=>$tags,
        ]);
    }

    public function editConfirm(Request $request)
    {
    
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

        return view('post.editC',[
            'post'=>$request->all(),
            'tag'=>implode(',',$array),
            'image_name1'=>$image_name1 ,
            'image_name2'=>$image_name2 ?? null,
            'image_name3'=>$image_name3 ?? null,
            'camera'=>$camera,
            'lens'=>$lens,
        ]);
    
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
        try{

       
            $post = Post::findOrFail($id);

            $post->title = $request->title;
            $post->camera_id = $request->camera_id;
            $post->lens_id = $request->lens_id;
            $post->spot_name = $request->spot_name;
            $post->spot_address = $request->spot_address;
            $post->image1 = $request->image1;
            $post->image2 = $request->image2 ?? null;
            $post->image3 = $request->image3 ?? null;
            $post->save();

            // タグの保存
            foreach($post->tags as $tag){
                Tag::where('id',$tag->id)->delete();
            }
            
            $tags = explode(',',$request->tag);
            $tags_id = [];
            foreach ($tags as $tag) {
                $record = Tag::create(
                    ['name' => $tag]
                ); 
                // array_push($tags_id, $post['id']);
                DB::table('post_tag')->insert([
                    'tag_id'=>$record->id,
                    'post_id'=>$post['id']
                ]);
            };
            
        }catch(\Exception $e){
            report($e);
        }
        return redirect()->route('home');
        
    }

    public function report()
    {

        $posts = Post::where('report', '!=', '0')->get();
        return view('post.report',[
            'posts' => $posts,
        ]);
    }


      /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reportUpdate(Request $request, $id)
    {
        try{

       
            $post = Post::findOrFail($id);
            $post->report = $request->report;
            $post->report = $post->report + 1;
          
            $post->save();

            
        }catch(\Exception $e){
            report($e);
        }
        return redirect()->route('post.index');
        
    }

   
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        
        return redirect(route('post.index'))->with('success', '投稿を削除しました');
        
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
