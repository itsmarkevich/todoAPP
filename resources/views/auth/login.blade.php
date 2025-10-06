<!DOCTYPE html>
<html>
<head>
    <title>Login Test</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 400px; margin: 50px auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input[type="email"], input[type="password"] { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        button { background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .errors { color: red; margin-bottom: 15px; }
    </style>
</head>
<body>
<h2>Test Login Form</h2>

{{-- Показ ошибок --}}
@if ($errors->any())
    <div class="errors">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form method="POST" action="{{ route('auth.login') }}">
    @csrf
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
    </div>

    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </div>

    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <!-- И рядом добавь для проверки -->
    <div style="display: none;">
        CSRF Token: {{ csrf_token() }}
    </div>

    <button type="submit">Login</button>
</form>
</body>
</html>
