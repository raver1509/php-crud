<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Thought;
//use App\Models\Comment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request  $request)
    {
        $thoughts = Thought::with('user', 'likes')->latest()->get();
        if ($request->has('search')) {
            $search = $request->input('search');
            $thoughts = $thoughts->filter(function ($thought) use ($search) {
                return stripos($thought->content, $search) !== false ||
                    stripos($thought->user->name, $search) !== false;
            });
        }
        return view('home', compact('thoughts'));
    }

    public function liked(Request $request) {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $user = auth()->user();
        $thoughts = $user->likedThoughts()->with('user', 'likes')->latest()->get();

        if ($request->has('search')) {
            $search = $request->input('search');
            $thoughts = $thoughts->filter(function ($thought) use ($search) {
                return stripos($thought->content, $search) !== false ||
                    stripos($thought->user->name, $search) !== false;
            });
        }

        return view('liked', compact('thoughts'));
    }

}
