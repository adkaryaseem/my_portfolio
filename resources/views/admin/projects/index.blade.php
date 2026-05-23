@extends('admin.layout')

@section('title', 'Projects')
@section('header_title', 'Portfolio Projects')

@section('content')
<div class="glass-panel p-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h3 class="text-lg font-bold text-white">Project Matrix</h3>
            <p class="text-admin-muted text-xs mt-1">Single-row data architecture for clear management</p>
        </div>
        <a href="{{ route('admin.projects.create') }}" class="btn-primary !py-2.5 !px-6 text-[11px]">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Add Project
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 35%;">Name</th>
                    <th style="width: 25%;">Slug</th>
                    <th style="width: 15%;">Link</th>
                    <th style="width: 25%;" class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                <tr>
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-7 rounded-sm overflow-hidden border border-white/5 flex-shrink-0">
                                <img src="{{ $project->image_url }}" class="w-full h-full object-cover">
                            </div>
                            <span class="font-bold text-white text-[11px] truncate">{{ $project->title }}</span>
                        </div>
                    </td>
                    <td>
                        <div class="text-[10px] bg-white/5 px-2 py-1 rounded text-indigo-300 inline-block truncate max-w-full">
                            /{{ $project->slug }}
                        </div>
                    </td>
                    <td>
                        <a href="{{ $project->url }}" target="_blank" class="text-[10px] text-admin-muted hover:text-indigo-400 font-bold uppercase tracking-wider">
                            Visit
                        </a>
                    </td>
                    <td>
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.projects.edit', $project) }}" class="btn-secondary !px-3 !py-1.5 !text-[9px]">
                                Edit
                            </a>
                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="inline" onsubmit="return confirm('Delete this project?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger !px-3 !py-1.5 !text-[9px]">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-12 text-admin-muted uppercase tracking-widest text-[9px]">
                        Database empty. No projects found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
