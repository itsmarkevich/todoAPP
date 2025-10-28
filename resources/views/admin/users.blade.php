<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Admin — Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .admin-container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .profile-btn:hover {
            background: #0056b3;
        }

        .create-btn {
            background: #28a745;
            color: #fff;
            padding: 8px 18px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .create-btn:hover {
            background: #218838;
        }

        .search-input {
            padding: 6px 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-left: 10px;
        }

        .user-list {
            margin-top: 20px;
        }

        .user-item {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
        }

        .user-row {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-name {
            flex: 1;
            text-align: left;
            font-weight: bold;
            text-decoration: none;
            color: #222;
        }

        .toggle-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.2em;
            color: #007bff;
            padding: 0 5px;
        }

        .toggle-btn:focus {
            outline: none;
        }

        .task-list {
            margin-top: 10px;
            margin-left: 30px;
        }

        .task-item {
            border-bottom: 1px solid #f3f3f3;
            padding: 8px 0;
        }

        .task-row {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .task-name {
            flex: 1;
        }

        .task-actions button,
        .task-actions a {
            margin-left: 10px;
            padding: 5px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
        }

        .edit-btn {
            background: #ffc107;
            color: #222;
        }

        .edit-btn:hover {
            background: #e0a800;
        }

        .delete-btn {
            background: #dc3545;
            color: #fff;
        }

        .delete-btn:hover {
            background: #b52a37;
        }

        .task-desc-block {
            display: none;
            margin-top: 5px;
            color: #555;
            font-size: 0.95em;
            background: #f8f9fa;
            border-radius: 4px;
            padding: 8px 12px;
        }

        .task-item.open .task-desc-block {
            display: block;
        }

    </style>
</head>
<body>
<div class="admin-container" style="position: relative;">
    <a href="{{ route('profile') }}" class="profile-btn" id="profile-btn"
       style="position: absolute; top: 25px; right: 20px;">
        My Profile
    </a>
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 30px;">
        <a href="{{ route('dashboard') }}" class="profile-btn" style="position: static; margin-right: 20px;">
            Back to Dashboard
        </a>
        <h2 style="flex: 1; text-align: center; margin-bottom: 0;">Users list</h2>
        <div style="width: 160px;"></div>
    </div>
    <div class="actions"
         style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; gap: 10px;">
        <div style="display: flex; gap: 10px;">
        </div>
        <form class="search-form" method="GET" action="{{ route('admin.users.list') }}"
              style="display: flex; align-items: center;">
            <input type="text" name="search" class="search-input" placeholder="Search..."
                   value="{{ $search ?? '' }}">
            <button type="submit" class="create-btn" style="margin-left: 8px;">Search</button>
        </form>
    </div>
    <div class="user-list">
        @foreach($users as $user)
            <div class="user-item" id="user-{{ $user->id }}">
                <div class="user-row">
                    <button class="toggle-btn" onclick="toggleUserTasks({{ $user->id }})" type="button">▶</button>
                    <a href="{{ route('admin.user.tasksList', $user->id) }}" class="user-name">{{ $user->name }}</a>
                    <span style="color: #888;">{{ $user->email }}</span>
                </div>
                <div class="task-list" id="tasks-{{ $user->id }}" style="display: none;">
                    @forelse($user->tasks as $task)
                        <div class="task-item" id="task-{{ $user->id }}-{{ $task->id }}">
                            <div class="task-row">
                                <button class="toggle-btn"
                                        onclick="toggleTaskDesc({{ $user->id }}, {{ $task->id }})"
                                        type="button">▶
                                </button>
                                <span class="task-name"><strong>{{ $task->title }}</strong></span>
                                <div class="task-actions">
                                    <a href="{{ route('admin.task.edit', [$user->id, $task->id]) }}"
                                       class="edit-btn">Edit</a>
                                    <form method="POST"
                                          action="{{ route('admin.task.destroy', [$user->id, $task->id]) }}"
                                          style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn"
                                                onclick="return confirm('Delete task?')">Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="task-desc-block" id="desc-{{ $user->id }}-{{ $task->id }}">
                                {!! nl2br(e(\Illuminate\Support\Str::limit($task->description ?? 'No desription\'s', 120, '...'))) !!}
                            </div>
                        </div>
                    @empty
                        <div style="color: #888; margin-left: 10px;">No tasks</div>
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>
</div>
<script>
    function toggleUserTasks(userId) {
        const el = document.getElementById('tasks-' + userId);
        el.style.display = el.style.display === 'none' ? 'block' : 'none';
    }

    function toggleTaskDesc(userId, taskId) {
        const el = document.getElementById('task-' + userId + '-' + taskId);
        el.classList.toggle('open');
    }
</script>
</body>
</html>
