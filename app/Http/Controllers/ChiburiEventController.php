<?php

namespace App\Http\Controllers;

use App\Models\Chiburi_Event;
use Illuminate\Http\Request;
use Validator;  //この1行だけ追加！
use Auth;

class ChiburiEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chiburi_events = Chiburi_Event::where('user_id',Auth::user()->id)->orderBy('created_at', 'asc')->get();
    return view('chiburi_events', [
        'chiburi_events' => $chiburi_events
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
         'event_title' => 'required|min:3|max:255',
         'event_content' => 'required|min:3|max:255',
         'event_url' => 'required|min:3|max:255',
    ]);

    //バリデーション:エラー 
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
    //以下に登録処理を記述（Eloquentモデル）

  // Eloquentモデル
  $chiburi_events = new Chiburi_Event;
  $chiburi_events->user_id  = Auth::user()->id;
  $chiburi_events->event_title   = $request->event_title;
  $chiburi_events->event_content = $request->event_content;
  $chiburi_events->event_url = $request->event_url;
  $chiburi_events->save(); 
  return redirect('/');
  
  
   //** ↑ 上をコピー ↑ **
    }

    /**
     * Display the specified resource.
     */
    public function show(Chiburi_Event $chiburi_Event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chiburi_Event $chiburi_Event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chiburi_Event $chiburi_Event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chiburi_Event $chiburi_Event)
    {
        //
    }
}
