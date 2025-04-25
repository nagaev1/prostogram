<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Request $request)
    {
        Like::create([
            'user_id' => Auth::user()->id,
            'post_id' => $request->route('post_id')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Like::where('user_id', Auth::user()->id)->where('post_id', $request->route('post_id'))->first()->delete();
    }
}
