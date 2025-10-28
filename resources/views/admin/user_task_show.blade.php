<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ $user->name }}'s task details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            position: relative;
        }

        .show-task-container {
            max-width: 500px;
            margin: 60px auto;
            padding: 30px 30px 24px 30px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
            box-sizing: border-box;
        }

        h2 {
            text-align: center;
            margin-bottom: 28px;
        }

        .field-label {
            font-weight: 500;
            margin-bottom: 6px;
            display: block;
        }

        .field-value {
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
            background: #f8f9fa;
            margin-bottom: 18px;
            min-height: 38px;
            word-break: break-word;
        }

        .form-row {
            display: flex;
            gap: 16px;
        }

        .form-row > div {
            flex: 1;
        }

        .form-row:not(:first-child) {
            margin-top: 18px;
        }

        .action-btns {
            gap: 16px;
            display: flex;
        }

        .action-btns > * {
            flex: 1;
        }

        .action-btns form {
            width: 100%;
            display: flex;
            flex: 1;
        }

        .action-btns form .delete-btn {
            width: 100%;
        }

        .edit-btn,
        .delete-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 44px;
            font-size: 1.1em;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            font-family: inherit;
            font-weight: 500;
            transition: background 0.2s;
            box-sizing: border-box;
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

        #back-to-dashboard-btn {
            position: absolute;
            left: 0;
            top: 50px;
            margin-left: 500px;
            background: #007bff;
            color: white;
            height: 36px;
            padding: 0 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            line-height: 36px;
        }

        #back-to-dashboard-btn:hover {
            background: #0056b3;
        }

    </style>
</head>
<body>
<a href="{{ route('admin.user.tasksList', ['user' => $user->id]) }}" class="edit-btn" id="back-to-dashboard-btn">
    {{ $user->name }}'s dashboard
</a>
<div class="show-task-container">
    <h2>{{ $user->name }}'s task details</h2>
    <div>
        <label class="field-label">Title</label>
        <div class="field-value">
            {{ $task->title ?? '' }}
        </div>
    </div>
    <div>
        <label class="field-label">Description</label>
        <div class="field-value" style="min-height:70px;">
            {!! nl2br(e($task->description ?? '')) !!}
        </div>
    </div>
    <div class="form-row">
        <div>
            <label class="field-label">Start date</label>
            <div class="field-value">
                {{ $task->start_date ? \Carbon\Carbon::parse($task->start_date)->format('d.m.Y') : '-' }}
            </div>
        </div>
        <div>
            <label class="field-label">Finish date</label>
            <div class="field-value">
                {{ $task->finish_date ? \Carbon\Carbon::parse($task->finish_date)->format('d.m.Y') : '-' }}
            </div>
        </div>
    </div>
    <div class="form-row action-btns">
        <a href="{{ route('admin.task.edit', ['user' => $user->id, 'slug' => $task->slug]) }}" class="edit-btn">Edit</a>
        <form method="POST" action="{{ route('admin.task.destroy', ['user' => $user->id, 'slug' => $task->slug]) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-btn" onclick="return confirm('Delete task?')">Delete</button>
        </form>
    </div>
</div>
</body>
</html>

