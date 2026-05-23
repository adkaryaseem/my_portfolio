@extends('admin.layout')

@section('title', 'Certifications')
@section('header_title', 'Manage Certifications')

@section('content')
<div class="glass-card">
    <div class="d-flex justify-between align-center mb-2">
        <h3 style="margin: 0;">All Certifications</h3>
        <a href="{{ route('admin.certifications.create') }}" class="btn btn-primary btn-sm">Add New Certification</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Issuer</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($certifications as $certification)
            <tr>
                <td>{{ $certification->name }}</td>
                <td>{{ $certification->issuer }}</td>
                <td>{{ $certification->date }}</td>
                <td class="d-flex gap-2">
                    <a href="{{ route('admin.certifications.edit', $certification) }}" class="btn btn-secondary btn-sm">Edit</a>
                    <form action="{{ route('admin.certifications.destroy', $certification) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-secondary btn-sm" style="color: #ff6b6b; border-color: rgba(255,107,107,0.3);">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center text-muted">No certifications found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
