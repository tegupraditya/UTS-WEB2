@extends('layouts.app')

@section('header', 'Manage Categories')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-6 flex justify-between items-center">
            {{-- The main title "Manage Categories" is already in the header section from @section('header') --}}
            {{-- If you want a sub-title here, you can add it: --}}
            {{-- <h2 class="text-xl font-semibold text-[var(--dark-text)]">All Categories</h2> --}}
            
            {{-- "Create New Category" Button --}}
            {{-- Assuming authorization, e.g., @can('create', App\Models\Category::class) --}}
            <a href="{{ route('categories.create') }}"
               class="px-4 py-2 bg-[var(--primary-color)] text-white font-semibold rounded-lg shadow-md hover:bg-[var(--primary-hover)] focus:outline-none focus:ring-2 focus:ring-[var(--primary-color)] focus:ring-opacity-75 transition ease-in-out duration-150 ripple">
                Create New Category
            </a>
            {{-- @endcan --}}
        </div>

        {{-- Flash messages are handled by the main layout (layouts.app) --}}
        {{-- The @if (session('success')) block for Bootstrap alert is removed --}}

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-0 md:p-6"> {{-- Adjusted padding for table container --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-[var(--border-color)]">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--medium-text)] uppercase tracking-wider">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--medium-text)] uppercase tracking-wider">
                                    Slug
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--medium-text)] uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-[var(--border-color)]">
                            @forelse($categories as $category)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-[var(--dark-text)]">
                                        {{ $category->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[var(--medium-text)]">
                                        {{ $category->slug }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('categories.show', $category->id) }}" class="px-3 py-1 bg-[var(--accent-color)] text-white text-xs font-semibold rounded-md shadow-sm hover:opacity-80 focus:outline-none focus:ring-2 focus:ring-[var(--accent-color)] focus:ring-opacity-75 transition ripple">
                                                View
                                            </a>
                                            {{-- Assuming authorization for edit/delete --}}
                                            {{-- @can('update', $category) --}}
                                            <a href="{{ route('categories.edit', $category->id) }}" class="px-3 py-1 bg-[var(--warning-color)] text-white text-xs font-semibold rounded-md shadow-sm hover:opacity-80 focus:outline-none focus:ring-2 focus:ring-[var(--warning-color)] focus:ring-opacity-75 transition ripple">
                                                Edit
                                            </a>
                                            {{-- @endcan --}}
                                            {{-- @can('delete', $category) --}}
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                {{--
                                                    IMPORTANT: The layout rules discourage confirm().
                                                    You should implement a custom modal for delete confirmation.
                                                --}}
                                                <button type="submit"
                                                        class="px-3 py-1 bg-[var(--danger-color)] text-white text-xs font-semibold rounded-md shadow-sm hover:opacity-80 focus:outline-none focus:ring-2 focus:ring-[var(--danger-color)] focus:ring-opacity-75 transition ripple"
                                                        aria-label="Delete category {{ $category->name }}">
                                                    Delete
                                                </button>
                                            </form>
                                            {{-- @endcan --}}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-12 text-center text-sm text-[var(--medium-text)]">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-12 h-12 text-gray-400 mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
                                            </svg>
                                            <p class="font-semibold">No Categories Found.</p>
                                            <p class="mt-1">
                                                Why not <a href="{{ route('categories.create') }}" class="text-[var(--primary-color)] hover:text-[var(--primary-hover)] underline">create one</a>?
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if ($categories instanceof \Illuminate\Pagination\LengthAwarePaginator && $categories->hasPages())
            <div class="mt-8">
                {{ $categories->links() }} {{-- Ensure your pagination views are styled with Tailwind --}}
            </div>
        @endif

    </div>
</div>
@endsection
