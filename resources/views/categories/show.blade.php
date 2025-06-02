@extends('layouts.app')

@section('header', 'Category Details: ' . $category->name)

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 md:p-8">
                {{-- Category Name as a prominent title within the card --}}
                <div class="mb-6 pb-4 border-b border-[var(--border-color)]">
                    <h2 class="text-2xl font-bold text-[var(--primary-color)] leading-tight">
                        {{ $category->name }}
                    </h2>
                    <p class="text-sm text-[var(--medium-text)] mt-1">
                        Slug: <code class="bg-gray-100 text-gray-700 px-2 py-1 rounded-md text-xs">{{ $category->slug }}</code>
                    </p>
                </div>

                <dl class="space-y-6">
                    <div>
                        <dt class="text-sm font-medium text-[var(--medium-text)] uppercase tracking-wider">Created At</dt>
                        <dd class="mt-1 text-md text-[var(--dark-text)]">{{ $category->created_at->format('F j, Y, H:i:s') }} ({{ $category->created_at->diffForHumans() }})</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-[var(--medium-text)] uppercase tracking-wider">Last Updated At</dt>
                        <dd class="mt-1 text-md text-[var(--dark-text)]">{{ $category->updated_at->format('F j, Y, H:i:s') }} ({{ $category->updated_at->diffForHumans() }})</dd>
                    </div>
                    
                    {{-- Placeholder for number of associated items, if applicable --}}
                    {{-- For example, if categories have posts or products --}}
                    {{-- @if($category->relationName()->count() > 0)
                    <div>
                        <dt class="text-sm font-medium text-[var(--medium-text)] uppercase tracking-wider">Associated Items</dt>
                        <dd class="mt-1 text-md text-[var(--dark-text)]">{{ $category->relationName()->count() }} items</dd>
                    </div>
                    @endif --}}

                </dl>

                {{-- Action Buttons --}}
                <div class="mt-10 pt-6 border-t border-[var(--border-color)] flex flex-col sm:flex-row items-center justify-end gap-3">
                    <a href="{{ route('categories.index') }}"
                       class="w-full sm:w-auto px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-[var(--medium-text)] bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--primary-color)] transition ripple text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1 -mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Categories
                    </a>

                    {{-- Assuming authorization for edit/delete --}}
                    {{-- @can('update', $category) --}}
                    <a href="{{ route('categories.edit', $category->id) }}"
                       class="w-full sm:w-auto px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-[var(--warning-color)] hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--warning-color)] transition ripple text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1 -mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        Edit Category
                    </a>
                    {{-- @endcan --}}

                    {{-- @can('delete', $category) --}}
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="w-full sm:w-auto">
                        @csrf
                        @method('DELETE')
                        {{--
                            IMPORTANT: The layout rules discourage confirm().
                            You should implement a custom modal for delete confirmation.
                        --}}
                        <button type="submit"
                                class="w-full px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-[var(--danger-color)] hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--danger-color)] transition ripple flex items-center justify-center"
                                aria-label="Delete category {{ $category->name }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Delete Category
                        </button>
                    </form>
                    {{-- @endcan --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
