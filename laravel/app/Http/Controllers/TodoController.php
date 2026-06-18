<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Todo;
use App\Enums\TodoStatus;
use App\Http\Requests\StoreTodoRequest;

class TodoController extends Controller
{
    /**
     * todo一覧を表示
     */
    public function index(): View
    {
        $todos = Todo::all();
        return view('todos.index', [
            'todos' => $todos
        ]);
    }

    /**
     * todo登録
     */
    public function store(StoreTodoRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $todo = new Todo([
            'title' => $validated['title'],
            'status' => TodoStatus::Pending, 
        ]);
        $todo->save();

        return back();
    }
}
