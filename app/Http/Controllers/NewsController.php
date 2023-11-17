<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Validator;

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

        if ($news->isEmpty()) {
            return response()->json(['message' => 'No data available'], 200);
        }

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

        $validator = Validator::make($request->all(),
        [
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'content' => 'required|min:3|max:1000',
            'url' => 'required',
            'url_image' => 'required',
            'category' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                ['error' => $validator->errors()],400);
        }

        /* 
        $validated = $request->validated(
            [
                'title' => 'required',
                'author' => 'required',
                'description' => 'required',
                'content' => 'required|min:3|max:1000',
                'url' => 'required',
                'url_image' => 'required',
                'category' => 'required',
            ]
        );

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
        */

        $data = $request->all();
        $news = News::create($data);

        return response()->json($news, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $news = News::find($id);

        if (!$news) {
            return response()->json(['error' => 'Data not found'],404);
        }

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
    public function update(Request $request, $id)
    {

        $news = News::find($id);

        if (!$news) {
            return response()->json(['error' => 'Data not found'],404);
        }

        $news->update($request->only(['title','author','description','content','url','url_image','category']));

        // $news->update(
        //     [
        //         'title' => $request->get('title'),
        //         'author' => $request->get('author'),
        //         'description' => $request->get('description'),
        //         'content' => $request->get('content'),
        //         'url' => $request->get('url'),
        //         'url_image' => $request->get('url_image'),
        //         'category' => $request->get('category')
        //     ]);

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
    public function destroy($id)
    {

        $news = News::find($id);

        if (!$news) {
            return response()->json(['error' => 'Data not found'],404);
        }

        $news->delete();
        
        //mengembalikan response sebagai json
        return response()->json(['message' => 'Data has been deleted'], 200);
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
