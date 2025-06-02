@extends('layouts.app')

@section('header', 'Create New Category')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 md:p-8 text-[var(--dark-text)]">
                {{-- The main title "Create New Category" is in the @section('header') --}}
                {{-- <h2 class="text-2xl font-semibold mb-6">Create New Category</h2> --}}

                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf

                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-[var(--medium-text)] mb-1">
                            Category Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name"
                               value="{{ old('name') }}"
                               class="mt-1 block w-full py-2 px-3 border border-[var(--border-color)] rounded-md shadow-sm focus:outline-none focus:ring-[var(--primary-color)] focus:border-[var(--primary-color)] sm:text-sm @error('name') border-red-500 @enderror"
                               required autofocus>
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    {{-- Slug input is omitted as it was not in your provided "create" form. 
                         Slugs are typically best generated automatically in the controller upon creation. --}}

                    <div class="flex items-center justify-end space-x-4 pt-4 mt-6 border-t border-[var(--border-color)]">
                        <a href="{{ route('categories.index') }}"
                           class="px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-[var(--medium-text)] bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--primary-color)] transition ripple">
                            Back
                        </a>
                        <button type="submit"
                                class="px-6 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-[var(--success-color)] hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--success-color)] transition ripple">
                            Save Category
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
    // Specific scripts for this form can go here if needed.
    // The client-side slug generation script is removed as the slug input is omitted.
</script>
@endpush
