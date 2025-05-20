@extends('layouts.app')

@section('content')
<article class="min-h-screen bg-gray-50/40">
    <!-- Novel Header -->
    <header class="relative bg-white/80 backdrop-blur-xl border-b border-gray-100">
        <div class="mx-auto max-w-4xl px-5 py-10">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Cover Image -->
                <div class="flex-none w-48 mx-auto md:mx-0">
                    <div class="relative aspect-[3/4] rounded-sm overflow-hidden bg-gray-50 shadow-sm group transition-transform duration-300 hover:-translate-y-1">
                        @if($novel->cover_image)
                            <img src="{{ asset('storage/' . $novel->cover_image) }}"
                                 alt="{{ $novel->title }}"
                                 class="w-full h-full object-cover transition-transform duration-300">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Novel Info -->
                <div class="flex-1 min-w-0 text-center md:text-left">
                    <div class="space-y-4">
                        <div class="space-y-1.5">
                            <h1 class="text-2xl font-bold leading-snug tracking-tight">{{ $novel->title }}</h1>
                        </div>

                        <!-- Author & Stats -->
                        <div class="flex items-center gap-6 text-sm text-gray-500 justify-center md:justify-start">
                            <span class="inline-flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                {{ $novel->author->name ?? 'ไม่ทราบผู้เขียน' }}
                            </span>
                            <span class="inline-flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                {{ number_format($novel->views) }}
                            </span>
                        </div>

                        <!-- Tags -->
                        <div class="flex flex-wrap gap-2 justify-center md:justify-start">
                            <span class="px-3 py-1 rounded-[4px] text-sm bg-rose-50 font-medium">
                                {{ $novel->category->name }}
                            </span>
                            <span class="px-3 py-1 rounded-[4px] text-sm font-medium {{ $novel->status === 'completed' ? 'bg-emerald-50 text-emerald-600' : 'bg-amber-50 text-amber-600' }}">
                                {{ $novel->status === 'completed' ? 'จบแล้ว' : 'กำลังเขียน' }}
                            </span>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-3 mt-6 justify-center md:justify-start">
                            @if($novel->chapters->isNotEmpty())
                                <a href="{{ route('novels.chapters.show', [$novel, $novel->chapters->first()]) }}"
                                   class="inline-flex items-center justify-center gap-2 px-8 py-3 bg-rose-500 text-white rounded-[4px] text-base font-medium shadow-sm hover:bg-rose-500/90 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>เริ่มอ่าน</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Description -->
    <div class="mx-auto max-w-4xl px-5 py-8">
        <div class="bg-white rounded-[4px] p-8 shadow-sm border border-gray-100">
            <h3 class="text-base font-bold mb-4 flex items-center gap-2 text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                เกี่ยวกับเรื่องนี้
            </h3>
            <div class="prose text-base text-gray-600 leading-relaxed">{!! $novel->description !!}</div>
        </div>
    </div>

    <!-- Chapters List -->
    <div class="mx-auto max-w-4xl px-5 py-6 pb-20">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-bold flex items-center gap-2 text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                รายการตอน
            </h2>
            <span class="text-sm text-gray-500">
                ทั้งหมด {{ $novel->chapters->count() }} ตอน
            </span>
        </div>

        <div class="bg-white rounded-[4px] divide-y divide-gray-100 border border-gray-100 shadow-sm">
            @forelse($novel->chapters->sortBy('chapter_number') as $chapterItem)
                <a href="{{ route('novels.chapters.show', [$novel, $chapterItem]) }}"
                   class="flex items-center gap-4 p-4 hover:bg-gray-50 transition-colors">
                    <span class="flex-none w-12 h-12 flex items-center justify-center text-sm font-medium text-gray-600">
                        {{ $chapterItem->chapter_number }}
                    </span>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-base font-medium text-gray-900 truncate">{{ $chapterItem->title }}</h3>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-none text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            @empty
                <div class="p-8 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-base font-medium text-gray-900 mb-1">ยังไม่มีตอนใดๆ</h3>
                    <p class="text-sm text-gray-500">ขออภัย ยังไม่มีตอนใดๆ สำหรับนิยายเรื่องนี้</p>
                </div>
            @endforelse
        </div>
    </div>
</article>
@endsection
