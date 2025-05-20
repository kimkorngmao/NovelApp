@extends('layouts.app')

@section('content')
<article>
    <!-- Top Navigation Bar -->
    <div class="fixed top-0 inset-x-0 z-50 bg-white/95 backdrop-blur-xl border-b border-gray-100 transition-opacity duration-200" id="topNav">
        <div class="mx-auto max-w-4xl px-4">
            <div class="h-16 flex items-center justify-between gap-4">
                <a href="{{ route('novels.show', $novel) }}"
                   class="flex items-center gap-2 text-gray-500 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span class="text-sm font-medium">กลับไปหน้านิยาย</span>
                </a>

                <div class="text-center flex-1 min-w-0">
                    <h1 class="text-sm font-medium truncate">{{ $novel->title }}</h1>                
                </div>
                <div class="w-24"></div>
            </div>
        </div>
    </div>

    <!-- Reading Area -->
    <div class="mx-auto max-w-4xl px-4 pt-12">
        <!-- Chapter Title -->
        <header class="mb-12 text-center space-y-3">
            <div class="inline-flex items-center justify-center px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-sm">
                ตอนที่ {{ $chapter->chapter_number }}
            </div>
            <h1 class="text-2xl font-medium text-gray-900 tracking-tight">{{ $chapter->title }}</h1>
        </header>

        <!-- Content -->
        <div class="mb-16 text-lg leading-relaxed tracking-wide">
            <div class="prose max-w-none">
                <div class="mb-12">
                    {!! $chapter->content !!}
                </div>
            </div>
        </div>

        <!-- Chapter Navigation -->
        <nav class="bg-white/95 backdrop-blur-xl border-t border-gray-100 py-4">
            <div class="mx-auto max-w-4xl flex items-center justify-between gap-4">
                @if($prevChapter)
                    <a href="{{ route('novels.chapters.show', [$novel, $prevChapter]) }}"
                       class="flex-1 flex items-center justify-center gap-2 h-12 bg-gray-100 hover:bg-gray-50 text-gray-600 rounded-lg text-sm font-medium transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7" />
                        </svg>
                        ตอนก่อนหน้า
                    </a>
                @else
                    <div class="flex-1"></div>
                @endif

                @if($nextChapter)
                    <a href="{{ route('novels.chapters.show', [$novel, $nextChapter]) }}"
                       class="flex-1 flex items-center justify-center gap-2 h-12 bg-rose-500 hover:bg-rose-500/90 text-white rounded-lg text-sm font-medium transition-colors">
                        ตอนถัดไป
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                @else
                    <div class="flex-1"></div>
                @endif
            </div>
        </nav>
    </div>
</article>

@push('scripts')
<script>
    // Hide/show navigation on scroll
    let lastScrollY = window.scrollY;
    const topNav = document.getElementById('topNav');

    window.addEventListener('scroll', () => {
        if (window.scrollY > lastScrollY) {
            topNav.style.opacity = '0';
            topNav.style.pointerEvents = 'none';
        } else {
            topNav.style.opacity = '1';
            topNav.style.pointerEvents = 'auto';
        }
        lastScrollY = window.scrollY;
    });

    // Add touch swipe navigation
    document.addEventListener('touchstart', handleTouchStart, false);
    document.addEventListener('touchmove', handleTouchMove, false);

    let xDown = null;
    let yDown = null;

    function handleTouchStart(evt) {
        xDown = evt.touches[0].clientX;
        yDown = evt.touches[0].clientY;
    }

    function handleTouchMove(evt) {
        if (!xDown || !yDown) {
            return;
        }

        const xUp = evt.touches[0].clientX;
        const yUp = evt.touches[0].clientY;
        const xDiff = xDown - xUp;
        const yDiff = yDown - yUp;

        if (Math.abs(xDiff) > Math.abs(yDiff)) {
            if (xDiff > 0 && document.querySelector('a[href*="next"]')) {
                // Swipe left - Next Chapter
                window.location.href = document.querySelector('a[href*="next"]').href;
            } else if (xDiff < 0 && document.querySelector('a[href*="prev"]')) {
                // Swipe right - Previous Chapter
                window.location.href = document.querySelector('a[href*="prev"]').href;
            }
        }

        xDown = null;
        yDown = null;
    }
</script>
@endpush
@endsection
