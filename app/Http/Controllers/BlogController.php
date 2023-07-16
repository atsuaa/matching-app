<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchBlogRequest;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    const SEARCH_KEY = 'blog.search';

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $param = $request->session()->get(self::SEARCH_KEY) ?? [];
        $query = Blog::query();
        if (isset($param['title'])) {
            $query->where('title', 'like', '%' . $param['title'] . '%');
        }
        if (isset($param['published'])) {
            $query->whereIn('published', $param['published']);
        }
        $blogs = $query->get();
        return view('blog.index', [
            'param' => $param,
            'blogs' => $blogs,
        ]);
    }

    /**
     * 検索
     */
    public function search(SearchBlogRequest $request)
    {
        $request->session()->put(self::SEARCH_KEY, $request->validated() ?? []);
        return redirect(route('blog.index'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blog.create', ['blog' => null]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        $blog = new Blog();
        $data = $request->validated();
        $blog->user_id = $request->user()->id;
        $blog->title = $data['title'];
        $blog->body = $data['body'];
        $blog->published = $data['published'];
        $blog->save();

        return redirect(route('blog.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $blog = Blog::find($id);
        if (is_null($blog)) {
            return redirect(route('blog.index'));
        }

        return view('blog.show', [
            'blog' => $blog,
            'id' => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $blog = Blog::find($id);
        if (is_null($blog)) {
            return redirect(route('blog.index'));
        }

        return view('blog.edit', [
            'blog' => $blog,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, int $id)
    {
        $blog = Blog::find($id);
        $data = $request->validated();
        $blog->title = $data['title'];
        $blog->body = $data['body'];
        $blog->published = $data['published'];
        $blog->save();

        return redirect(route('blog.show', ['id' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $blog = Blog::find($id);
        if (is_null($blog)) {
            return redirect(route('blog.index'));
        }
        $blog->delete();

        return redirect(route('blog.index'));
    }
}
