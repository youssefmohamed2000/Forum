<?php

namespace App\Http\Livewire\Replies;

use App\Models\Reply;
use Livewire\Component;

class EditReply extends Component
{
    //prop
    public $reply, $content;

    protected $rules = [
        'content' => 'required|string'
    ];

    // life cycle
    public function mount(Reply $reply)
    {
        $this->reply = $reply;
        $this->content = $this->reply->content;
    }// end of mount

    //func
    public function update()
    {
        $validated = $this->validate();

        $this->reply->update($validated);

        session()->flash('message', 'Reply successfully updated.');
    }// end of update

    //render
    public function render()
    {
        return view('livewire.replies.edit-reply')
            ->extends('layouts.app')
            ->section('content');
    }//end of render
}
