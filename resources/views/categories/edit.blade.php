@extends('layouts.app')

{{-- Determine if this is a create or edit form to set the header and form action dynamically --}}
@php
    $isEditMode = isset($category) && $category->exists;
    $formAction = $isEditMode ? route('categories.update', $category->id) : route('categories.store');
    $headerTitle = $isEditMode ? 'Edit Category: ' . $category->name : 'Create New Category';
    $buttonText = $isEditMode ? 'Update Category' : 'Save Category';
@endphp

@section('header', $headerTitle)

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 md:p-8 text-[var(--dark-text)]">
                {{-- The main title is in the @section('header') --}}
                {{-- <h2 class="text-2xl font-semibold mb-6">{{ $headerTitle }}</h2> --}}

                <form action="{{ $formAction }}" method="POST">
                    @csrf
                    @if($isEditMode)
                        @method('PUT')
                    @endif

                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-[var(--medium-text)] mb-1">
                            Category Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name"
                               value="{{ old('name', $isEditMode ? $category->name : '') }}"
                               class="mt-1 block w-full py-2 px-3 border border-[var(--border-color)] rounded-md shadow-sm focus:outline-none focus:ring-[var(--primary-color)] focus:border-[var(--primary-color)] sm:text-sm @error('name') border-red-500 @enderror"
                               required autofocus>
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- If you want to allow manual slug editing, uncomment this section. 
                         Otherwise, slugs are typically generated automatically from the name in the controller. --}}
                    {{--
                    <div class="mb-6">
                        <label for="slug" class="block text-sm font-medium text-[var(--medium-text)] mb-1">
                            Slug (Optional, will be auto-generated if left empty)
                        </label>
                        <input type="text" id="slug" name="slug"
                               value="{{ old('slug', $isEditMode ? $category->slug : '') }}"
                               class="mt-1 block w-full py-2 px-3 border border-[var(--border-color)] rounded-md shadow-sm focus:outline-none focus:ring-[var(--primary-color)] focus:border-[var(--primary-color)] sm:text-sm @error('slug') border-red-500 @enderror"
                               aria-describedby="slug-description">
                        <p class="mt-1 text-xs text-gray-500" id="slug-description">
                            The slug is the URL-friendly version of the name. Usually lowercase and contains only letters, numbers, and hyphens.
                        </p>
                        @error('slug')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    --}}
                    
                    {{-- Add other fields for the category if any, e.g., description, parent_category_id --}}

                    <div class="flex items-center justify-end space-x-4 pt-4 mt-6 border-t border-[var(--border-color)]">
                        <a href="{{ route('categories.index') }}"
                           class="px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-[var(--medium-text)] bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--primary-color)] transition ripple">
                            Cancel
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
    // If you want to auto-generate slug from name on client-side (optional)
    // document.addEventListener('DOMContentLoaded', function () {
    //     const nameInput = document.getElementById('name');
    //     const slugInput = document.getElementById('slug'); // Assuming slug input is present

    //     if (nameInput && slugInput) {
    //         nameInput.addEventListener('keyup', function () {
    //             // Basic slug generation (can be improved)
    //             const slug = this.value
    //                 .toLowerCase()
    //                 .trim()
    //                 .replace(/\s+/g, '-')           // Replace spaces with -
    //                 .replace(/[^\w-]+/g, '')       // Remove all non-word chars
    //                 .replace(/--+/g, '-');          // Replace multiple - with single -
    //             slugInput.value = slug;
    //         });
    //     }
    // });
</script>
@endpush
