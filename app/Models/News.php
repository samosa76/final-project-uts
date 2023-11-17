<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'author', 'description', 'content', 'url', 'url_image', 'category'];
    public $timestamps = true;

    public function getAllNews()
    {
        $news = DB::select('select * form news');
        return $news;
    }
}
