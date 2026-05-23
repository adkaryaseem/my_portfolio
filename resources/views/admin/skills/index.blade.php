@extends('admin.layout')

@section('title', 'Skills')
@section('header_title', 'Technical Skills')

@section('content')
<div class="glass-panel p-8">
    <div class="flex justify-between items-center mb-10">
        <div>
            <h3 class="text-xl font-bold text-white">Skill Matrix</h3>
            <p class="text-admin-muted text-sm mt-1">Manage your technical proficiencies and categories</p>
        </div>
        <a href="{{ route('admin.skills.create') }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Add New Skill
        </a>
    </div>

    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Skill Name</th>
                    <th>Category</th>
                    <th>Proficiency</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($skills as $skill)
                <tr>
                    <td class="font-bold text-white">{{ $skill->name }}</td>
                    <td>
                        <span class="text-xs bg-indigo-500/10 text-indigo-300 px-3 py-1 rounded-full border border-indigo-500/20">
                            {{ $skill->category }}
                        </span>
                    </td>
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="flex-1 h-1.5 bg-white/5 rounded-full overflow-hidden max-w-[100px]">
                                <div class="h-full bg-indigo-500 shadow-[0_0_10px_rgba(99,102,241,0.5)]" style="width: {{ $skill->proficiency }}%"></div>
                            </div>
                            <span class="text-xs font-bold text-white">{{ $skill->proficiency }}%</span>
                        </div>
                    </td>
                    <td>
                        <div class="flex justify-end gap-3">
                            <a href="{{ route('admin.skills.edit', $skill) }}" class="btn-secondary !px-4 !py-2 text-[10px]">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                Edit
                            </a>
                            <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this skill?');">
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
                        No skills added yet.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
