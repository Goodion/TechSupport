@extends('layouts.master')

@section('title', $appeal->id)

@section('content')

    <main role="main" class="container">
        <div class="row">
            <div class="col-md-8 blog-main">
                <h3 class="pb-4 mb-4 font-italic border-bottom">
                    Заявка № @yield('title')
                </h3>
                <div class="blog-post">
                    <h2 class="blog-post-title">{{ $appeal->title }}</h2>
                    <p class="blog-post-meta">{{ $appeal->created_at }}, автор {{ $appeal->author->name }}</p>
                    <p>{!! $appeal->body !!}</p>

                </div><!-- /.blog-post -->
                <div class="container pb-5">
                    <div class="row">
                        @can('update', $appeal)
                            <div class="col-auto">
                                <form method="post" action="{{ action('AppealsController@close', ['appeal' => $appeal]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn btn-secondary">Закрыть заявку</button>
                                </form>
                            </div>
                        @endcan
                    </div>
                </div>
            </div><!-- /.blog-main -->

        </div><!-- /.row -->

    </main><!-- /.container -->

@endsection
