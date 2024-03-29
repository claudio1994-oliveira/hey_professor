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

it('should not be able to like more than 1 time', function () {

    $user = User::factory()->create();
    actingAs($user);
    $question = Question::factory()->create();

    post(route('question.like', $question));
    post(route('question.like', $question));
    post(route('question.like', $question));
    post(route('question.like', $question));

    expect($user->votes()->where('question_id', $question->id)->get())->toHaveCount(1);
});

it('should be able to unlike a question', function () {

    $user = User::factory()->create();
    actingAs($user);
    $question = Question::factory()->create();

    post(route('question.unlike', $question))->assertRedirect();

    assertDatabaseHas('votes', [
        'question_id' => 1,
        'like'        => 0,
        'unlike'      => 1,
        'user_id'     => $user->id,
    ]);
});

it('should not be able to unlike more than 1 time', function () {

    $user = User::factory()->create();
    actingAs($user);
    $question = Question::factory()->create();

    post(route('question.unlike', $question));
    post(route('question.unlike', $question));
    post(route('question.unlike', $question));
    post(route('question.unlike', $question));

    expect($user->votes()->where('question_id', $question->id)->get())->toHaveCount(1);
});
