<?php

namespace App\Http\Livewire\Discussions;

use App\Models\Channel;
use App\Models\Discussion;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class EditDiscussion extends Component
{
    use AuthorizesRequests;

    public $discussion, $content;

    // LIFE CYCLE
    public function mount($id)
    {
        $this->discussion = Discussion::query()->findOrFail($id);
        $this->content = $this->discussion->content;
        $this->channels = Channel::all();
    }

    // VALIDATION
    protected $rules = [
        'content' => 'required|string'
    ];

    // FUNCTION
    public function update()
    {
        $this->authorize('update', $this->discussion);

        $validated = $this->validate();

        $this->discussion->update($validated);

        session()->flash('message', 'Discussion successfully updated.');

    }

    public function render()
    {
        return view('livewire.discussions.edit-discussion')
            ->extends('layouts.app')
            ->section('content');
    }
}
