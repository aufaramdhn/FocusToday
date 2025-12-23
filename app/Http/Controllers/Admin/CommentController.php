<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with(['user', 'article'])->latest()->paginate(20);
        return view('admin.comments.index', compact('comments'));
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'Komentar dihapus.');
    }

    public function updateStatus(Request $request, Comment $comment)
    {
        $comment->update(['status' => $request->status]);
        return back()->with('success', 'Status komentar diubah.');
    }
}
