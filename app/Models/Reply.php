<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'discussion_id', 'content', 'best_answer'
    ];

    public function discussion()
    {
        return $this->belongsTo(Discussion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isLikedByAuthUser()
    {
        $likers = array();
        foreach ($this->likes as $like) {
            array_push($likers, $like->user_id);
        }
        if (in_array(auth()->user()->id, $likers)) {
            return true;
        } else {
            return false;
        }
    }
}
