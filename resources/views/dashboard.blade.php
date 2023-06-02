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
    </x-container>
</x-app-layout>
