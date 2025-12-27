<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $recentArticles = Article::with('category')->latest()->take(5)->get();

        $totalArticles = Article::count();

        $totalViews = Article::sum('views');

        $totalUsers = User::count();

        $totalComments = Comment::count();

        $popularArticles = Article::orderBy('views', 'desc')->take(4)->get();

        return view('admin.dashboard.index', compact('recentArticles', 'totalArticles', 'totalViews', 'totalUsers', 'totalComments', 'popularArticles'));
    }
}
