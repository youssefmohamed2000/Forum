<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReplyRequest;
use App\Models\Discussion;
use App\Models\Like;
use App\Models\Reply;
use App\Notifications\NewReplyAdded;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    public function store(StoreReplyRequest $request, $id)
    {
        $discussion = Discussion::query()->findOrFail($id);
        $validated = $request->safe();
        $reply = Reply::query()->create([
            'user_id' => auth()->user()->id,
            'discussion_id' => $id,
            'content' => $validated['content'],
        ]);
        $user_of_discussion = $discussion->user;
        if ($user_of_discussion->id !== $reply->user_id) {
            $user_of_discussion->notify(new NewReplyAdded($discussion->slug));
        }
        session()->flash('success', 'Reply Added Successfully');
        return redirect()->back();
    }

    public function edit($id)
    {
        $reply = Reply::query()->findOrFail($id);
        return view('replies.edit' , compact('reply'));
    }

    public function update(StoreReplyRequest $request , $id)
    {
        $reply = Reply::query()->findOrFail($id);
        $validated = $request->safe();
        $reply->update([
            'content' => $validated['content']
        ]);
        session()->flash('success', 'Reply Updated Successfully');
        return redirect()->route('discussions.show',$reply->discussion->slug);
    }

    public function like($id)
    {
        $reply = Reply::query()->findOrFail($id);
        Like::query()->create([
            'user_id' => auth()->user()->id,
            'reply_id' => $id
        ]);
        return redirect()->back();
    }

    public function unlike($id)
    {
        Like::query()->where('reply_id', $id)
            ->where('user_id', auth()->user()->id)
            ->firstOrFail()
            ->delete();
        return redirect()->back();
    }

    public function bestAnswer($id)
    {
        $reply = Reply::query()->findOrFail($id);
        $reply->update([
            'best_answer' => 1
        ]);
        return redirect()->back();
    }
}
