<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ $user->name }}'s dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .dashboard-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            position: relative;
        }
        .profile-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .profile-btn:hover {
            background: #0056b3;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 10px;
        }
        .actions > div {
            display: flex;
            gap: 10px;
        }
        .search-form {
            display: flex;
            align-items: center;
        }
        .search-input {
            padding: 6px 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-left: 10px;
        }
        .create-btn {
            background: #28a745;
            color: #fff;
            padding: 8px 18px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .create-btn:hover {
            background: #218838;
        }
        .task-list {
            margin-top: 20px;
        }
        .task-item {
            border-bottom: 1px solid #eee;
            padding: 10px 0;
        }
        .task-row {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .task-name {
            flex: 1;
            text-align: left;
            display: block;
            text-decoration: none;
            color: inherit;
        }
        .task-actions button {
            margin-left: 10px;
            padding: 5px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
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
            margin-top: 10px;
            color: #555;
            font-size: 0.95em;
            background: #f8f9fa;
            border-radius: 4px;
            padding: 10px 15px;
        }
        .task-item.open .task-desc-block {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            max-height: 4.5em;
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
        .edit-btn, a.edit-btn, .delete-btn {
            padding: 5px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-left: 10px;
            font-size: 1em;
            line-height: 1.2;
        }
    </style>
</head>
<body>
<div class="dashboard-container">
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 30px;">
        <a href="{{ route('admin.users.list') }}" class="profile-btn" style="position: static; margin-right: 20px;">
            Back to Users List
        </a>
        <h2 style="flex: 1; text-align: center; margin-bottom: 0;">{{ $user->name }}'s dashboard</h2>
        <a href="{{ route('profile') }}" class="profile-btn" id="profile-btn" style="position: static;">
            My Profile
        </a>
    </div>
    <div class="actions">
        <div>
            <a href="{{ route('admin.task.create',  ['user' => $user->id]) }}" class="create-btn">Create</a>
            <a href="{{ route('admin.user.profile', ['user' => $user->id]) }}" class="create-btn">View Profile</a>
        </div>
        <form class="search-form" method="GET" action="">
            <input type="text" name="search" class="search-input" placeholder="Search by name..." value="{{ $search ?? '' }}">
            <button type="submit" class="create-btn" style="margin-left: 8px;">Search</button>
        </form>
    </div>
    <div class="task-list">
        @foreach(($tasks ?? []) as $task)
            <div class="task-item" id="task-{{ $task->id }}">
                <div class="task-row">
                    <button class="toggle-btn" onclick="toggleTask({{ $task->id }})" type="button" style="margin-right: 10px;">▶</button>
                    <a href="{{ route('admin.task.show', ['user' => $user->id, 'slug' => $task->slug]) }}" class="task-name">
                        <strong>{{ $task->title }}</strong>
                        <span style="margin-left: 20px; color: #888; font-size: 0.95em;">
                            Start: {{ $task->start_date ? \Carbon\Carbon::parse($task->start_date)->format('d.m.Y') : '-' }} |
                            Finish: {{ $task->finish_date ? \Carbon\Carbon::parse($task->finish_date)->format('d.m.Y') : '-' }}
                        </span>
                    </a>
                    <div class="task-actions">
                        <form method="POST" action="{{ route('admin.task.destroy', ['user' => $user->id, 'slug' => $task->slug]) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn" onclick="return confirm('Delete task?')">Delete</button>
                        </form>
                    </div>
                </div>
                <div class="task-desc-block">
                    {!! nl2br(e(\Illuminate\Support\Str::limit($task->description ?? 'No description', 120, '...'))) !!}
                </div>
            </div>
        @endforeach
    </div>
</div>
<script>
    function toggleTask(id) {
        const el = document.getElementById('task-' + id);
        el.classList.toggle('open');
    }
</script>
</body>
</html>
