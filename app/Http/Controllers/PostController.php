<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller
{
    public function view() {
        $params = Post::latest('created_at')->where('created_by', '=', Auth::user()->id)->get();

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

        if ($request->image != '') {
            if ($post->image_url != '') {
                $old_path = public_path('images').'/'.$post->image_url;
                if (file_exists($old_path)) {
                    unlink($old_path);
                }
            }

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $post->image_url = $imageName;
        }

        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();

        return redirect()->route('post')->with('success', 'Berhasil mengubah post');
    }

    public function delete($id) {
        $post = Post::find($id);
        $post->delete();

        return redirect()
        ->route('post')
        ->with('success', 'Berhasil menghapuss post');
    }

    public function create(Request $request) {

        // upload process
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->created_by = Auth::user()->id;
        $post->image_url = $imageName;
        $post->save();

        return redirect()
        ->back()
        ->with('success', 'Berhasil menambahkan post');
    }
}
