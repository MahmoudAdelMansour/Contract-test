<?php

use App\Http\Controllers\ContractController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Models\Contract;
use App\Models\Room;
use Illuminate\Support\Facades\Route;

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

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'rooms' , 'as' => 'rooms.','middleware' => 'auth'], function()
    {

    Route::get('index',[RoomController::class,'index'])->name('index');
    Route::get('edit/{room}',[RoomController::class,'edit'])->name('edit');
    Route::get('create',[RoomController::class,'create'])->name('create');
    Route::post('store',[RoomController::class,'store'])->name('store');
    Route::patch('update/{room}',[RoomController::class,'update'])->name('update');
    Route::delete('delete/{room}',[RoomController::class,'destroy'])->name('destroy');

});
Route::group(['prefix' => 'contracts' , 'as' => 'contracts.','middleware' => 'auth'], function()
    {

    Route::get('index/{room}',[ContractController::class,'index'])->name('index');;
    Route::get('join/{room}',[ContractController::class,'join'])->name('join');;
    Route::get('edit/{contract}',[ContractController::class,'edit'])->name('edit');;
    Route::get('create/{room}',[ContractController::class,'create'])->name('create');;
    Route::post('store/{room}',[ContractController::class,'store'])->name('store');;
    Route::patch('update/{contract}',[ContractController::class,'update'])->name('update');;
    Route::delete('delete/{contract}',[ContractController::class,'destroy'])->name('destroy');;


});
