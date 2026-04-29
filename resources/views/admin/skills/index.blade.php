@extends('admin.layout')

@section('title', 'Skills')
@section('header_title', 'Manage Skills')

@section('content')
<div class="glass-card">
    <div class="d-flex justify-between align-center mb-2">
        <h3 style="margin: 0;">All Skills</h3>
        <a href="{{ route('admin.skills.create') }}" class="btn btn-primary btn-sm">Add New Skill</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Proficiency</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($skills as $skill)
            <tr>
                <td>{{ $skill->name }}</td>
                <td>{{ $skill->category }}</td>
                <td>{{ $skill->proficiency }}%</td>
                <td class="d-flex gap-2">
                    <a href="{{ route('admin.skills.edit', $skill) }}" class="btn btn-secondary btn-sm">Edit</a>
                    <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-secondary btn-sm" style="color: #ff6b6b; border-color: rgba(255,107,107,0.3);">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center text-muted">No skills found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
