<?php

namespace App\Policies;

use App\Models\Discussion;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiscussionPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Discussion $discussion)
    {
        return $user->id == $discussion->user_id;
    } // end of update

    public function delete(User $user, Discussion $discussion)
    {
        return $user->id == $discussion->user_id;
    } // end of delete

    public function follow(User $user, Discussion $discussion)
    {
        return $user->id != $discussion->user_id;
    } // end of follow


}
