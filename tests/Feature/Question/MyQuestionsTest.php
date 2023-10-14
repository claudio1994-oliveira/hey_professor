<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('shoul be able to list all question created by me', function () {
    $wrongUser = User::factory()->create();
    $user      = User::factory()->create();

    actingAs($user);

    $wrongQuestions = Question::factory()->for($wrongUser, 'createdBy')->count(10)->create();

    $questions = Question::factory()->for($user, 'createdBy')->count(10)->create();

    $response = get(route('question.index'));

    foreach ($questions as $q) {
        $response->assertSee($q->question);
    }

    foreach ($wrongQuestions as $question) {
        $response->assertDontSee($question->question);
    }
});
