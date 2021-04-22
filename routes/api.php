<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    // Route::post('/refresh', [AuthController::class, 'refresh']);
    // Route::post('/user-profile', [AuthController::class, 'userProfile']);
});


// Route::middleware('auth:api')->group(function () {
//   Route::get('/home', [HomeController::class, 'home'])->name('home');
//   Route::get('/new', [HomeController::class, 'newOrder'])->name('new');
//   Route::post('/add_new', [HomeController::class, 'addNewOrder'])->name('addNewOrder');
//   Route::get('/remove/{id}', [HomeController::class, 'remove'])->name('remove');
//   Route::post('pending_orders', [HomeController::class, 'pendingOrders'])->name('pendingOrders');
//
//   Route::group(['prefix' => 'admin', 'middleware' => 'checkRole:api'], function () {
//     Route::get('/', [HomeController::class, 'adminPage'])->name('adminPage');
//     Route::get('/all', [HomeController::class, 'all'])->name('all');
//     Route::get('/order_done/{id}', [HomeController::class, 'orderDone'])->name('orderDone');
//
//     Route::group(['prefix' => 'edit'], function () {
//       Route::get('/bases', [HomeController::class, 'editBasesPage'])->name('editBasesPage');
//       Route::get('/condiments', [HomeController::class, 'editCondimentsPage'])->name('editCondimentsPage');
//       Route::get('/toppings', [HomeController::class, 'editToppingsPage'])->name('editToppingsPage');
//       Route::get('/delete_base/{id}', [HomeController::class, 'removeBase'])->name('removeBase');
//       Route::get('/delete_condiment/{id}', [HomeController::class, 'removeCondiment'])->name('removeCondiment');
//       Route::get('/delete_topping/{id}', [HomeController::class, 'removeTopping'])->name('removeTopping');
//       Route::post('/new_base', [HomeController::class, 'newBase'])->name('newBase');
//       Route::post('/new_condiment', [HomeController::class, 'newCondiment'])->name('newCondiment');
//       Route::post('/new_topping', [HomeController::class, 'newTopping'])->name('newTopping');
//     });
//
//   });
//
// });
