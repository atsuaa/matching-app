<?php

namespace App\Http\Controllers;

use App\Http\Requests\FavoriteUserRequest;
use App\Http\Requests\SearchUserRequest;
use App\Models\User;
use App\Models\UserFavorite;
use Illuminate\Http\Request;

class UserController extends Controller
{
    const SEARCH_KEY = 'user.search';

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $param = $request->session()->get(self::SEARCH_KEY) ?? [];
        $query = User::query();
        $query->whereNot('id', $request->user()->id);
        if (isset($param['name'])) {
            $query->where('name', 'like', '%' . $param['name'] . '%');
        }
        $entities = $query->paginate(15);
        return view('user.index', [
            'param' => $param,
            'entities' => $entities,
        ]);
    }

    /**
     * 検索
     */
    public function search(SearchUserRequest $request)
    {
        $request->session()->put(self::SEARCH_KEY, $request->validated() ?? []);
        return redirect(route('user.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, int $id)
    {
        $entity = User::find($id);
        if (is_null($entity)) {
            return redirect(route('user.index'));
        }

        $FavariteUserEntity = UserFavorite::query()
            ->where('user_id', $request->user()->id)
            ->where('favorite_user_id', $id)
            ->first();

        return view('user.show', [
            'entity' => $entity,
            'id' => $id,
            'isFavoritedUser' => is_null($FavariteUserEntity) ? 0 : 1,
        ]);
    }

    /**
     * お気に入り
     */
    public function favorite(FavoriteUserRequest $request, int $id)
    {
        $data = $request->validated();

        $result = $this->favoriteUserService($data, $request, $id);

        if ($result === 1) {
            session()->flash('flash.success', config('message.favorite.success'));
        } else {
            session()->flash('flash.success', config('message.unfavorite.success'));
        }

        return response()->json([
            'data' => [
                'is_favorite' => $result,
            ],
        ]);
    }

    private function favoriteUserService($data, $request, $id)
    {
        if ($data['favorite'] == 1) {
            $entity = UserFavorite::query()
                ->where('user_id', $request->user()->id)
                ->where('favorite_user_id', $id)
                ->first();

            if (is_null($entity)) {
                $entity = new UserFavorite();
                $entity->user_id = $request->user()->id;
                $entity->favorite_user_id = $id;
                $entity->save();
            }
            return 1;
        }

        $entity = UserFavorite::query()
            ->where('user_id', $request->user()->id)
            ->where('favorite_user_id', $id)
            ->first();

        if ($entity) {
            $entity->delete();
        }
        return 0;
    }
}
