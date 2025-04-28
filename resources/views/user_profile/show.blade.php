@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h5>Main Skill: {{ $userProfile->main_skill }}</h5>
            <h5>Needed Skill: {{ $userProfile->needed_skill }}</h5>
            <p>Bio: {{ $userProfile->bio }}</p>
        </div>
    </div>

    <a href="{{ route('user-profiles.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
