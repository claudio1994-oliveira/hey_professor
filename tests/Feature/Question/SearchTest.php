<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('should be able to search a question by text', function () {

    $user = User::factory()->create();
    actingAs($user);
    $wrongQuestions = Question::factory(5)->create(['draft' => false]);
    $question       = Question::factory()->create(['question' => 'is a question about Laravel?']);

    $response = get(route('dashboard', ['search' => 'question']));

    foreach ($wrongQuestions as $q) {
        $response->assertDontSee($q->question);
    }

    $response->assertSee('is a question about Laravel?');
});
