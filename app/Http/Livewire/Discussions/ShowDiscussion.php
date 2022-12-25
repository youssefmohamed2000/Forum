<?php

namespace App\Http\Livewire\Discussions;

use App\Models\Discussion;
use App\Models\Follower;
use App\Models\Like;
use App\Models\Reply;
use App\Notifications\NewReplyAdded;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class ShowDiscussion extends Component
{
    use AuthorizesRequests;

    public $discussion, $best_answer, $reply_content;

    // LIFE CYCLE
    public function mount($id)
    {
        $this->discussion = Discussion::with('replies')->findOrFail($id);
        if ($this->discussion->hasBestAnswer()) {
            $this->best_answer = $this->discussion->replies()->where('best_answer', 1)->first();
        }
    }

    // FUNCTION

    public function like($reply_id)
    {
        $reply = Reply::query()->findOrFail($reply_id);
        Like::query()->create([
            'user_id' => auth()->user()->id,
            'reply_id' => $reply_id
        ]);
    } // end of like

    public function unlike($reply_id)
    {
        Like::query()->where('reply_id', $reply_id)
            ->where('user_id', auth()->user()->id)
            ->firstOrFail()
            ->delete();
    } // end of unlike

    public function makeBestAnswer($reply_id)
    {
        $reply = Reply::query()->findOrFail($reply_id);
        $reply->update([
            'best_answer' => 1
        ]);
        $this->mount($this->discussion->id);
    } // end of bestAnswer

    public function follow()
    {
        Follower::query()->create([
            'user_id' => auth()->user()->id,
            'discussion_id' => $this->discussion->id
        ]);

        $this->mount($this->discussion->id);

    }// end of follow

    public function unfollow()
    {
        Follower::query()->where('discussion_id', $this->discussion->id)
            ->where('user_id', auth()->user()->id)
            ->firstOrFail()
            ->delete();

        $this->mount($this->discussion->id);

    }// end of unfollow

    public function delete()
    {
        $this->authorize('delete', $this->discussion);

        $this->discussion->delete();

        return redirect()->route('home');
    } // end of delete

    public function addReply()
    {
        $validated = $this->validate([
            'reply_content' => 'required|string'
        ]);
        $reply = Reply::query()->create([
            'user_id' => auth()->user()->id,
            'discussion_id' => $this->discussion->id,
            'content' => $validated['reply_content'],
        ]);
        $user_of_discussion = $this->discussion->user;
        if ($user_of_discussion->id !== $reply->user_id) {
            $user_of_discussion->notify(new NewReplyAdded($this->discussion->id));
        }
        $this->reset('reply_content');
        session()->flash('message', 'Reply successfully added');
    } // end of addReply

    public function deleteReply(Reply $reply)
    {
        $reply->delete();

    } // end of deleteReply

    // RENDER
    public function render()
    {
        return view('livewire.discussions.show-discussion')
            ->extends('layouts.app')
            ->section('content');
    }
}
