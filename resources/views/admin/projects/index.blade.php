@extends('admin.layout')

@section('title', 'Projects')
@section('header_title', 'Manage Projects')

@section('content')
<div class="glass-card">
    <div class="d-flex justify-between align-center mb-2">
        <h3 style="margin: 0;">All Projects</h3>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary btn-sm">Add New Project</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>URL</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($projects as $project)
            <tr>
                <td>{{ $project->title }}</td>
                <td>{{ $project->url }}</td>
                <td class="d-flex gap-2">
                    <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-secondary btn-sm">Edit</a>
                    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-secondary btn-sm" style="color: #ff6b6b; border-color: rgba(255,107,107,0.3);">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center text-muted">No projects found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
