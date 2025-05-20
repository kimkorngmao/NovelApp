@extends('admin.layouts.app')

@section('content')
<div class="sm:flex sm:items-center sm:justify-between mb-6">
    <h1 class="text-2xl font-semibold text-gray-900">จัดการหมวดหมู่นิยาย</h1>
    <a href="{{ route('admin.categories.create') }}"
       class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
        เพิ่มหมวดหมู่ใหม่
    </a>
</div>

<div class="bg-white shadow-sm rounded-lg overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    ชื่อหมวดหมู่
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Slug
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    จำนวนนิยาย
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    วันที่สร้าง
                </th>
                <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Actions</span>
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($categories as $category)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center gap-2">
                            @if($category->icon)
                                <span class="inline-block align-middle h-6 w-6">{!! $category->icon !!}</span>
                            @endif
                            <div>
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $category->name }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $category->slug }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $category->novels_count }} เรื่อง
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $category->created_at->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('admin.categories.edit', $category) }}"
                               class="text-indigo-600 hover:text-indigo-900">แก้ไข</a>

                            <form action="{{ route('admin.categories.destroy', $category) }}"
                                  method="POST"
                                  onsubmit="return confirm('คุณแน่ใจหรือไม่ที่จะลบหมวดหมู่นี้?');"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">ลบ</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                        ไม่พบข้อมูลหมวดหมู่
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
