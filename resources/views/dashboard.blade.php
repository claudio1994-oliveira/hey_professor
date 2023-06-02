<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Dashboard') }}
        </x-header>

    </x-slot>
    <x-container>
        <x-form post :action="route('question.store')">

            <x-text-area label="Your Question" name="question" />

            <x-btn.primary type="submit">
                Save
            </x-btn.primary>

            <x-btn.info type="reset">
                Cancel
            </x-btn.info>
        </x-form>

        <hr class="border-gray-700 border-dashed my-4">
        <div class="dark:text-gray-600 uppercase font-bold mb-1"> Question List</div>
        <div class="dark:text-gray-400 space-y-4">
            @foreach ($questions as $q)
                <x-question :item="$q"></x-question>
            @endforeach
        </div>

    </x-container>
</x-app-layout>
