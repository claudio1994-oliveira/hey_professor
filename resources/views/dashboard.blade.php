<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Vote for a Question') }}
        </x-header>

    </x-slot>
    <x-container>

        <div class="mb-1 font-bold uppercase dark:text-gray-600"> Question List</div>
        <form action="{{ route('dashboard') }}" method="GET" class="flex mb-5 space-x-2">
            @csrf
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..."
                class="w-full px-4 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-300 dark:placeholder-gray-500 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none">
            <button type="submit"
                class="px-4 py-2 text-sm font-medium tracking-wide text-white capitalize bg-indigo-500 rounded-md dark:bg-indigo-500 focus:outline-none focus:bg-indigo-600">Search</button>
        </form>

        <div class="space-y-4 dark:text-gray-400">
            @forelse ($questions as $q)
                <x-question :item="$q"></x-question>
            @empty
                <div class="text-center">
                    <h1 class="text-2xl font-bold">No results found</h1>
                    <p class="text-gray-500">Try adjusting your search or filter to find what you're looking for.</p>
                    <img src="{{ asset('images/searching.svg') }}" alt="Not found results">
                </div>
            @endforelse

            @if (count($questions) > 0)
                {{ $questions->withQueryString()->links() }}
            @endif

        </div>

    </x-container>
</x-app-layout>
