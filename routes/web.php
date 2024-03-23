<?php
use App\Http\Controllers\ProfileController;//9.43.x~
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\BookController; //Add
use App\Http\Controllers\LocalController; 
use App\Http\Controllers\ChiburiEventController; 
use App\Models\Book; //Add
use App\Models\Local; //

// 最初のページへのアクセス
Route::get('/first', function () {
    return view('firstPage');
});

// 知夫里島ページへのアクセス
Route::get('/chiburi', function () {
    return view('chiburi');
});

// 知夫里島への訪問方法ページ
Route::get('/chiburi_Access', [LocalController::class,'index'])->middleware(['auth'])->name('chiburi_Access');

// ローカル情報表示
Route::get('/local', [LocalController::class,'index'])->middleware(['auth'])->name('local_index');
// ローカル情報保存
Route::post('/local_store', [LocalController::class,'store'])->name('local_store');


//★イベント登録★

//イベント一覧へ
Route::get('/chibu_event', [ChiburiEventController::class,'index'])->middleware(['auth'])->name('chibu_event_index');
Route::get('/chibu_dashboard', [ChiburiEventController::class,'index'])->middleware(['auth'])->name('chibu_event_dashboard');

//イベント全部表示
Route::get('/chibu_event2', [ChiburiEventController::class,'index2'])->middleware(['auth'])->name('chibu_event_index2');

//イベント追加
Route::post('/chibu_events',[ChiburiEventController::class,"store"])->name('chibu_events_store');

//本：削除 
Route::delete('/chibu_event/{chibu_event}', [ChiburiEventController::class,"destroy"])->name('book_destroy');

//本：更新画面
Route::post('/chibu_event_edit/{chibu_event}',[ChiburiEventController::class,"edit"])->name('book_edit'); //通常
Route::get('/chibu_event/{chibu_event}', [ChiburiEventController::class,"edit"])->name('edit');      //Validationエラーありの場合

//本：更新画面
Route::post('/chibu_event/update',[ChiburiEventController::class,"update"])->name('book_update');


















//本：ダッシュボード表示：個人情報(books.blade.php)
Route::get('/', [BookController::class,'index'])->middleware(['auth'])->name('book_index');
Route::get('/dashboard', [BookController::class,'index'])->middleware(['auth'])->name('dashboard');

//本：ダッシュボード表示：全体情報(books.blade.php)
Route::get('/index2', [BookController::class,'index2'])->middleware(['auth'])->name('book_index');

//本：追加 
Route::post('/books',[BookController::class,"store"])->name('book_store');

//本：削除 
Route::delete('/book/{book}', [BookController::class,"destroy"])->name('book_destroy');

//本：更新画面
Route::post('/booksedit/{book}',[BookController::class,"edit"])->name('book_edit'); //通常
Route::get('/booksedit/{book}', [BookController::class,"edit"])->name('edit');      //Validationエラーありの場合

//本：更新画面
Route::post('/books/update',[BookController::class,"update"])->name('book_update');

/**
* 「ログイン機能」インストールで追加されています 
*/
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';