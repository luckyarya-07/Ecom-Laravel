<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CoupanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UploadController;
use App\Http\Middleware\AdminAuth;

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
Route::get('admin/login', function () {
    return view('welcome');
});


Route::group(['middleware' => 'auth'], function(){
//    Route::get('/category',[CategoryController::class,'index'])->name('category');
//    Route::get('category/add-category',[CategoryController::class,'index']);
//    Route::post('category/store',[CategoryController::class,'store'])->name('category.store');
});

Route::group(['middleware' => 'admin'], function(){
    
Route::resource('category', CategoryController::class)->middleware('auth');
Route::resource('category', CategoryController::class)->only([
    'index', 'show'
])->middleware('auth');
Route::resource('category', CategoryController::class)->except([
    'create', 'store', 'update', 'destroy'
])->middleware('auth');
Route::resource('coupan', CoupanController::class)->middleware('auth');

Route::resource('product-category', ProductCategoryController::class)->middleware('auth');
Route::resource('product', ProductController::class)->middleware('auth');

Route::get('/user/account/name/{username}', function($username) {
    return view('profile/account');
})->name('username')->middleware('auth');

Route::post('upload',[UploadController::class,'store']);

});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin/dashboard');
})->name('dashboard');

