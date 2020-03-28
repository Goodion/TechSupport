@extends('layouts.master')

@section('title', $appeal->id)

@section('content')

    <main role="main" class="container">
        <div class="row">
            <div class="col-md blog-main">
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
                        @if($appeal->isNotclosed())
                            <div class="col-auto">
                                <form method="post" action="{{ action('AppealsController@close', ['appeal' => $appeal]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn btn-secondary">Закрыть заявку</button>
                                </form>
                            </div>
                        @endif
                        @if(Gate::allows('manager') && $appeal->isNotAccepted())
                            <div class="col-auto">
                                <form method="post" action="{{ action('AppealsController@accept', ['appeal' => $appeal]) }}">
                                    @csrf
                                    <button type="submit" class="btn btn btn-success">Принять заявку</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="container pb-3">
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col-5">
                            @can(['notClosed', 'accepted'], $appeal)
                                <div class="col-auto table-active pb-4 py-4">
                                    <p class="mb-0 text-info text-uppercase text-center">Ответить</p>
                                    <form method="post" action="{{ action('AppealsController@storeFeedback', ['appeal' => $appeal]) }}">
                                        @csrf
                                        @include('appeals.form')
                                    </form>
                                </div>
                            @endcan
                        </div>
                        <div class="col-4"></div>
                    </div>
                </div>
                <div class="container col-10 text-right">
                    <div class="row">
                        <div class="col-md">
                            <blockquote class="blockquote text-right">
                                <h4>Ответы по заявке:</h4>
                                @forelse($appeal->feedbacks->sortByDesc('created_at') as $feedback)
                                    <p class="mb-0 text-info text-uppercase">{{ $feedback->title }}</p>
                                    <p class="text-small mb-0">{{ $feedback->body }}</p>
                                    <footer class="blockquote-footer">
                                        <cite title="Автор">
                                            {{ $feedback->author->name }}
                                        </cite>
                                        <span class="small">
                                            {{ $feedback->created_at }}
                                        </span>
                                    </footer>
                                @empty
                                    <p class="text-small mb-0">Нет ответов =(</p>
                                @endforelse
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div><!-- /.blog-main -->

        </div><!-- /.row -->

    </main><!-- /.container -->

@endsection
