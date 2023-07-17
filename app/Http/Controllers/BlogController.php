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
        $entities = $query->paginate(15);
        return view('blog.index', [
            'param' => $param,
            'entities' => $entities,
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
        return view('blog.create', ['entity' => null]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        try {
            $entity = new Blog();
            $data = $request->validated();
            $entity->user_id = $request->user()->id;
            $entity->title = $data['title'];
            $entity->body = $data['body'];
            $entity->published = $data['published'];
            $entity->save();
            session()->flash('flash.success', config('message.store.success'));
        } catch (\Throwable $th) {
            session()->flash('flash.error', config('message.store.fail'));
        }

        return redirect(route('blog.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $entity = Blog::find($id);
        if (is_null($entity)) {
            return redirect(route('blog.index'));
        }

        return view('blog.show', [
            'entity' => $entity,
            'id' => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $entity = Blog::find($id);
        if (is_null($entity)) {
            return redirect(route('blog.index'));
        }

        return view('blog.edit', [
            'entity' => $entity,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, int $id)
    {
        try {
            $entity = Blog::find($id);
            $data = $request->validated();
            $entity->title = $data['title'];
            $entity->body = $data['body'];
            $entity->published = $data['published'];
            $entity->save();
            session()->flash('flash.success', config('message.update.success'));
        } catch (\Throwable $th) {
            session()->flash('flash.error', config('message.update.fail'));
        }

        return redirect(route('blog.show', ['id' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $entity = Blog::find($id);
            if (is_null($entity)) {
                return redirect(route('blog.index'));
            }
            $entity->delete();
            session()->flash('flash.success', config('message.delete.success'));
        } catch (\Throwable $th) {
            session()->flash('flash.error', config('message.delete.fail'));
        }

        return redirect(route('blog.index'));
    }
}
