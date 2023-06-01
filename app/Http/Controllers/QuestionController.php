<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\{RedirectResponse, Request};

class QuestionController extends Controller
{
    public function store(): RedirectResponse
    {
        $data = request()->validate([
            'question' => [
                'required',
                'min:10',
            ],
        ]);
        Question::query()->create($data);

        return to_route('dashboard');
    }
}
