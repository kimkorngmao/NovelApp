@extends('admin.layouts.app')

@section('content')
<div class="sm:flex sm:items-center sm:justify-between mb-6">
    <h1 class="text-2xl font-semibold text-gray-900">จัดการนิยาย</h1>
    <a href="{{ route('admin.novels.create') }}"
       class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
        เพิ่มนิยายใหม่
    </a>
</div>

<div class="bg-white shadow-sm rounded-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        นิยาย
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        หมวดหมู่
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        สถานะ
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        จำนวนตอน
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        ยอดอ่าน
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($novels as $novel)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="h-16 w-12 flex-shrink-0">
                                    @if($novel->cover_image)
                                        <img src="{{ asset('storage/' . $novel->cover_image) }}"
                                             alt="{{ $novel->title }}"
                                             class="h-16 w-12 object-cover rounded">
                                    @else
                                        <div class="h-16 w-12 bg-gray-200 rounded flex items-center justify-center">
                                            <span class="text-gray-400 text-xs">No image</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $novel->title }}</div>
                                    <div class="text-xs text-gray-500">
                                        โดย {{ $novel->author->name }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $novel->category->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex flex-col space-y-1">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $novel->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $novel->status === 'completed' ? 'จบแล้ว' : 'กำลังเขียน' }}
                                </span>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $novel->is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $novel->is_published ? 'เผยแพร่แล้ว' : 'ฉบับร่าง' }}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $novel->chapters_count }} ตอน
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ number_format($novel->views) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-2">
                                <a href="{{ route('admin.novels.chapters.index', $novel) }}"
                                   class="text-blue-600 hover:text-blue-900">จัดการตอน</a>
                                <a href="{{ route('admin.novels.edit', $novel) }}"
                                   class="text-indigo-600 hover:text-indigo-900">แก้ไข</a>
                                <form action="{{ route('admin.novels.destroy', $novel) }}"
                                      method="POST"
                                      onsubmit="return confirm('คุณแน่ใจหรือไม่ที่จะลบนิยายนี้?');"
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
                        <td colspan="7" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                            ไม่พบข้อมูลนิยาย
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
