@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <form action="{{ route('user-profiles.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="main_skill" class="form-label">Main Skill</label>
            <input type="text" id="main_skill" name="main_skill" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="needed_skill" class="form-label">Needed Skill</label>
            <input type="text" id="needed_skill" name="needed_skill" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="bio" class="form-label">Bio</label>
            <textarea id="bio" name="bio" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('user-profiles.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
