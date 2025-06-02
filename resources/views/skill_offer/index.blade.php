@extends('layouts.app')

@section('header', 'Skill Offers') {{-- Optional: You can set a header title here --}}

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="mb-6 flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-[var(--dark-text)]">Manage Your Skill Offers</h2>
                    <a href="{{ route('skill-offers.create') }}" 
                       class="px-4 py-2 bg-[var(--primary-color)] text-white font-semibold rounded-lg shadow-md hover:bg-[var(--primary-hover)] focus:outline-none focus:ring-2 focus:ring-[var(--primary-color)] focus:ring-opacity-75 transition ease-in-out duration-150 ripple">
                        Create New Offer
                    </a>
                </div>

                {{-- Flash messages will be handled by the main layout (layouts.app) --}}
                {{-- No need for @if(session('success')) here if layout handles it --}}

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-[var(--border-color)]">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--medium-text)] uppercase tracking-wider">
                                    Category
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--medium-text)] uppercase tracking-wider">
                                    Skill Offered
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--medium-text)] uppercase tracking-wider">
                                    Skill Requested
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--medium-text)] uppercase tracking-wider">
                                    Description
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[var(--medium-text)] uppercase tracking-wider">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-[var(--border-color)]">
                            @forelse($offers as $offer)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[var(--dark-text)]">
                                        {{-- Ideally, this would be $offer->category->name or similar --}}
                                        {{ $offer->category_id }} 
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[var(--dark-text)]">
                                        {{ $offer->skill_offered }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[var(--dark-text)]">
                                        {{ $offer->skill_requested }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-[var(--dark-text)] max-w-xs truncate" title="{{ $offer->description }}">
                                        {{ Str::limit($offer->description, 50) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('skill-offers.show', $offer->id) }}" class="px-3 py-1 bg-[var(--accent-color)] text-white text-xs font-semibold rounded-md shadow-sm hover:opacity-80 focus:outline-none focus:ring-2 focus:ring-[var(--accent-color)] focus:ring-opacity-75 transition ripple">
                                                View
                                            </a>
                                            <a href="{{ route('skill-offers.edit', $offer->id) }}" class="px-3 py-1 bg-[var(--warning-color)] text-white text-xs font-semibold rounded-md shadow-sm hover:opacity-80 focus:outline-none focus:ring-2 focus:ring-[var(--warning-color)] focus:ring-opacity-75 transition ripple">
                                                Edit
                                            </a>
                                            <form action="{{ route('skill-offers.destroy', $offer->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                {{-- 
                                                    IMPORTANT: The layout rules discourage confirm(). 
                                                    You should implement a custom modal for delete confirmation.
                                                    For example, trigger a modal with JavaScript here.
                                                --}}
                                                <button type="submit" 
                                                        class="px-3 py-1 bg-[var(--danger-color)] text-white text-xs font-semibold rounded-md shadow-sm hover:opacity-80 focus:outline-none focus:ring-2 focus:ring-[var(--danger-color)] focus:ring-opacity-75 transition ripple"
                                                        {{-- onclick="return confirm('Are you sure?')" --}} {{-- Removed confirm() --}}
                                                        aria-label="Delete offer for {{ $offer->skill_offered }}">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-sm text-[var(--medium-text)]">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path><path d="M9 10h.01M15 10h.01"></path></svg>
                                            <p class="font-semibold">No skill offers found.</p>
                                            <p class="mt-1">Why not <a href="{{ route('skill-offers.create') }}" class="text-[var(--primary-color)] hover:text-[var(--primary-hover)] underline">create one</a>?</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if ($offers instanceof \Illuminate\Pagination\LengthAwarePaginator && $offers->hasPages())
                    <div class="mt-6">
                        {{ $offers->links() }} {{-- Ensure your pagination views are styled with Tailwind --}}
                    </div>
                @endif

                </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // If you need any specific JavaScript for this page, you can add it here.
    // For example, to initialize modals for delete confirmations.
    // document.querySelectorAll('.delete-button-class').forEach(button => {
    // button.addEventListener('click', function(event) {
    // event.preventDefault(); // Prevent form submission
    // const form = this.closest('form');
    // // Logic to show your custom modal
    // // e.g., myModal.show(() => form.submit()); 
    //         });
    //     });
</script>
@endpush
