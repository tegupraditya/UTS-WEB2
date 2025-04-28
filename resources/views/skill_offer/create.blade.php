@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <form action="{{ route('skill-offers.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="skill_offered" class="form-label">Skill Offered</label>
                <input type="text" id="skill_offered" name="skill_offered" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="skill_requested" class="form-label">Skill Requested</label>
                <input type="text" id="skill_requested" name="skill_requested" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('skill-offers.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
