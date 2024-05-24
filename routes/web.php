<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware([CheckRole::class])->group(function(){
    Route::post('create', [BooksController::class, 'create'])->name('create');
    Route::get('delete', [BooksController::class, 'delete'])->name('delete');
    Route::get('edit', [BooksController::class, 'edit'])->name('edit');
    Route::post('update', [BooksController::class, 'update'])->name('update');
    Route::get('/', [BooksController::class, 'test'])->name('test');
    Route::get('list_user', [BooksController::class, 'chat'])->name('chat');
    Route::post('postMessage', [BooksController::class, 'postMessage'])->name('postMessage');
    Route::get('chatPrivate/{userId}', [BooksController::class, 'chatPrivate'])->name('chatPrivate');
    Route::post('messagePrivate/{userId}', [BooksController::class, 'messagePrivate'])->name('messagePrivate');


}) ;



Route::prefix('/')->group(function(){
    Route::get('index/{id?}', [BooksController::class, 'index'])->name('index');
    Route::get('cart', [BooksController::class, 'cart'])->name('cart');
    Route::get('loginreal', [BooksController::class, 'login'])->name('loginreal');
    Route::post('check_login', [BooksController::class, 'check_login'])->name('check_login');
    Route::post('change-to-cart', [BooksController::class, 'changetocart'])->name('change-to-cart');
    Route::get('detail', [BooksController::class, 'detail'])->name('detail');
    Route::post('display-to-cart', [BooksController::class, 'displaytocar'])->name('display-to-cart');
    Route::post('add-to-cart', [BooksController::class, 'addtocart'])->name('add-to-cart');
    Route::post('order', [BooksController::class, 'order'])->name('order');
    Route::post('check_oder', [BooksController::class, 'check_oder'])->name('check_oder');
    Route::get('list_order', [BooksController::class, 'list_order'])->name('list_order');
    Route::post('comment', [BooksController::class, 'comment'])->name('comment');
    Route::post('deletecomment', [BooksController::class, 'deletecomment'])->name('deletecomment');
    Route::get('logout', [BooksController::class, 'logout'])->name('logout');
    Route::get('signup', [BooksController::class, 'signup'])->name('signup');
    Route::post('check_signup', [BooksController::class, 'check_signup'])->name('check_signup');
    Route::get('create_acc', [BooksController::class, 'create_acc'])->name('create_acc');
    Route::get('list_acc', [BooksController::class, 'list_acc'])->name('list_acc');
    // Route::get('edit_acc', [BooksController::class, 'edit_acc'])->name('edit_acc');
    // Route::post('update_acc', [BooksController::class, 'update_acc'])->name('update_acc');
    Route::get('store', [BooksController::class, 'store'])->name('store');
    Route::post('infor', [BooksController::class, 'infor'])->name('infor');
    Route::post('check_like', [BooksController::class, 'check_like'])->name('check_like');
    Route::get('liked', [BooksController::class, 'liked'])->name('liked');
    Route::get('acc_comfirm', [BooksController::class, 'acc_comfirm'])->name('acc_comfirm');
    Route::post('comfirm_acc', [BooksController::class, 'comfirm_acc'])->name('comfirm_acc');
    Route::post('evalueat', [BooksController::class, 'evalueat'])->name('evalueat');
    Route::post('check_pass', [BooksController::class, 'check_pass'])->name('check_pass');
    Route::get('product_sold', [BooksController::class, 'product_sold'])->name('product_sold');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
