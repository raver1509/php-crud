<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thought;
use App\Models\Like;

class ThoughtController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:280',
        ]);

        $thought = new Thought;
        $thought->fill([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);
        $thought->save();
        return redirect()->back();
    }


    public function edit(Thought $thought)
    {
        if ($thought->user_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        if (strlen($thought->content) > 280) {
            abort(403, 'Thought content length exceeds the allowed limit.');
        }

        return view('thoughts.edit', compact('thought'));
    }

    public function update(Request $request, Thought $thought)
    {
        if ($thought->user_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'content' => ['required', 'string', 'max:280'],
        ]);

        $thought->update([
            'content' => $request->content,
        ]);

        return redirect()->route('index')->with('success', 'Thought updated successfully.');
    }

    public function destroy(Thought $thought)
    {
        if (auth()->id() != $thought->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $thought->delete();
        return redirect()->back();
    }

    public function like(Thought $thought)
    {
        $thought->like();

        $thought->refresh();

        return back();
    }

    public function dislike(Thought $thought)
    {
        $thought->dislike();

        $thought->refresh();

        return back();
    }

}
