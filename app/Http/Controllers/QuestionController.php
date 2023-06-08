<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Closure;
use Illuminate\Http\{RedirectResponse, Request};

class QuestionController extends Controller
{
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
        Question::query()->create(array_merge($data, ['draft' => true]));

        return to_route('dashboard');
    }
}
