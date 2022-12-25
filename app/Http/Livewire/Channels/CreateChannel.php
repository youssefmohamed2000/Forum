<?php

namespace App\Http\Livewire\Channels;

use App\Models\Channel;
use Livewire\Component;

class CreateChannel extends Component
{
    // prop
    public $title;

    protected $rules = [
        'title' => 'required|string|max:255|unique:channels,title'
    ];

    // func
    public function create()
    {
        $validated = $this->validate();

        Channel::query()->create($validated);

        $this->reset('title');

        session()->flash('message', 'Channel successfully created');

    }

    // render
    public function render()
    {
        return view('livewire.channels.create-channel')
            ->extends('layouts.app')
            ->section('content');
    } // end of render
}
