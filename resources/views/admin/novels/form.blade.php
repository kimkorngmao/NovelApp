@extends('admin.layouts.app')

@section('content')
<div class="sm:flex sm:items-center sm:justify-between mb-6">
    <h1 class="text-2xl font-semibold text-gray-900">
        {{ isset($novel) ? 'แก้ไขนิยาย' : 'เพิ่มนิยายใหม่' }}
    </h1>
    <a href="{{ route('admin.novels.index') }}"
       class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
        กลับ
    </a>
</div>

<div class="bg-white shadow-sm rounded-lg overflow-hidden">
    <form action="{{ isset($novel) ? route('admin.novels.update', $novel) : route('admin.novels.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="p-6 space-y-6">
        @csrf
        @if(isset($novel))
            @method('PUT')
        @endif

        <!-- Cover Image Preview -->
        <div class="border rounded-lg p-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                ปกนิยาย
            </label>
            @if(isset($novel) && $novel->cover_image)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $novel->cover_image) }}"
                         alt="Current cover"
                         class="h-64 object-cover rounded">
                </div>
            @endif
            <input type="file"
                   name="cover_image"
                   id="cover_image"
                   accept="image/*"
                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
            @error('cover_image')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Title -->
            <div>            <label for="title" class="block text-sm font-medium text-gray-700">
                ชื่อเรื่อง
            </label>
            <input type="text"
                   name="title"
                   id="title"
                   value="{{ old('title', $novel->title ?? '') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                       required>
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category -->
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">
                    หมวดหมู่
                </label>
                <select name="category_id"
                        id="category_id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        required>
                    <option value="">เลือกหมวดหมู่</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                                {{ old('category_id', $novel->category_id ?? '') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">
                    สถานะ
                </label>
                <select name="status"
                        id="status"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        required>
                    <option value="ongoing" {{ old('status', $novel->status ?? '') == 'ongoing' ? 'selected' : '' }}>
                        กำลังเขียน
                    </option>
                    <option value="completed" {{ old('status', $novel->status ?? '') == 'completed' ? 'selected' : '' }}>
                        จบแล้ว
                    </option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Published Status -->
            <div class="flex items-center space-x-3">
                <input type="checkbox"
                       name="is_published"
                       id="is_published"
                       value="1"
                       {{ old('is_published', $novel->is_published ?? 0) ? 'checked' : '' }}
                       class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                <label for="is_published" class="text-sm font-medium text-gray-700">
                    เผยแพร่
                </label>
                @error('is_published')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">
                เรื่องย่อ
            </label>
            <textarea name="description"
                      id="description"
                      rows="4"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                      required>{{ old('description', $novel->description ?? '') }}</textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                {{ isset($novel) ? 'บันทึกการแก้ไข' : 'เพิ่มนิยาย' }}
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#description'), {
            toolbar: ['heading', '|',
                     'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
                     'undo', 'redo', '|',
                     'alignment', 'insertTable', 'blockQuote'],
            height: '300px'
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endpush
@endsection
