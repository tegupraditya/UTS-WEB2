@extends('layouts.app')

@section('header', 'My Transactions')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Section 1: Transactions I Initiated (as Requester) --}}
        <div class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6">
                Proposals I Sent
            </h2>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="overflow-x-auto">
                    @if($initiatedTransactions->isEmpty())
                        <div class="p-6 text-center text-gray-500 dark:text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76" />
                            </svg>
                            <p class="mt-2 text-sm">You haven't sent any transaction proposals yet.</p>
                            <a href="{{ route('skill-offers.index') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-[var(--primary-color)] text-white text-sm font-medium rounded-md hover:bg-[var(--primary-hover)] transition">
                                Find Skill Offers
                            </a>
                        </div>
                    @else
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Skill Offered (by Them)
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Offered By
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        My Request For
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Proposed On
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($initiatedTransactions as $transaction)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $transaction->skillOffer->skill_offered }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                            {{ $transaction->skillOffer->user->name ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                            {{ $transaction->skillOffer->skill_requested }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($transaction->status === 'pending_proposal') bg-yellow-100 text-yellow-800 dark:bg-yellow-700 dark:text-yellow-100
                                                @elseif($transaction->status === 'accepted' || $transaction->status === 'in_progress') bg-blue-100 text-blue-800 dark:bg-blue-700 dark:text-blue-100
                                                @elseif($transaction->status === 'completed') bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-100
                                                @elseif($transaction->status === 'rejected' || Str::startsWith($transaction->status, 'cancelled')) bg-red-100 text-red-800 dark:bg-red-700 dark:text-red-100
                                                @else bg-gray-100 text-gray-800 dark:bg-gray-600 dark:text-gray-100 @endif">
                                                {{ Str::title(str_replace('_', ' ', $transaction->status)) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                            {{ $transaction->created_at->format('d M Y, H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('transactions.show', $transaction->id) }}" class="text-[var(--primary-color)] hover:text-[var(--primary-hover)]">View Details</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if($initiatedTransactions->hasPages())
                            <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                                {{ $initiatedTransactions->links() }}
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        {{-- Section 2: Transactions on My Offers (as Offerer) --}}
        <div>
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6">
                Proposals on My Skill Offers
            </h2>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="overflow-x-auto">
                    @if($transactionsOnMyOffers->isEmpty())
                        <div class="p-6 text-center text-gray-500 dark:text-gray-400">
                             <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <p class="mt-2 text-sm">No one has proposed a transaction on your skill offers yet.</p>
                             <a href="{{ route('skill-offers.create') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-[var(--primary-color)] text-white text-sm font-medium rounded-md hover:bg-[var(--primary-hover)] transition">
                                Create a New Skill Offer
                            </a>
                        </div>
                    @else
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        My Offered Skill
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Requested By
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Their Request For
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Proposed On
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($transactionsOnMyOffers as $transaction)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $transaction->skillOffer->skill_offered }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                            {{ $transaction->requester->name ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                            {{ $transaction->skillOffer->skill_requested }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($transaction->status === 'pending_proposal') bg-yellow-100 text-yellow-800 dark:bg-yellow-700 dark:text-yellow-100
                                                @elseif($transaction->status === 'accepted' || $transaction->status === 'in_progress') bg-blue-100 text-blue-800 dark:bg-blue-700 dark:text-blue-100
                                                @elseif($transaction->status === 'completed') bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-100
                                                @elseif($transaction->status === 'rejected' || Str::startsWith($transaction->status, 'cancelled')) bg-red-100 text-red-800 dark:bg-red-700 dark:text-red-100
                                                @else bg-gray-100 text-gray-800 dark:bg-gray-600 dark:text-gray-100 @endif">
                                                {{ Str::title(str_replace('_', ' ', $transaction->status)) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                            {{ $transaction->created_at->format('d M Y, H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('transactions.show', $transaction->id) }}" class="text-[var(--primary-color)] hover:text-[var(--primary-hover)]">View Details</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if($transactionsOnMyOffers->hasPages())
                            <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                                {{ $transactionsOnMyOffers->links() }}
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
