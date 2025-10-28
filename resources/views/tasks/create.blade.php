<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Create Task</title>
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

        .submit-btn {
            background: #28a745;
            color: #fff;
            padding: 10px 0;
            border: none;
            border-radius: 4px;
            font-size: 1.1em;
            cursor: pointer;
            margin-top: 10px;
        }

        .submit-btn:hover {
            background: #218838;
        }

    </style>
</head>
<body>
<div class="create-task-container">
    <h2>Create new task</h2>
    <form method="POST" action="{{ route('tasks.store') }}">
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
        <button type="submit" class="submit-btn">Create</button>
    </form>
</div>
</body>
</html>
