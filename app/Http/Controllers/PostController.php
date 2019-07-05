<?php
namespace App\Http\Controllers;

use App\Post;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class postController extends Controller
{
    public function getDashboard()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('dashboard', ['posts' => $posts]);
    }

    public function postCreatePost(Request $request)
    {
        $this->validate($request, [
            'body' => 'required|max:1000'
        ]);

        $post = new Post();
        $post->body = $request->body;
        $status = "faliure";
        $message = 'Something went wrong';
        if ($request->user()->posts()->save($post)) {
            $status = "success";
            $message = 'Post successfully created';
        }
        return redirect()->route('dashboard')->with(['status' => $status, 'message' => $message]);
    }

    public function getDeletePost($post_id)
    {
        $post = Post::where('id', $post_id)->first();
        if (Auth::user() != $post->user) {
            return redirect()->route('dashboard')->with(['status' => "faliure", 'message' => "You do cannot delete post of others" ]);
        }
        $post->delete();
        return redirect()->route('dashboard')->with(['status' => "success", 'message' => "Post successfully deleted" ]);
    }

    public function postEditPost(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);
        $post = Post::find($request->postId);
        if (Auth::user() != $post->user) {
            return response()->json(['status' => "faliure", 'message' => "You do cannot edit post of others" ], 422);
        }
        $post->body = $request->body;
        if($post->update()) {
            return response()->json(['status' => 'success', 'message' => 'Post Edited', 'new_body' => $post->body], 200);
        } else {
            return response()->json(['status' => 'faliure', 'message' => 'Post Not Edited'], 500);
        }
        
    }

    public function postLikePost(Request $request)
    {
        $post_id = $request->postId;
        $is_like = $request->isLike == "true";
        $update = false;
        $post = Post::find($post_id);
        if (!$post) {
            // error
            return null;
        }
        $user = Auth::user();
        $like = $user->likes()->where('post_id', $post_id)->first();
        if ($like) {
            $already_like = $like->like;
            $update = true;
            if ($already_like == $is_like) {
                $like->delete();
                return null;
            }
        } else {
            $like = new Like();
        }
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->post_id = $post->id;
        if ($update) {
            $like->update();
        } else {
            $like->save();
        }
        return null;
    }
}