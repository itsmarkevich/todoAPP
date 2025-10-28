<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Task edit (admin)</title>
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
            padding: 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
            background: #f8f9fa;
            margin-bottom: 18px;
            min-height: 38px;
            word-break: break-word;
        }

        .field-value input[type="text"],
        .field-value input[type="date"],
        .field-value textarea {
            width: 100%;
            border: none;
            background: transparent;
            font-size: 1em;
            padding: 8px 12px;
            box-sizing: border-box;
            resize: none;
            outline: none;
            font-family: inherit;
        }

        .field-value[style], .field-value textarea {
            min-height: 110px !important;
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
            margin-top: 24px;
            width: 100%;
        }

        .action-btns > * {
            flex: 1;
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
            background: #28a745;
            color: #fff;
        }

        .edit-btn:hover {
            background: #218838;
        }

        .delete-btn {
            background: #dc3545;
            color: #fff;
        }

        .delete-btn:hover {
            background: #b52a37;
        }

        #cancel-btn {
            position: absolute;
            left: 0;
            top: 50px;
            margin-left: 550px;
            background: #6c757d;
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

        #cancel-btn:hover {
            background: #495057;
        }

        .action-btns > button.action-btn,
        .action-btns > form > button.action-btn {
            width: 100%;
            min-width: 0;
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

        .action-btns > form {
            width: 100%;
            display: flex;
            flex: 1;
            padding: 0;
            margin: 0;
        }

        .action-btns > button.edit-btn {
            max-width: calc(50% - 8px);
        }

    </style>
</head>
<body>
<a href="{{ route('admin.task.show', ['user' => $user->id, 'slug' => $task->slug]) }}" class="edit-btn" id="cancel-btn">
    Cancel
</a>
<div class="show-task-container">
    <form id="edit-form" method="POST"
          action="{{ route('admin.task.update', ['user' => $user->id, 'slug' => $task->slug]) }}"
          style="margin:0; padding:0;">
        @csrf
        @method('PATCH')
        <h2>{{ $user->name }}'s task edit</h2>
        <div>
            <label class="field-label">Title</label>
            <div class="field-value">
                <input type="text" id="title" name="title" value="{{ old('title', $task->title) }}" required>
            </div>
        </div>
        <div>
            <label class="field-label">Description</label>
            <div class="field-value" style="min-height:70px;">
                <textarea id="description" name="description"
                          required>{{ old('description', $task->description) }}</textarea>
            </div>
        </div>
        <div class="form-row">
            <div>
                <label class="field-label">Start date</label>
                <div class="field-value">
                    <input type="date" id="start_date" name="start_date"
                           value="{{ old('start_date', $task->start_date ? \Carbon\Carbon::parse($task->start_date)->format('Y-m-d') : '') }}">
                </div>
            </div>
            <div>
                <label class="field-label">Finish date</label>
                <div class="field-value">
                    <input type="date" id="finish_date" name="finish_date"
                           value="{{ old('finish_date', $task->finish_date ? \Carbon\Carbon::parse($task->finish_date)->format('Y-m-d') : '') }}">
                </div>
            </div>
        </div>
    </form>
    <div class="action-btns">
        <button type="submit" class="edit-btn action-btn" form="edit-form">Save</button>
        <form method="POST" action="{{ route('admin.task.destroy', ['user' => $user->id, 'slug' => $task->slug]) }}"
              style="margin:0; padding:0;">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-btn action-btn" onclick="return confirm('Delete task?')">Delete</button>
        </form>
    </div>
</div>
</body>
</html>

