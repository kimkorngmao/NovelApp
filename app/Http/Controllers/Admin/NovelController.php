<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Novel;
use App\Models\NovelCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NovelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $novels = Novel::with(['category', 'author'])
            ->withCount('chapters')
            ->latest()
            ->paginate(10);
        return view('admin.novels.index', compact('novels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = NovelCategory::all();
        return view('admin.novels.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:novel_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'cover_image' => 'nullable|image|max:2048',
            'status' => 'required|in:ongoing,completed',
            'is_published' => 'boolean'
        ]);

        $data = $request->except('cover_image');
        $data['user_id'] = auth()->id();
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('covers', 'public');
            $data['cover_image'] = $path;
        }

        $novel = Novel::create($data);

        return redirect()->route('admin.novels.edit', $novel)
            ->with('success', 'สร้างนิยายเรียบร้อยแล้ว');
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
    public function edit(Novel $novel)
    {
        $categories = NovelCategory::all();
        return view('admin.novels.edit', compact('novel', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Novel $novel)
    {
        $request->validate([
            'category_id' => 'required|exists:novel_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'cover_image' => 'nullable|image|max:2048',
            'status' => 'required|in:ongoing,completed',
            'is_published' => 'boolean'
        ]);

        $data = $request->except('cover_image');
        
        // Generate a unique slug from the title
        $slug = Str::slug($request->title);
        $counter = 1;
        
        // Keep checking if the slug exists (excluding the current novel)
        while (Novel::where('slug', $slug)->where('id', '!=', $novel->id)->exists()) {
            $slug = Str::slug($request->title) . '-' . $counter++;
        }
        
        $data['slug'] = $slug;

        if ($request->hasFile('cover_image')) {
            // Delete old image if exists
            if ($novel->cover_image) {
                Storage::disk('public')->delete($novel->cover_image);
            }
            $path = $request->file('cover_image')->store('covers', 'public');
            $data['cover_image'] = $path;
        }

        $novel->update($data);

        return redirect()->route('admin.novels.edit', $novel)
            ->with('success', 'อัพเดทนิยายเรียบร้อยแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Novel $novel)
    {
        if ($novel->cover_image) {
            Storage::disk('public')->delete($novel->cover_image);
        }
        $novel->delete();
        return redirect()->route('admin.novels.index')
            ->with('success', 'ลบนิยายเรียบร้อยแล้ว');
    }
}
