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
<body class="font-thai antialiased">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold text-gray-800">
                                Admin Panel
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                            <a href="{{ route('admin.dashboard') }}"
                               class="@if (Route::is('admin.dashboard')) border-indigo-500 text-gray-900 @else border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 @endif inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                แดชบอร์ด
                            </a>
                            <a href="{{ route('admin.novels.index') }}"
                               class="@if (Route::is('admin.novels.*')) border-indigo-500 text-gray-900 @else border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 @endif inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                นิยาย
                            </a>
                            <a href="{{ route('admin.categories.index') }}"
                               class="@if (Route::is('admin.categories.*')) border-indigo-500 text-gray-900 @else border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 @endif inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                หมวดหมู่
                            </a>
                            <a href="{{ route('admin.pages.index') }}"
                               class="@if (Route::is('admin.pages.*')) border-indigo-500 text-gray-900 @else border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 @endif inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                จัดการหน้า
                            </a>
                            <a href="{{ route('admin.users.index') }}"
                               class="@if (Route::is('admin.users.*')) border-indigo-500 text-gray-900 @else border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 @endif inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                ผู้ใช้งาน
                            </a>
                        </div>
                    </div>

                    <!-- User Menu -->
                    <div class="flex items-center">
                        <div class="relative">
                            <button id="userMenuButton" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                                <span class="sr-only">Open user menu</span>
                                <img class="h-8 w-8 rounded-full object-cover"
                                     src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}"
                                     alt="{{ auth()->user()->name }}">
                            </button>

                            <!-- Dropdown Menu -->
                            <div id="userDropdownMenu"
                                 class="origin-top-right z-50 absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 transition-all duration-200 opacity-0 invisible pointer-events-none">
                                <!-- Back to Site -->
                                <a href="{{ url('/') }}"
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    กลับสู่หน้าเว็บ
                                </a>
                                <!-- Logout -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        ออกจากระบบ
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @if (session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    @stack('scripts')

    <script>
        // User dropdown menu
        document.addEventListener('DOMContentLoaded', function () {
            const button = document.getElementById('userMenuButton');
            const menu = document.getElementById('userDropdownMenu');

            button.addEventListener('click', function (e) {
                e.stopPropagation();
                const isOpen = menu.classList.contains('opacity-100');
                if (isOpen) {
                    menu.classList.remove('opacity-100', 'visible', 'pointer-events-auto');
                    menu.classList.add('opacity-0', 'invisible', 'pointer-events-none');
                } else {
                    menu.classList.remove('opacity-0', 'invisible', 'pointer-events-none');
                    menu.classList.add('opacity-100', 'visible', 'pointer-events-auto');
                }
            });

            document.addEventListener('click', function () {
                menu.classList.remove('opacity-100', 'visible', 'pointer-events-auto');
                menu.classList.add('opacity-0', 'invisible', 'pointer-events-none');
            });
        });
    </script>
</body>
</html>
