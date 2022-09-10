<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Front\CustomerController;
use App\Http\Controllers\Front\FrontCommentController;
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
    return view('front.index');
});
Route::get('/', [CustomerController::class,'index']);
Route::get('/getPostByCategory/{category_id}', [CustomerController::class,'getPostByCategory']);
Route::get('/detail/{id}', [CustomerController::class,'detail']);
Route::post('/comment/{post_id}',[FrontCommentController::class,'comment'])->name('comment');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('check-level');

Route::middleware(['auth'])->group(function(){
    Route::prefix('admin')->group(function(){
        Route::get('/users', [UserController::class,'index'])->middleware('check:list_user');
        Route::get('/users/create', [UserController::class,'create'])->middleware('check:add_user');
        Route::post('/users/store', [UserController::class,'store'])->middleware('check:add_user');
        Route::get('/users/edit/{id}', [UserController::class,'edit'])->middleware('check:edit_user');
        Route::post('/users/update/{id}', [UserController::class,'update'])->middleware('check:edit_user');
        Route::delete('/users/delete/{id}', [UserController::class,'destroy'])->middleware('check:delete_user');

        Route::prefix('roles')->group(function(){
            Route::get('/', [RoleController::class,'index'])->name('role.index')->middleware('check:list_role'); 
            Route::get('/create', [RoleController::class,'create'])->name('role.create')->middleware('check:add_role'); 
            Route::post('/store', [RoleController::class,'store'])->name('role.store')->middleware('check:add_role'); 
            Route::get('/edit/{id}', [RoleController::class,'edit'])->name('role.edit')->middleware('check:edit_role');
            Route::post('/update/{id}', [RoleController::class,'update'])->name('role.update')->middleware('check:edit_role');
            Route::delete('/delete/{id}', [RoleController::class,'destroy'])->name('role.delete')->middleware('check:delete_role'); 
        });

        Route::prefix('posts')->group(function(){
            Route::get('/', [PostController::class,'index']);
            Route::get('/create', [PostController::class,'create']); 
            Route::post('/store', [PostController::class,'store']); 
            Route::get('/edit/{id}', [PostController::class,'edit']);
            Route::post('/update/{id}', [PostController::class,'update']); 
            Route::delete('/delete/{id}', [PostController::class,'destroy'])->name('post.destroy'); 
        });
        Route::resource('/categories',CategoryController::class);

        Route::prefix('comments')->group(function(){
            Route::get('/', [CommentController::class,'index']);
            Route::delete('/delete/{id}', [CommentController::class,'destroy']);
            Route::get('/soft-trash', [CommentController::class,'soft_trash']);
            Route::post('/restore/{id}', [CommentController::class,'untrash']);
        });
    });
});

