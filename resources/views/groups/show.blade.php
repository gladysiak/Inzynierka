@extends('layout')

@section('styles')
    <link rel="stylesheet" href="/css/table-style.css">
@endsection

@section('content')
<div class="table">
    <div class="table_header">
        <p style="font-size:40px">{{ $group->group_name }}</p>
        @if ($group->admin_id === auth()->id() || auth()->user()->isAdmin())
        <div>
            <form style="display: inline" method="POST" action="/groups/{{ $group->id }}/add-users">
                @csrf
                <input type="text" name="user_name" placeholder="Wprowadź nick" />
                <button class="add_new">Dodaj użytkownika</button>
                @if(session('error'))
                    <div class="alert alert-danger" style="margin-top: 5px">
                        {{ session('error') }}
                    </div>
                @endif
            </form>
        </div>
        @endif
    </div>
    <div class="table_section">
        <table>
            <thead>
            <tr>
                <th>Nickname</th>
                <th>Gry</th>
            </tr>
            </thead>
            <tbody>
            @foreach($group->users as $user)
                <tr>
                    <td>{{ $user->name }}
                        @if ($group->admin_id === auth()->id() || auth()->user()->isAdmin())
                            <form style="display: inline" method="POST" action="/groups/{{ $group->id }}/remove-user/{{ $user->id }}">
                                @csrf
                                @method('DELETE')
                                <button style="background-color: #f80000"><i class="fa-sharp fa-solid fa-trash"></i></button>
                            </form>
                        @endif
                    </td>
                    <td>
                        @if(!$user->games->isEmpty())
                        @foreach($user->games as $game)
                            <p>{{ $game->game_name }}</p>
                        @endforeach
                        @else
                            <p>Brak gier</p>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
