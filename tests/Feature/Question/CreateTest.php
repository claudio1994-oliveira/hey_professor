<?php

use App\Models\User;

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, post};

it('shoul be able to create a new question bigger than 255 characters', function () {

    $user = User::factory()->create();
    actingAs($user);

    $request = post(route('question.store'), [
        'question' => str_repeat('*', 260) . '?',
    ]);

    $request->assertRedirect();
    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', ['question' => str_repeat('*', 260) . '?']);
});

it('shoul create as a draft all the time', function () {

    $user = User::factory()->create();
    actingAs($user);

    $request = post(route('question.store'), [
        'question' => str_repeat('*', 260) . '?',
    ]);

    assertDatabaseHas('questions', [
        'question' => str_repeat('*', 260) . '?',
        'draft'    => true,
    ]);
});

it('should check if with question mark ?', function () {
    $user = User::factory()->create();
    actingAs($user);

    $request = post(route('question.store'), [
        'question' => str_repeat('*', 10),
    ]);

    $request->assertSessionHasErrors(['question' => 'Are you sure tha is a question? It is missing te question mark in the end.']);
    assertDatabaseCount('questions', 0);
});

it('should have least 10 characters', function () {
    $user = User::factory()->create();
    actingAs($user);

    $request = post(route('question.store'), [
        'question' => str_repeat('*', 8) . '?',
    ]);

    $request->assertSessionHasErrors(['question' => __('validation.min.string', ['min' => 10, 'attribute' => 'question'])]);
    assertDatabaseCount('questions', 0);
});

test('only authenticated users can create a new question', function () {
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 10) . '?',
    ]);

    $request->assertRedirect(route('login'));
});

test('question should be unique', function () {
    $user = User::factory()->create();
    actingAs($user);

    $request = post(route('question.store'), [
        'question' => 'Pergunta já existe?',
    ]);

    $request->assertRedirect();
    assertDatabaseCount('questions', 1);

    $request = post(route('question.store'), [
        'question' => 'Pergunta já existe?',
    ]);

    $request->assertSessionHasErrors(['question' => "The Question Already Exists"]);
    assertDatabaseCount('questions', 1);
});
