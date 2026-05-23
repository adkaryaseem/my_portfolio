@extends('admin.layout')

@section('title', 'Reply to Message')
@section('header_title', 'Compose Reply')

@section('content')
<div class="max-w-4xl">
    <div class="grid grid-cols-1 gap-8">
        <!-- Original Message -->
        <div class="glass-panel p-8">
            <h4 class="text-[10px] font-bold text-indigo-400 uppercase tracking-[0.2em] mb-6 flex items-center gap-2">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                Incoming Message
            </h4>
            
            <div class="flex justify-between items-start mb-6 border-b border-white/5 pb-6">
                <div>
                    <div class="text-lg font-bold text-white">{{ $message->name }}</div>
                    <div class="text-xs text-admin-muted mt-1">{{ $message->email }}</div>
                </div>
                <div class="text-[9px] text-admin-muted uppercase tracking-widest font-bold">
                    {{ $message->created_at->format('F d, Y • H:i') }}
                </div>
            </div>

            <div class="bg-black/20 p-5 rounded-xl border border-white/5 text-admin-text leading-relaxed text-sm font-medium opacity-90">
                {{ $message->message }}
            </div>
        </div>

        <!-- Reply Form -->
        <div class="glass-panel p-8 bg-indigo-500/[0.02]">
            <h4 class="text-[10px] font-bold text-white uppercase tracking-[0.2em] mb-8 flex items-center gap-2">
                <svg class="w-3.5 h-3.5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg>
                Official Reply Channel
            </h4>

            <form method="POST" action="{{ route('admin.messages.reply.send', $message->id) }}" class="space-y-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="form-group mb-0">
                        <label class="form-label text-[10px] opacity-50">Sender Identity (Your Email)</label>
                        <input type="email" name="sender_email" class="form-input" required value="info@ashimadhikari.info.np">
                    </div>
                </div>
                
                <div class="form-group mb-0">
                    <label class="form-label text-[10px] opacity-50">Message Body</label>
                    <textarea name="reply_message" class="form-input h-64 text-sm" required placeholder="Type your professional reply here..."></textarea>
                </div>
                
                <div class="flex items-center gap-4 pt-4">
                    <button type="submit" class="btn-primary px-12">
                        Dispatch Reply
                    </button>
                    <a href="{{ route('admin.messages') }}" class="btn-secondary">
                        Back to Inbox
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
