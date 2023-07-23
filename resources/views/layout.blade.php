<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('styles')

{{--    <link rel="stylesheet" href="/css/register-style.css">--}}
{{--    <link rel="stylesheet" href="/css/home-style.css">--}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>--}}

    <title>Biblioteka</title>
    <style>
        .select-multiple {
            width: 100%;
            height: 400px;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #fff;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        }

        .select-multiple option {
            padding: 4px;
        }

        .alert-success {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            color: #333;
        }
    </style>
</head>
@php
    use Illuminate\Support\Facades\Route;
    $notification = session('notification'); // Pobranie powiadomienia z sesji
@endphp
<body
{{--    @if(Route::is('register') || Route::is('login') || Route::is('homePage'))--}}
{{--        style="background-color: #23232a"--}}
{{--    @else--}}
{{--        style="background-color: #d5d5d5"--}}
{{--    @endif--}}
>


@yield('content')

@auth
    @php
        $user = auth()->user();
        $latestEventId = $user->last_event_id;
    @endphp
    @if ($latestEventId)
        <div class="alert-success" role="alert">
            Nowe wydarzenie zostało dodane przez członka grupy!
        </div>
    @endif
@endauth

<div class="sidebar">
    <div class="logo-content">
        <div class="logo">
            <i class='bx bx-ghost'></i>
            <h1>GameBox</h1>
        </div>
        <i class='bx bx-menu' id="abc"></i>
    </div>
    <ul class="list">
        <li class="list-item {{ Route::is('homePage') ? 'active' : '' }}">
            <a href="/">
                <i class='bx bx-grid-alt'></i>
                <span
                    class="links-name">Strona główna
                        </span>
            </a>
        </li>
        @auth()
            <li class="list-item {{ Route::is('games.*') ? 'active' : '' }}">
                <a href="/games">
                    <i class='bx bx-dice-5'></i>
                    <span
                        class="links-name">Gry
                            </span>
                </a>
            </li>
            <li class="list-item {{ Route::is('groups.*') ? 'active' : '' }}">
                <a href="/groups">
                    <i class='bx bx-group'></i>
                    <span
                        class="links-name">Grupy
                            </span>
                </a>
            </li>
            @php
                $userGroups = Auth::user()->groups()->pluck('id')->toArray();
            @endphp
            @if (count($userGroups) > 0)
            <li class="list-item {{ Route::is('fullcalendar') ? 'active' : '' }}">
                <a href="{{ route('fullcalendar') }}">
                    <i class='bx bxs-calendar'></i>
                    <span
                        class="links-name">Kalendarz
                            </span>
                </a>
            </li>
            @endif
        @endauth
    </ul>

    <ul class="list-logout">
        @if (auth()->check() && auth()->user()->isAdmin())
            <li class="list-item {{ Route::is('admin-games.*') ? 'active' : '' }}">
                <a href="/admin-games">
                    <i class='bx bx-cog'></i>
                    <span
                        class="links-name">Zarządzaj grami
                            </span>
                </a>
            </li>
            <li class="list-item {{ Route::is('users.admin.*') ? 'active' : '' }}">
                <a href="/users">
                    <i class='bx bx-cog'></i>
                    <span
                        class="links-name">Użytkownicy
                        </span>
                </a>
            </li>
        @endif
        @auth()
            <li class="list-item {{ (Route::is('users.edit') || Route::is('users.change-password')) ? 'active' : '' }}">
                <a href="/users/{{ auth()->user()->getAuthIdentifier() }}/edit">
                    <i class='bx bx-user'></i>
                    <span class="links-name">Mój profil</span>
                </a>
            </li>
            <li>
                <form method="post" action="/logout">
                    @csrf
                    <button type="submit" class="logout-button">
                        <i class='bx bx-log-out'></i>
                        <span class="links-name">Wyloguj się</span>
                    </button>
                </form>
            </li>
        @else
            <li class="list-item {{ Route::is('register') ? 'active' : '' }}">
                <a href="/register">
                    <i class='bx bx-registered' ></i>
                    <span class="links-name">Rejestracja</span>
                </a>
            </li>
            <li class="list-item {{ Route::is('login') ? 'active' : '' }}">
                <a href="/login">
                    <i class='bx bx-user'></i>
                    <span class="links-name">Logowanie</span>
                </a>
            </li>
        @endauth
    </ul>
</div>

<script src="/js/home-script.js"></script>
</body>
</html>
