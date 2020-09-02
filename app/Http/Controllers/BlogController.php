<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Http\Requests\BlogRequest;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            "data" => Blog::all()
        ], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        $request->validated();

        $blog = Blog::create([
            "title" => $request->title,
            "content" => $request->content,
            "published" => $request->published,
        ]);

        return response()->json([
            "data" => $blog
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        return response()->json([
            "data" => Blog::where('slug', $slug)->first()
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, $slug)
    {
        $request->validated();

        $blog = Blog::where('slug', $slug)->first();

        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->published = $request->published;
        $blog->save();

        return response()->json([
            "data" => $blog
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json([
            "data" => Blog::find($id)->delete()
        ], 200);
    }
}
