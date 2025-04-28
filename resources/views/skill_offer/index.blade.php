@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Content starts here -->
                    <div class="container mt-5">
                        <a href="{{ route('skill-offers.create') }}" class="btn btn-primary mb-3">Create New Offer</a>

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Skill Offered</th>
                                    <th>Skill Requested</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($offers as $offer)
                                    <tr>
                                        <td>{{ $offer->skill_offered }}</td>
                                        <td>{{ $offer->skill_requested }}</td>
                                        <td>{{ $offer->description }}</td>
                                        <td>
                                            <a href="{{ route('skill-offers.show', $offer->id) }}" class="btn btn-info btn-sm">View</a>
                                            <a href="{{ route('skill-offers.edit', $offer->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('skill-offers.destroy', $offer->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Content ends here -->
                </div>
            </div>
        </div>
    </div>
@endsection
