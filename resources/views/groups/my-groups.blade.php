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
            <p style="font-size:40px">Grupy, w których jestem dodany</p>
            <div>
                <form style="display: inline" action="/groups/my-groups">
                    <input type="text" name="search" placeholder="Szukaj grupy" />
                </form>
                <a href="/groups"><button class="add_new">Lista grup</button></a>
            </div>
        </div>

        <div class="table_section">
            <table>
                <thead>
                <tr>
                    <th>Nazwa grupy</th>
                </tr>
                </thead>
                <tbody>
                @foreach($user->groups as $group)
                    <tr>
                        <td><a href="/groups/{{ $group->id }}">{{ $group->group_name }}</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
