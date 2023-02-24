<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lens;

class LensController extends Controller
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
        $lens = new Lens;
        $all_lens = $lens->all()->toArray();

        return view('lens.create',[
            'lenses' => $all_lens,
        ]);  
    }

    public function confirm(Request $request){
        
        $validatedDate = $request->validate([

            'maker' => 'required|max:20',
            'name' => 'required|max:50',
        ]);

        return view('lens.confirm',[
            
            'lens'=>$request->all(),
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
        $lens = new Lens;
        $lens->maker = $request->maker;
        $lens->name = $request->name;
        $lens->save();
        return redirect()->route('lens.create');
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
        $lens = Lens::find($id);
        
        return view('lens.edit',[
            'lens' => $lens,
        ]);
    }

    public function editConfirm(Request $request){
              
        $validatedDate = $request->validate([
            'id' => 'required',
            'maker' => 'required|max:20',
            'name' => 'required|max:50',
        ]);

        return view('lens.editConfirm',[    
            'lens'=>$request->all(),
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
        $lens = Lens::findOrFail($id);

        $lens->maker = $request->maker;
        $lens->name = $request->name;
        $lens->save();
        return redirect()->route('lens.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lens = Lens::find($id);
        $lens->delete();
        
        return redirect(route('lens.create'))->with('success', 'カメラを削除しました');    
    }
}
