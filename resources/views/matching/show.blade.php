@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Matching for {{ $profile->main_skill }}
        </h2>

        @if($offers->isEmpty())
            <div class="alert alert-warning">No matches found for this skill.</div>
        @else
            <div class="row">
                @foreach($offers as $offer)
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">{{ $offer->skill_offered }}</h5>
                                <p class="card-text"><strong>Requested Skill:</strong> {{ $offer->skill_requested }}</p>
                                <p class="card-text">{{ $offer->description }}</p>
                                <a href="{{ route('skill-offers.show', $offer->id) }}" class="btn btn-info btn-sm">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <a href="{{ route('matching.index') }}" class="btn btn-secondary mt-3">Back to All Matches</a>
    </div>
@endsection
