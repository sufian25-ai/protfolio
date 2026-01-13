@extends('admin.layout')

@section('content')
    <div class="page-header">
        <h2>Add New Testimonial</h2>
        <a href="{{ route('admin.testimonials') }}" class="btn-secondary">Back</a>
    </div>

    <div style="background: var(--card-bg); padding: 30px; border-radius: 10px; border: var(--glass-border); max-width: 600px;">
        <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div style="display: flex; gap: 20px; margin-bottom: 20px;">
                <div style="flex: 1;">
                    <label style="display: block; margin-bottom: 8px; color: var(--text-secondary);">Client Name</label>
                    <input type="text" name="name" required style="width: 100%; padding: 12px; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 5px;">
                </div>
                <div style="flex: 1;">
                    <label style="display: block; margin-bottom: 8px; color: var(--text-secondary);">Role/Company</label>
                    <input type="text" name="role" style="width: 100%; padding: 12px; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 5px;">
                </div>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; color: var(--text-secondary);">Rating (1-5)</label>
                <select name="rating" style="width: 100%; padding: 12px; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 5px;">
                    <option value="5">⭐⭐⭐⭐⭐ (5)</option>
                    <option value="4">⭐⭐⭐⭐ (4)</option>
                    <option value="3">⭐⭐⭐ (3)</option>
                    <option value="2">⭐⭐ (2)</option>
                    <option value="1">⭐ (1)</option>
                </select>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; color: var(--text-secondary);">Review</label>
                <textarea name="review" rows="4" required style="width: 100%; padding: 15px; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 5px;"></textarea>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; color: var(--text-secondary);">Client Photo</label>
                <input type="file" name="image" accept="image/*" style="width: 100%; padding: 10px; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 5px;">
            </div>

            <button type="submit" class="btn-primary">Save Review</button>
        </form>
    </div>
@endsection
