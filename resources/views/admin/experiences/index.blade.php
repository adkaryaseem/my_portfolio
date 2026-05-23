@extends('admin.layout')

@section('title', 'Experiences')
@section('header_title', 'Professional History')

@section('content')
<div class="glass-panel p-8">
    <div class="flex justify-between items-center mb-10">
        <div>
            <h3 class="text-xl font-bold text-white">Experience Timeline</h3>
            <p class="text-admin-muted text-sm mt-1">Manage your career history and roles</p>
        </div>
        <a href="{{ route('admin.experiences.create') }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Add New Experience
        </a>
    </div>

    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Role Title</th>
                    <th>Organization</th>
                    <th>Timeline</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($experiences as $exp)
                <tr>
                    <td class="font-bold text-white">{{ $exp->title }}</td>
                    <td>
                        <span class="text-admin-text opacity-80">{{ $exp->company }}</span>
                    </td>
                    <td>
                        <div class="flex items-center gap-2">
                            <svg class="w-3 h-3 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span class="text-xs font-medium text-indigo-300">{{ $exp->start_date }} — {{ $exp->end_date ?? 'Present' }}</span>
                        </div>
                    </td>
                    <td>
                        <div class="flex justify-end gap-3">
                            <a href="{{ route('admin.experiences.edit', $exp) }}" class="btn-secondary !px-4 !py-2 text-[10px]">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                Edit
                            </a>
                            <form action="{{ route('admin.experiences.destroy', $exp) }}" method="POST" onsubmit="return confirm('Archive this experience entry?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger !px-4 !py-2 text-[10px]">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-12 text-admin-muted uppercase tracking-widest text-[10px]">
                        No history records found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
