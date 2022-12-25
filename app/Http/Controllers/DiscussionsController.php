<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDiscussionRequest;
use App\Http\Requests\StoreReplyRequest;
use App\Http\Requests\UpdateDiscussionRequest;
use App\Models\Channel;
use App\Models\Discussion;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DiscussionsController extends Controller
{

    public function create()
    {
        $channels = Channel::all();
        return view('discussions.create', compact('channels'));
    }

    public function store(StoreDiscussionRequest $request)
    {
        $validated = $request->safe();
        $discussion = Discussion::query()->create([
            'user_id' => auth()->user()->id,
            'channel_id' => $validated['channel_id'],
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'content' => $validated['content']
        ]);
        session()->flash('success', 'Discussion Created Successfully');
        return redirect()->route('discussions.show', $discussion->slug);
    }

    public function show($slug)
    {
        $discussion = Discussion::query()->where('slug', $slug)->firstOrFail();
        $best_answer = $discussion->replies()->where('best_answer', 1)->first();
        if (\request()->has('notification_id')) {
            DB::table('notifications')
                ->where('id', \request()->notification_id)
                ->update([
                    'read_at' => now()
                ]);
        }
        return view('discussions.show', compact('discussion', 'best_answer'));
    }

    public function edit($slug)
    {
        $discussion = Discussion::query()->where('slug', $slug)->firstOrFail();
        return view('discussions.edit', compact('discussion'));
    }

    public function update(UpdateDiscussionRequest $request, $slug)
    {
        $discussion = Discussion::query()->where('slug', $slug)->firstOrFail();
        $this->authorize('update', $discussion);
        $validated = $request->safe();
        $discussion->update([
            'content' => $validated['content']
        ]);
        session()->flash('success', 'Discussion Updated Successfully');
        return redirect()->route('discussions.show', $slug);
    }

    public function destroy($id)
    {
        $discussion = Discussion::query()->findOrFail($id);
        $this->authorize('delete', $discussion);
        $discussion->delete();
        session()->flash('success', 'Discussion has been deleted');
        return redirect()->route('myDiscussions');
    }

}
