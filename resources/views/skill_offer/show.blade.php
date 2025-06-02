@extends('layouts.app')

@section('header', 'Skill Offer Details')

@section('content')
<div class="py-12 bg-slate-50">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            
            {{-- Offer Header --}}
            <div class="p-6 md:p-8 border-b border-gray-200 dark:border-gray-700">
                @if($skillOffer->category)
                    <span class="inline-block bg-indigo-100 text-[var(--accent-color)] text-xs font-semibold px-3 py-1 rounded-full mb-2 uppercase tracking-wider">
                        {{ $skillOffer->category->name }}
                    </span>
                @endif
                <h1 class="text-3xl md:text-4xl font-bold text-[var(--primary-color)] leading-tight">
                    {{ $skillOffer->skill_offered }}
                </h1>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    Offered by: 
                    <a href="{{ $skillOffer->user ? route('user-profiles.show', $skillOffer->user->profile->id) : '#' }}" class="font-medium text-gray-700 dark:text-gray-300 hover:text-[var(--primary-hover)]">
                        {{ $skillOffer->user->name ?? 'N/A' }}
                    </a>
                </p>
            </div>

            <div class="p-6 md:p-8">
                {{-- Skill Exchange Details --}}
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Skill Exchange</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-blue-50 dark:bg-blue-900/30 p-4 rounded-lg shadow-sm border border-blue-200 dark:border-blue-700">
                            <h3 class="text-sm font-medium text-blue-700 dark:text-blue-300 mb-1">Offering Skill In:</h3>
                            <p class="text-lg text-blue-900 dark:text-blue-100 font-semibold">{{ $skillOffer->skill_offered }}</p>
                        </div>
                        <div class="bg-purple-50 dark:bg-purple-900/30 p-4 rounded-lg shadow-sm border border-purple-200 dark:border-purple-700">
                            <h3 class="text-sm font-medium text-purple-700 dark:text-purple-300 mb-1">Looking For Skill In:</h3>
                            <p class="text-lg text-purple-900 dark:text-purple-100 font-semibold">{{ $skillOffer->skill_requested }}</p>
                        </div>
                    </div>
                </div>

                {{-- Description --}}
                @if($skillOffer->description)
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-3">Details & Description</h3>
                    <div class="prose prose-sm sm:prose-base max-w-none text-gray-700 dark:text-gray-300 p-4 border border-gray-200 dark:border-gray-700 rounded-md bg-gray-50 dark:bg-gray-900/20 whitespace-pre-wrap leading-relaxed">
                        {!! nl2br(e($skillOffer->description)) !!}
                    </div>
                </div>
                @endif

                {{-- Meta Information --}}
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-3">Offer Information</h3>
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 text-sm">
                        <div>
                            <dt class="font-medium text-gray-500 dark:text-gray-400">Created On</dt>
                            <dd class="mt-1 text-gray-900 dark:text-gray-100">{{ $skillOffer->created_at->format('F j, Y, g:i a') }} ({{ $skillOffer->created_at->diffForHumans() }})</dd>
                        </div>
                        <div>
                            <dt class="font-medium text-gray-500 dark:text-gray-400">Last Updated</dt>
                            <dd class="mt-1 text-gray-900 dark:text-gray-100">{{ $skillOffer->updated_at->format('F j, Y, g:i a') }} ({{ $skillOffer->updated_at->diffForHumans() }})</dd>
                        </div>
                    </dl>
                </div>

                {{-- Tombol Aksi untuk Transaksi --}}
                @auth {{-- Pastikan pengguna sudah login --}}
                    @if(Auth::id() !== $skillOffer->user_id) {{-- Pengguna tidak bisa bertransaksi dengan penawarannya sendiri --}}
                        @php
                            // Cek apakah sudah ada proposal aktif dari user ini untuk offer ini
                            $existingProposal = \App\Models\Transaction::where('skill_offer_id', $skillOffer->id)
                                                                    ->where('requester_user_id', Auth::id())
                                                                    ->whereIn('status', ['pending_proposal', 'accepted', 'in_progress'])
                                                                    ->first();
                        @endphp

                        @if($existingProposal)
                            <div class="mt-6 p-4 bg-yellow-50 dark:bg-yellow-900/30 border-l-4 border-yellow-400 dark:border-yellow-600 text-yellow-700 dark:text-yellow-200 rounded-md">
                                <p class="font-medium">You have an active proposal for this offer (Status: {{ Str::title(str_replace('_', ' ', $existingProposal->status)) }}).</p>
                                <a href="{{ route('transactions.show', $existingProposal->id) }}" class="text-yellow-800 dark:text-yellow-100 hover:underline font-semibold">View Proposal</a>
                            </div>
                        @else
                            <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-3">Interested in this offer?</h3>
                                <form action="{{ route('transactions.store.proposal', $skillOffer->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="notes_requester" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Additional Notes for the Offerer (Optional)
                                        </label>
                                        <textarea name="notes_requester" id="notes_requester" rows="3" 
                                                  class="mt-1 block w-full py-2 px-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-[var(--primary-color)] focus:border-[var(--primary-color)] sm:text-sm text-gray-900 dark:text-gray-100"
                                                  placeholder="Misalnya, ketersediaan waktu Anda atau detail spesifik yang ingin Anda diskusikan.">{{ old('notes_requester') }}</textarea>
                                    </div>
                                    <button type="submit"
                                            class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition ripple">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
                                        </svg>
                                        Propose Skill Exchange
                                    </button>
                                </form>
                            </div>
                        @endif
                    @else
                        <div class="mt-6 p-4 bg-blue-50 dark:bg-blue-900/30 border-l-4 border-blue-400 dark:border-blue-600 text-blue-700 dark:text-blue-200 rounded-md">
                            <p class="font-medium">This is your own skill offer.</p>
                            <a href="{{ route('skill-offers.edit', $skillOffer->id) }}" class="text-blue-800 dark:text-blue-100 hover:underline font-semibold">Edit this offer</a>
                        </div>
                    @endif
                @endauth


                {{-- Tombol Aksi Edit/Delete untuk Pemilik Offer --}}
                <div class="mt-10 pt-6 border-t border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row items-center {{ Auth::check() && Auth::id() == $skillOffer->user_id ? 'justify-between' : 'justify-end' }} gap-3">
                    <a href="{{ route('skill-offers.index') }}" 
                       class="w-full sm:w-auto px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--primary-color)] transition ripple text-center flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to List
                    </a>
                    <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                        @can('update', $skillOffer)
                            <a href="{{ route('skill-offers.edit', $skillOffer->id) }}" 
                               class="w-full sm:w-auto px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-[var(--warning-color)] hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--warning-color)] transition ripple text-center flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                                Edit Offer
                            </a>
                        @endcan
                        @can('delete', $skillOffer)
                            <form action="{{ route('skill-offers.destroy', $skillOffer->id) }}" method="POST" class="w-full sm:w-auto">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-full px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-[var(--danger-color)] hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--danger-color)] transition ripple flex items-center justify-center"
                                        aria-label="Delete this skill offer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Delete Offer
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
