<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Edit Question') }} :: {{ $question->id }}
        </x-header>

    </x-slot>
    <x-container>
        <x-form post :action="route('question.update', $question)" put>

            <x-text-area label="Your Question" name="question" :value="$question->question" />

            <x-btn.primary type="submit">
                Update
            </x-btn.primary>

            <x-btn.info type="reset">
                Cancel
            </x-btn.info>
        </x-form>

    </x-container>
</x-app-layout>
