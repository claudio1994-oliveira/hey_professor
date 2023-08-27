<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Closure;
use Illuminate\Http\{RedirectResponse, Request};
use Illuminate\View\View;

class QuestionController extends Controller
{
    public function index(): View
    {
        return view('question.index', ['questions' => user()->questions()->get()]);
    }

    public function store(): RedirectResponse
    {
        $data = request()->validate([
            'question' => [
                'required',
                'min:10',
                function (string $attr, mixed $value, Closure $fail) {
                    if ($value[strlen($value) - 1] != '?') {
                        $fail('Are you sure tha is a question? It is missing te question mark in the end.');
                    }
                },
            ],
        ]);

        user()->questions()->create(array_merge($data, ['draft' => true]));

        return back();
    }

    public function destroy(Question $question): RedirectResponse
    {
        $this->authorize('delete', $question);

        $question->delete();

        return back();
    }

    public function edit(Question $question): View
    {
        $this->authorize('update', $question);

        return view('question.edit', ['question' => $question]);
    }

    public function update(Question $question): RedirectResponse
    {
        $this->authorize('update', $question);

        $data = request()->validate([
            'question' => [
                'required',
                'min:10',
                function (string $attr, mixed $value, Closure $fail) {
                    if ($value[strlen($value) - 1] != '?') {
                        $fail('Are you sure tha is a question? It is missing te question mark in the end.');
                    }
                },
            ],
        ]);

        $question->update($data);

        return to_route('question.index');
    }
}
