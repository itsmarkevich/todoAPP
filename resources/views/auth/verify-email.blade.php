<!-- resources/views/auth/verify-email.blade.php -->
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Подтвердите email</title>
</head>
<body>
<h1>Пожалуйста, подтвердите ваш email</h1>
<p>На вашу почту отправлено письмо с ссылкой для подтверждения. Перейдите по ней, чтобы продолжить.</p>
@if (session('message'))
    <p style="color: green;">{{ session('message') }}</p>
@endif
<form method="POST" action="{{ route('verification.send') }}">
    @csrf
    <button type="submit">Отправить письмо повторно</button>
</form>
</body>
</html>

