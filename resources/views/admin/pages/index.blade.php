@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-semibold text-gray-900">จัดการหน้า</h1>
        <a href="{{ route('admin.pages.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition">
            สร้างหน้าใหม่
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ชื่อเรื่อง</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">slug</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">สถานะ</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">การดำเนินการ</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($pages as $page)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $page->title }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $page->slug }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                        <span class="bg-{{ $page->is_published ? 'green' : 'red' }}-200 text-{{ $page->is_published ? 'green' : 'red' }}-600 py-1 px-3 rounded-full text-xs">
                            {{ $page->is_published ? 'เผยแพร่' : 'ร่าง' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <div class="flex item-center justify-center">
                            <a href="{{ url($page->slug) }}" class="text-indigo-600 hover:text-indigo-900">
                                พรีวิว
                            </a>                            
                            <a href="{{ route('admin.pages.edit', $page) }}" class="ml-4 text-indigo-600 hover:text-indigo-900">
                                แก้ไข
                            </a>
                            <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" class="inline-block" onsubmit="return confirm('คุณแน่ใจหรือไม่ที่จะลบหน้านี้?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 ml-4">ลบ</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
