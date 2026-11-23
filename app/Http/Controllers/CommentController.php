<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'body' => ['required', 'string', 'max:2000'],
        ]);

        $post->comments()->create([
            'user_id' => $request->user()->id,
            'body' => $validated['body'],
        ]);

        return redirect()->route('posts.show', $post)
            ->with('success', 'Your comment has been added.');
    }

    public function destroy(Post $post, int $comment)
    {
        $record = $post->comments()->findOrFail($comment);

        abort_unless($record->user_id === auth()->id(), 403);

        $record->delete();

        return back()->with('success', 'Comment deleted successfully.');
    }
}