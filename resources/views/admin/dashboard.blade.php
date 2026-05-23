@extends('admin.layout')

@section('title', 'Dashboard')
@section('header_title', 'Admin Dashboard')

@section('content')
<!-- Stats Grid -->
<div class="stats-container">
    <div class="stat-card">
        <div class="stat-icon text-[#8b5cf6]">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
        </div>
        <div class="stat-value">{{ $stats['projects'] }}</div>
        <div class="stat-label">Projects</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon text-[#ec4899]">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
        </div>
        <div class="stat-value">{{ $stats['unread_messages'] }}</div>
        <div class="stat-label">New Messages</div>
    </div>

    <div class="stat-card">
        <div class="stat-icon text-[#8b5cf6]">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
        </div>
        <div class="stat-value">{{ $stats['skills'] }}</div>
        <div class="stat-label">Skills</div>
    </div>
</div>

<div class="stats-secondary">
    <div class="stat-card">
        <div class="stat-icon text-[#ec4899]">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
        </div>
        <div class="stat-value">{{ $stats['experiences'] }}</div>
        <div class="stat-label">Experiences</div>
    </div>
</div>

<!-- General Settings Section -->
<div class="settings-section">
    <h2>General Settings</h2>
    
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- Profile Picture -->
        <div class="form-group">
            <label class="form-label">Profile Picture</label>
            @php $profilePic = $settings->where('key', 'profile_picture')->first(); @endphp
            @if($profilePic && $profilePic->value)
                <div class="profile-preview">
                    <img src="{{ $profilePic->value }}" alt="Profile">
                </div>
            @endif
            <input type="file" name="profile_picture" class="form-input">
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
            <div class="form-group">
                <label class="form-label">Hero Name</label>
                <input type="text" name="hero_name" class="form-input" value="{{ $settings->where('key', 'hero_name')->first()->value ?? '' }}">
            </div>
            <div class="form-group">
                <label class="form-label">Hero Title</label>
                <input type="text" name="hero_title" class="form-input" value="{{ $settings->where('key', 'hero_title')->first()->value ?? '' }}">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">About Me</label>
            <textarea name="about_me" class="form-input" rows="5">{{ $settings->where('key', 'about_me')->first()->value ?? '' }}</textarea>
        </div>

        <div class="form-group">
            <label class="form-label">Contact Email</label>
            <input type="email" name="contact_email" class="form-input" value="{{ $settings->where('key', 'contact_email')->first()->value ?? '' }}">
        </div>

        <button type="submit" class="btn-save">Update General Settings</button>
    </form>
</div>
@endsection
