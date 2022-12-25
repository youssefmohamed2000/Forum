<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class HomeController extends Controller
{

    public function index()
    {
        // $discussions = Discussion::query()->paginate(5);
        // $discussions = Discussion::whenType(\request()->get('type'))->paginate(5);
        return view('home');
    }

    /*    public function myDiscussions()
        {
            $discussions = Discussion::query()->where('user_id', auth()->user()->id)->paginate(5);
            return view('home', compact('discussions'));
        }

        public function answeredDiscussions()
        {
            $all_discussions = Discussion::all();
            $discussions = array();
            foreach ($all_discussions as $discussion) {
                if ($discussion->hasBestAnswer()) {
                    array_push($discussions, $discussion);
                }
            }
            $discussions = $this->paginate($discussions, 2, null, 'answered-discussions');
            return view('home', compact('discussions'));
        }

        public function myFollowing()
        {
            $discussions = [];
            foreach (auth()->user()->followers as $x) {
                $discussions[] = $x->discussion;
            }
            $discussions = $this->paginate($discussions, 1, null, 'my-following');
            return view('home', compact('discussions'));
        }

        public function paginate($items, $perPage = 1, $page = null, $path)
        {
            $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
            $total = count($items);
            $current_page = $page;
            $offset = ($current_page * $perPage) - $perPage;
            $items_to_show = array_slice($items, $offset, $perPage);
            //dd($items_to_show);
            return new LengthAwarePaginator($items_to_show, $total, $perPage, 0, ['path' => $path]);
        }*/
}
