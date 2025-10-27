<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\tasks\TaskCreateRequest;
use App\Http\Requests\tasks\TaskUpdateRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = User::query()->with('tasks');
        if ($search = $request->input('search')) {
            $query->search($search);
        }
        $users = $query->get();
        return view('admin.users', compact('users', 'search'));
    }

    public function userTasksList(int $userId, Request $request): View
    {
        $user = User::query()->findOrFail($userId);
        $query = $user->tasks();
        if ($search = $request->input('search')) {
            $query->findtask($search);
        }
        $tasks = $query->get();
        return view('admin.user_tasks_list', compact('user', 'tasks', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($userId): View
    {
        $user = User::query()->findOrFail($userId);
        return view('admin.user_task_create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($userId, TaskCreateRequest $request): RedirectResponse
    {
        $user = User::query()->findOrFail($userId);
        $data = $request->all();
        $data['user_id'] = $userId;
        Task::create($data);
        return redirect()->route('admin.user.tasksList', ['user' => $userId]);
    }

    /**
     * Display the specified resource.
     */
    public function show($userId, string $slug): View
    {
        $task = Task::query()
            ->byUserAndSlug($userId, $slug)
            ->firstOrFail();
        $user = User::query()->findOrFail($userId);
        return view('admin.user_task_show', compact('task', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($userId, string $slug): View
    {
        $task = Task::query()
            ->byUserAndSlug($userId, $slug)
            ->firstOrFail();
        $user = User::query()->findOrFail($userId);
        return view('admin.user_task_edit', compact('task', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskUpdateRequest $request, $userId, string $slug): RedirectResponse
    {
        $task = Task::query()
            ->byUserAndSlug($userId, $slug)
            ->firstOrFail();
        $task->update($request->validated());
        return redirect()->route('admin.user.tasksList', ['user' => $userId]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($userId, string $slug)
    {
        $task = Task::query()
            ->byUserAndSlug($userId, $slug)
            ->firstOrFail();
        $user = User::query()->findOrFail($userId);
        $task->delete();
        return redirect()->route('admin.user.tasksList', ['user' => $userId]);
    }
}
