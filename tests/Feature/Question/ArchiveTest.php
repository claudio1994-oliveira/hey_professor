<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertSoftDeleted, delete, patch};

it('should be able to arcuive a question', function () {
    $user = User::factory()->create();
    actingAs($user);
    $question = Question::factory()->create(['draft' => true, 'created_by' => $user->id]);

    patch(route('question.archive', $question))
        ->assertRedirect();

    assertSoftDeleted('questions', ['id' => $question->id]);

    expect($question)
        ->refresh()
        ->deleted_at->not()->toBeNull();
});

it('should make sure the only the person who has created the question can archive the question', function () {
    $rightUser = User::factory()->create();
    $wrongUser = User::factory()->create();

    $question = Question::factory()->create(['draft' => true, 'created_by' => $rightUser->id]);
    actingAs($wrongUser);

    patch(route('question.archive', $question))
        ->assertForbidden();

    actingAs($rightUser);

    patch(route('question.archive', $question))->assertRedirect();
});
