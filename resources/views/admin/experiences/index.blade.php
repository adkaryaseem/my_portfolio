@extends('admin.layout')

@section('title', 'Experiences')
@section('header_title', 'Manage Experiences')

@section('content')
<div class="glass-card">
    <div class="d-flex justify-between align-center mb-2">
        <h3 style="margin: 0;">All Experiences</h3>
        <a href="{{ route('admin.experiences.create') }}" class="btn btn-primary btn-sm">Add New Experience</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Company</th>
                <th>Dates</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($experiences as $experience)
            <tr>
                <td>{{ $experience->title }}</td>
                <td>{{ $experience->company }}</td>
                <td>{{ $experience->start_date }} - {{ $experience->end_date }}</td>
                <td class="d-flex gap-2">
                    <a href="{{ route('admin.experiences.edit', $experience) }}" class="btn btn-secondary btn-sm">Edit</a>
                    <form action="{{ route('admin.experiences.destroy', $experience) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-secondary btn-sm" style="color: #ff6b6b; border-color: rgba(255,107,107,0.3);">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center text-muted">No experiences found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
