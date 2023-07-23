<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Models\Message;
use App\Models\Thread;
use App\Models\ThreadViewing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            DB::transaction(function () use ($request, $thread_id) {
                $threadEntity = Thread::find($thread_id);
                if (is_null($threadEntity)) {
                    throw new \Exception("Error Processing Request");
                }
                $entity = new Message();
                $data = $request->validated();
                $entity->thread_id = $thread_id;
                $entity->from_user_id = $request->user()->id;
                $entity->to_user_id = $data['to_user_id'];
                $entity->message = $data['message'];
                if ($entity->save() === false) {
                    throw new \Exception("Error Processing Request");
                }
                if ($threadEntity->message_exist !== 1) {
                    $threadViewingEntity = new ThreadViewing();
                    $threadViewingEntity->thread_id = $thread_id;
                    $threadViewingEntity->user_id = $data['to_user_id'];
                    $threadViewingEntity->is_viewing = 1;
                    if ($threadViewingEntity->save() === false) {
                        throw new \Exception("Error Processing Request");
                    }
                }
            });
            session()->flash('flash.success', config('message.store.success'));
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
            session()->flash('flash.error', config('message.store.fail'));
        }

        return redirect(route('message.index', ['thread_id' => $thread_id]));
    }
}
