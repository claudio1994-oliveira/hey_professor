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
