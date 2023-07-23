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
            <p style="font-size:40px">Wszystkie grupy</p>
            <div>
                <form style="display: inline" action="/groups">
                    <input type="text" name="search" placeholder="Szukaj grupy" />
                </form>
                <a href="/groups/create"><button class="add_new">+ Utwórz grupę</button></a>
                <a href="/groups/admin-my-groups"><button class="add_new">Zarządzaj swoimi grupami</button></a>
                <a href="/groups/my-groups"><button class="add_new">Grupy do których należysz</button></a>
            </div>
        </div>

        <div class="table_section">
            <table>
                <thead>
                <tr>
                    <th>Nazwa grupy</th>
                    @if (auth()->user()->isAdmin())
                        <th>Actions</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach($groups as $group)
                <tr>
                    <td><a href="/groups/{{ $group->id }}">{{ $group->group_name }}</a></td>
                    @if (auth()->user()->isAdmin())
                    <td>
                        <button><i class="fa-sharp fa-solid fa-pen-to-square"></i></button>
                        <form style="display: inline" method="post" action="/groups/{{ $group->id }}">
                            @csrf
                            @method('DELETE')
                            <button class="trash-background"><i class="fa-sharp fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                    @endif
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $groups->links() }}
    </div>

@endsection
