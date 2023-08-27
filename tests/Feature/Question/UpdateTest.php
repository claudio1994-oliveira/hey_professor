<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, put};

it('should update the question in the database', function () {
    $user = User::factory()->create();
    actingAs($user);

    $question = Question::factory()->create(['draft' => true, 'created_by' => $user->id]);

    put(route('question.update', $question), [
        'question' => 'Updated Question?',
    ])->assertRedirect();

    $question->refresh();

    expect($question)->question->toBe('Updated Question?');
});

it('should make sure that only question with status DRAFT can be updated', function () {
    $user = User::factory()->create();
    actingAs($user);
    $questionNotDraft = Question::factory()->create(['draft' => false, 'created_by' => $user->id]);
    $draftQuestion    = Question::factory()->create(['draft' => true, 'created_by' => $user->id]);

    put(route('question.update', $questionNotDraft))
        ->assertForbidden();
    put(route('question.update', $draftQuestion))->assertRedirect();
});

it('should make sure that only the person who has created the question can update the question', function () {
    $rightUser = User::factory()->create();
    $wrongUser = User::factory()->create();

    $question = Question::factory()->create(['draft' => true, 'created_by' => $rightUser->id]);
    actingAs($wrongUser);

    put(route('question.update', $question))
        ->assertForbidden();

    actingAs($rightUser);

    put(route('question.update', $question))->assertRedirect();
});
