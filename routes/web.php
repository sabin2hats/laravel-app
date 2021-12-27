<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\Document;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use App\Models\Post;
use App\Models\User;

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

Route::get('test/', function () {
    return view('test');
});

Route::get('post/', function () {
    $posts = Post::all();

    return view('posts', ['posts' => $posts]);
});

Route::get('post/{post}', function ($slug) {

    return view(
        'post',
        [
            'post' => Post::find($slug)
        ]
    );
})->where('post', '[A-z_\-]+');

Route::get('blog/', [BlogController::class, 'index'])->name('blog');

Route::get('blog/{blog}', [BlogController::class, 'show'])->where('post', '[A-z_\-]+');

// Route::get('categories/{category:name}', function (Category $category) {

//     return view(
//         'posts',
//         [
//             'posts' => $category->posts,
//             'categories' => Category::all(),
//             'currentCategory' => $category
//         ]
//     );
// });

// Route::get('authors/{user}', function (User $user) {
//     // ->load(['category', 'user']) to avoid clockwork
//     return view('posts', ['posts' => $user->posts, 'categories' => Category::all()]);
// });
Route::get('register/', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register/', [RegisterController::class, 'store'])->middleware('guest');
Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');
Route::post('posts/{post:id}/comments', [CommentController::class, 'store']);
