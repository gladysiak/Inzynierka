@extends('layout')

@section('styles')
    <link rel="stylesheet" href="/css/create-by-admin-style.css">
@endsection

@section('content')

    <div class="box">
        <form method="post" action="/users/{{ $user->id }}/update-role">
            @csrf
            @method('PUT')

            <div class="select">
                <span class="dane">Wybierz nową rolę:</span>
                <select name="role">
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <input type="submit" value="Zapisz">
        </form>
    </div>


@endsection
