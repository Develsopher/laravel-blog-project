<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Follow extends Model
{
    use HasFactory;

    public function followerUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function followingUser()
    {
        return $this->belongsTo(User::class, 'followedUser');
    }

    public function isUserFollowing(): Attribute
    {
        return new Attribute(
            get: function () {
                if(1) {
                    return auth()->user()->id;
                } else {
                    return 'ffff';
                }
            }
        );
    }
}
