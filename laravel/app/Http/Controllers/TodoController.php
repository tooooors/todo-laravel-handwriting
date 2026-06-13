<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Todo;

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
}
