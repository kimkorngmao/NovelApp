@extends('admin.layouts.app')

@section('content')
<div class="sm:flex sm:items-center sm:justify-between mb-6">
    <div>
        <h1 class="text-2xl font-semibold text-gray-900">จัดการตอน</h1>
        <p class="mt-1 text-sm text-gray-600">{{ $novel->title }}</p>
    </div>
    <div class="flex space-x-3">
        <a href="{{ route('admin.novels.index') }}"
           class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
            กลับ
        </a>
        <a href="{{ route('admin.novels.chapters.create', $novel) }}"
           class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
            เพิ่มตอนใหม่
        </a>
    </div>
</div>

<div class="bg-white shadow-sm rounded-lg overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    ตอนที่
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    ชื่อตอน
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    สถานะ
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    ยอดอ่าน
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    วันที่อัพเดท
                </th>
                <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Actions</span>
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($chapters as $chapter)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $chapter->chapter_number }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900">{{ $chapter->title }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $chapter->is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $chapter->is_published ? 'เผยแพร่แล้ว' : 'ฉบับร่าง' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ number_format($chapter->views) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $chapter->updated_at->format('d/m/Y H:i') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('admin.novels.chapters.edit', [$novel, $chapter]) }}"
                               class="text-indigo-600 hover:text-indigo-900">แก้ไข</a>

                            <form action="{{ route('admin.novels.chapters.destroy', [$novel, $chapter]) }}"
                                  method="POST"
                                  onsubmit="return confirm('คุณแน่ใจหรือไม่ที่จะลบตอนนี้?');"
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
                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                        ยังไม่มีตอน
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
