<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $query = Todo::query();
        $search = $request->input('search');
        $filter = $request->input('filter');
        if ($search) {
            $query->where('title', 'like', "%$search%");
        }
        if ($filter === 'completed') {
            $query->where('is_completed', true);
        } elseif ($filter === 'pending') {
            $query->where('is_completed', false);
        }
        $todos = $query->orderByDesc('created_at')->get();
        return view('todos.index', compact('todos', 'search', 'filter'));
    }

    public function create()
    {
        return view('todos.form', ['todo' => new Todo()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);
        Todo::create($validated);
        return redirect()->route('todos.index')->with('success', 'To-Do berhasil ditambahkan!');
    }

    public function edit(Todo $todo)
    {
        return view('todos.form', compact('todo'));
    }

    public function update(Request $request, Todo $todo)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);
        $todo->update($validated);
        return redirect()->route('todos.index')->with('success', 'To-Do berhasil diupdate!');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('todos.index')->with('success', 'To-Do berhasil dihapus!');
    }

    public function toggleStatus(Todo $todo)
    {
        $todo->is_completed = !$todo->is_completed;
        $todo->save();
        return redirect()->route('todos.index')->with('success', 'Status To-Do berhasil diubah!');
    }
}
