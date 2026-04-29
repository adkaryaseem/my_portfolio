@extends('admin.layout')

@section('title', 'Dashboard')
@section('header_title', 'Admin Dashboard')

@section('content')
<div class="skills-grid mb-2">
    <div class="glass-card text-center">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 10px;"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
        <h3>{{ $stats['projects'] }}</h3>
        <div class="text-muted">Projects</div>
    </div>
    <div class="glass-card text-center">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--secondary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 10px;"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
        <h3>{{ $stats['unread_messages'] }}</h3>
        <div class="text-muted">New Messages</div>
    </div>
    <div class="glass-card text-center">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 10px;"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>
        <h3>{{ $stats['skills'] }}</h3>
        <div class="text-muted">Skills</div>
    </div>
    <div class="glass-card text-center">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--secondary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 10px;"><path d="M22 12h-4l-3 9L9 3l-3 9H2"></path></svg>
        <h3>{{ $stats['experiences'] }}</h3>
        <div class="text-muted">Experiences</div>
    </div>
</div>

<div class="glass-card">
    <h3 class="mb-2">General Settings</h3>
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="form-label">Profile Picture</label>
            @php $profilePic = $settings->where('key', 'profile_picture')->first(); @endphp
            @if($profilePic && $profilePic->value)
                <div class="mb-1">
                    <img src="{{ $profilePic->value }}" alt="Profile" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; border: 2px solid var(--primary);">
                </div>
            @endif
            <input type="file" name="profile_picture" class="form-input">
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
            @php 
                $excludeKeys = ['profile_picture', 'github_url', 'linkedin_url', 'twitter_url', 'facebook_url', 'blog_url', 'contact_email'];
            @endphp
            @foreach($settings as $setting)
                @if(!str_starts_with($setting->key, 'mail_') && !in_array($setting->key, $excludeKeys) && !str_starts_with($setting->key, 'cube_'))
                    <div class="form-group">
                        <label class="form-label">{{ ucwords(str_replace('_', ' ', $setting->key)) }}</label>
                        @if(strlen($setting->value) > 100 || str_contains($setting->key, 'about'))
                            <textarea name="{{ $setting->key }}" class="form-input">{{ $setting->value }}</textarea>
                        @else
                            <input type="text" name="{{ $setting->key }}" class="form-input" value="{{ $setting->value }}">
                        @endif
                    </div>
                @endif
            @endforeach
        </div>

        <h4 class="mb-1 mt-2">Social Links & Contact</h4>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
            <div class="form-group">
                <label class="form-label">Contact Email</label>
                <input type="email" name="contact_email" class="form-input" value="{{ $settings->where('key', 'contact_email')->first()->value ?? '' }}">
            </div>
            <div class="form-group">
                <label class="form-label">Facebook URL</label>
                <input type="text" name="facebook_url" class="form-input" value="{{ $settings->where('key', 'facebook_url')->first()->value ?? '' }}">
            </div>
            <div class="form-group">
                <label class="form-label">LinkedIn URL</label>
                <input type="text" name="linkedin_url" class="form-input" value="{{ $settings->where('key', 'linkedin_url')->first()->value ?? '' }}">
            </div>
            <div class="form-group">
                <label class="form-label">GitHub URL</label>
                <input type="text" name="github_url" class="form-input" value="{{ $settings->where('key', 'github_url')->first()->value ?? '' }}">
            </div>
            <div class="form-group">
                <label class="form-label">Blog URL</label>
                <input type="text" name="blog_url" class="form-input" value="{{ $settings->where('key', 'blog_url')->first()->value ?? '' }}">
            </div>
            <div class="form-group">
                <label class="form-label">Twitter URL</label>
                <input type="text" name="twitter_url" class="form-input" value="{{ $settings->where('key', 'twitter_url')->first()->value ?? '' }}">
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-1">Save General Settings</button>
    </form>
</div>

<div class="glass-card mt-2">
    <h3 class="mb-2">3D Cube Customization</h3>
    <p class="text-muted mb-2">Configure the content for each face of the 3D cube. Upload an image to override the text.</p>
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
            @php
                $faces = ['front', 'back', 'right', 'left', 'top', 'bottom'];
            @endphp
            @foreach($faces as $face)
                <div class="glass-card" style="padding: 1.5rem; background: rgba(255,255,255,0.02);">
                    <h4 class="mb-1" style="text-transform: capitalize;">{{ $face }} Face</h4>
                    <div class="form-group">
                        <label class="form-label">Text Content</label>
                        <input type="text" name="cube_text_{{ $face }}" class="form-input" value="{{ $settings->where('key', 'cube_text_'.$face)->first()->value ?? '' }}" placeholder="Enter text...">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Or Image</label>
                        @php $img = $settings->where('key', 'cube_img_'.$face)->first(); @endphp
                        @if($img && $img->value)
                            <div class="mb-1">
                                <img src="{{ $img->value }}" alt="{{ $face }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                            </div>
                        @endif
                        <input type="file" name="cube_img_{{ $face }}" class="form-input">
                    </div>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary mt-2">Update Cube Faces</button>
    </form>
</div>
@endsection
