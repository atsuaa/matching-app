<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Models\Message;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    const SEARCH_KEY = 'message.search';

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, int $thread_id)
    {
        $threadEntity = Thread::find($thread_id);
        $param = $request->session()->get(self::SEARCH_KEY) ?? [];
        $query = $threadEntity->messages();
        if (isset($param['message'])) {
            $query->where('message', 'like', '%' . $param['message'] . '%');
        }
        $entities = $query->paginate(15);

        return view('message.index', [
            'threadEntity' => $threadEntity,
            'entities' => $entities,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMessageRequest $request, int $thread_id)
    {
        try {
            $entity = new Message();
            $data = $request->validated();
            $entity->thread_id = $thread_id;
            $entity->from_user_id = $request->user()->id;
            $entity->to_user_id = $data['to_user_id'];
            $entity->message = $data['message'];
            $entity->save();
            session()->flash('flash.success', config('message.store.success'));
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
            session()->flash('flash.error', config('message.store.fail'));
        }

        return redirect(route('message.index', ['thread_id' => $thread_id]));
    }
}
