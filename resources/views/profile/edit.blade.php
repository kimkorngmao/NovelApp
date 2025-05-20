@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-paper">
    <!-- Header -->
    <div class="sticky top-14 z-40 bg-paper">
        <div class="mx-auto max-w-4xl px-4 py-4">
            <h1 class="text-lg font-bold">จัดการโปรไฟล์</h1>
            <p class="text-sm text-gray-500">แก้ไขข้อมูลส่วนตัวของคุณ</p>
        </div>
    </div>

    <div class="mx-auto max-w-4xl px-4 pb-20 space-y-4">
        <!-- Profile Information -->
        <div class="bg-white rounded-lg shadow-card">
            <div class="p-4">
                <h2 class="text-base font-bold mb-4">ข้อมูลโปรไฟล์</h2>

                <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
                    @csrf
                    @method('patch')

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">ชื่อ</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                               class="mt-1 block w-full rounded-lg border-gray-200 focus:border-paakwaan focus:ring-paakwaan text-sm">
                        @error('name')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">อีเมล</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                               class="mt-1 block w-full rounded-lg border-gray-200 focus:border-paakwaan focus:ring-paakwaan text-sm">
                        @error('email')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-4 pt-2">
                        <button type="submit"
                                class="inline-flex items-center gap-1.5 px-4 py-2 bg-paakwaan text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors">
                            <span>บันทึกการเปลี่ยนแปลง</span>
                        </button>

                        @if (session('status') === 'profile-updated')
                            <p class="text-sm text-green-600 flex items-center gap-1.5">
                                <span>บันทึกข้อมูลเรียบร้อย</span>
                            </p>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Update Password -->
        <div class="bg-white rounded-lg shadow-card">
            <div class="p-4">
                <h2 class="text-base font-bold mb-4">เปลี่ยนรหัสผ่าน</h2>

                <form id="password-form" method="post" action="{{ route('user-password.update') }}" class="space-y-4">
                    @csrf
                    @method('put')

                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700">รหัสผ่านปัจจุบัน</label>
                        <input type="password" name="current_password" id="current_password"
                               class="mt-1 block w-full rounded-lg border-gray-200 focus:border-paakwaan focus:ring-paakwaan text-sm">
                        @error('current_password')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">รหัสผ่านใหม่</label>
                        <input type="password" name="password" id="password"
                               class="mt-1 block w-full rounded-lg border-gray-200 focus:border-paakwaan focus:ring-paakwaan text-sm">
                        @error('password')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">ยืนยันรหัสผ่านใหม่</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="mt-1 block w-full rounded-lg border-gray-200 focus:border-paakwaan focus:ring-paakwaan text-sm">
                    </div>

                    <div class="flex items-center gap-4 pt-2">
                        <button type="submit"
                                class="inline-flex items-center gap-1.5 px-4 py-2 bg-paakwaan text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors">
                            <span>เปลี่ยนรหัสผ่าน</span>
                        </button>

                        @if (session('status') === 'password-updated')
                            <p class="text-sm text-green-600 flex items-center gap-1.5">
                                <span>เปลี่ยนรหัสผ่านเรียบร้อย</span>
                            </p>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Account -->
        <div class="bg-white rounded-lg shadow-card">
            <div class="p-4">
                <h2 class="text-base font-bold mb-2">ลบบัญชี</h2>
                <p class="text-sm text-gray-600 mb-4">เมื่อบัญชีของคุณถูกลบ ข้อมูลและทรัพยากรทั้งหมดจะถูกลบอย่างถาวร</p>

                <button onclick="document.getElementById('deleteModal').classList.remove('hidden')"
                        class="inline-flex items-center gap-1.5 px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors">
                    <span>ลบบัญชี</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection