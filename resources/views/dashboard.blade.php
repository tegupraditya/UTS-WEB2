@extends('layouts.app')

@section('header', 'Dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 dark:from-gray-900 dark:to-blue-900 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Dashboard</h1>
                    <p class="text-gray-600 dark:text-gray-300 mt-1">
                        Welcome back, {{ Auth::user()->name }}! Here's what's happening.
                    </p>
                </div>
                <div class="flex space-x-3 mt-4 sm:mt-0">
                    <button onclick="window.location.reload();" class="bg-white dark:bg-gray-700 dark:text-gray-200 border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors shadow-sm flex items-center">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2.086a8.001 8.001 0 00-11.991 0m11.991 0A8.001 8.001 0 014.63 16.5M4.63 16.5L3 19m1.63-2.5H19.5M19.5 19l1.5-2.5"></path>
                        </svg>
                        Refresh
                    </button>
                    <a href="{{ route('skill-offers.create') }}" class="bg-blue-600 text-white rounded-lg px-4 py-2 text-sm font-medium hover:bg-blue-700 transition-colors shadow-sm flex items-center">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        New Offer
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-xl transition-shadow duration-300 animate-fade-in">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Total Skill Offers</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $skillOffersCount }}</p>
                        </div>
                        <div class="bg-blue-100 dark:bg-blue-500/20 rounded-full p-3">
                            <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-3">
                    <a href="{{ route('skill-offers.index') }}" class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-colors">
                        View all offers &rarr;
                    </a>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-xl transition-shadow duration-300 animate-fade-in" style="animation-delay: 0.1s;">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Total User Profiles</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $userProfilesCount }}</p>
                        </div>
                        <div class="bg-green-100 dark:bg-green-500/20 rounded-full p-3">
                            <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-3">
                    <a href="{{ route('user-profiles.index') }}" class="text-sm font-medium text-green-600 dark:text-green-400 hover:text-green-700 dark:hover:text-green-300 transition-colors">
                        View all profiles &rarr;
                    </a>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-xl transition-shadow duration-300 animate-fade-in" style="animation-delay: 0.2s;">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Potential Matches</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $matchingCount }}</p>
                        </div>
                        <div class="bg-orange-100 dark:bg-orange-500/20 rounded-full p-3">
                            <svg class="w-8 h-8 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-3">
                    <a href="{{ route('matching.index') }}" class="text-sm font-medium text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 transition-colors">
                        View all matches &rarr;
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Recommended Skill Offers</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        @if($recommendedMatches->isEmpty())
                            <div class="text-center py-12">
                                <svg class="w-16 h-16 text-gray-300 dark:text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7H7m2.55 2.55l-1.414 1.414"></path>
                                </svg>
                                <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No specific recommendations found yet.</h4>
                                <p class="text-gray-600 dark:text-gray-400 mb-6">Make sure your profile's "Main Skill" and "Needed Skill" are filled to get better recommendations, or explore all offers.</p>
                                <a href="{{ route('skill-offers.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                    Browse All Offers
                                </a>
                            </div>
                        @else
                            <div class="space-y-4">
                                @foreach($recommendedMatches as $matchOffer)
                                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:border-blue-300 dark:hover:border-blue-500 hover:shadow-sm transition-all bg-gray-50 dark:bg-gray-700/30">
                                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between">
                                            <div class="flex items-center space-x-3 mb-2 sm:mb-0">
                                                <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-full p-2 flex-shrink-0">
                                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="flex items-center space-x-2 mb-0.5">
                                                        <span class="font-semibold text-gray-900 dark:text-white">{{ $matchOffer->skill_offered }}</span>
                                                        <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                                        </svg>
                                                        <span class="font-semibold text-gray-900 dark:text-white">{{ $matchOffer->skill_requested }}</span>
                                                    </div>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                                        Offered by {{ $matchOffer->user->name ?? 'N/A' }} 
                                                        @if($matchOffer->category)
                                                        <span class="mx-1">&bull;</span> In <span class="font-medium">{{ $matchOffer->category->name }}</span>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            {{-- PERBAIKAN LINK DAN TEKS TOMBOL --}}
                                            <a href="{{ route('skill-offers.show', $matchOffer->id) }}" 
                                               class="w-full sm:w-auto mt-2 sm:mt-0 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors text-center">
                                                View Offer
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            @if($recommendedMatches->count() >= 5)
                                <div class="mt-6 text-center">
                                    <a href="{{ route('matching.index') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium text-sm transition-colors">
                                        View all potential matches &rarr;
                                    </a>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Quick Actions</h3>
                    </div>
                    <div class="p-6 space-y-3">
                        <a href="{{ route('skill-offers.create') }}" class="w-full bg-blue-600 text-white rounded-lg px-4 py-3 text-sm font-medium hover:bg-blue-700 transition-colors flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Create Skill Offer
                        </a>
                        <a href="{{ route('skill-offers.index') }}" class="w-full bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg px-4 py-3 text-sm font-medium hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Browse All Offers
                        </a>
                        @if($userProfile)
                            <a href="{{ route('user-profiles.edit.mine') }}" class="w-full bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg px-4 py-3 text-sm font-medium hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Edit My Profile
                            </a>
                        @else
                             <a href="{{ route('user-profiles.create.mine') }}" class="w-full bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg px-4 py-3 text-sm font-medium hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Lengkapi Profil Saya
                            </a>
                        @endif
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Transactions</h3>
                    </div>
                    <div class="p-6">
                        @if($recentActivities->isEmpty())
                            <p class="text-sm text-gray-500 dark:text-gray-400">No recent transaction activity.</p>
                        @else
                            <div class="space-y-4">
                                @foreach($recentActivities as $activity)
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0 {{ $activity->status === 'completed' ? 'bg-green-100 dark:bg-green-500/20' : ($activity->status === 'pending_proposal' ? 'bg-yellow-100 dark:bg-yellow-500/20' : 'bg-blue-100 dark:bg-blue-500/20') }} rounded-full p-1.5">
                                            <svg class="w-4 h-4 {{ $activity->status === 'completed' ? 'text-green-600 dark:text-green-400' : ($activity->status === 'pending_proposal' ? 'text-yellow-600 dark:text-yellow-400' : 'text-blue-600 dark:text-blue-400') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                @if($activity->status === 'completed')
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                @elseif($activity->status === 'pending_proposal')
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.79 4 4s-1.79 4-4 4c-1.742 0-3.223-.835-3.772-2M12 12H4m4 4H4m4-8H4" />
                                                @else
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                @endif
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm text-gray-900 dark:text-white truncate">
                                                <a href="{{ route('transactions.show', $activity->id) }}" class="font-medium hover:underline">
                                                    Transaction for "{{ Str::limit($activity->skillOffer->skill_offered, 25) }}"
                                                </a>
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                Status: <span class="font-medium">{{ Str::title(str_replace('_', ' ', $activity->status)) }}</span> 
                                                - {{ $activity->updated_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                             @if($recentActivities->count() > 0)
                                <a href="{{ route('transactions.index.mine') }}" class="block w-full mt-4 text-center text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 text-sm font-medium transition-colors">
                                    View All My Transactions &rarr;
                                </a>
                            @endif
                        @endif
                    </div>
                </div>

                @if($userProfile)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Your Current Skills</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            @if($myMainSkill)
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">You Offer:</span>
                                <span class="bg-blue-100 dark:bg-blue-500/20 text-blue-800 dark:text-blue-300 text-xs font-semibold px-2.5 py-1 rounded-full">{{ $myMainSkill }}</span>
                            </div>
                            @else
                             <p class="text-sm text-gray-500 dark:text-gray-400">You haven't set your main skill yet.</p>
                            @endif

                            @if($myNeededSkill)
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">You Need:</span>
                                <span class="bg-purple-100 dark:bg-purple-500/20 text-purple-800 dark:text-purple-300 text-xs font-semibold px-2.5 py-1 rounded-full">{{ $myNeededSkill }}</span>
                            </div>
                             @else
                             <p class="text-sm text-gray-500 dark:text-gray-400">You haven't set your needed skill yet.</p>
                            @endif
                        </div>
                         <a href="{{ route('user-profiles.edit.mine') }}" class="block w-full mt-4 text-center text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 text-sm font-medium transition-colors">
                            Update Your Skills & Profile &rarr;
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fadeIn 0.5s ease-out forwards;
    }
    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.animate-fade-in');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.05}s`;
        });
        const buttons = document.querySelectorAll('button, a.bg-blue-600, a.bg-gray-100, a.bg-white');
        buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                if (button.tagName === 'A' && button.getAttribute('href') && button.getAttribute('href') !== '#') {
                    // Allow navigation
                } else if (button.type === 'submit' || (button.tagName === 'A' && button.getAttribute('href') === '#')) {
                    // Potentially prevent default for non-navigational buttons if ripple is main action
                }

                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.cssText = `
                    position: absolute;
                    width: ${size}px;
                    height: ${size}px;
                    left: ${x}px;
                    top: ${y}px;
                    background: rgba(255, 255, 255, 0.4);
                    border-radius: 50%;
                    transform: scale(0);
                    animation: ripple 0.6s ease-out;
                    pointer-events: none;
                `;
                
                if (getComputedStyle(this).position === 'static') {
                    this.style.position = 'relative';
                }
                this.style.overflow = 'hidden';
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
    });
</script>
@endsection
