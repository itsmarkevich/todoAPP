<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .welcome-container {
            max-width: 600px;
            margin: 100px auto 0;
            padding: 40px 30px 30px 30px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
            position: relative;
        }

        .auth-buttons {
            position: absolute;
            top: 30px;
            right: 30px;
            display: flex;
            gap: 12px;
        }

        .auth-btn {
            background: #007bff;
            color: #fff;
            padding: 8px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 1em;
            transition: background 0.2s;
        }

        .auth-btn:hover {
            background: #0056b3;
        }

        .welcome-title {
            text-align: center;
            font-size: 2em;
            margin-top: 60px;
            margin-bottom: 0;
            color: #222;
        }

    </style>
</head>
<body>
<div class="welcome-container">
    <div class="auth-buttons">
        <a href="{{ route('register') }}" class="auth-btn">Registration</a>
        <a href="{{ route('login') }}" class="auth-btn">Login</a>
    </div>
    <h1 class="welcome-title">Welcome to the ToDo App</h1>
</div>
</body>
</html>
