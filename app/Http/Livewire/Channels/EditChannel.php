<?php

namespace App\Http\Livewire\Channels;

use App\Models\Channel;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditChannel extends Component
{
    // prop
    public $channel, $title;

    //life cycle
    public function mount($id)
    {
        $this->channel = Channel::query()->findOrFail($id);
        $this->title = $this->channel->title;
    }// end of mount

    //func
    public function rules()
    {
        return [
            'title' => ['required', 'max:255', 'string',
                Rule::unique('channels', 'title')->ignore($this->channel, 'id')],
        ];
    }// end of rules

    public function update()
    {
        $validated = $this->validate();

        $this->channel->update($validated);

        session()->flash('message', 'Channel successfully updated');
    } // end of update

    // render
    public function render()
    {
        return view('livewire.channels.edit-channel')
            ->extends('layouts.app')
            ->section('content');
    } // end of render
}
