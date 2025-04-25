<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Inertia\Inertia;

class PostController extends Controller
{

    public function create()
    {
        return Inertia::render('Posts/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'caption' => 'required|string',
            'image' => 'required|image|max:5120'
        ]);

        $path = $request->file('image')->store('posts', 'public');

        Auth::user()->posts()->create([
            'caption' => $request->caption,
            'image' => $path
        ]);

        return redirect()->route('home');
    }
}
