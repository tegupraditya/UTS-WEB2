@extends('layouts.app')

@section('header', 'Matching Skills')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        @if($myProfile)
            <div class="mb-8 p-4 bg-blue-50 dark:bg-blue-900/30 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-blue-700 dark:text-blue-300">Matching based on your profile:</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">You offer: <strong>{{ $myProfile->main_skill }}</strong></p>
                <p class="text-sm text-gray-600 dark:text-gray-400">You need: <strong>{{ $myProfile->needed_skill }}</strong></p>
            </div>
        @endif

        {{-- Strong Matches --}}
        <section class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Ideal Matches for You</h2>
            @if($strongMatches->isEmpty())
                <p class="text-gray-500 dark:text-gray-400">No ideal matches found at the moment.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($strongMatches as $offer)
                        {{-- Tampilkan card untuk setiap $offer, mirip dengan di skill_offers.index --}}
                        {{-- Contoh: @include('skill_offer._card', ['skillOffer' => $offer]) --}}
                        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                            <h4 class="font-semibold text-lg text-[var(--primary-color)]">{{ $offer->skill_offered }}</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">In exchange for: {{ $offer->skill_requested }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">By: {{ $offer->user->name ?? 'N/A' }}</p>
                            <a href="{{ route('skill-offers.show', $offer->id) }}" class="mt-3 inline-block text-sm text-blue-600 dark:text-blue-400 hover:underline">View Offer</a>
                        </div>
                    @endforeach
                </div>
                <div class="mt-6">
                    {{ $strongMatches->links('pagination::tailwind') }} {{-- Atau paginator default Anda --}}
                </div>
            @endif
        </section>

        {{-- You Can Help Them --}}
        <section class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Offers That Need Your Main Skill ({{ $myProfile->main_skill ?? '' }})</h2>
             @if($youCanHelpThem->isEmpty())
                <p class="text-gray-500 dark:text-gray-400">No offers found that specifically need your main skill right now.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($youCanHelpThem as $offer)
                         <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                            <h4 class="font-semibold text-lg text-[var(--primary-color)]">{{ $offer->skill_offered }}</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Requests: <strong class="text-red-500">{{ $offer->skill_requested }}</strong></p>
                            <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">By: {{ $offer->user->name ?? 'N/A' }}</p>
                            <a href="{{ route('skill-offers.show', $offer->id) }}" class="mt-3 inline-block text-sm text-blue-600 dark:text-blue-400 hover:underline">View Offer</a>
                        </div>
                    @endforeach
                </div>
                <div class="mt-6">
                    {{ $youCanHelpThem->links('pagination::tailwind') }}
                </div>
            @endif
        </section>

        {{-- They Can Help You --}}
        <section>
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Offers That Provide Skills You Need ({{ $myProfile->needed_skill ?? '' }})</h2>
            @if($theyCanHelpYou->isEmpty())
                <p class="text-gray-500 dark:text-gray-400">No offers found that provide the skill you need right now.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($theyCanHelpYou as $offer)
                        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                            <h4 class="font-semibold text-lg text-[var(--primary-color)]"><strong class="text-green-500">{{ $offer->skill_offered }}</strong></h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">In exchange for: {{ $offer->skill_requested }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">By: {{ $offer->user->name ?? 'N/A' }}</p>
                            <a href="{{ route('skill-offers.show', $offer->id) }}" class="mt-3 inline-block text-sm text-blue-600 dark:text-blue-400 hover:underline">View Offer</a>
                        </div>
                    @endforeach
                </div>
                <div class="mt-6">
                    {{ $theyCanHelpYou->links('pagination::tailwind') }}
                </div>
            @endif
        </section>
    </div>
</div>
@endsection