@extends('admin.layouts.app')

@section('content')
<div class="sm:flex sm:items-center sm:justify-between mb-6">
    <h1 class="text-2xl font-semibold text-gray-900">
        {{ isset($category) ? 'แก้ไขหมวดหมู่' : 'เพิ่มหมวดหมู่ใหม่' }}
    </h1>
    <a href="{{ route('admin.categories.index') }}"
       class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
        กลับ
    </a>
</div>

<div class="bg-white shadow-sm rounded-lg overflow-hidden">
    <form action="{{ isset($category) ? route('admin.categories.update', $category) : route('admin.categories.store') }}"
          method="POST"
          class="p-6 space-y-6">
        @csrf
        @if(isset($category))
            @method('PUT')
        @endif

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">
                ชื่อหมวดหมู่
            </label>
            <input type="text"
                   name="name"
                   id="name"
                   value="{{ old('name', $category->name ?? '') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                   required>
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">
                คำอธิบาย
            </label>
            <textarea name="description"
                      id="description"
                      rows="3"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('description', $category->description ?? '') }}</textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="icon" class="block text-sm font-medium text-gray-700">
                ไอคอน SVG (วางโค้ด SVG ที่นี่)
            </label>
            <textarea name="icon"
                      id="icon"
                      rows="3"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('icon', $category->icon ?? '') }}</textarea>
            @error('icon')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                {{ isset($category) ? 'บันทึกการแก้ไข' : 'เพิ่มหมวดหมู่' }}
            </button>
        </div>
    </form>
</div>
@endsection
