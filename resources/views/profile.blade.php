<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Профиль</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .profile-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .profile-rows {
            width: 100%;
        }

        .profile-row {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .label {
            width: 100px;
        }

        .edit-btn, a.edit-btn {
            margin-left: 20px;
            background: #007bff;
            color: white;
            padding: 6px 14px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            line-height: normal;
        }

        .edit-btn:hover, a.edit-btn:hover {
            background: #0056b3;
        }

        .cancel-btn {
            background: #6c757d !important;
        }

        .logout-btn {
            background: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 20px auto 0;
            display: block;
        }

        .logout-btn:hover {
            background: #0056b3;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative; /* Добавьте это */
        }

        .profile-header {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            margin-bottom: 30px;
            min-height: 48px; /* высота кнопки + отступы */
        }

        #back-to-dashboard-btn {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translate(-100%, -50%);
            margin: 0;
        }

        .profile-container h2 {
            margin: 0;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="profile-container">
    <div class="profile-header">
        <a href="/dashboard" class="edit-btn" id="back-to-dashboard-btn">
            Back to dashboard
        </a>
        <h2>My Profile</h2>
    </div>
    @if(session('success'))
        <div style="color: green; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif
    <div class="profile-rows">
        <div class="profile-row">
            <span class="label">Name:</span>
            @if(request('edit') === 'name')
                <form method="POST" action="{{ route('profile.update.name') }}"
                      style="display: flex; align-items: center;">
                    @csrf
                    @method('PATCH')
                    <input type="text" name="name" value="{{ $user->name }}" required>
                    <button type="submit" class="edit-btn" style="margin-left: 10px;">Save</button>
                    <a href="{{ route('profile') }}" class="edit-btn cancel-btn" style="margin-left: 10px;">Cancel</a>
                </form>
            @else
                <span>{{ $user->name }}</span>
                <a href="{{ route('profile', ['edit' => 'name']) }}" class="edit-btn"
                   style="margin-left: 10px;">Edit</a>
            @endif
        </div>
        <div class="profile-row">
            <span class="label">Email:</span>
            @if(request('edit') === 'email')
                <form method="POST" action="{{ route('profile.update.email') }}"
                      style="display: flex; align-items: center;">
                    @csrf
                    @method('PATCH')
                    <input type="text" name="email" value="{{ $user->email }}" required>
                    <button type="submit" class="edit-btn" style="margin-left: 10px;">Save</button>
                    <a href="{{ route('profile') }}" class="edit-btn cancel-btn" style="margin-left: 10px;">Cancel</a>
                </form>
            @else
                <span>{{ $user->email }}</span>
                <a href="{{ route('profile', ['edit' => 'email']) }}" class="edit-btn"
                   style="margin-left: 10px;">Edit</a>
            @endif
        </div>
        <div class="profile-row">
            <span class="label">Password:</span>
            @if(request('edit') === 'password')
                <form method="POST" action="{{ route('profile.update.password') }}"
                      style="display: flex; align-items: center;">
                    @csrf
                    @method('PATCH')
                    <input type="password" name="old_password" placeholder="current password" required>
                    <input type="password" name="password" placeholder="new password" required>
                    <input type="password" name="password_confirmation" placeholder="confirmation new password"
                           required>
                    <button type="submit" class="edit-btn" style="margin-left: 10px;">Save</button>
                    <a href="{{ route('profile') }}" class="edit-btn cancel-btn" style="margin-left: 10px;">Cancel</a>
                </form>
            @else
                <span> ********** </span>
                <a href="{{ route('profile', ['edit' => 'password']) }}" class="edit-btn" style="margin-left: 10px;">Edit</a>
            @endif
        </div>
    </div>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="logout-btn" type="submit">Logout</button>
    </form>
    <form method="POST" action="{{ route('profile.destroy') }}" style="margin-top:10px;">
        @csrf
        @method('DELETE')
        <button class="logout-btn" style="background:#dc3545;" type="submit"
                onclick="return confirm('Are you sure you want to delete your account?')">
            Destroy account
        </button>
    </form>
</div>
</body>
</html>
