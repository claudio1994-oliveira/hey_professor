<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseHas, get, post, put};

it('should be able to like a question', function () {

    $user = User::factory()->create();
    actingAs($user);
    $question = Question::factory()->create();

    post(route('question.like', $question))->assertRedirect();

    assertDatabaseHas('votes', [
        'question_id' => 1,
        'like'        => 1,
        'unlike'      => 0,
        'user_id'     => $user->id,
    ]);
});