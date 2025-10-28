<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ $user->name }}'s profile</title>
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
            position: relative;
        }

        .profile-header {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            margin-bottom: 30px;
            min-height: 48px;
        }

        #back-to-dashboard-btn {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translate(-100%, -50%);
            margin: 0;
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

        button, button.edit-btn, button.logout-btn {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            font-family: Arial, sans-serif !important;
            font-weight: 400 !important;
            font-size: inherit !important;
            line-height: normal !important;
        }

        /* css */
        .destroy-btn {
            background: #dc3545 !important;
            color: white !important;
            padding: 10px 20px !important;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 0;
            display: block;
            min-width: 160px;
            font-family: Arial, sans-serif;
            font-size: 1rem;
            font-weight: 400;
            line-height: normal;
            transition: background 0.2s;
        }

        .destroy-btn:hover {
            background: #b52a37 !important;
        }

    </style>
</head>
<body>
<div class="profile-container">
    <div class="profile-header">
        <a href="{{ route('admin.user.tasksList', ['user' => $user->id]) }}" class="edit-btn"
           id="back-to-dashboard-btn">
            {{ $user->name }}'s dashboard
        </a>
        <h2>{{ $user->name }}'s profile</h2>
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
                <form method="POST" action="{{ route('admin.user.update.name', ['user' => $user->id]) }}"
                      style="display: flex; align-items: center;">
                    @csrf
                    @method('PATCH')
                    <input type="text" name="name" value="{{ $user->name }}" required>
                    <button type="submit" class="edit-btn" style="margin-left: 10px;">Save</button>
                    <a href="{{ route('admin.user.profile', ['user' => $user->id]) }}" class="edit-btn cancel-btn"
                       style="margin-left: 10px;">Cancel</a>
                </form>
            @else
                <span>{{ $user->name }}</span>
                <a href="{{ route('admin.user.profile', ['user' => $user->id, 'edit' => 'name']) }}" class="edit-btn"
                   style="margin-left: 10px;">Edit</a>
            @endif
        </div>
        <div class="profile-row">
            <span class="label">Email:</span>
            @if(request('edit') === 'email')
                <form method="POST" action="{{ route('admin.user.update.email', ['user' => $user->id]) }}"
                      style="display: flex; align-items: center;">
                    @csrf
                    @method('PATCH')
                    <input type="text" name="email" value="{{ $user->email }}" required>
                    <button type="submit" class="edit-btn" style="margin-left: 10px;">Save</button>
                    <a href="{{ route('admin.user.profile', ['user' => $user->id]) }}" class="edit-btn cancel-btn"
                       style="margin-left: 10px;">Cancel</a>
                </form>
            @else
                <span>{{ $user->email }}</span>
                <a href="{{ route('admin.user.profile', ['user' => $user->id, 'edit' => 'email']) }}" class="edit-btn"
                   style="margin-left: 10px;">Edit</a>
            @endif
        </div>
        <div class="profile-row">
            <span class="label">Password:</span>
            @if(request('edit') === 'password')
                <form method="POST" action="{{ route('admin.user.update.password', ['user' => $user->id]) }}"
                      style="display: flex; align-items: center;">
                    @csrf
                    @method('PATCH')
                    <input type="password" name="old_password" placeholder="current password" required>
                    <input type="password" name="password" placeholder="new password" required>
                    <input type="password" name="password_confirmation" placeholder="confirmation new password"
                           required>
                    <button type="submit" class="edit-btn" style="margin-left: 10px;">Save</button>
                    <a href="{{ route('admin.user.profile', ['user' => $user->id]) }}" class="edit-btn cancel-btn"
                       style="margin-left: 10px;">Cancel</a>
                </form>
            @else
                <span> ********** </span>
                <a href="{{ route('admin.user.profile', ['user' => $user->id, 'edit' => 'password']) }}"
                   class="edit-btn" style="margin-left: 10px;">Edit</a>
            @endif
        </div>
        <div class="profile-row">
            <span class="label">Status:</span>
            <span>
        @php
            $statusId = (int) optional($user->user_statuses)->status_id;
        @endphp
                @if($statusId === 1)
                    Active
                @elseif($statusId === 0)
                    Inactive
                @else
                    N/A
                @endif
            </span>
        </div>
    </div>
    <div style="display: flex; gap: 10px; margin-top: 10px;">
        @if((int) optional($user->user_statuses)->status_id !== 1)
            <form method="POST" action="{{ route('admin.user.profile.recover', ['user' => $user->id]) }}">
                @csrf
                <button class="logout-btn" style="background:#28a745; width:auto; margin:0;" type="submit"
                        onclick="return confirm('Are you sure you want to recover user account?')">
                    Recover account
                </button>
            </form>
        @endif
        @if((int) optional($user->user_statuses)->status_id !== 0)
            <form method="POST" action="{{ route('admin.user.profile.destroy', ['user' => $user->id]) }}">
                @csrf
                @method('DELETE')
                <button class="destroy-btn" type="submit"
                        onclick="return confirm('Are you sure you want to delete user account?')">
                    Destroy account
                </button>
            </form>
        @endif
    </div>
</div>
</body>
</html>
