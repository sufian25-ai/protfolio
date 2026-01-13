@extends('admin.layout')

@section('content')
    <div class="page-header">
        <h2>Add New Project</h2>
        <a href="{{ route('admin.projects') }}" class="btn-secondary btn-sm">Back to List</a>
    </div>

    <div style="background: var(--card-bg); padding: 30px; border-radius: 10px; border: var(--glass-border); max-width: 800px;">
    <div style="background: var(--card-bg); padding: 30px; border-radius: 10px; border: var(--glass-border); max-width: 800px;">
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; color: var(--text-secondary);">Project Title</label>
                <input type="text" name="title" required style="width: 100%; padding: 10px; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 5px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; color: var(--text-secondary);">Description</label>
                <textarea name="description" rows="4" required style="width: 100%; padding: 10px; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 5px; font-family: inherit;"></textarea>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; color: var(--text-secondary);">Project Image</label>
                <input type="file" name="image" required accept="image/*" style="width: 100%; padding: 10px; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 5px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; color: var(--text-secondary);">Tech Stack (comma separated)</label>
                <input type="text" name="tech_stack" placeholder="Laravel, Vue, MySQL" style="width: 100%; padding: 10px; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 5px;">
            </div>

            <div style="display: flex; gap: 20px;">
                <div style="flex: 1; margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; color: var(--text-secondary);">Live Link</label>
                    <input type="url" name="live_link" style="width: 100%; padding: 10px; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 5px;">
                </div>
                <div style="flex: 1; margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; color: var(--text-secondary);">GitHub Link</label>
                    <input type="url" name="github_link" style="width: 100%; padding: 10px; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 5px;">
                </div>
            </div>

            <button type="submit" class="btn-primary">Create Project</button>
        </form>
    </div>
@endsection
