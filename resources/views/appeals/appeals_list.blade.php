@if(Gate::allows('manager'))
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="form-group">
                    <h4>Отфильтровать заявки:</h4>
                    <form method="GET" action="/">

                        @csrf

                        <div class="form-check">
                            <div class="col-3">
                                <input class="form-check-input" type="checkbox" name="filters[]" value="unViewed" @if(is_array(request()->filters) && in_array('unViewed', request()->filters)) checked @endif>
                                <label class="form-check-label" for="unViewed">
                                    Непросмотренные
                                </label>
                            </div>

                            <div class="col-3">
                                <input class="form-check-input" type="checkbox" name="filters[]" value="not_closed" @if(is_array(request()->filters) && in_array('not_closed', request()->filters)) checked @endif>
                                <label class="form-check-label" for="not_closed">
                                    Открытые
                                </label>
                            </div>

                            <div class="col-3">
                                <input class="form-check-input" type="checkbox" name="filters[]" value="answered" @if(is_array(request()->filters) && in_array('answered', request()->filters)) checked @endif>
                                <label class="form-check-label" for="answered">
                                    С ответами
                                </label>
                            </div>
                            <button type="submit" class="badge badge-info">Отфильтровать</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
@endif

@foreach ($appeals as $appeal)
    <div class="blog-post">
        <h2 class="blog-post-title"><a href="/appeals/{{ $appeal->id }}" class="text-dark text-decoration-none">{{ $appeal->title }}</a></h2>
        <p class="blog-post-meta">{{ $appeal->created_at->toFormattedDateString() }}, автор {{ $appeal->author->name }}</p>
    </div><!-- /.blog-post -->
@endforeach
