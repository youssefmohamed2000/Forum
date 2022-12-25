<?php

namespace App\Notifications;

use App\Models\Discussion;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewReplyAdded extends Notification
{
    use Queueable;

    private $discussion_id;

    public function __construct($discussion_id)
    {
        $this->discussion_id = $discussion_id;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'user_name' => auth()->user()->name,
            'subject' => 'replied to your discussion',
            'discussion_id' => $this->discussion_id
        ];
    }
}
