<?php

namespace App\Http\Controllers;

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
}
