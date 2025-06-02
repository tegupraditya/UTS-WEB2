@extends('layouts.app')

{{-- Judul header dinamis berdasarkan detail transaksi --}}
@section('header', 'Transaction Details')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 md:p-8">
                @php
                    $skillOffer = $transaction->skillOffer;
                    $offerer = $skillOffer->user; // Pengguna yang membuat SkillOffer
                    $requester = $transaction->requester; // Pengguna yang mengajukan proposal pada SkillOffer ini
                    $currentUserIsOfferer = Auth::id() == $offerer->id;
                    $currentUserIsRequester = Auth::id() == $requester->id;
                @endphp

                {{-- Judul Utama Transaksi --}}
                <div class="mb-6 pb-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">
                        Transaction for: <a href="{{ route('skill-offers.show', $skillOffer->id) }}" class="text-[var(--primary-color)] hover:text-[var(--primary-hover)] underline">{{ $skillOffer->skill_offered }}</a>
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Status: 
                        <span class="px-2 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full 
                            @if($transaction->status === 'pending_proposal') bg-yellow-100 text-yellow-800 dark:bg-yellow-700 dark:text-yellow-100
                            @elseif($transaction->status === 'accepted') bg-blue-100 text-blue-800 dark:bg-blue-700 dark:text-blue-100
                            @elseif($transaction->status === 'in_progress') bg-sky-100 text-sky-800 dark:bg-sky-700 dark:text-sky-100
                            @elseif($transaction->status === 'completed') bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-100
                            @elseif($transaction->status === 'rejected' || Str::startsWith($transaction->status, 'cancelled')) bg-red-100 text-red-800 dark:bg-red-700 dark:text-red-100
                            @else bg-gray-100 text-gray-800 dark:bg-gray-600 dark:text-gray-100 @endif">
                            {{ Str::title(str_replace('_', ' ', $transaction->status)) }}
                        </span>
                    </p>
                </div>

                {{-- Detail Pihak Terlibat --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Offered By (Seller)</h3>
                        <div class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                            <p><strong>Name:</strong> <a href="{{ route('user-profiles.show', $offerer->profile->id) }}" class="text-[var(--primary-color)] hover:underline">{{ $offerer->name }}</a></p>
                            <p><strong>Email:</strong> {{ $offerer->email }}</p>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Proposed By (Buyer/Requester)</h3>
                        <div class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                            <p><strong>Name:</strong> <a href="{{ route('user-profiles.show', $requester->profile->id) }}" class="text-[var(--primary-color)] hover:underline">{{ $requester->name }}</a></p>
                            <p><strong>Email:</strong> {{ $requester->email }}</p>
                        </div>
                    </div>
                </div>

                {{-- Detail Skill Offer yang Ditransaksikan --}}
                <div class="mb-8 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-3">Skill Offer Details</h3>
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-2 text-sm">
                        <div class="sm:col-span-1">
                            <dt class="font-medium text-gray-500 dark:text-gray-400">Skill Offered:</dt>
                            <dd class="text-gray-900 dark:text-white">{{ $skillOffer->skill_offered }}</dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="font-medium text-gray-500 dark:text-gray-400">Skill Requested in Return:</dt>
                            <dd class="text-gray-900 dark:text-white">{{ $skillOffer->skill_requested }}</dd>
                        </div>
                        @if($skillOffer->category)
                        <div class="sm:col-span-1">
                            <dt class="font-medium text-gray-500 dark:text-gray-400">Category:</dt>
                            <dd class="text-gray-900 dark:text-white">{{ $skillOffer->category->name }}</dd>
                        </div>
                        @endif
                        <div class="sm:col-span-2">
                            <dt class="font-medium text-gray-500 dark:text-gray-400">Description:</dt>
                            <dd class="text-gray-900 dark:text-white mt-1 whitespace-pre-wrap">{{ $skillOffer->description ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>
                
                {{-- Catatan Transaksi --}}
                @if($transaction->notes_requester || $transaction->notes_offerer)
                <div class="mb-8">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-3">Transaction Notes</h3>
                    @if($transaction->notes_requester)
                    <div class="mb-3 p-3 bg-blue-50 dark:bg-blue-900/30 border-l-4 border-blue-400 dark:border-blue-600 rounded">
                        <p class="text-xs text-blue-700 dark:text-blue-300 font-semibold">Note from {{ $requester->name }}:</p>
                        <p class="text-sm text-gray-700 dark:text-gray-200 whitespace-pre-wrap">{{ $transaction->notes_requester }}</p>
                    </div>
                    @endif
                    @if($transaction->notes_offerer)
                    <div class="p-3 bg-green-50 dark:bg-green-900/30 border-l-4 border-green-400 dark:border-green-600 rounded">
                        <p class="text-xs text-green-700 dark:text-green-300 font-semibold">Note from {{ $offerer->name }}:</p>
                        <p class="text-sm text-gray-700 dark:text-gray-200 whitespace-pre-wrap">{{ $transaction->notes_offerer }}</p>
                    </div>
                    @endif
                </div>
                @endif

                {{-- Tombol Aksi Transaksi --}}
                <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Actions</h3>
                    <div class="flex flex-col sm:flex-row gap-3">
                        {{-- Aksi untuk Offerer (Pemilik SkillOffer) --}}
                        @if($currentUserIsOfferer)
                            @if($transaction->status === 'pending_proposal')
                                <form action="{{ route('transactions.update.status', $transaction->id) }}" method="POST" class="w-full sm:w-auto">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="accepted">
                                    <button type="submit" class="w-full justify-center inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition ripple">
                                        Accept Proposal
                                    </button>
                                </form>
                                <form action="{{ route('transactions.update.status', $transaction->id) }}" method="POST" class="w-full sm:w-auto">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="rejected">
                                    {{-- Anda bisa menambahkan field untuk notes_offerer di sini jika mau --}}
                                    {{-- <textarea name="notes_offerer" placeholder="Reason for rejection (optional)"></textarea> --}}
                                    <button type="submit" class="w-full justify-center inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ripple">
                                        Reject Proposal
                                    </button>
                                </form>
                            @elseif(in_array($transaction->status, ['accepted', 'in_progress']))
                                <form action="{{ route('transactions.update.status', $transaction->id) }}" method="POST" class="w-full sm:w-auto">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="completed">
                                    <button type="submit" class="w-full justify-center inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ripple">
                                        Mark as Completed
                                    </button>
                                </form>
                                {{-- Tambahkan tombol "Cancel Transaction" jika diperlukan --}}
                            @endif
                        @endif

                        {{-- Aksi untuk Requester (Peminta Transaksi) --}}
                        @if($currentUserIsRequester)
                            @if(in_array($transaction->status, ['accepted', 'in_progress']))
                                <form action="{{ route('transactions.update.status', $transaction->id) }}" method="POST" class="w-full sm:w-auto">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="completed">
                                    <button type="submit" class="w-full justify-center inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ripple">
                                        Mark as Completed (My Side)
                                    </button>
                                </form>
                            @elseif($transaction->status === 'pending_proposal')
                                <p class="text-sm text-gray-600 dark:text-gray-400">Waiting for offerer to respond.</p>
                                {{-- Tambahkan tombol "Cancel Proposal" jika diperlukan --}}
                            @endif
                        @endif

                        {{-- Informasi jika transaksi sudah selesai atau dibatalkan --}}
                        @if($transaction->status === 'completed')
                            <p class="text-sm text-green-600 dark:text-green-400 font-semibold">This transaction has been completed.</p>
                        @elseif($transaction->status === 'rejected' || Str::startsWith($transaction->status, 'cancelled'))
                            <p class="text-sm text-red-600 dark:text-red-400 font-semibold">This transaction was {{ str_replace('_', ' ', $transaction->status) }}.</p>
                        @endif
                    </div>
                </div>

                {{-- Tombol Kembali --}}
                <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                     <a href="{{ route('transactions.index.mine') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--primary-color)] transition ripple">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to My Transactions
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
