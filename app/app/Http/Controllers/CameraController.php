<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Camera;

class CameraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $camera = new Camera;
        $all_camera = $camera->all()->toArray();

        return view('camera.create',[

            'cameras' => $all_camera,

        ]);
    }

    public function confirm(Request $request){
              
        $validatedDate = $request->validate([

            'maker' => 'required|max:20',
            'name' => 'required|max:50',
        ]);

        return view('camera.confirm',[    

            'camera'=>$request->all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $camera = new Camera;
        $camera->maker = $request->maker;
        $camera->name = $request->name;
        $camera->save();
        return redirect()->route('camera.create');

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
        $camera = Camera::find($id);
        
        return view('camera.edit',[
            'camera' => $camera,
        ]);
    }

    public function editConfirm(Request $request){
              
        $validatedDate = $request->validate([
            'id' => 'required',
            'maker' => 'required|max:20',
            'name' => 'required|max:50',
        ]);
        return view('camera.editConfirm',[    
            'camera'=>$request->all(),
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
        $camera = Camera::findOrFail($id);

        $camera->maker = $request->maker;
        $camera->name = $request->name;
        $camera->save();
        return redirect()->route('camera.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $camera = Camera::find($id);
        $camera->delete();
        
        return redirect(route('camera.create'))->with('success', 'カメラを削除しました');
    }
}
