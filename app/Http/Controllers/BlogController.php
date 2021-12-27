<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Blog::latest()->filter(request(['search', 'category', 'author']))->paginate(6)->withQueryString();
        // $categories = Category::all();
        return view(
            'posts',
            [
                'posts' => $posts,
                // 'categories' => $categories,
                // 'currentCategory' => Category::firstWhere('name', request('category'))
            ]
        );
    }
    public function show(Blog $blog)
    {
        return view(
            'post',
            [
                'post' => $blog,
                // 'categories' => Category::all()
            ]
        );
    }
}
