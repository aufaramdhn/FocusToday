<?php

namespace App\Http\Controllers\Landing;

use App\Models\Tag;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DetailArtikelController extends Controller
{
    public function store(Request $request, Comment $comment)
    {
        $request->validate(
            [
                'content' => 'required|string|max:1000',
                'article_id' => 'required|exists:articles,id',
            ],
            [
                'content.required' => 'Komentar tidak boleh kosong.',
                'content.max' => 'Komentar maksimal 1000 karakter.',
            ]
        );

        if (!Auth::check()) {
            return back()->with('error', 'Anda harus login untuk menambahkan komentar.');
        }

        Comment::create([
            'article_id' => $request->article_id,
            'user_id' => Auth::id(),
            'content' => $request->content,
            'status' => 'approved',
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }

    public function update(Request $request, Comment $comment)
    {
        if (! Auth::user()->is($comment->user)) {
            return back()->with('error', 'Anda tidak berhak mengedit komentar ini.');
        }

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment->update([
            'content' => $request->content
        ]);

        return back()->with('success', 'Komentar berhasil diperbarui.');
    }

    public function destroy(Comment $comment)
    {
        if (Auth::id() != $comment->user_id && Auth::user()->role != 'admin') {
            abort(403, 'Unauthorized action.');
        }
        $comment->delete();

        return back()->with('success', 'Komentar berhasil dihapus.');
    }
}
