<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Confirm the email</title>
</head>
<body>
<h1>Please, confirm your email</h1>
<p>An email has been sent to your email with a confirmation link. Click on it to continue.</p>
@if (session('message'))
    <p style="color: green;">{{ session('message') }}</p>
@endif
<form method="POST" action="{{ route('verification.send') }}">
    @csrf
    <button type="submit">Resend the email</button>
</form>
</body>
</html>

