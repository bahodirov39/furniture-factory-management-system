<?php

use App\Http\Controllers\ActionsController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [PagesController::class, 'redirect'])->name('redirect');
Route::get('admin/{list_status?}', [PagesController::class, 'index'])->name('index');

Route::get('list/orders', [PagesController::class, 'order'])->name('order');
Route::post('order/add', [ActionsController::class, 'addUserAndOrder'])->name('add.order');
Route::get('list/users/{filter?}', [ActionsController::class, 'getUsers'])->name('get.users');
Route::get('list/archives/{list_status?}', [PagesController::class, 'getArchives'])->name('get.archives');

Route::put('change/status/{status_id}', [ActionsController::class, 'changeStatus'])->name('change.status');

// EDIT
Route::get('order/edit/{id}', [ActionsController::class, 'orderEdit'])->name('order.edit');
Route::put('order/update/{id}', [ActionsController::class, 'orderUpdate'])->name('order.update');

Route::delete('order/delete', [ActionsController::class, 'orderDelete'])->name('order.delete');
Route::delete('user/delete', [ActionsController::class, 'userDelete'])->name('user.delete');

Route::get('order/view/{id}', [PagesController::class, 'viewOrder'])->name('order.view');

Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

