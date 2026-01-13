@extends('layouts.app')

@section('content')
<div class="container" style="padding-top: 120px; padding-bottom: 60px;">
    <div class="section-title" data-aos="fade-up">
        <h2>Latest Articles</h2>
        <p class="section-subtitle">Thoughts, tutorials, and insights.</p>
    </div>

    <div class="projects-grid">
        @foreach($articles as $article)
        <div class="project-card" data-aos="fade-up">
            <div class="project-img-container">
                @if($article->image)
                    <img src="{{ asset($article->image) }}" alt="{{ $article->title }}" class="project-img">
                @else
                    <div style="width:100%; height:100%; background:#1e293b; display:flex; align-items:center; justify-content:center; color:#94a3b8;">No Image</div>
                @endif
                <div class="project-overlay">
                    <a href="{{ route('blog.show', $article->slug) }}" class="project-link"><i class="fas fa-eye"></i></a>
                </div>
            </div>
            <div class="project-content">
                <div style="opacity: 0.7; font-size: 0.8rem; margin-bottom: 5px; font-family: var(--font-code);">
                    {{ $article->created_at->format('M d, Y') }} | <i class="fas fa-eye"></i> {{ $article->views }}
                </div>
                <h3 class="project-title">{{ $article->title }}</h3>
                <p class="project-desc">{{ Str::limit(strip_tags($article->content), 100) }}</p>
                <a href="{{ route('blog.show', $article->slug) }}" class="btn-primary" style="padding: 8px 15px; font-size: 0.8rem;">Read More</a>
            </div>
        </div>
        @endforeach
    </div>

    <div style="margin-top: 40px; display: flex; justify-content: center;">
        {{ $articles->links() }} 
    </div>
</div>
@endsection
