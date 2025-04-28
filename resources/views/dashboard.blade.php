@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <!-- Overview Panel -->
        <div class="row">
            <!-- Total Skill Offers -->
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Skill Offers</h5>
                        <p class="card-text">{{ $skillOffersCount }}</p>
                    </div>
                </div>
            </div>

            <!-- Total User Profiles -->
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total User Profiles</h5>
                        <p class="card-text">{{ $userProfilesCount }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Matches -->
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Matches</h5>
                        <p class="card-text">{{ $matchingCount }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recommended Matches -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Recommended Matches</div>
                    <div class="card-body">
                        @if($recommendedMatches->isEmpty())
                            <p>No matches found yet. Try creating more profiles and offers!</p>
                        @else
                            <ul class="list-group">
                                @foreach($recommendedMatches as $match)
                                    <li class="list-group-item">
                                        <strong>{{ $match->main_skill }}</strong> looking for <strong>{{ $match->needed_skill }}</strong>
                                        <a href="{{ route('matching.show', $match->id) }}" class="btn btn-info btn-sm float-right">View Match</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
