@extends('admin.layout')

@section('content')
    <div class="page-header">
        <h2>Client Testimonials</h2>
        <a href="{{ route('admin.testimonials.create') }}" class="btn-primary"><i class="fas fa-plus"></i> Add Testimonial</a>
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
                    <th>Name</th>
                    <th>Role</th>
                    <th>Rating</th>
                    <th>Review</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($testimonials as $testimonial)
                <tr>
                    <td>
                        @if($testimonial->image)
                            <img src="{{ asset($testimonial->image) }}" alt="img" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                        @else
                            <div style="width: 50px; height: 50px; background: #333; border-radius: 50%;"></div>
                        @endif
                    </td>
                    <td>{{ $testimonial->name }}</td>
                    <td>{{ $testimonial->role }}</td>
                    <td>{{ $testimonial->rating }} <i class="fas fa-star" style="color: gold; font-size: 0.8rem;"></i></td>
                    <td>{{ Str::limit($testimonial->review, 50) }}</td>
                    <td>
                        <a href="{{ route('admin.testimonials.delete', $testimonial->id) }}" onclick="return confirm('Are you sure?')" class="btn-sm" style="color: #ff5f56;"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
