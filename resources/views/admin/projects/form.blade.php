@extends('admin.layout')

@section('title', $project->exists ? 'Edit Project' : 'Add Project')
@section('header_title', $project->exists ? 'Edit Project' : 'Add New Project')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="glass-panel p-8 md:p-10">
        <form action="{{ $project->exists ? route('admin.projects.update', $project) : route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @if($project->exists) @method('PUT') @endif

            <div class="form-group">
                <label class="form-label text-white/40">Project Title</label>
                <input type="text" name="title" class="form-input" value="{{ old('title', $project->title) }}" required placeholder="e.g. Portfolio Website">
            </div>

            <div class="form-group">
                <label class="form-label text-white/40">Project Description</label>
                <textarea name="description" class="form-input h-48" placeholder="Describe your project here...">{{ old('description', $project->description) }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label text-white/40">Project Image</label>
                <div class="flex flex-col md:flex-row gap-8 items-start">
                    <div class="w-full md:w-1/2 space-y-4">
                        <div class="p-4 bg-black/20 rounded-xl border border-white/5">
                            <input type="file" name="image" class="form-input text-xs">
                            <p class="text-[10px] text-admin-muted mt-2 uppercase tracking-widest text-center">Upload from computer</p>
                        </div>
                        <div class="relative">
                            <input type="url" name="image_url" class="form-input text-sm" value="{{ old('image_url', $project->image_url) }}" placeholder="Or paste image URL">
                        </div>
                    </div>
                    
                    @if($project->image_url)
                    <div class="w-full md:w-1/2">
                        <div class="aspect-video rounded-xl overflow-hidden border border-white/10 shadow-2xl">
                            <img src="{{ $project->image_url }}" class="w-full h-full object-cover">
                        </div>
                        <p class="text-[10px] text-center text-admin-muted mt-2 uppercase tracking-widest">Preview</p>
                    </div>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="form-label text-white/40">Live Project Link</label>
                <input type="url" name="url" class="form-input" value="{{ old('url', $project->url) }}" placeholder="https://example.com">
            </div>

            <div class="pt-8 border-t border-white/5 flex gap-4">
                <button type="submit" class="btn-primary px-12">
                    {{ $project->exists ? 'Update Project' : 'Save Project' }}
                </button>
                <a href="{{ route('admin.projects.index') }}" class="btn-secondary">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
