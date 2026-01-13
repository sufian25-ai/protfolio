@extends('layouts.app')

@section('seo')
    <title>{{ $article->title }} - My Blog</title>
    <meta name="description" content="{{ Str::limit(strip_tags($article->content), 160) }}">
    <meta property="og:title" content="{{ $article->title }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($article->content), 160) }}">
    <meta property="og:image" content="{{ $article->image }}">
    <meta property="og:type" content="article">
@endsection

@section('content')
<div class="container" style="padding-top: 120px; padding-bottom: 100px; max-width: 900px;">
    <a href="{{ route('blog.index') }}" class="btn-secondary" style="margin-bottom: 30px;"><i class="fas fa-arrow-left"></i> Back to Blog</a>

    <div data-aos="fade-up">
        @if($article->image)
            <img src="{{ asset($article->image) }}" alt="{{ $article->title }}" style="width: 100%; max-height: 400px; object-fit: cover; border-radius: 15px; margin-bottom: 30px;">
        @endif

        <h1 style="font-size: 2.5rem; color: var(--text-primary); margin-bottom: 15px;">{{ $article->title }}</h1>
        
        <div style="color: var(--text-secondary); margin-bottom: 30px; font-family: var(--font-code); display: flex; gap: 20px;">
            <span><i class="far fa-calendar"></i> {{ $article->created_at->format('M d, Y') }}</span>
            <span><i class="far fa-eye"></i> {{ $article->views }} Views</span>
        </div>

        <div class="article-content" style="color: var(--text-secondary); line-height: 1.8; font-size: 1.1rem;">
            {!! nl2br(e($article->content)) !!} 
            {{-- Note: For real markdown, use a parser like accessing Parsedown in controller or view --}}
        </div>
    </div>
</div>
@endsection
