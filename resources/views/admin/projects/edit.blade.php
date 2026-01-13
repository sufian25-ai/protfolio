@extends('admin.layout')

@section('content')
    <div class="page-header">
        <h2>Edit Project: {{ $project->title }}</h2>
        <a href="{{ route('admin.projects') }}" class="btn-secondary btn-sm">Back to List</a>
    </div>

    <div style="background: var(--card-bg); padding: 30px; border-radius: 10px; border: var(--glass-border); max-width: 800px;">
        <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; color: var(--text-secondary);">Project Title</label>
                <input type="text" name="title" value="{{ $project->title }}" required style="width: 100%; padding: 10px; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 5px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; color: var(--text-secondary);">Description</label>
                <textarea name="description" rows="4" required style="width: 100%; padding: 10px; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 5px; font-family: inherit;">{{ $project->description }}</textarea>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; color: var(--text-secondary);">Project Image</label>
                @if(filter_var($project->image, FILTER_VALIDATE_URL))
                    <img src="{{ $project->image }}" alt="Current Image" style="width: 100px; height: 60px; object-fit: cover; border-radius: 5px; margin-bottom: 10px;">
                @else
                    <img src="{{ asset($project->image) }}" alt="Current Image" style="width: 100px; height: 60px; object-fit: cover; border-radius: 5px; margin-bottom: 10px;">
                @endif
                <input type="file" name="image" accept="image/*" style="width: 100%; padding: 10px; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 5px;">
                <small style="color: #666; display: block; margin-top: 5px;">Leave empty to keep current image</small>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; color: var(--text-secondary);">Tech Stack (comma separated)</label>
                <input type="text" name="tech_stack" value="{{ $techStackString }}" placeholder="Laravel, Vue, MySQL" style="width: 100%; padding: 10px; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 5px;">
            </div>

            <div style="display: flex; gap: 20px;">
                <div style="flex: 1; margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; color: var(--text-secondary);">Live Link</label>
                    <input type="url" name="live_link" value="{{ $project->live_link }}" style="width: 100%; padding: 10px; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 5px;">
                </div>
                <div style="flex: 1; margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; color: var(--text-secondary);">GitHub Link</label>
                    <input type="url" name="github_link" value="{{ $project->github_link }}" style="width: 100%; padding: 10px; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 5px;">
                </div>
            </div>

            <button type="submit" class="btn-primary">Update Project</button>
        </form>
    </div>
@endsection
