@extends('layouts.app')

@section('content')
    {{-- {!! page->content !!} --}}
    <div class="prose mx-auto max-w-4xl px-4 py-8">
        {!! $page->content !!}
    </div>
@endsection
