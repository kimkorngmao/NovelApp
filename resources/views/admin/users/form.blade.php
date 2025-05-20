@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-semibold text-gray-900">{{ isset($user) ? 'แก้ไขผู้ใช้' : 'เพิ่มผู้ใช้ใหม่' }}</h1>
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
            กลับ
        </a>
    </div>

    <div class="bg-white shadow-sm rounded-lg overflow-hidden p-6">
        <form method="POST" action="{{ isset($user) ? route('admin.users.update', $user) : route('admin.users.store') }}">
            @csrf
            @if(isset($user))
                @method('PUT')
            @endif

            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700">ชื่อ</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name ?? '') }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700">อีเมล</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email ?? '') }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700">รหัสผ่าน {{ isset($user) ? '(เว้นว่างไว้ถ้าไม่ต้องการเปลี่ยน)' : '' }}</label>
                <input type="password" name="password" id="password" {{ isset($user) ? '' : 'required' }}
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="is_admin" class="inline-flex items-center">
                    <input type="checkbox" name="is_admin" id="is_admin" value="1" {{ old('is_admin', isset($user) && $user->isAdmin()) ? 'checked' : '' }}
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <span class="ml-2 text-sm text-gray-600">เป็นผู้ดูแลระบบ</span>
                </label>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                    {{ isset($user) ? 'อัปเดต' : 'เพิ่ม' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
