<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Paakwaan') }} - Admin</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col text-gray-900 antialiased subpixel-antialiased text-rendering-optimizeLegibility">
    <!-- Header -->
    <header class="sticky top-0 z-50 w-full bg-white/95 backdrop-blur-lg border-b border-gray-100">
        <div class="mx-auto max-w-4xl px-5 h-14 flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center gap-2.5">
                <span class="text-xl font-black tracking-tight">PAAKWAAN</span>
            </a>

            <!-- Actions -->
            <div class="flex items-center gap-3">
                <!-- Browse -->
                <a href="{{ route('novels.index') }}"
                   class="inline-flex items-center gap-2 px-3 h-8 rounded-sm bg-gray-50 hover:bg-gray-100 group transition-all duration-200 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600 group-transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <span class="text-sm font-medium text-gray-600 group-transition-colors">เรื่องทั้งหมด</span>
                </a>

                @guest
                    <a href="{{ route('login') }}" 
                       class="inline-flex items-center gap-2 px-3 h-8 rounded-sm bg-rose-500 hover:bg-rose-600 text-white text-sm font-medium transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        เข้าสู่ระบบ
                    </a>
                @endguest

                @auth
                    <!-- User Menu -->
                    <div class="relative group">
                        <button class="flex items-center gap-2 text-sm group-transition-colors">
                            <img class="h-8 w-8 rounded-full object-cover"
                                     src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}"
                                     alt="{{ auth()->user()->name }}">
                        </button>
                        <!-- Dropdown -->
                        <div class="absolute right-0 top-full mt-1.5 w-52 bg-white rounded-sm shadow-lg ring-1 ring-black/5 invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all">
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm hover:bg-gray-50 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                    </svg>
                                    <span>แดชบอร์ด</span>
                                </a>
                            @endif
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm hover:bg-gray-50 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span>โปรไฟล์</span>
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="border-t border-gray-100">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-2.5 px-4 py-2.5 text-sm hover:bg-gray-50 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    <span>ออกจากระบบ</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 scroll-decoration pb-20 md:pb-0">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="py-6 px-5 mt-8 w-full max-w-4xl mx-auto md:mt-12">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
            <div class="flex flex-col items-center md:items-start gap-1.5">
                <span class="text-xl font-black tracking-tight">
                    PAAKWAAN
                </span>
                <span class="text-[10px] tracking-wider uppercase text-gray-600/60">ปากหวาน: เปิดโลกนิยายไร้ขอบ อ่านรอบเดียวตรึงใจ</span>
            </div>

            <!-- Social icons -->
            <div class="flex gap-2">
                <!-- Instagram -->
                <a href="#" class="w-8 h-8 rounded-sm bg-gray-50 flex items-center justify-center text-gray-600 hover:bg-gray-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                    </svg>
                </a>
                <!-- Facebook -->
                <a href="#" class="w-8 h-8 rounded-sm bg-gray-50 flex items-center justify-center text-gray-600 hover:bg-gray-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
                    </svg>
                </a>
                <!-- Twitter / X -->
                <a href="#" class="w-8 h-8 rounded-sm bg-gray-50 flex items-center justify-center text-gray-600 hover:bg-gray-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                    </svg>
                </a>
            </div>
        </div>

        <div class="border-t border-gray-100 pt-4 flex flex-col md:flex-row justify-between items-center gap-3 text-xs">
            <p class="text-gray-600/60">© 2025 PAAKWAAN สงวนลิขสิทธิ์ทั้งหมด</p>
            <div class="flex flex-wrap justify-center gap-x-3 gap-y-2">
                <a href="{{ url('terms-of-service') }}" class="text-gray-600 transition-colors">ข้อกำหนดการใช้งาน</a>
                <span class="text-gray-600/40">•</span>
                <a href="{{ url('privacy-policy') }}" class="text-gray-600 transition-colors">นโยบายความเป็นส่วนตัว</a>
                <span class="text-gray-600/40">•</span>
                <a href="{{ url('about-us') }}" class="text-gray-600 transition-colors">เกี่ยวกับเรา</a>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggle = document.getElementById('menuToggle');
            const nav = document.getElementById('mobileNav');
            toggle.addEventListener('click', () => nav.classList.toggle('hidden'));
        });
    </script>

    @stack('scripts')
</body>
</html>
