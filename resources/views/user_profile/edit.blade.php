@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <form action="{{ route('user-profiles.update', $userProfile->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="main_skill" class="form-label">Main Skill</label>
            <input type="text" id="main_skill" name="main_skill" value="{{ $userProfile->main_skill }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="needed_skill" class="form-label">Needed Skill</label>
            <input type="text" id="needed_skill" name="needed_skill" value="{{ $userProfile->needed_skill }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="bio" class="form-label">Bio</label>
            <textarea id="bio" name="bio" class="form-control">{{ $userProfile->bio }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('user-profiles.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
