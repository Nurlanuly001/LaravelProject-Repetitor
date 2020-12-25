<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use App\Models\Tag;
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
        $blogs = Blog::all();
        $cats = Category::all();

        return view('blogs.index', compact(['blogs', 'cats']));
    }

    public function blogsByCat(Category $category){
        $cats = Category::all();
        $blogs = Blog::where('category_id', $category->id)->get();

        return view('blogs.index', compact(['blogs', 'cats']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = Category::all();
        $tags = Tag::all();
        return view('blogs.create', compact(['cats', 'tags']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $blog = new Blog();
        $blog->title = $request->input('title');
        $blog->body = $request->input('body');
//        $blog->user_id = User::pluck('id')->random();
        $blog->user_id = $request->input('user_id');
        $blog->category_id = $request->input('category_id');

        $blog->save();

        $blog->tags()->sync($request->input('tag_id'));

        return redirect()->route('blogs.index')->with('success', "Your question has been saved");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return view('blogs.details', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $cats = Category::all();
        return view('blogs.edit', compact(['blog', 'cats']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $blog->update($request->only('title', 'body', 'category_id'));
        return redirect()->route('blogs.index')->with('success', "Your question has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {

        $blog->delete();
        return redirect()->route('blogs.index')->with('success', "Your question has been deleted");
    }
}
