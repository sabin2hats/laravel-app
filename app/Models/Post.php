<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Illuminate\Support\Collection;

use function PHPUnit\Framework\throwException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Post
{
    public $title;
    public $date;
    public $body;
    public $slug;
    public function __construct($title, $date, $body, $slug)
    {
        $this->title = $title;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }

    public static function all()
    {
        $files = File::files(resource_path("posts"));
        // dd($files);
        return collect($files)
            ->map(function ($file) {
                return YamlFrontMatter::parseFile($file);
            })
            ->map(function ($document) {
                return new Post(
                    $document->title,
                    $document->date,
                    $document->body(),
                    $document->slug,
                );
            })
            ->sortByDesc('date');
    }
    public static function find($slug)
    {
        $posts = static::all()->firstWhere('slug', $slug);
        if (!$posts) {
            throw new ModelNotFoundException();
        }
        return $posts;
    }
}
