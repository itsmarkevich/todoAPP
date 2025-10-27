<?php

namespace App\Http\Controllers;

use App\Http\Requests\tasks\TaskCreateRequest;
use App\Http\Requests\tasks\TaskUpdateRequest;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = auth()->user()->tasks();
        if ($search = $request->input('search')) {
            $query->findtask($search);
        }
        $tasks = $query->get();
        return view('dashboard', compact('tasks', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskCreateRequest $request): RedirectResponse
    {
        $data = $request->all();
        $data['user_id'] = auth()->id();
        Task::create($data);
        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug): View
    {
        $task = auth()->user()->tasks()->taskBySlug($slug)->firstOrFail();
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug): View
    {
        $task = auth()->user()->tasks()->taskBySlug($slug)->firstOrFail();
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskUpdateRequest $request, string $slug): RedirectResponse
    {
        $task = auth()->user()->tasks()->taskBySlug($slug)->firstOrFail();
        $task->update($request->all());
        return redirect()->route('tasks.show', $task->slug);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $task = auth()->user()->tasks()->taskBySlug($slug)->firstOrFail();
        $task->delete();
        return redirect()->route('dashboard');
    }
}
