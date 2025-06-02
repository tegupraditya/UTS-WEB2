@extends('layouts.app')

@section('header', 'User Profiles')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-[var(--dark-text)]">All User Profiles</h2>
                <p class="text-sm text-[var(--medium-text)]">Browse and discover profiles of other users.</p>
            </div>
            {{-- Tombol ini mengarahkan pengguna untuk melengkapi profilnya jika belum ada --}}
            @if(Auth::check() && !Auth::user()->profile)
            <a href="{{ route('user-profiles.create.mine') }}"
               class="w-full sm:w-auto px-4 py-2 bg-[var(--primary-color)] text-white font-semibold rounded-lg shadow-md hover:bg-[var(--primary-hover)] focus:outline-none focus:ring-2 focus:ring-[var(--primary-color)] focus:ring-opacity-75 transition ease-in-out duration-150 ripple text-center">
                Lengkapi Profil Anda
            </a>
            @endif
        </div>

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-0 md:p-6"> {{-- Padding disesuaikan untuk tabel --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-[var(--border-color)]">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--medium-text)] uppercase tracking-wider">
                                    User
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--medium-text)] uppercase tracking-wider">
                                    Main Skill
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--medium-text)] uppercase tracking-wider">
                                    Needed Skill
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--medium-text)] uppercase tracking-wider">
                                    Location
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--medium-text)] uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-[var(--border-color)]">
                            @forelse($profiles as $profile) {{-- Asumsi controller mengirimkan $profiles --}}
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                @if($profile->profile_picture_url)
                                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ $profile->profile_picture_url }}" alt="{{ $profile->user->name ?? 'User' }}">
                                                @else
                                                    <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-semibold">
                                                        {{ $profile->user ? strtoupper(substr($profile->user->name, 0, 1)) : 'U' }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-[var(--dark-text)]">{{ $profile->user->name ?? 'N/A' }}</div>
                                                <div class="text-xs text-[var(--medium-text)]">{{ $profile->user->email ?? '' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[var(--dark-text)]">
                                        {{ $profile->main_skill }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[var(--dark-text)]">
                                        {{ $profile->needed_skill }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[var(--medium-text)]">
                                        {{ $profile->city }}{{ $profile->city && $profile->province ? ', ' : '' }}{{ $profile->province }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('user-profiles.show', $profile->id) }}" class="px-3 py-1 bg-[var(--accent-color)] text-white text-xs font-semibold rounded-md shadow-sm hover:opacity-80 focus:outline-none focus:ring-2 focus:ring-[var(--accent-color)] focus:ring-opacity-75 transition ripple">
                                                View
                                            </a>
                                            {{-- Tombol Edit hanya muncul jika profil ini milik pengguna yang login --}}
                                            @if(Auth::check() && Auth::id() == $profile->user_id)
                                            <a href="{{ route('user-profiles.edit.mine') }}" class="px-3 py-1 bg-[var(--warning-color)] text-white text-xs font-semibold rounded-md shadow-sm hover:opacity-80 focus:outline-none focus:ring-2 focus:ring-[var(--warning-color)] focus:ring-opacity-75 transition ripple">
                                                Edit
                                            </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-sm text-[var(--medium-text)]">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-12 h-12 text-gray-400 mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                            </svg>
                                            <p class="font-semibold">No User Profiles Found.</p>
                                            <p class="mt-1">Be the first to create a profile or check back later.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if ($profiles instanceof \Illuminate\Pagination\LengthAwarePaginator && $profiles->hasPages())
            <div class="mt-8">
                {{ $profiles->links() }} {{-- Pastikan view paginasi Anda sudah di-style dengan Tailwind --}}
            </div>
        @endif

    </div>
</div>
@endsection
