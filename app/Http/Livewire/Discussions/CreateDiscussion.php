<?php

namespace App\Http\Livewire\Discussions;

use App\Models\Channel;
use App\Models\Discussion;
use Livewire\Component;

class CreateDiscussion extends Component
{
    public $title, $channel_id, $content, $channels;

    // LIFE CYCLE
    public function mount()
    {
        $this->channels = Channel::all();
    }

    // VALIDATION
    protected $rules = [
        'title' => 'required|string|max:255',
        'channel_id' => 'required|exists:channels,id',
        'content' => 'required|string'
    ];

    // FUNCTION
    public function createDiscussion()
    {
        $validated = $this->validate();

        $validated = array_merge($validated, [
            'user_id' => auth()->user()->id
        ]);

        Discussion::query()->create($validated);

        $this->reset('title', 'content', 'channel_id');

        session()->flash('message', 'Discussion successfully created.');

    } // end of createDiscussion

    //RENDER
    public function render()
    {
        //dd($this->title, $this->channel_id, $this->content);
        return view('livewire.discussions.create-discussion')
            ->extends('layouts.app')
            ->section('content');
    } // end of render
}
