<?php

namespace App\Http\Livewire;

use App\Models\Channel;
use App\Models\Discussion;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // PROPERTIES
    public $discussion_type, $channel_name; // displaying on blade
    public $type, $channel_id; // for query

    // LIFE CYCLE FUNCTIONS
    public function mount()
    {
        $this->discussion_type = 'All Discussions';
    }

    public function dehydrateType()
    {
        $this->resetPage();
    }

    // FUNCTIONS

    public function discussionType($type = null)
    {
        if ($type == 'my_discussions') {
            $this->discussion_type = 'My Discussions';
            $this->type = $type;
        } else if ($type == 'answered_discussions') {
            $this->discussion_type = 'Answered Discussions';
            $this->type = $type;
        } else if ($type == 'my_following') {
            $this->discussion_type = 'My Following';
            $this->type = $type;
        } else {
            $this->discussion_type = 'All Discussions';
            $this->type = null;
        }
        $this->channel_id = null;
        $this->channel_name = null;
    }

    public function discussionChannel($channel_id)
    {
        $this->channel_id = $channel_id;
        $this->channel_name = Channel::query()->find($channel_id)->title;
        $this->type = null;
    }

    // RENDER

    public function render()
    {
        //dd($this->type, $this->channel_id);
        return view('livewire.home',
            ['discussions' => Discussion::whenType($this->type)
                ->WhenChannelId($this->channel_id)
                ->paginate(5)
            ]
        )
            ->extends('layouts.app')
            ->section('content');
    }
}
