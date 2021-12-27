<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $with = ['category', 'user'];
    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['search'])) {
            $query->when(
                $filters['search'],
                fn ($query, $search) =>
                $query->where(
                    fn ($query) =>
                    $query
                        ->where('title', 'like', '%' . $search . '%')
                        ->orWhere('body', 'like', '%' . $search . '%')
                )
            );
        }
        if (isset($filters['category'])) {
            $query->when(
                $filters['category'],
                fn ($query, $category) =>
                $query
                    ->whereHas(
                        'category',
                        fn ($query) =>
                        $query->where('name', $category)
                    )
            );
        }
        if (isset($filters['author'])) {
            $query->when(
                $filters['author'],
                fn ($query, $author) =>
                $query
                    ->whereHas(
                        'user',
                        fn ($query) =>
                        $query->where('id', $author)
                    )
            );
        }
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    // public function author()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
}
