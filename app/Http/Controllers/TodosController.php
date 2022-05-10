<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodosController extends Controller
{
  public function getTodo(int $id)
  {
    $todo = Todo::findOrFail($id);

    // if (!$todo) return response()->json(['error' => 'not found'], 404);

    return response()->json($todo);
  }

  public function postTodo(Request $request)
  {
    $this->validate($request, [
      'title' => 'required',
      'description' => 'required'
    ]);

    $model = Todo::create($request->only(['title', 'description']));

    return response()->json(['something'], 201);
  }

  public function deleteTodo(int $id)
  {
    $todo = Todo::find($id);

    if (!$todo) return response()->json(['error' => 'id not found in database'], 404);

    $todo->delete();

    return response()->json([], 204);
  }

  public function putTodoStatus(Request $request, int $id)
  {
    $todo = Todo::findOrFail($id);

    $todo->toggle()->save();

    return response()->json($todo, 200);
  }
}
