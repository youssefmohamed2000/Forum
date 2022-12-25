<?php

namespace App\Http\Livewire;

use JetBrains\PhpStorm\NoReturn;
use Livewire\Component;

class Notifications extends Component
{

    public function markAllAsRead()
    {
        dd('sfsa');
        auth()->user()->unreadNotifications->markAsRead();
    }

    // render
    public function render()
    {
        return view('livewire.notifications', ['notifications' => auth()->user()->un]);
    }// end of render
}
