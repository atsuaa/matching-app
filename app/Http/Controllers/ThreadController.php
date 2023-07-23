<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchBlogRequest;
use App\Models\Thread;
use App\Models\ThreadMember;
use App\Models\ThreadViewing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ThreadController extends Controller
{
    const SEARCH_KEY = 'thread.search';

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        /** @var User */
        $userEntity = $request->user();
        $query = $userEntity->threads();
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
    public function store(Request $request, int $userId)
    {
        try {
            $entity = DB::transaction(function () use ($request, $userId) {
                $entity = Thread::create();
                $threadMemberEntity = new ThreadMember();
                $threadMemberEntity->thread_id = $entity->id;
                $threadMemberEntity->user_id = $request->user()->id;
                if ($threadMemberEntity->save() === false) {
                    throw new \Exception("Error Processing Request");
                }
                $threadMemberEntity = new ThreadMember();
                $threadMemberEntity->thread_id = $entity->id;
                $threadMemberEntity->user_id = $userId;
                if ($threadMemberEntity->save() === false) {
                    throw new \Exception("Error Processing Request");
                }
                $threadViewingEntity = new ThreadViewing();
                $threadViewingEntity->thread_id = $entity->id;
                $threadViewingEntity->user_id = $request->user()->id;
                $threadViewingEntity->is_viewing = 1;
                if ($threadViewingEntity->save() === false) {
                    throw new \Exception("Error Processing Request");
                }

                return $entity;
            });
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
            session()->flash('flash.error', config('message.store.fail'));
        }

        return redirect(route('message.index', [
            'thread_id' => $entity->id,
        ]));
    }
}
