<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Thought;

class CommentController extends Controller
{
    public function store(Request $request, Thought $thought)
    {
        $request->validate([
            'content' => 'required|max:280',
        ]);

        $comment = new Comment;
        $comment->fill([
            'user_id' => auth()->id(),
            'thought_id' => $thought->id,
            'content' => $request->content,
        ]);
        $comment->save();

        return redirect()->back();
    }
}
