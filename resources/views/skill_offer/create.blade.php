@extends('layouts.app')

{{-- Determine if this is a create or edit form to set the header and form action dynamically --}}
@php
    $isEditMode = isset($offer);
    $formAction = $isEditMode ? route('skill-offers.update', $offer->id) : route('skill-offers.store');
    $headerTitle = $isEditMode ? 'Edit Skill Offer' : 'Create New Skill Offer';
    $buttonText = $isEditMode ? 'Update Offer' : 'Save Offer';
@endphp

@section('header', $headerTitle)

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 md:p-8 text-[var(--dark-text)]">
                {{-- Form Title already in header, but you can add a sub-header if needed --}}
                {{-- <h2 class="text-2xl font-semibold mb-6">{{ $headerTitle }}</h2> --}}

                <form action="{{ $formAction }}" method="POST">
                    @csrf
                    @if($isEditMode)
                        @method('PUT')
                    @endif

                    <div class="mb-6">
                        <label for="category_id" class="block text-sm font-medium text-[var(--medium-text)] mb-1">Category <span class="text-red-500">*</span></label>
                        <select name="category_id" id="category_id" 
                                class="mt-1 block w-full py-2 px-3 border border-[var(--border-color)] bg-white rounded-md shadow-sm focus:outline-none focus:ring-[var(--primary-color)] focus:border-[var(--primary-color)] sm:text-sm @error('category_id') border-red-500 @enderror" 
                                required>
                            <option value="">Select a Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                        {{ old('category_id', $isEditMode ? $offer->category_id : '') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="skill_offered" class="block text-sm font-medium text-[var(--medium-text)] mb-1">Skill Offered <span class="text-red-500">*</span></label>
                        <input type="text" id="skill_offered" name="skill_offered" 
                               value="{{ old('skill_offered', $isEditMode ? $offer->skill_offered : '') }}" 
                               class="mt-1 block w-full py-2 px-3 border border-[var(--border-color)] rounded-md shadow-sm focus:outline-none focus:ring-[var(--primary-color)] focus:border-[var(--primary-color)] sm:text-sm @error('skill_offered') border-red-500 @enderror" 
                               required>
                        @error('skill_offered')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="skill_requested" class="block text-sm font-medium text-[var(--medium-text)] mb-1">Skill Requested <span class="text-red-500">*</span></label>
                        <input type="text" id="skill_requested" name="skill_requested" 
                               value="{{ old('skill_requested', $isEditMode ? $offer->skill_requested : '') }}" 
                               class="mt-1 block w-full py-2 px-3 border border-[var(--border-color)] rounded-md shadow-sm focus:outline-none focus:ring-[var(--primary-color)] focus:border-[var(--primary-color)] sm:text-sm @error('skill_requested') border-red-500 @enderror" 
                               required>
                        @error('skill_requested')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-[var(--medium-text)] mb-1">Description</label>
                        <textarea id="description" name="description" rows="4" 
                                  class="mt-1 block w-full py-2 px-3 border border-[var(--border-color)] rounded-md shadow-sm focus:outline-none focus:ring-[var(--primary-color)] focus:border-[var(--primary-color)] sm:text-sm @error('description') border-red-500 @enderror">{{ old('description', $isEditMode ? $offer->description : '') }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end space-x-4 pt-4 border-t border-[var(--border-color)]">
                        <a href="{{ route('skill-offers.index') }}" 
                           class="px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-[var(--medium-text)] bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--primary-color)] transition ripple">
                            Back
                        </a>
                        <button type="submit" 
                                class="px-6 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-[var(--success-color)] hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--success-color)] transition ripple">
                            {{ $buttonText }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Any specific JavaScript for this form can go here.
    // For example, if you wanted to add character counters or more complex validation.
</script>
@endpush
