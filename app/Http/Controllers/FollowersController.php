<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\Follower;
use Illuminate\Http\Request;

class FollowersController extends Controller
{
    public function follow($id)
    {
        $discussion = Discussion::query()->findOrFail($id);
        Follower::query()->create([
            'user_id' => auth()->user()->id,
            'discussion_id' => $id
        ]);
        session()->flash('success', 'You are following this discussion');
        return redirect()->back();
    }

    public function unfollow($id)
    {
        Follower::query()->where('discussion_id', $id)
            ->where('user_id', auth()->user()->id)
            ->firstOrFail()
            ->delete();

        session()->flash('success', 'You are unfollow this discussion');
        return redirect()->back();
    }
}
