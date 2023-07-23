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
            <p style="font-size:40px">Moje grupy</p>
            <div>
                <form style="display: inline" action="/groups/admin-my-groups">
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
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($adminGroups as $group)
                    <tr>
                        <td><a href="/groups/{{ $group->id }}">{{ $group->group_name }}</a></td>
                        <td>
                            <button><i class="fa-sharp fa-solid fa-pen-to-square"></i></button>
                            <form style="display: inline" method="post" action="/groups/{{ $group->id }}">
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
    </div>
@endsection
