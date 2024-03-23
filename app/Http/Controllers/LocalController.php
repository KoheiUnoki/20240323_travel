<?php

namespace App\Http\Controllers;

use App\Models\Local;
use Illuminate\Http\Request;
use Validator; 
use Auth;

class LocalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $locals = Local::orderBy('created_at', 'asc')->get();
    return view('locals', [
        'locals' => $locals
    ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
             //バリデーション
    $validator = Validator::make($request->all(), [
         'local_name' => 'required|min:3|max:255',
         'local_explain' => 'required|min:3|max:500',
         'local_picture' => 'required|min:3|max:500'
    ]);

    //バリデーション:エラー 
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
    //以下に登録処理を記述（Eloquentモデル）

  // Eloquentモデル
  $locals = new Local;
  $locals->local_name   = $request->local_name;
  $locals->local_explain = $request->local_explain;
  $locals->local_picture = $request->local_picture;
  $locals->save(); 
  return redirect('/local');
  
    }

    /**
     * Display the specified resource.
     */
    public function show(Local $local)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Local $local)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Local $local)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Local $local)
    {
        //
    }
}
