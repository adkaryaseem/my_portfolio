@extends('admin.layout')

@section('title', $certification->exists ? 'Edit Certification' : 'New Certification')
@section('header_title', $certification->exists ? 'Edit Certification' : 'Add New Certification')

@section('content')
<div class="glass-card" style="max-width: 600px;">
    <form action="{{ $certification->exists ? route('admin.certifications.update', $certification) : route('admin.certifications.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($certification->exists) @method('PUT') @endif

        <div class="form-group">
            <label class="form-label">Certification Name</label>
            <input type="text" name="name" class="form-input" value="{{ old('name', $certification->name) }}" required>
        </div>

        <div class="form-group">
            <label class="form-label">Issuer</label>
            <input type="text" name="issuer" class="form-input" value="{{ old('issuer', $certification->issuer) }}">
        </div>

        <div class="form-group">
            <label class="form-label">Date</label>
            <input type="text" name="date" class="form-input" value="{{ old('date', $certification->date) }}">
        </div>

        <div class="form-group">
            <label class="form-label">Upload Certificate</label>
            <input type="file" name="certificate_file" class="form-input">
            @if($certification->certificate_file)
                <p class="mt-2"><a href="{{ $certification->certificate_file }}" target="_blank" style="color: var(--primary-color);">View Current Certificate</a></p>
            @endif
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Save Certification</button>
            <a href="{{ route('admin.certifications.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
