<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thought extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes')->withPivot('liked');
    }
    public function like()
    {
        $user = auth()->user();

        $like = $this->likes()->where('user_id', $user->id)->first();

        if (!$like) {
            $this->increment('likes');
            $this->likes()->attach($user, ['liked' => true]);
        }
    }

    public function dislike()
    {
        $user = auth()->user();

        $like = $this->likes()->where('user_id', $user->id)->first();

        if ($like) {
            $this->decrement('likes');
            $this->likes()->detach($user);
        }
    }
    public function isLikedBy($user)
    {
        return $this->likes()->where('user_id', $user->id)->first();
    }

    protected $fillable = ['user_id', 'content'];

    use HasFactory;
}
