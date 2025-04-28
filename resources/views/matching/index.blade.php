@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Content starts here -->
                    <div class="container mt-5">
                        <div class="row">
                            @foreach($profiles as $profile)
                                <div class="col-md-4">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $profile->main_skill }}</h5>
                                            <p class="card-text">Looking for: {{ $profile->needed_skill }}</p>
                                            <a href="{{ route('matching.show', $profile->id) }}" class="btn btn-info">Find Matches</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Content ends here -->
                </div>
            </div>
        </div>
    </div>
@endsection
