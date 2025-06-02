@extends('layouts.app')

@section('header', "Matches for: {$profile->main_skill}")

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Sub-header to clarify what the user is seeing --}}
        <div class="mb-6 px-4 sm:px-0">
            <p class="text-lg text-[var(--medium-text)]">
                Showing skill offers that need <strong class="text-[var(--dark-text)]">{{ $profile->main_skill }}</strong> and are offering <strong class="text-[var(--dark-text)]">{{ $profile->needed_skill }}</strong> in return.
            </p>
        </div>

        @if($offers->isEmpty())
            <div class="bg-yellow-50 border-l-4 border-[var(--warning-color)] text-yellow-700 p-6 rounded-md shadow-sm">
                <div class="flex">
                    <div class="py-1">
                        <svg class="fill-current h-6 w-6 text-[var(--warning-color)] mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zM9 5v6h2V5H9zm0 8v2h2v-2H9z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold">No Matches Found</p>
                        <p class="text-sm">Unfortunately, there are currently no skill offers that match your criteria for "{{ $profile->main_skill }}".</p>
                    </div>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($offers as $offer)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover-lift flex flex-col transition-all duration-300 ease-in-out">
                        <div class="p-6 flex-grow">
                            <div class="mb-3">
                                @if(isset($offer->user) && $offer->user->name)
                                <p class="text-xs text-[var(--medium-text)] mb-1">Offered by: {{ $offer->user->name }}</p>
                                @endif
                                <h3 class="text-xl font-semibold text-[var(--primary-color)] hover:text-[var(--primary-hover)] transition-colors">
                                    {{ $offer->skill_offered }}
                                </h3>
                                @if(isset($offer->category) && $offer->category->name)
                                    <span class="mt-1 inline-block bg-indigo-100 text-[var(--accent-color)] text-xs font-semibold px-2 py-0.5 rounded-full">
                                        {{ $offer->category->name }}
                                    </span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <p class="text-sm text-[var(--medium-text)]">In exchange for skill in:</p>
                                <p class="text-md font-medium text-[var(--dark-text)]">{{ $offer->skill_requested }}</p>
                            </div>

                            @if($offer->description)
                                <div class="mb-4">
                                    <p class="text-sm text-[var(--medium-text)]">Description:</p>
                                    <p class="text-sm text-gray-600 line-clamp-3" title="{{ $offer->description }}">
                                        {{ $offer->description }}
                                    </p>
                                </div>
                            @endif
                        </div>

                        <div class="mt-auto p-6 border-t border-[var(--border-color)]">
                            <a href="{{ route('skill-offers.show', $offer->id) }}"
                               class="w-full flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-[var(--primary-color)] hover:bg-[var(--primary-hover)] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--primary-color)] transition ripple">
                                View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="mt-8 text-center">
            <a href="{{ route('matching.index') }}"
               class="inline-flex items-center px-6 py-2 border border-gray-300 text-sm font-medium rounded-md text-[var(--medium-text)] bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--primary-color)] transition ripple">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to All Profiles
            </a>
        </div>

         @if ($offers instanceof \Illuminate\Pagination\LengthAwarePaginator && $offers->hasPages())
            <div class="mt-8">
                {{ $offers->links() }} {{-- Ensure your pagination views are styled with Tailwind --}}
            </div>
        @endif
    </div>
</div>
@endsection
