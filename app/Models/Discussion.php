<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    use HasFactory;

    protected $table = 'discussions';

    protected $fillable = [
        'user_id', 'channel_id', 'title', 'slug', 'content',
    ];

    // RELATIONS

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function followers()
    {
        return $this->hasMany(Follower::class);
    }

    //SCOPES

    public function scopeWhenType($query, $type)
    {
        return $query->when($type, function ($q) use ($type) {
            if ($type == 'my_discussions') {
                return $q->where('user_id', auth()->user()->id);
            } else if ($type == 'answered_discussions') {
                return $q->whereHas('replies', function ($qu) {
                    return $qu->where('replies.best_answer', '1');
                });
            } else if ($type == 'my_following') {
                return $q->whereHas('followers', function ($qu) {
                    return $qu->where('followers.user_id', auth()->user()->id);
                });
            }
        });
    }

    public function scopeWhenChannelId($query, $channel_id)
    {
        return $query->when($channel_id, function ($q) use ($channel_id) {
            return $q->where('channel_id', $channel_id);
        });
    }


    // FUNCTIONS
    public function isfollowedByAuthUser()
    {
        $followersIds = array();
        foreach ($this->followers as $follower) {
            array_push($followersIds, $follower->user_id);
        }
        if (in_array(auth()->user()->id, $followersIds)) {
            return true;
        } else {
            return false;
        }
    }

    public function hasBestAnswer()
    {
        $result = false;
        foreach ($this->replies as $reply) {
            if ($reply->best_answer === 1) {
                $result = true;
                break;
            }
        }
        return $result;
    }
}
