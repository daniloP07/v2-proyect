<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
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

Route::get('/dashboard', function () {
    return view('back.dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


// frontend pages 
Route::get('/', 'PageController@index')->name('home');
Route::get('/posts', 'PageController@posts')->name('posts');
Route::get('/posts/{post}', 'PageController@showPost')->name('posts.view');
Route::get('/category/{category}', 'PageController@showCategory')->name('categories.view');
//rutas de admin users

Route::get('admin/users', [UserController::class, 'index'])->name('admin.users.index');
Route::get('admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
Route::post('admin/users', [UserController::class, 'store'])->name('admin.users.store');
Route::get('admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
Route::put('admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
Route::delete('admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');


// admin pages 
Route::group(['prefix' => '/admin', 'middleware' => 'auth'], function () {
    Route::resource('posts','PostController');
    Route::resource('categories','CategoryController')->except('show');
});
Route::get('/categories/{categoryName}/posts', [CategoryController::class, 'showPostsByCategory'])->name('categories.posts');


