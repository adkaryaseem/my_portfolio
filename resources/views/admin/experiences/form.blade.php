@extends('admin.layout')

@section('title', $experience->exists ? 'Edit Experience' : 'New Experience')
@section('header_title', $experience->exists ? 'Edit Experience' : 'Add New Experience')

@section('content')
<div class="glass-card" style="max-width: 600px;">
    <form action="{{ $experience->exists ? route('admin.experiences.update', $experience) : route('admin.experiences.store') }}" method="POST">
        @csrf
        @if($experience->exists) @method('PUT') @endif

        <div class="form-group">
            <label class="form-label">Title/Role</label>
            <input type="text" name="title" class="form-input" value="{{ old('title', $experience->title) }}" required>
        </div>

        <div class="form-group">
            <label class="form-label">Company</label>
            <input type="text" name="company" class="form-input" value="{{ old('company', $experience->company) }}" required>
        </div>

        <div class="d-flex gap-2 mb-2">
            <div style="flex: 1;">
                <label class="form-label">Start Date</label>
                <input type="text" name="start_date" class="form-input" value="{{ old('start_date', $experience->start_date) }}">
            </div>
            <div style="flex: 1;">
                <label class="form-label">End Date</label>
                <input type="text" name="end_date" class="form-input" value="{{ old('end_date', $experience->end_date) }}">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-input">{{ old('description', $experience->description) }}</textarea>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Save Experience</button>
            <a href="{{ route('admin.experiences.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
