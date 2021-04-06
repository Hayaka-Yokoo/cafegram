<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    public function getFollowCount($user_id)
    {
        return $this->where('follow_id', $user_id)->count();
    }

    public function getFollowerCount($follow_id)
    {
        return $this->where('user_id', $follow_id)->count();
    }
}
