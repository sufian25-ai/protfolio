@extends('admin.layout')

@section('content')
    <div class="page-header">
        <h2>Edit Article</h2>
        <a href="{{ route('admin.articles') }}" class="btn-secondary">Back</a>
    </div>

    <div style="background: var(--card-bg); padding: 30px; border-radius: 10px; border: var(--glass-border); max-width: 800px;">
        <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; color: var(--text-secondary);">Article Title</label>
                <input type="text" name="title" value="{{ $article->title }}" required style="width: 100%; padding: 12px; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 5px; font-size: 1.1rem;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; color: var(--text-secondary);">Current Image</label>
                @if($article->image)
                    <img src="{{ asset($article->image) }}" alt="img" style="width: 100px; height: 60px; object-fit: cover; border-radius: 5px; margin-bottom: 10px;">
                @endif
                <input type="file" name="image" accept="image/*" style="width: 100%; padding: 10px; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 5px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; color: var(--text-secondary);">Status</label>
                <select name="is_published" style="width: 100%; padding: 12px; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 5px;">
                    <option value="1" {{ $article->is_published ? 'selected' : '' }}>Published</option>
                    <option value="0" {{ !$article->is_published ? 'selected' : '' }}>Draft</option>
                </select>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; color: var(--text-secondary);">Content (Markdown supported)</label>
                <textarea name="content" rows="15" required style="width: 100%; padding: 15px; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 5px; font-family: var(--font-code); line-height: 1.6;">{{ $article->content }}</textarea>
            </div>

            <button type="submit" class="btn-primary">Update Article</button>
        </form>
    </div>
@endsection
