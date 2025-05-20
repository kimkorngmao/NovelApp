@extends('admin.layouts.app')

@section('content')
<div class="sm:flex sm:items-center sm:justify-between mb-6">
    <div>
        <h1 class="text-2xl font-semibold text-gray-900">
            {{ isset($chapter) ? 'แก้ไขตอน' : 'เพิ่มตอนใหม่' }}
        </h1>
        <p class="mt-1 text-sm text-gray-600">{{ $novel->title }}</p>
    </div>
    <div class="flex space-x-3">
        <a href="{{ route('admin.novels.chapters.index', $novel) }}"
           class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
            กลับ
        </a>
    </div>
</div>

<div class="bg-white shadow-sm rounded-lg overflow-hidden">
    <form action="{{ isset($chapter) ? route('admin.novels.chapters.update', [$novel, $chapter]) : route('admin.novels.chapters.store', $novel) }}"
          method="POST"
          class="p-6 space-y-6">
        @csrf
        @if(isset($chapter))
            @method('PUT')
        @endif

        <!-- Title -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Chapter Number -->
            <div>
                <label for="chapter_number" class="block text-sm font-medium text-gray-700">
                    ตอนที่
                </label>
                <input type="number"
                       name="chapter_number"
                       id="chapter_number"
                       value="{{ old('chapter_number', $chapter->chapter_number ?? $nextChapterNumber ?? 1) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                       required>
                @error('chapter_number')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Published Status -->
            <div class="flex items-center space-x-3">
                <input type="checkbox"
                       name="is_published"
                       id="is_published"
                       value="1"
                       {{ old('is_published', $chapter->is_published ?? 0) ? 'checked' : '' }}
                       class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                <label for="is_published" class="text-sm font-medium text-gray-700">
                    เผยแพร่
                </label>
                @error('is_published')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Title -->
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">
                ชื่อตอน
            </label>
            <input type="text"
                   name="title"
                   id="title"
                   value="{{ old('title', $chapter->title ?? '') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                   required>
            @error('title')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Chapter Content -->
        <div>
            <label for="content" class="block text-sm font-medium text-gray-700">
                เนื้อหา
            </label>
            <div class="mt-1">
                <textarea id="content"
                          name="content"
                          rows="20"
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                          style="font-family: monospace;">{{ old('content', $chapter->content ?? '') }}</textarea>
            </div>
            @error('content')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                {{ isset($chapter) ? 'บันทึกการเปลี่ยนแปลง' : 'เพิ่มตอน' }}
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#content'), {
            toolbar: ['heading', '|',
                     'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
                     'undo', 'redo', '|',
                     'alignment', 'insertTable', 'blockQuote'],
            height: '500px'
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endpush
@endsection
