@extends('layouts.master')

@section('title', 'Редактирование заявки')

@section('content')
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">@yield('title')</h1>
        </div>
    </section>
    <div class="container">
        <form method="POST" action="/appeals/{{ $appeal->id }}">

            @csrf
            @method('PATCH')
            @include('appeals.form')

        </form>
        <form method="post" action="/appeals/{{ $appeal }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-secondary">Удалить</button>
        </form>
    </div>
@endsection
