@extends('layouts.master')

@section('title', 'Заявки')

@section('content')

    <main role="main" class="container">
        <div class="row">
            <div class="col-md-8 blog-main">
                <h3 class="pb-4 mb-4 font-italic border-bottom">
                    @yield('title')
                </h3>

                @include('appeals.appeals_list')

            </div><!-- /.blog-main -->

        </div><!-- /.row -->

    </main><!-- /.container -->

@endsection
