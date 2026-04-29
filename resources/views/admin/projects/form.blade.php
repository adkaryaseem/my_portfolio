@extends('admin.layout')

@section('title', $project->exists ? 'Edit Project' : 'New Project')
@section('header_title', $project->exists ? 'Edit Project' : 'Add New Project')

@section('content')
<div class="glass-card" style="max-width: 600px;">
    <form action="{{ $project->exists ? route('admin.projects.update', $project) : route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($project->exists) @method('PUT') @endif

        <div class="form-group">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-input" value="{{ old('title', $project->title) }}" required>
        </div>

        <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-input">{{ old('description', $project->description) }}</textarea>
        </div>

        <div class="form-group">
            <label class="form-label">Project Image</label>
            @if($project->image_url)
                <div class="mb-1">
                    <img src="{{ $project->image_url }}" alt="Project Preview" style="width: 200px; height: 120px; object-fit: cover; border-radius: 10px; border: 1px solid var(--glass-border);">
                </div>
            @endif
            <input type="file" name="image" class="form-input">
            <small class="text-muted">Or paste an Image URL below:</small>
            <input type="url" name="image_url" class="form-input mt-1" value="{{ old('image_url', $project->image_url) }}" placeholder="https://example.com/image.jpg">
        </div>

        <div class="form-group">
            <label class="form-label">Project Link (URL)</label>
            <input type="url" name="url" class="form-input" value="{{ old('url', $project->url) }}" placeholder="https://github.com/yourproject">
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Save Project</button>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
