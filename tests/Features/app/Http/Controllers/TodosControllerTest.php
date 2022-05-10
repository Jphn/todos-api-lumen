<?php

namespace Features\app\Http\Controllers;

use App\Models\Todo;
use Carbon\Carbon;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Tests\TestCase;

class TodoControllerTest extends TestCase
{

  use DatabaseMigrations;

  public function testUserCanCreateATodo()
  {
    // Prepare
    $payload = [
      'title' => 'Tirar o lixo',
      'description' => 'Lembrar de tirar o lixo para fora.'
    ];

    // Act
    $result = $this->post('/todos', $payload);

    // Assert
    $result->assertResponseStatus(201); // Created

    $result->seeInDatabase('todos', $payload);
  }

  public function testUserShouldSendTitleAndDescription()
  {
    // Prepare
    $payload = [
      'some' => 'content'
    ];

    // Act
    $response = $this->post('/todos', $payload);

    // Assert
    $this->assertResponseStatus(422); // Unprocessable Entity
  }

  public function testUserCanRetrieveASpecificTodo()
  {
    //Prepare
    $todo = Todo::factory()->create();

    // Act
    $uri = '/todos/' . $todo->id;
    $response = $this->get($uri);

    // Assert
    $response->assertResponseOk();
    $response->seeJsonContains(['title' => $todo->title]);
  }

  public function testUserShouldReceive404WhenSearchSomethingThatDoesNotExists()
  {
    //Prepare

    // Act
    $response = $this->get('/todos/1');

    // Assert
    $response->assertResponseStatus(404);
  }

  public function testUserCanDeleteATodo()
  {
    // Prepare
    $todo = Todo::factory()->create();

    // Act
    $uri = '/todos/' . $todo->id;
    $response = $this->delete($uri);

    // Assert
    $response->assertResponseStatus(204); // No Content
    $response->notSeeInDatabase('todos', [
      'id' => $todo->id
    ]);
  }

  public function testUserCanNotDeleteATodoThatDoesNotExistsInsideTheDatabase()
  {
    // Prepare
    $todo = Todo::factory()->create();

    // Act
    $uri = '/todos/' . ($todo->id + 1);
    $response = $this->delete($uri);

    // Assert
    $response->assertResponseStatus(404);
    $response->notSeeInDatabase('todos', [
      'id' => ($todo->id + 1)
    ]);
  }

  public function testUserCanSetTodoDone()
  {
    // Prepare
    $todo = Todo::factory()->create();

    // Act
    $uri = '/todos/' . $todo->id . '/status';
    $response = $this->put($uri);

    // Assert
    $response->assertResponseOk();
    $this->seeInDatabase('todos', [
      'id' => $todo->id,
      'done' => true,
    ]);
    $this->missingFromDatabase('todos', [
      'id' => $todo->id,
      'done_at' => null
    ]);
  }

  public function testUserCanSetTodoToUndone()
  {
    // Prepare
    $todo = Todo::factory()->create(['done' => true, 'done_at' => Carbon::now()]);

    // Act
    $uri = '/todos/' . $todo->id . '/status';
    $response = $this->put($uri);

    // Assert
    $response->assertResponseOk();
    $response->seeInDatabase('todos', [
      'id' => $todo->id,
      'done' => false,
      'done_at' => null
    ]);
  }

  public function testUserShoulReceive404WhenTryingToChangeStatusOfATodoThatDoesNotExists()
  {
    // Prepare
    // Act
    $response = $this->put('/todos/1/status');

    // Assert
    $response->assertResponseStatus(404);
  }
}
