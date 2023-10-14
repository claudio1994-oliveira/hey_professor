<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Vote for a Question') }}
        </x-header>

    </x-slot>
    <x-container>

        <div class="mb-1 font-bold uppercase dark:text-gray-600"> Question List</div>
        <div class="space-y-4 dark:text-gray-400">
            @foreach ($questions as $q)
                <x-question :item="$q"></x-question>
            @endforeach

            {{ $questions->withQueryString()->links() }}
        </div>

    </x-container>
</x-app-layout>
