@extends('admin.layout')

@section('title', $skill->exists ? 'Edit Skill' : 'New Skill')
@section('header_title', $skill->exists ? 'Edit Skill' : 'Add New Skill')

@section('content')
<div class="glass-card" style="max-width: 600px;">
    <form action="{{ $skill->exists ? route('admin.skills.update', $skill) : route('admin.skills.store') }}" method="POST">
        @csrf
        @if($skill->exists) @method('PUT') @endif

        <div class="form-group">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-input" value="{{ old('name', $skill->name) }}" required>
        </div>

        <div class="form-group">
            <label class="form-label">Category</label>
            <input type="text" name="category" class="form-input" value="{{ old('category', $skill->category) }}">
        </div>

        <div class="form-group">
            <label class="form-label">Proficiency (0-100)</label>
            <input type="number" name="proficiency" class="form-input" value="{{ old('proficiency', $skill->proficiency) }}" min="0" max="100" required>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Save Skill</button>
            <a href="{{ route('admin.skills.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
