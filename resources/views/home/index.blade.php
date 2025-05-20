@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-4xl space-y-8 mt-4 md:mt-6 px-5">
        <!-- Hero Banner -->
        <div class="relative overflow-hidden h-48 md:h-56 bg-gradient-to-br from-rose-500 to-rose-400 flex items-center rounded-sm">
            <!-- Decorative pattern -->
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxwYXRoIGQ9Ik0zNiAxOGMzLjMxNCAwIDYgMi42ODYgNiA2cy0yLjY4NiA2LTYgNi02LTIuNjg2LTYtNiAyLjY4Ni02IDYtNiIgc3Ryb2tlPSJyZ2JhKDI1NSwyNTUsMjU1LDAuMSkiLz48L2c+PC9zdmc+')] opacity-50"></div>

            <!-- Content -->
            <div class="relative z-10 px-6 md:px-8 w-full">
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-3 ns tracking-tight">ปากหวาน</h2>
                <p class="text-white/90 md:text-lg mb-5">เปิดโลกนิยายไร้ขอบ อ่านรอบเดียวตรึงใจ</p>
                <a href="{{ route('novels.index') }}"
                    class="inline-flex items-center gap-2 bg-white hover:bg-white/95 px-4 py-2 rounded-sm text-sm font-medium transition-colors">
                    <span>เริ่มอ่านเลย</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Categories -->
        <div>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-base font-bold">หมวดหมู่</h2>
                <a href="{{ route('novels.index') }}" class="text-sm hover:underline">ดูทั้งหมด</a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2">
                @foreach ($categories as $category)
                    <a href="{{ route('novels.index', ['category' => $category->slug]) }}"
                        class="flex items-center gap-2.5 p-3 rounded-sm bg-gray-100 hover:bg-gray-200 transition-colors">
                        @if ($category->icon)
                            <span class="text-lg size-5">{!! $category->icon !!}</span>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        @endif
                        <span class="text-sm">{{ $category->name }}</span>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Featured Novels -->
        <section>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-base font-bold">นิยายมาแรง</h2>
                <a href="{{ route('novels.index') }}" class="text-sm hover:underline">ดูทั้งหมด</a>
            </div>
            <!-- Grid view for desktop -->
            <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-4">
                @foreach ($popularNovels as $novel)
                    <a href="{{ route('novels.show', $novel) }}" class="group col-span-1">
                        <div class="relative">                        
                            <div class="relative aspect-[3/4] mb-3 overflow-hidden rounded-sm transition-transform duration-300 hover:-translate-y-1">
                            @if ($novel->cover_image)
                                    <img src="{{ Storage::url($novel->cover_image) }}"
                                        alt="{{ $novel->title }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute top-2 right-2 px-1.5 py-0.5 text-[10px] bg-white/90 rounded-sm backdrop-blur-sm">
                                    {{ $novel->category->name }}
                                </div>
                            </div>
                            <h3 class="text-sm font-medium line-clamp-1 group-transition-colors">{{ $novel->title }}</h3>
                            <p class="text-xs text-gray-600 mt-1">โดย {{ $novel->author->name ?? 'ไม่ทราบผู้เขียน' }}</p>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="inline-flex items-center gap-1 text-[10px] text-inkLight">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    {{ number_format($novel->views) }}
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- Latest Updates -->
        <section class="mt-10">
            <div class="flex items-center justify-between mb-5">
                <h2 class="text-lg font-bold flex items-center gap-2">
                    <span class="w-1 h-5 bg-paakwaan rounded-full"></span>
                    <span class="flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        อัพเดทล่าสุด
                    </span>
                </h2>
                <a href="{{ route('novels.index', ['sort' => 'updated']) }}"
                    class="text-xs text-gray-500 flex items-center gap-1 transition-colors">
                    ดูทั้งหมด
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            <div class="space-y-3">
                @foreach ($latestChapters as $chapter)
                    <a href="{{ route('novels.chapters.show', [$chapter->novel, $chapter]) }}"
                        class="block bg-white rounded-md p-3.5 shadow-sm hover:shadow-md border-0 transition-all duration-300">
                        <div class="flex gap-3.5">
                            <div class="flex-none w-12 h-16 rounded-sm overflow-hidden bg-gray-50">
                                @if ($chapter->novel->cover_image)
                                    <img src="{{ Storage::url($chapter->novel->cover_image) }}"
                                        alt="{{ $chapter->novel->title }}"
                                        class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-1">
                                    <h3 class="text-sm font-bold truncate">{{ $chapter->novel->title }}</h3>
                                    <span class="flex-none text-[10px] px-1.5 py-0.5 rounded-md bg-paakwaan/10">
                                        {{ $chapter->novel->category->name }}
                                    </span>
                                </div>
                                <p class="text-xs text-gray-600 line-clamp-1">
                                    ตอนที่ {{ $chapter->chapter_number }} - {{ $chapter->title }}
                                </p>
                                <div class="mt-2 flex items-center gap-3">
                                    <span class="inline-flex items-center gap-1 text-[10px] text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $chapter->created_at->diffForHumans() }}
                                    </span>
                                    <span class="inline-flex items-center gap-1 text-[10px] text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        {{ number_format($chapter->views) }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex-none self-center">
                                <div class="w-7 h-7 rounded-full flex items-center justify-center bg-gray-50 text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    </div>
@endsection
