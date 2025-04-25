<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
class HomeController extends Controller
{
    public function index()
    {
        $friends = Auth::user()->friends()->pluck('users.id');
        // $posts = Post::whereIn('user_id', $friends)
        //     ->with('user.profile')
        //     ->latest()
        //     ->paginate(10);
        $posts = Post::with('user.profile')->with('comments')->with('likes')
            ->latest()
            ->paginate(10);
        // return $posts;

        return Inertia::render('Home', [
            'posts' => $posts,
        ]);
    }
}
