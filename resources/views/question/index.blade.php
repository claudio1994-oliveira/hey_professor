<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('My Questions') }}
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
        <div class="dark:text-gray-600 uppercase font-bold mb-1"> Drafts</div>

        <div class="dark:text-gray-400 space-y-4">
            <x-table>
                <x-table.thead>
                    <tr>
                        <x-table.th>Question</x-table.th>
                        <x-table.th>Actions</x-table.th>
                    </tr>
                </x-table.thead>
                <tbody>
                    @foreach ($questions->where('draft', true) as $q)
                        <x-table.tr>
                            <x-table.td>{{ $q->question }}</x-table.td>
                            <x-table.td>
                                <x-form :action="route('question.publish', ['question' => $q])" put>
                                    <x-btn.primary type="submit">
                                        Publish
                                    </x-btn.primary>

                                </x-form>
                                <x-form :action="route('question.destroy', ['question' => $q])" delete>
                                    <x-danger-button type="submit">
                                        Delete
                                    </x-danger-button>
                                </x-form>
                            </x-table.td>
                        </x-table.tr>
                    @endforeach

                </tbody>
            </x-table>
        </div>

        <hr class="border-gray-700 border-dashed my-4">
        <div class="dark:text-gray-600 uppercase font-bold mb-1"> My Questions</div>

        <div class="dark:text-gray-400 space-y-4">

            <x-table>
                <x-table.thead>
                    <tr>
                        <x-table.th>Question</x-table.th>
                        <x-table.th>Actions</x-table.th>
                    </tr>
                </x-table.thead>
                <tbody>
                    @foreach ($questions->where('draft', false) as $q)
                        <x-table.tr>
                            <x-table.td>{{ $q->question }}</x-table.td>
                            <x-table.td>
                                <x-form :action="route('question.destroy', ['question' => $q])" delete>
                                    <x-danger-button type="submit">
                                        Delete
                                    </x-danger-button>
                                </x-form>
                            </x-table.td>
                        </x-table.tr>
                    @endforeach

                </tbody>
            </x-table>
        </div>

    </x-container>
</x-app-layout>
