<?php

namespace App\Http\Controllers;

use App\Models\Novel;
use App\Models\Chapter;
use App\Models\NovelCategory;
use Illuminate\Http\Request;

class NovelController extends Controller
{
    public function index(Request $request)
    {
        $query = Novel::with('category')
            ->withCount(['chapters' => function($query) {
                $query->where('is_published', true);
            }])
            ->where('is_published', true);

        if ($request->category) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->sort === 'popular') {
            $query->orderBy('views', 'desc');
        } elseif ($request->sort === 'latest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($request->sort === 'updated') {
            $query->orderBy('updated_at', 'desc');
        } else {
            $query->latest();
        }

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $novels = $query->latest()->paginate(12);
        $categories = NovelCategory::all();

        return view('novels.index', compact('novels', 'categories'));
    }

    public function show(Novel $novel)
    {
        if (!$novel->is_published) {
            abort(404);
        }

        $novel->load(['category', 'chapters' => function ($query) {
            $query->where('is_published', true)
                  ->orderBy('chapter_number', 'asc');
        }]);

        // Increment view count
        $novel->increment('views');

        return view('novels.show', compact('novel'));
    }

    public function showChapter(Novel $novel, Chapter $chapter)
    {
        if (!$novel->is_published || !$chapter->is_published) {
            abort(404);
        }

        if ($chapter->novel_id !== $novel->id) {
            abort(404);
        }

        // Increment chapter view count
        $chapter->increment('views');

        $prevChapter = Chapter::where('novel_id', $novel->id)
            ->where('chapter_number', '<', $chapter->chapter_number)
            ->orderBy('chapter_number', 'desc')
            ->first();

        $nextChapter = Chapter::where('novel_id', $novel->id)
            ->where('chapter_number', '>', $chapter->chapter_number)
            ->orderBy('chapter_number', 'asc')
            ->first();

        return view('novels.chapter', compact('novel', 'chapter', 'prevChapter', 'nextChapter'));
    }
}
