@extends('layouts.master')

@section('title', 'Создание заявки')

@section('content')
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">@yield('title')</h1>
        </div>
    </section>
    <div class="container pb-5">
        <form method="POST" action="/appeals" enctype="multipart/form-data">

            @csrf

            @include('appeals.form')

        </form>
    </div>
@endsection
