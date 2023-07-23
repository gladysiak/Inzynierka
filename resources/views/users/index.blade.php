@extends('layout')

@section('styles')
    <link rel="stylesheet" href="/css/table-style.css">
@endsection

@section('content')
@if(session()->has('message'))
    <div class="message">{{ session('message') }}</div>
@endif
<div class="table">
    <div class="table_header">
        <p style="font-size:40px">Panel użytkowników</p>
        <div>
            <form style="display: inline" action="/users">
                <input type="text" name="search" placeholder="Szukaj użytkownika" />
            </form>
            <a href="/users/create-by-admin"><button class="add_new">+ Dodaj użytkownika</button></a>
        </div>
    </div>

    <div class="table_section">
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Nick</th>
                <th>E-mail</th>
                <th>Rola</th>
                <th>Akcje</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach($user->roles as $role)
                            {{ $role->name }}
                        @endforeach
                        <a href="/users/{{ $user->id }}/edit-role"><button><i class="fa-sharp fa-solid fa-pen-to-square"></i></button></a>
                    </td>
                    <td>
                        <form style="display: inline" method="post" action="/users/{{ $user->id }}">
                            @csrf
                            @method('DELETE')
                            <button class="trash-background"><i class="fa-sharp fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{ $users->links() }}
</div>
@endsection
