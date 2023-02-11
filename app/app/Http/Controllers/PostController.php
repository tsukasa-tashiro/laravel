<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Camera;
use App\Lens;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function confirm(Request $request){

        $validatedData = $request->validate([
            'title' => 'required|max:255',
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
        $camera = Camera::find($request->camera_id);
        $lens= Lens::find($request->lens_id);
        return view('post.confirm',[
            'post'=>$request->all(),
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
        $post->tag = $request->tag;
        $post->camera_id = $request->camera_id;
        $post->lens_id = $request->lens_id;
        $post->user_id = Auth::id();
        $post->spot_name = $request->spot_name;
        $post->spot_address = $request->spot_address;
        $post->image1 = $request->image1;
        $post->image2 = $request->image2 ?? null;
        $post->image3 = $request->image3 ?? null;
        $post->save();
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
        //
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
}
