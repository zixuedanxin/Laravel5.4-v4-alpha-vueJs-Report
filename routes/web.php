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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/cards', 'CardController');

Route::get('/api/cards', function(){
  return App\Card::with('user')->get();
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

Route::delete('/api/card/{id}', function($id){
  $card = App\Card::find($id);
  $card->delete();
  return ['message' => 'Card has been deleted.'];
})->where('id', '[0-9]+')->middleware('auth');
