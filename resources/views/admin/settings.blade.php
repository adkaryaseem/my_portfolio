@extends('admin.layout')

@section('title', 'Settings')
@section('header_title', 'System Settings')

@section('content')
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 2rem;">
    <!-- Security Settings -->
    <div class="glass-card">
        <h3 class="mb-2">Security Settings</h3>
        <p class="text-muted mb-2">Update your login password here.</p>
        
        @if($errors->any())
            <div style="background: rgba(231, 76, 60, 0.2); border: 1px solid #e74c3c; color: #e74c3c; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                <ul style="margin: 0; padding-left: 1.2rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.password.update') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Current Password</label>
                <input type="password" name="current_password" class="form-input" required>
            </div>
            <div class="form-group">
                <label class="form-label">New Password</label>
                <input type="password" name="new_password" class="form-input" required>
            </div>
            <div class="form-group">
                <label class="form-label">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" class="form-input" required>
            </div>
            <button type="submit" class="btn btn-secondary mt-1">Update Password</button>
        </form>
    </div>

    <!-- Email Configuration -->
    <div class="glass-card">
        <h3 class="mb-2">Mail Configuration (SMTP)</h3>
        <p class="text-muted mb-2">Configure how the system sends reply emails.</p>
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">SMTP Host</label>
                <input type="text" name="mail_host" class="form-input" value="{{ $settings->where('key', 'mail_host')->first()->value ?? '' }}" placeholder="smtp.gmail.com">
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label class="form-label">SMTP Port</label>
                    <input type="text" name="mail_port" class="form-input" value="{{ $settings->where('key', 'mail_port')->first()->value ?? '587' }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Encryption</label>
                    <input type="text" name="mail_encryption" class="form-input" value="{{ $settings->where('key', 'mail_encryption')->first()->value ?? 'tls' }}" placeholder="tls or ssl">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">SMTP Username</label>
                <input type="text" name="mail_username" class="form-input" value="{{ $settings->where('key', 'mail_username')->first()->value ?? '' }}">
            </div>
            <div class="form-group">
                <label class="form-label">SMTP Password</label>
                <input type="password" name="mail_password" class="form-input" value="{{ $settings->where('key', 'mail_password')->first()->value ?? '' }}">
            </div>
            <div class="form-group">
                <label class="form-label">From Address</label>
                <input type="email" name="mail_from_address" class="form-input" value="{{ $settings->where('key', 'mail_from_address')->first()->value ?? '' }}">
            </div>
            <div class="form-group">
                <label class="form-label">From Name</label>
                <input type="text" name="mail_from_name" class="form-input" value="{{ $settings->where('key', 'mail_from_name')->first()->value ?? '' }}">
            </div>
            <button type="submit" class="btn btn-primary mt-1">Save Mail Config</button>
        </form>
    </div>
</div>
@endsection
