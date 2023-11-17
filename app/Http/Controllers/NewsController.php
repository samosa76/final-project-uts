<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    /**
     * Constructor
     */
    public $news;
    public function __construct() 
    {
        $this->news = new News;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::all();

        $data = 
        [
            'message' => 'showing all news',
            'data' => $news
        ];

        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = 
        [
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'content' => $request->content,
            'url' => $request->url,
            'url_image' => $request->url_image,
            'category' => $request->category,
        ];

        $news = News::create($input);

        $data = 
        [
            'message' => 'News is created',
            'data' => $news
        ];

        return response()->json($data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $news = News::where('id',$id)->get();

        $data = 
        [
            'message' => 'showing selected news',
            'data' => $news
        ];

        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $news->update(
            [
                'title' => $request->get('title'),
                'author' => $request->get('author'),
                'description' => $request->get('description'),
                'content' => $request->get('content'),
                'url' => $request->get('url'),
                'url_image' => $request->get('url_image'),
                'category' => $request->get('category')
            ]
            );
        return response()->json(
            [
                'data' => $news,
                'message' => 'news updated successfully',
                'success' => true
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {

        $news->delete();

        $data = 
        [
            'message' => 'student has been remove',
            'data' => [],
            'success' => true
        ];

        //mengembalikan response sebagai json
        return response()->json($data, 204);
    }
    public function search($title)
    {
        $news = News::where('title','like',"%$title%")->get();

        $data = 
        [
            'message' => 'showing selected news by title',
            'data' => $news
        ];

        //mengembalikan response sebagai json
        return response()->json($data, 200);
    }

    public function category($category)
    {
        //mengambil data berdasarkan kategori 
        $news = News::where('category', $category)->get();

        //membuat message dan memasukan data yang diambil kedalam message
        $data =
        [
            'message' => 'showing selected news by title',
            'data' => $news
        ];

        //mengembalikan response sebagai json
        return response()->json($data, 200);
    }
}
