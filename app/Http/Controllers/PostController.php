<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller
{
    public function view() {
        $params = Post::latest('created_at')->get();

        return view('post.index', [
            "posts" => $params,
        ]);
    }

    public function edit($id) {
        $post = Post::find($id);

        return view('post.edit', [
            "post" => $post
        ]);
    }

    public function update(Request $request) {
        $post = Post::find($request->id);

        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();

        return redirect()->route('post');
    }

    public function delete($id) {
        $post = Post::find($id);
        $post->delete();

        return redirect()->route('post');
    }

    public function create(Request $request) {
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->created_by = Auth::user()->id;
        $post->save();

        return redirect()->back();
    }
}
