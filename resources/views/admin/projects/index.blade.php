@extends('admin.layout')

@section('content')
    <div class="page-header">
        <h2>Manage Projects</h2>
        <a href="{{ route('admin.projects.create') }}" class="btn-primary btn-sm"><i class="fas fa-plus"></i> Add New Project</a>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Tech Stack</th>
                <th>Links</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $project)
            <tr>
                <td style="width: 100px;">
                    <img src="{{ Str::startsWith($project->image, 'http') ? $project->image : asset($project->image) }}" alt="" style="width: 80px; height: 50px; object-fit: cover; border-radius: 5px;">
                </td>
                <td>{{ $project->title }}</td>
                <td>
                    @foreach($project->tech_stack ?? [] as $tech)
                        <span style="font-size: 0.8rem; background: rgba(255,255,255,0.1); padding: 2px 6px; border-radius: 3px;">{{ $tech }}</span>
                    @endforeach
                </td>
                <td>
                    @if($project->live_link) <a href="{{ $project->live_link }}" target="_blank" style="color: var(--primary-color);"><i class="fas fa-link"></i></a> @endif
                    @if($project->github_link) <a href="{{ $project->github_link }}" target="_blank" style="color: var(--text-secondary);"><i class="fab fa-github"></i></a> @endif
                </td>
                <td>
                    <a href="{{ route('admin.projects.edit', $project->id) }}" class="action-btn"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('admin.projects.delete', $project->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn delete-btn" style="background: none; border: none; cursor: pointer;"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
