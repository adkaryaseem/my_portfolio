@extends('admin.layout')

@section('title', 'Settings')
@section('header_title', 'General Settings')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Password Section -->
    <div class="settings-section">
        <h2>Change Password</h2>
        <p class="text-admin-muted text-sm mb-8">Update your login password to keep your account secure.</p>
        
        <form action="{{ route('admin.password.update') }}" method="POST" class="space-y-6">
            @csrf
            <div class="form-group">
                <label class="form-label">Current Password</label>
                <input type="password" name="current_password" class="form-input" required placeholder="Enter current password">
            </div>
            <div class="form-group">
                <label class="form-label">New Password</label>
                <input type="password" name="new_password" class="form-input" required placeholder="Min. 8 characters">
            </div>
            <div class="form-group">
                <label class="form-label">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" class="form-input" required placeholder="Repeat new password">
            </div>
            <button type="submit" class="btn-primary w-full">Update Password</button>
        </form>
    </div>

    <!-- WhatsApp Section -->
    <div class="settings-section">
        <h2>WhatsApp OTP Settings</h2>
        <p class="text-admin-muted text-sm mb-8">Set up your WhatsApp number to receive login verification codes.</p>
        
        <form action="{{ route('admin.settings.whatsapp') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="form-group">
                    <label class="form-label">Country Code</label>
                    <input type="text" name="country_code" class="form-input text-center" value="{{ $whatsappSettings->country_code ?? '' }}" placeholder="977">
                </div>
                <div class="form-group md:col-span-2">
                    <label class="form-label">Phone Number</label>
                    <input type="text" name="phone_number" class="form-input" value="{{ $whatsappSettings->phone_number ?? '' }}" placeholder="98XXXXXXXX">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">CallMeBot API Key</label>
                <input type="password" name="api_key" class="form-input" value="{{ $whatsappSettings->api_key ?? '' }}" placeholder="Enter your API key">
                <p class="text-[10px] text-admin-muted mt-2 uppercase tracking-widest">Your key is stored securely using encryption.</p>
            </div>

            <button type="submit" class="btn-primary w-full" style="background: var(--admin-accent);">Save WhatsApp Settings</button>
        </form>
    </div>

    <!-- Email Section -->
    <div class="settings-section lg:col-span-2">
        <h2>Email (SMTP) Settings</h2>
        <p class="text-admin-muted text-sm mb-8">Configure how the system sends automated emails and replies.</p>
        
        <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-8">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="form-group md:col-span-2">
                    <label class="form-label">SMTP Host</label>
                    <input type="text" name="mail_host" class="form-input" value="{{ $settings->where('key', 'mail_host')->first()->value ?? '' }}" placeholder="e.g., smtp.gmail.com">
                </div>
                <div class="form-group">
                    <label class="form-label">Port & Encryption</label>
                    <div class="flex gap-4">
                        <input type="text" name="mail_port" class="form-input text-center" value="{{ $settings->where('key', 'mail_port')->first()->value ?? '587' }}">
                        <input type="text" name="mail_encryption" class="form-input text-center" value="{{ $settings->where('key', 'mail_encryption')->first()->value ?? 'tls' }}">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="form-group">
                    <label class="form-label">SMTP Username</label>
                    <input type="text" name="mail_username" class="form-input" value="{{ $settings->where('key', 'mail_username')->first()->value ?? '' }}">
                </div>
                <div class="form-group">
                    <label class="form-label">SMTP Password</label>
                    <input type="password" name="mail_password" class="form-input" value="{{ $settings->where('key', 'mail_password')->first()->value ?? '' }}">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="form-group">
                    <label class="form-label">Sender Email Address</label>
                    <input type="email" name="mail_from_address" class="form-input" value="{{ $settings->where('key', 'mail_from_address')->first()->value ?? '' }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Sender Name</label>
                    <input type="text" name="mail_from_name" class="form-input" value="{{ $settings->where('key', 'mail_from_name')->first()->value ?? '' }}">
                </div>
            </div>

            <button type="submit" class="btn-primary px-12">Save Email Settings</button>
        </form>
    </div>
</div>
@endsection
