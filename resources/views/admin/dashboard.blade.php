@extends('admin.layouts.app')

@section('content')
<div class="bg-white/90 backdrop-blur-sm shadow-sm overflow-hidden ring-1 ring-gray-100">
    <div class="p-6 md:p-8 text-gray-900">
        <h1 class="text-2xl font-semibold mb-6">แดชบอร์ดผู้ดูแลระบบ</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Novel Stats -->
            <a href="{{ route('admin.novels.index') }}" class="bg-blue-50 p-6 rounded-lg">
                <h2 class="text-lg font-medium text-blue-800 mb-2">นิยายทั้งหมด</h2>
                <p class="text-3xl font-bold text-blue-600">{{ \App\Models\Novel::count() }}</p>
            </a>

            <!-- Users Stats -->
            <a href="{{ route('admin.users.index') }}" class="bg-yellow-50 p-6 rounded-lg">
                <h2 class="text-lg font-medium text-yellow-800 mb-2">ผู้ใช้ทั้งหมด</h2>
                <p class="text-3xl font-bold text-yellow-600">{{ \App\Models\User::count() }}</p>
            </a>

            <!-- Category Stats -->
            <a href="{{ route('admin.categories.index') }}" class="bg-green-50 p-6 rounded-lg">
                <h2 class="text-lg font-medium text-green-800 mb-2">หมวดหมู่ทั้งหมด</h2>
                <p class="text-3xl font-bold text-green-600">{{ \App\Models\NovelCategory::count() }}</p>
            </a>

            <!-- Chapter Stats -->
            <div class="bg-purple-50 p-6 rounded-lg">
                <h2 class="text-lg font-medium text-purple-800 mb-2">ตอนทั้งหมด</h2>
                <p class="text-3xl font-bold text-purple-600">{{ \App\Models\Chapter::count() }}</p>
            </div>
        </div>

        <!-- Recent Novels -->
        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-4">นิยายล่าสุด</h2>
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ชื่อเรื่อง</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">หมวดหมู่</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">สถานะ</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">วันที่เพิ่ม</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach(\App\Models\Novel::latest()->take(5)->get() as $novel)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('admin.novels.edit', $novel) }}" class="text-sm font-medium text-gray-900">{{ $novel->title }}</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ $novel->category->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($novel->is_published)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">เผยแพร่แล้ว</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">ฉบับร่าง</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $novel->created_at->format('d/m/Y') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
