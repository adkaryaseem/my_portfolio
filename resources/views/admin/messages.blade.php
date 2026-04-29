@extends('admin.layout')

@section('title', 'Inbox')
@section('header_title', 'Inbox Messages')

@section('content')
<div class="messages-container">
    @forelse($messages as $msg)
    <div class="glass-card message-card" style="margin-bottom: 1.5rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 1px solid var(--glass-border);">
            <div>
                <h4 style="margin-bottom: 0.2rem;">{{ $msg->name }}</h4>
                <div style="font-size: 0.85rem; color: var(--text-muted);">
                    <a href="mailto:{{ $msg->email }}" style="color: var(--primary);">{{ $msg->email }}</a> • {{ $msg->created_at->diffForHumans() }}
                </div>
            </div>
            <div style="font-size: 0.8rem; padding: 0.2rem 0.6rem; border-radius: 12px; font-weight: bold; {{ $msg->is_read ? 'background: rgba(255,255,255,0.1); color: var(--text-muted);' : 'background: rgba(236, 72, 153, 0.2); color: var(--secondary);' }}">
                {{ $msg->is_read ? 'Read' : 'New' }}
            </div>
        </div>
        
        <div style="white-space: pre-wrap; margin-bottom: 1.5rem; color: var(--text-color);">{{ $msg->message }}</div>
        
        <div style="background: rgba(0,0,0,0.2); padding: 1.5rem; border-radius: 12px; border: 1px solid var(--glass-border);">
            <h4 style="margin-bottom: 1rem; font-size: 1rem;">Send Reply</h4>
            <form method="POST" action="{{ route('admin.messages.reply', $msg->id) }}">
                @csrf
                <div class="form-group">
                    <label class="form-label" style="font-size: 0.9rem;">Send From (Email Address):</label>
                    <input type="email" name="sender_email" class="form-input" required placeholder="e.g. info@ashimadhikari.info.np" value="info@ashimadhikari.info.np">
                </div>
                <div class="form-group">
                    <label class="form-label" style="font-size: 0.9rem;">Your Reply:</label>
                    <textarea name="reply_message" class="form-input" required placeholder="Type your reply here..."></textarea>
                </div>
                <div style="display: flex; gap: 1rem;">
                    <button type="submit" class="btn btn-primary btn-sm">Send Email Reply</button>
                    @if(!$msg->is_read)
                    <a href="{{ route('admin.messages.read', $msg->id) }}" class="btn btn-secondary btn-sm" onclick="event.preventDefault(); document.getElementById('read-form-{{ $msg->id }}').submit();">Mark as Read Only</a>
                    @endif
                </div>
            </form>
            @if(!$msg->is_read)
            <form id="read-form-{{ $msg->id }}" method="POST" action="{{ route('admin.messages.read', $msg->id) }}" style="display: none;">
                @csrf
            </form>
            @endif
        </div>
    </div>
    @empty
    <div class="glass-card text-center">
        <p class="text-muted">No messages found in your inbox.</p>
    </div>
    @endforelse
</div>
@endsection
