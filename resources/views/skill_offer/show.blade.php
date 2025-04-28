@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h5>Skill Offered: {{ $skillOffer->skill_offered }}</h5>
                <h5>Skill Requested: {{ $skillOffer->skill_requested }}</h5>
                <p>Description: {{ $skillOffer->description }}</p>
            </div>
        </div>

        <a href="{{ route('skill-offers.index') }}" class="btn btn-secondary mt-3">Back</a>
    </div>
@endsection
