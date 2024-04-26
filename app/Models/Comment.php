<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function thought()
    {
        return $this->belongsTo(Thought::class);
    }
    protected $fillable = ['user_id', 'content'];
    use HasFactory;
}
