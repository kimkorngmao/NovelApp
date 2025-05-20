@extends('layouts.app')

@section('content')
<div class="min-h-screen">
    <div class="mx-auto max-w-4xl space-y-6 py-4 px-5">
        <!-- Search Bar -->
        <div class="sticky top-14 z-40 -mx-5 px-5 pb-4 pt-2 bg-white/95 backdrop-blur-lg">
            <div class="relative">
                <span class="absolute inset-y-0 left-3 flex items-center text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <form action="{{ route('novels.index') }}" method="GET">
                    <input type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="w-full h-12 pl-10 pr-4 bg-white rounded-lg border border-gray-200 text-sm focus:border-rose-500 focus:ring-1 focus:ring-rose-500"
                        placeholder="ค้นหานิยาย...">
                </form>
            </div>
        </div>

        <!-- Categories -->
        <div class="flex gap-2 overflow-x-auto scrollbar-none py-2">
            <a href="{{ route('novels.index') }}"
               class="flex-none px-4 h-10 flex items-center justify-center rounded-full text-sm font-medium {{ !request('category') ? 'bg-rose-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-50' }} transition-colors">
                ทั้งหมด
            </a>
            @foreach($categories as $category)
                <a href="{{ route('novels.index', ['category' => $category->slug]) }}"
                   class="flex-none px-4 h-10 flex items-center justify-center rounded-full text-sm font-medium {{ request('category') == $category->slug ? 'bg-rose-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-50' }} transition-colors">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>

        <!-- Sort Options -->
        <div class="flex gap-2 overflow-x-auto scrollbar-none">
            <a href="{{ route('novels.index', ['sort' => 'popular']) }}"
               class="flex-none px-4 h-10 flex items-center justify-center rounded-full text-sm font-medium {{ request('sort') == 'popular' ? 'bg-rose-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-50' }} transition-colors">
                ยอดนิยม
            </a>
            <a href="{{ route('novels.index', ['sort' => 'latest']) }}"
               class="flex-none px-4 h-10 flex items-center justify-center rounded-full text-sm font-medium {{ request('sort') == 'latest' ? 'bg-rose-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-50' }} transition-colors">
                ล่าสุด
            </a>
            <a href="{{ route('novels.index', ['sort' => 'updated']) }}"
               class="flex-none px-4 h-10 flex items-center justify-center rounded-full text-sm font-medium {{ request('sort') == 'updated' ? 'bg-rose-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-50' }} transition-colors">
                อัปเดตล่าสุด
            </a>
        </div>

        @if(request()->hasAny(['search', 'category', 'sort']))
            <div class="flex justify-center">
                <a href="{{ route('novels.index') }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2 text-sm text-inkLight transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    <span>ล้างการค้นหา</span>
                </a>
            </div>
        @endif

        <!-- Results -->
        @if($novels->isEmpty())
            <div class="flex flex-col items-center justify-center py-16 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">ไม่พบนิยาย</h3>
                <p class="text-sm text-gray-500">ลองปรับเปลี่ยนคำค้นหาหรือตัวกรองของคุณ</p>
            </div>
        @else
            <!-- Novel Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-6">
                @foreach($novels as $novel)
                    <a href="{{ route('novels.show', $novel) }}" class="group">
                        <div class="relative">
                            <div class="relative aspect-[3/4] mb-3 overflow-hidden rounded-sm transition-transform duration-300 hover:-translate-y-1">
                                @if($novel->cover_image)
                                    <img src="{{ Storage::url($novel->cover_image) }}"
                                         alt="{{ $novel->title }}"
                                         class="w-full h-full object-cover" />
                                @else
                                    <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute top-2 right-2 px-2 py-1 text-[10px] bg-white/90 rounded-full backdrop-blur-sm">
                                    {{ $novel->category->name }}
                                </div>
                            </div>
                            <div class="space-y-1.5">
                                <h3 class="text-sm font-medium line-clamp-2 group-transition-colors">
                                    {{ $novel->title }}
                                </h3>
                                <p class="text-xs text-gray-500 line-clamp-1">
                                    โดย {{ $novel->author->name ?? 'ผู้เขียนไม่ระบุชื่อ' }}
                                </p>
                                <div class="flex items-center gap-3 pt-1">
                                    <span class="inline-flex items-center gap-1 text-[10px] text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        {{ number_format($novel->views) }}
                                    </span>
                                    <span class="inline-flex items-center gap-1 text-[10px] text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                        {{ $novel->chapters_count }} ตอน
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-10 flex justify-center">
                {{ $novels->withQueryString()->links() }}
            </div>
        @endif
    </div>
</div>
@endsection