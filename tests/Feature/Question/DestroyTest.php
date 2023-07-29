<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseMissing, delete};

it('should be able to delete a question', function () {
    $user = User::factory()->create();
    actingAs($user);
    $question = Question::factory()->create(['draft' => true, 'created_by' => $user->id]);

    delete(route('question.destroy', $question))
        ->assertRedirect();

    assertDatabaseMissing('questions', ['id' => $question->id]);
});

it('should make sure the only the person who has created the question can destroy the question', function () {
    $rightUser = User::factory()->create();
    $wrongUser = User::factory()->create();

    $question = Question::factory()->create(['draft' => true, 'created_by' => $rightUser->id]);
    actingAs($wrongUser);

    delete(route('question.destroy', $question))
        ->assertForbidden();

    actingAs($rightUser);

    delete(route('question.destroy', $question))->assertRedirect();
});
