<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Novel;
use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Novel $novel)
    {
        $chapters = $novel->chapters()
            ->orderBy('chapter_number', 'asc')
            ->paginate(20);

        return view('admin.chapters.index', compact('novel', 'chapters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Novel $novel)
    {
        // Get the next chapter number
        $nextChapterNumber = $novel->chapters()->max('chapter_number') + 1;
        return view('admin.chapters.create', compact('novel', 'nextChapterNumber'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Novel $novel)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'chapter_number' => 'required|integer|min:1',
            'is_published' => 'boolean'
        ]);

        $chapter = $novel->chapters()->create([
            'title' => $request->title,
            'content' => $request->content,
            'chapter_number' => $request->chapter_number,
            'is_published' => $request->boolean('is_published', false)
        ]);

        return redirect()->route('admin.novels.chapters.edit', [$novel, $chapter])
            ->with('success', 'สร้างตอนใหม่เรียบร้อยแล้ว');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Novel $novel, Chapter $chapter)
    {
        return view('admin.chapters.edit', compact('novel', 'chapter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Novel $novel, Chapter $chapter)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'chapter_number' => 'required|integer|min:1',
            'is_published' => 'boolean'
        ]);

        $chapter->update([
            'title' => $request->title,
            'content' => $request->content,
            'chapter_number' => $request->chapter_number,
            'is_published' => $request->boolean('is_published', false)
        ]);

        return redirect()->route('admin.novels.chapters.edit', [$novel, $chapter])
            ->with('success', 'อัพเดทตอนเรียบร้อยแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Novel $novel, Chapter $chapter)
    {
        $chapter->delete();
        return redirect()->route('admin.novels.chapters.index', $novel)
            ->with('success', 'ลบตอนเรียบร้อยแล้ว');
    }
}
