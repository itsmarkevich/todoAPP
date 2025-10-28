<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Create Task (Admin)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .create-task-container {
            max-width: 500px;
            margin: 60px auto;
            padding: 30px 30px 24px 30px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
        }

        h2 {
            text-align: center;
            margin-bottom: 28px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        label {
            font-weight: 500;
            margin-bottom: 6px;
        }

        input[type="text"],
        textarea,
        input[type="date"] {
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
            width: 100%;
            box-sizing: border-box;
        }

        textarea {
            min-height: 70px;
            resize: vertical;
        }

        .form-row {
            display: flex;
            gap: 16px;
        }

        .form-row > div {
            flex: 1;
        }

        .button-row {
            display: flex;
            gap: 16px;
            margin-top: 10px;
        }

        .submit-btn {
            background: #28a745;
            color: #fff;
            padding: 10px 0;
            border: none;
            border-radius: 4px;
            font-size: 1.1em;
            cursor: pointer;
            flex: 1;
        }

        .submit-btn:hover {
            background: #218838;
        }

        .cancel-btn {
            background: #dc3545;
            color: #fff;
            padding: 10px 0;
            border: none;
            border-radius: 4px;
            font-size: 1.1em;
            cursor: pointer;
            flex: 1;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }

        .cancel-btn:hover {
            background: #b52a37;
        }

    </style>
</head>
<body>
<div class="create-task-container">
    <h2>Create new task for {{ $user->name }}</h2>
    <form method="POST" action="{{ route('admin.task.store', ['user' => $user->id]) }}">
        @csrf
        <div>
            <label for="title">Title</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div>
            <label for="description">Description</label>
            <textarea id="description" name="description"></textarea>
        </div>
        <div class="form-row">
            <div>
                <label for="start_date">Start date</label>
                <input type="date" id="start_date" name="start_date">
            </div>
            <div>
                <label for="finish_date">Finish date</label>
                <input type="date" id="finish_date" name="finish_date">
            </div>
        </div>
        <div class="button-row">
            <button type="submit" class="submit-btn">Create</button>
            <a href="{{ route('admin.user.tasksList', ['user' => $user->id]) }}" class="cancel-btn">Cancel</a>
        </div>
    </form>
</div>
</body>
</html>
