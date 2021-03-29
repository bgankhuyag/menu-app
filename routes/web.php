<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::middleware(['auth'])->group(function () {
  Route::get('/home', [HomeController::class, 'home'])->name('home');
  Route::get('/new', [HomeController::class, 'newOrder'])->name('new');
  Route::post('/add_new', [HomeController::class, 'addNewOrder'])->name('addNewOrder');
  Route::get('/remove/{id}', [HomeController::class, 'remove'])->name('remove');
  Route::get('/pending_orders', [HomeController::class, 'pendingOrders'])->name('pendingOrders');

  Route::group(['prefix' => 'admin', 'middleware' => 'checkRole'], function () {
    Route::get('/', [HomeController::class, 'adminPage'])->name('adminPage');
    Route::get('/all', [HomeController::class, 'all'])->name('all');
    Route::get('/order_done/{id}', [HomeController::class, 'orderDone'])->name('orderDone');

    Route::group(['prefix' => 'edit'], function () {
      Route::get('/bases', [HomeController::class, 'editBasesPage'])->name('editBasesPage');
      Route::get('/condiments', [HomeController::class, 'editCondimentsPage'])->name('editCondimentsPage');
      Route::get('/toppings', [HomeController::class, 'editToppingsPage'])->name('editToppingsPage');
      Route::get('/delete_base/{id}', [HomeController::class, 'removeBase'])->name('removeBase');
      Route::get('/delete_condiment/{id}', [HomeController::class, 'removeCondiment'])->name('removeCondiment');
      Route::get('/delete_topping/{id}', [HomeController::class, 'removeTopping'])->name('removeTopping');
      Route::post('/new_base', [HomeController::class, 'newBase'])->name('newBase');
      Route::post('/new_condiment', [HomeController::class, 'newCondiment'])->name('newCondiment');
      Route::post('/new_topping', [HomeController::class, 'newTopping'])->name('newTopping');
    });

  });

});


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
