@extends('admin.layout')

@section('content')
    <div class="page-header">
        <h2>Blog Articles</h2>
        <a href="{{ route('admin.articles.create') }}" class="btn-primary"><i class="fas fa-plus"></i> New Article</a>
    </div>

    @if(session('success'))
        <div style="background: rgba(0, 255, 0, 0.1); border: 1px solid rgba(0, 255, 0, 0.3); color: #00ff00; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Views</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles as $article)
                <tr>
                    <td>
                        @if($article->image)
                            <img src="{{ asset($article->image) }}" alt="img" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                        @else
                            <div style="width: 50px; height: 50px; background: #333; border-radius: 5px;"></div>
                        @endif
                    </td>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->views }}</td>
                    <td>
                        @if($article->is_published)
                            <span style="color: #00ff00;">Published</span>
                        @else
                            <span style="color: #ffbd2e;">Draft</span>
                        @endif
                    </td>
                    <td>{{ $article->created_at->format('M d, Y') }}</td>
                    <td>
                        <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn-sm" style="color: var(--primary-color); margin-right: 10px;"><i class="fas fa-edit"></i></a>
                        <a href="{{ route('admin.articles.delete', $article->id) }}" onclick="return confirm('Are you sure?')" class="btn-sm" style="color: #ff5f56;"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
