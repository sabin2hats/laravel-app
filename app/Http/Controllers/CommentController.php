<?php

namespace App\Http\Controllers;

use App\Models\Blog;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Blog $post)
    {
        request()->validate([
            'body' => 'required'
        ]);
        $post->comments()->create([
            'user_id' => request()->user()->id,
            'body' => request('body')
        ]);
        return back();
    }
}
