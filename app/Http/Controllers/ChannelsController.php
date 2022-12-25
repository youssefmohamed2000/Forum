<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChannelRequest;
use App\Http\Requests\UpdateChannelRequest;
use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChannelsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'admin'])->except('show');
    }

    public function index()
    {
        $channels = Channel::all();
        return view('channels.index', compact('channels'));
    }


    public function create()
    {
        return view('channels.create');
    }

    public function store(StoreChannelRequest $request)
    {
        $validated = $request->safe();
        Channel::query()->create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title'])
        ]);
        session()->flash('success', 'Channel Created Successfully');
        return redirect()->route('channels.index');
    }

    public function show($slug)
    {
        $channel = Channel::query()->where('slug', $slug)->firstOrFail();
        $discussions = $channel->discussions()->paginate(3);
        return view('channels.show', compact('discussions', 'channel'));
    }

    public function edit($slug)
    {
        $channel = Channel::query()->where('slug', $slug)->firstOrFail();
        return view('channels.edit', compact('channel'));
    }

    public function update(UpdateChannelRequest $request, $slug)
    {
        $channel = Channel::query()->where('slug', $slug)->firstOrFail();
        $validated = $request->safe();
        $channel->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title'])
        ]);
        session()->flash('success', 'Channel Updated Successfully');
        return redirect()->route('channels.index');
    }

    public function destroy($slug)
    {
        $channel = Channel::query()->where('slug', $slug)->firstOrFail()->delete();
        session()->flash('success', 'Channel Deleted Successfully');
        return redirect()->route('channels.index');
    }
}
