<?php

namespace App\Http\Controllers;

use App\Models\Novel;
use App\Models\Chapter;
use App\Models\NovelCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $popularNovels = Novel::where('is_published', true)
            ->withCount(['chapters' => function($query) {
                $query->where('is_published', true);
            }])
            ->orderBy('views', 'desc')
            ->take(8)
            ->get();

        $categories = NovelCategory::withCount(['novels' => function($query) {
            $query->where('is_published', true);
        }])->get();

        $latestChapters = Chapter::with(['novel' => function($query) {
                $query->where('is_published', true);
            }, 'novel.category'])
            ->where('is_published', true)
            ->latest()
            ->take(5)
            ->get();

        return view('home.index', compact('popularNovels', 'categories', 'latestChapters'));
    }
}
