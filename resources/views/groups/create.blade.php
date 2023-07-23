@extends('layout')

@section('styles')
    <link rel="stylesheet" href="/css/register-style.css">
@endsection

@section('content')

<div class="box">
    <form method="post" action="/groups/create">
        @csrf
        <h1>Utwórz grupę</h1>
        <div class="inputBox">
            <input type="text" name="group_name" required="required">
            <span>Nazwa grupy</span>
            <i></i>
        </div>
        @if ($errors->has('group_name'))
            <p class="error-message">{{ $errors->first('group_name') }}</p>
        @endif
        <input type="submit" value="Utwórz grupę">
    </form>
</div>
    
@endsection
