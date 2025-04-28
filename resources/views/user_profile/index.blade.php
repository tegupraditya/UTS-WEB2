@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="container mt-5">
                    <a href="{{ route('user-profiles.create') }}" class="btn btn-primary mb-3">Create New Profile</a>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Main Skill</th>
                                <th>Needed Skill</th>
                                <th>Bio</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($profiles as $profile)
                                <tr>
                                    <td>{{ $profile->main_skill }}</td>
                                    <td>{{ $profile->needed_skill }}</td>
                                    <td>{{ $profile->bio }}</td>
                                    <td>
                                        <a href="{{ route('user-profiles.show', $profile->id) }}" class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('user-profiles.edit', $profile->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('user-profiles.destroy', $profile->id) }}" method="POST" style="display:inline-block;">
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
            </div>
        </div>
    </div>
</div>
@endsection
