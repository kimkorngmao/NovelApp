@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center">
    <div class="mx-auto w-full max-w-3xl px-4">
        <div class="text-center mb-8">
            <a href="{{ url('/') }}" class="inline-block">
                <span class="text-4xl font-black">ปากหวาน</span>
            </a>
            <h2 class="mt-4 text-xl font-bold">ยินดีต้อนรับกลับมา</h2>
            <p class="mt-2 text-sm text-gray-600">เข้าสู่ระบบเพื่อเริ่มอ่านนิยาย</p>
        </div>

        <div class="overflow-hidden">
            <div class="relative">
                <div class="p-6">
                    <form method="POST" action="{{ route('login') }}" class="space-y-4">
                        @csrf

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">อีเมล</label>
                            <div class="mt-1 relative">
                                <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </span>
                                <input id="email" type="email" name="email" required autofocus
                                    class="block w-full pl-10 pr-4 py-2.5 rounded-lg border-gray-200 focus:border-rose-500 focus:ring-rose-500 text-sm transition-colors"
                                    placeholder="name@example.com">
                            </div>
                            @error('email')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">รหัสผ่าน</label>
                            <div class="mt-1 relative">
                                <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </span>
                                <input id="password" type="password" name="password" required
                                    class="block w-full pl-10 pr-4 py-2.5 rounded-lg border-gray-200 focus:border-rose-500 focus:ring-rose-500 text-sm transition-colors"
                                    placeholder="••••••••">
                            </div>
                            @error('password')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember_me" name="remember" type="checkbox"
                                    class="w-4 h-4 rounded border-gray-300 focus:ring-rose-500">
                                <label for="remember_me" class="ml-2 text-sm text-gray-600">จดจำฉันไว้</label>
                            </div>

                            <a href="#"
                               class="text-sm font-medium hover:text-red-700 transition-colors">
                                ลืมรหัสผ่าน?
                            </a>
                        </div>

                        <button type="submit"
                            class="w-full flex justify-center items-center gap-2 px-6 py-2.5 bg-rose-500 hover:bg-rose-600 text-white font-medium rounded-lg transition-colors shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            <span>เข้าสู่ระบบ</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
