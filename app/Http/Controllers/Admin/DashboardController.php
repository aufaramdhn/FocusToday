<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $recentArticles = Article::with('category')->latest()->take(5)->get();

        $totalArticles = Article::count();

        $totalViews = Article::sum('views');

        $totalUsers = User::count();

        return view('admin.dashboard.index', compact('recentArticles', 'totalArticles', 'totalViews', 'totalUsers'));
    }
}
