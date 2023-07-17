<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchBlogRequest;
use App\Models\Thread;
use App\Models\UserThread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ThreadController extends Controller
{
    const SEARCH_KEY = 'message.search';

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->user()->threads();
        $entities = $query->paginate(15);

        return view('thread.index', [
            'entities' => $entities,
        ]);
    }

    /**
     * 検索
     */
    public function search(SearchBlogRequest $request)
    {
        $request->session()->put(self::SEARCH_KEY, $request->validated() ?? []);
        return redirect(route('message.index'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, int $id)
    {
        try {
            $entity = Thread::create();
            $userThreadEntity = new UserThread();
            $userThreadEntity->user_id = $request->user()->id;
            $userThreadEntity->thread_id = $entity->id;
            $userThreadEntity->save();
            $userThreadEntity = new UserThread();
            $userThreadEntity->user_id = $id;
            $userThreadEntity->thread_id = $entity->id;
            $userThreadEntity->save();
            session()->flash('flash.success', config('message.store.success'));
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
            session()->flash('flash.error', config('message.store.fail'));
        }

        return redirect(route('message.index', [
            'thread_id' => $entity->id,
        ]));
    }
}
