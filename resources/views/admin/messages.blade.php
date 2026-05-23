@extends('admin.layout')

@section('title', 'Inbox')
@section('header_title', 'Messages')

@section('content')
<div class="glass-panel p-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h3 class="text-lg font-bold text-white">Inbox Transmissions</h3>
            <p class="text-admin-muted text-xs mt-1">Manage incoming communications and official replies</p>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 25%;">Sender</th>
                    <th style="width: 40%;">Message Snippet</th>
                    <th style="width: 15%;">Date</th>
                    <th style="width: 20%;" class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $msg)
                <tr class="{{ !$msg->is_read ? 'bg-indigo-500/[0.02]' : '' }}">
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center text-xs font-bold text-indigo-400 border border-white/10">
                                {{ substr($msg->name, 0, 1) }}
                            </div>
                            <div class="truncate">
                                <div class="font-bold text-white text-xs">{{ $msg->name }}</div>
                                <div class="text-[10px] text-admin-muted">{{ $msg->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="text-xs text-admin-text opacity-70 truncate max-w-xs">
                            {{ Str::limit($msg->message, 80) }}
                        </div>
                    </td>
                    <td>
                        <div class="text-[10px] text-admin-muted uppercase tracking-widest font-bold">
                            {{ $msg->created_at->format('M d, Y') }}
                        </div>
                    </td>
                    <td>
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.messages.reply', $msg->id) }}" class="btn-primary !px-4 !py-1.5 !text-[9px]">
                                Reply
                            </a>
                            @if(!$msg->is_read)
                            <form action="{{ route('admin.messages.read', $msg->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="btn-secondary !px-4 !py-1.5 !text-[9px]">
                                    Mark Read
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-12 text-admin-muted uppercase tracking-widest text-[9px]">
                        Inbox is empty.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
