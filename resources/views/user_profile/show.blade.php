@extends('layouts.app')

{{-- Asumsi $userProfile dikirim ke view ini dan memiliki relasi user --}}
@section('header', ($userProfile->user ? $userProfile->user->name . "'s Profile" : 'User Profile Details'))

@section('content')
<div class="py-12 bg-slate-50">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="bg-gradient-to-br from-blue-600 to-purple-600 p-6 md:p-8 text-white">
                <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-6">
                    <div class="flex-shrink-0">
                        @if($userProfile->profile_picture_url)
                            <img class="h-32 w-32 rounded-full object-cover ring-4 ring-white/50 shadow-lg" src="{{ $userProfile->profile_picture_url }}" alt="Profile image of {{ $userProfile->user->name ?? 'User' }}">
                        @else
                             <div class="h-32 w-32 rounded-full bg-white/20 flex items-center justify-center text-5xl font-semibold ring-4 ring-white/50 shadow-lg">
                                {{ $userProfile->user ? strtoupper(substr($userProfile->user->name, 0, 1)) : 'U' }}
                            </div>
                        @endif
                    </div>
                    <div class="text-center sm:text-left">
                        <h1 class="text-3xl md:text-4xl font-bold tracking-tight">
                            {{ $userProfile->user->name ?? 'User Profile' }}
                        </h1>
                        <p class="text-blue-100 mt-1 text-sm">
                            {{ $userProfile->user->email ?? 'No email provided' }}
                        </p>
                        <p class="text-blue-200 text-xs mt-2">
                            @if($userProfile->user && $userProfile->user->created_at)
                                Member since {{ $userProfile->user->created_at->format('F Y') }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <div class="p-6 md:p-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="md:col-span-2 space-y-6">
                        <div>
                            <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Main Skill Offered</h3>
                            <p class="text-xl font-medium text-[var(--primary-color)] bg-blue-50 p-3 rounded-md shadow-sm">{{ $userProfile->main_skill ?? '-' }}</p>
                        </div>

                        <div>
                            <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Skill Looking For</h3>
                            <p class="text-xl font-medium text-[var(--accent-color)] bg-purple-50 p-3 rounded-md shadow-sm">{{ $userProfile->needed_skill ?? '-' }}</p>
                        </div>

                        @if($userProfile->bio)
                        <div>
                            <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">About Me (Bio)</h3>
                            <div class="mt-1 prose prose-sm sm:prose-base max-w-none text-gray-700 p-4 border border-gray-200 rounded-md bg-gray-50 whitespace-pre-wrap leading-relaxed">
                                {!! nl2br(e($userProfile->bio)) !!}
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="md:col-span-1 space-y-6">
                        <h4 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Personal Information</h4>
                        
                        @if($userProfile->date_of_birth)
                        <div>
                            <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" /></svg>
                                Date of Birth
                            </dt>
                            <dd class="mt-1 text-md text-gray-700">{{ $userProfile->date_of_birth->format('d F Y') }}</dd>
                        </div>
                        @endif

                        @if($userProfile->gender)
                        <div>
                            <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg>
                                Gender
                            </dt>
                            <dd class="mt-1 text-md text-gray-700">{{ $userProfile->gender }}</dd>
                        </div>
                        @endif

                        @if($userProfile->phone_number)
                        <div>
                            <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" /></svg>
                                Phone Number
                            </dt>
                            <dd class="mt-1 text-md text-gray-700">{{ $userProfile->phone_number }}</dd>
                        </div>
                        @endif
                        
                        @if($userProfile->address || $userProfile->city || $userProfile->province || $userProfile->postal_code)
                        <div>
                            <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg>
                                Address
                            </dt>
                            <address class="mt-1 text-md text-gray-700 not-italic leading-relaxed">
                                @if($userProfile->address){{ $userProfile->address }}<br>@endif
                                @if($userProfile->city || $userProfile->province || $userProfile->postal_code)
                                    {{ $userProfile->city ?? '' }}
                                    {{ $userProfile->city && ($userProfile->province || $userProfile->postal_code) ? ', ' : '' }}
                                    {{ $userProfile->province ?? '' }}
                                    {{ $userProfile->province && $userProfile->postal_code ? ' ' : '' }}
                                    {{ $userProfile->postal_code ?? '' }}
                                @endif
                            </address>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="mt-8 px-6 md:px-8 py-4 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row items-center justify-end gap-3">
                    <a href="{{ route('user-profiles.index') }}"
                       class="w-full sm:w-auto px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-[var(--medium-text)] bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--primary-color)] transition ripple text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1 -mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Profiles
                    </a>

                    @if(Auth::check() && Auth::id() == $userProfile->user_id)
                        <a href="{{ route('user-profiles.edit.mine') }}"
                           class="w-full sm:w-auto px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-[var(--warning-color)] hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--warning-color)] transition ripple text-center flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            Edit Profile
                        </a>
                        {{-- Tombol Delete bisa ditambahkan di sini jika diperlukan --}}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
