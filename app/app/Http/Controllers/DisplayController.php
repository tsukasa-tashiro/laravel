<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Camera;

class DisplayController extends Controller
{
    public function index(){

        $post = new   post;
        $all = $post->all()->toArray();

        return view('home',[
            'posts' => $all,
        ]);

    }

    public function search(){
      
        return view('search');

    }

    public function detail(){
        return view('detail');
    }

    public function account(){
        return view('account');
    }

    public function add_post(){
        return view('add_post');
    }

    public function camera_add(){
        
        return view('camera.add');
    }

    public function lens_add(){
        return view('lens_add');
    }

    public function create(Request $request){
        
        return view('post.create');
    }

    // public function store(Request $request){
    //     $img = $request->file('image1');
    //     $path = $img->store('img','public');
    //     Post::create([
    //         'image1' => $path,
    //     ]);
        
    //     return redirect()->route('post.index');
    // }


    
}
    
