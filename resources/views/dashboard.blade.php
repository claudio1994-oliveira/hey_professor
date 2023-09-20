<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Vote for a Question') }}
        </x-header>

    </x-slot>
    <x-container>

        <div class="dark:text-gray-600 uppercase font-bold mb-1"> Question List</div>
        <div class="dark:text-gray-400 space-y-4">
            @foreach ($questions as $q)
                <x-question :item="$q"></x-question>
            @endforeach

            {{ $questions->links() }}
        </div>

    </x-container>
</x-app-layout>
