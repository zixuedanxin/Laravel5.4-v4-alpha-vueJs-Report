<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::resource('/cards', 'CardController');
Route::get('/', 'HomeController@index')->name('home');


// WEB API GET
Route::get('/api/cards', function(){
  return App\Card::with('user')->get();
})->middleware('auth');

Route::get('/api/card/{id}', function($id){
  $card = App\Card::with('user')->find($id);
  return $card;
})->where('id', '[0-9]+')->middleware('auth');

Route::get('/api/card/run/{id}', function($id){
  if ($id) {
    try {
      $card = App\Card::with('user')->find($id);
      return DB::connection('reports')->select($card->query);
    } catch(\Illuminate\Database\QueryException $ex){
      return response(['error_message'=>$ex->getMessage()], 400)
                 ->header('Content-Type', 'text/plain');
    }
  }else{
    return [];
  }
})->middleware('auth');

// WEB API POST
Route::post('/api/run/query', function(Request $request){
  if ($request->input('query')) {
    try {
      return DB::connection('reports')->select($request->input('query'));
    } catch(\Illuminate\Database\QueryException $ex){
      return response(['error_message'=>$ex->getMessage()], 400)
                 ->header('Content-Type', 'text/plain');
    }
  }else{
    return [];
  }
})->middleware('auth');

Route::post('/api/card', function(Request $request){
  $card = new App\Card;
  $card->title = $request->input('card.title');
  $card->description = $request->input('card.description');
  $card->query = '';
  $card->user_id = Auth::id();
  $card->save();
  return App\Card::with('user')->find($card->id);
})->middleware('auth');

// WEB API PUT
Route::put('/api/save', function(Request $request){
  $card =  App\Card::with('user')->find($request->input('card.id'));
  $card->title = $request->input('card.title');
  $card->description = $request->input('card.description');
  $card->query = $request->input('card.query');
  $card->user_id = Auth::id();
  $card->save();

  if ($card->query) {
    try {
      return DB::connection('reports')->select($card->query);
    } catch(\Illuminate\Database\QueryException $ex){
      return response(['error_message'=>$ex->getMessage()], 400)
                 ->header('Content-Type', 'text/plain');
    }
  }else{
    return [];
  }
})->middleware('auth');

// WEB API DELETE
Route::delete('/api/card/{id}', function($id){
  $card = App\Card::find($id);
  $card->delete();
  return ['message' => 'Card has been deleted.'];
})->where('id', '[0-9]+')->middleware('auth');
