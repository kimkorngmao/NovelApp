@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-semibold text-gray-900">แก้ไขหน้า</h1>
        <a href="{{ route('admin.pages.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
            กลับ
        </a>
    </div>

    <div class="bg-white shadow-sm rounded-lg overflow-hidden p-6">
        <form action="{{ route('admin.pages.update', $page) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700" for="title">
                    ชื่อเรื่อง
                </label>
                <input class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    id="title"
                    type="text"
                    name="title"
                    value="{{ old('title', $page->title) }}"
                    required>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700" for="content">
                    เนื้อหา
                </label>
                <textarea
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm h-64"
                    id="content"
                    name="content"
                    required>{{ old('content', $page->content) }}</textarea>
            </div>

            <div class="mb-6">
                <label class="inline-flex items-center">
                    <input type="checkbox"
                        name="is_published"
                        value="1"
                        {{ old('is_published', $page->is_published) ? 'checked' : '' }}
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <span class="ml-2 text-sm text-gray-600">เผยแพร่</span>
                </label>
            </div>

            <div class="flex justify-end">
                <button class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700"
                    type="submit">
                    อัปเดตหน้า
                </button>
            </div>
        </form>
    </div>
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
