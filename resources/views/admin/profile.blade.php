@extends('admin.layout')

@section('content')
    <div class="page-header">
        <h2>Edit Profile / About Me</h2>
    </div>

    @if(session('success'))
        <div style="background: rgba(0, 255, 0, 0.1); border: 1px solid rgba(0, 255, 0, 0.3); color: #00ff00; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="background: var(--card-bg); padding: 30px; border-radius: 10px; border: var(--glass-border); max-width: 800px;">
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div style="display: flex; gap: 20px; margin-bottom: 20px;">
                <div style="flex: 1;">
                    <label style="display: block; margin-bottom: 8px; color: var(--text-secondary);">Your Name</label>
                    <input type="text" name="name" value="{{ $profile->name }}" required style="width: 100%; padding: 10px; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 5px;">
                </div>
                <div style="flex: 1;">
                    <label style="display: block; margin-bottom: 8px; color: var(--text-secondary);">Professional Title</label>
                    <input type="text" name="title" value="{{ $profile->title }}" style="width: 100%; padding: 10px; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 5px;">
                </div>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; color: var(--text-secondary);">About Description</label>
                <textarea name="description" rows="6" style="width: 100%; padding: 10px; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 5px; font-family: inherit;">{{ $profile->description }}</textarea>
            </div>

            <div style="display: flex; gap: 20px; margin-bottom: 20px;">
                <div style="flex: 1;">
                    <label style="display: block; margin-bottom: 8px; color: var(--text-secondary);">Years Experience (e.g. 10+)</label>
                    <input type="text" name="experience_years" value="{{ $profile->experience_years }}" style="width: 100%; padding: 10px; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 5px;">
                </div>
                <div style="flex: 1;">
                    <label style="display: block; margin-bottom: 8px; color: var(--text-secondary);">Projects Completed</label>
                    <input type="text" name="projects_completed" value="{{ $profile->projects_completed }}" style="width: 100%; padding: 10px; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 5px;">
                </div>
                <div style="flex: 1;">
                    <label style="display: block; margin-bottom: 8px; color: var(--text-secondary);">Clients Satisfied</label>
                    <input type="text" name="clients_satisfied" value="{{ $profile->clients_satisfied }}" style="width: 100%; padding: 10px; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 5px;">
                </div>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; color: var(--text-secondary);">Profile Image</label>
                @if($profile->image)
                    <div style="margin-bottom: 10px;">
                         @if(filter_var($profile->image, FILTER_VALIDATE_URL))
                            <img src="{{ $profile->image }}" alt="Current Image" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">
                        @else
                            <img src="{{ asset($profile->image) }}" alt="Current Image" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">
                        @endif
                    </div>
                @endif
                <input type="file" name="image" accept="image/*" style="width: 100%; padding: 10px; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 5px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; color: var(--text-secondary);">Upload CV (PDF only)</label>
                @if($profile->cv_path)
                    <div style="margin-bottom: 10px;">
                        <a href="{{ asset($profile->cv_path) }}" target="_blank" style="color: var(--primary-color);">View Current CV</a>
                    </div>
                @endif
                <input type="file" name="cv" accept="application/pdf" style="width: 100%; padding: 10px; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 5px;">
            </div>

            <button type="submit" class="btn-primary">Update Profile</button>
        </form>
    </div>
@endsection
