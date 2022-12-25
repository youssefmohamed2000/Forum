<?php

namespace App\Http\Livewire\Channels;

use App\Models\Channel;
use Livewire\Component;
use Livewire\WithPagination;

class AllChannels extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // PROP

    // LIFECYCLE

    //FUNC
    public function delete(Channel $channel)
    {
        $channel->delete();
        session()->flash('message', 'Channel successfully deleted.');
    }


    // RENDER
    public function render()
    {
        return view('livewire.channels.all-channels', ['channels' => Channel::query()->paginate(5)])
            ->extends('layouts.app')
            ->section('content');
    } // end of render
}
