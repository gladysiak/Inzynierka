@extends('layout')

@section('styles')
    <link rel="stylesheet" href="/css/create-by-admin-style.css">
@endsection

@section('content')

    <div class="box">
        <form method="post" action="/users/create-by-admin/store">
            @csrf
            <h1>Dodaj użytkownika</h1>
            <div class="inputBox">
                <input type="text" name="name" required="required">
                <span>Login</span>
                <i></i>
            </div>
            <div class="inputBox">
                <input type="email" name="email" required="required">
                <span>Email</span>
                <i></i>
            </div>
            <div class="inputBox">
                <input type="password" name="password" required="required">
                <span>Hasło</span>
                <i></i>
            </div>
            <div class="inputBox">
                <input type="password" name="password_confirmation" required="required">
                <span>Powtórz hasło</span>
                <i></i>
            </div>
            <div class="select">
                <span class="dane">Rola</span>
                <select name="role_id">
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <input type="submit" value="Dodaj">
        </form>
    </div>
{{--<main class="container">--}}
{{--    <h1>Utwórz użytkownika</h1>--}}

{{--    <form method="post" action="/users/create-by-admin/store">--}}
{{--        @csrf--}}
{{--        <div class="mb-3">--}}
{{--            <label class="form-label">Login</label>--}}
{{--            <input type="text" class="form-control" name="name">--}}
{{--        </div>--}}
{{--        <div class="mb-3">--}}
{{--            <label class="form-label">Email</label>--}}
{{--            <input type="email" class="form-control" name="email">--}}
{{--        </div>--}}
{{--        <div class="mb-3">--}}
{{--            <label class="form-label">Hasło</label>--}}
{{--            <input type="password" class="form-control" name="password">--}}
{{--        </div>--}}
{{--        <div class="mb-3">--}}
{{--            <label class="form-label">Powtórz hasło</label>--}}
{{--            <input type="password" class="form-control" name="password_confirmation">--}}
{{--        </div>--}}
{{--        <div class="mb-3">--}}
{{--            <label class="form-label">Rola</label>--}}
{{--            <select class="form-control" name="role_id">--}}
{{--                @foreach($roles as $role)--}}
{{--                    <option value="{{ $role->id }}">{{ $role->name }}</option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--        </div>--}}
{{--        <button type="submit" class="btn btn-primary">Submit</button>--}}
{{--    </form>--}}
{{--</main>--}}
@endsection
