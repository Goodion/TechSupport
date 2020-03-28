@if(Gate::allows('manager'))
    <div class="container">
        <div class="row">
            <div class="form-group">
                <h4>Отфильтровать заявки:</h4>
                <form method="GET" action="/">

                    @csrf
                    <div class="container">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="filters[]" value="unViewed" @if(is_array(request()->filters) && in_array('unViewed', request()->filters)) checked @endif>
                                    <label class="form-check-label" for="unViewed">
                                        Непросмотренные
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="filters[]" value="viewed" @if(is_array(request()->filters) && in_array('Viewed', request()->filters)) checked @endif>
                                    <label class="form-check-label" for="Viewed">
                                        Просмотренные
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="filters[]" value="none">
                                    <label class="form-check-label" for="none">
                                        Нет
                                    </label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="filters2[]" value="notClosed" @if(is_array(request()->filters2) && in_array('notClosed', request()->filters2)) checked @endif>
                                    <label class="form-check-label" for="notClosed">
                                        Открытые
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="filters2[]" value="closed" @if(is_array(request()->filters2) && in_array('closed', request()->filters2)) checked @endif>
                                    <label class="form-check-label" for="closed">
                                        Закрытые
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="filters2[]" value="none">
                                    <label class="form-check-label" for="none">
                                        Нет
                                    </label>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="filters3[]" value="answered" @if(is_array(request()->filters3) && in_array('answered', request()->filters3)) checked @endif>
                                    <label class="form-check-label" for="answered">
                                        С ответами
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="filters3[]" value="notAnswered" @if(is_array(request()->filters3) && in_array('notAnswered', request()->filters3)) checked @endif>
                                    <label class="form-check-label" for="notAnswered">
                                        Без ответов
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="filters3[]" value="none">
                                    <label class="form-check-label" for="none">
                                        Нет
                                    </label>
                                </div>
                            </div>
                            <div class="py-3 pb-3">
                                <button type="submit" class="badge badge-info">Отфильтровать</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif

@foreach ($appeals as $appeal)
    <div class="blog-post">
        <h2 class="blog-post-title"><a href="/appeals/{{ $appeal->id }}" class="text-dark text-decoration-none">{{ $appeal->title }}</a></h2>
        <p class="blog-post-meta">{{ $appeal->created_at->toFormattedDateString() }}, автор {{ $appeal->author->name }}</p>
    </div><!-- /.blog-post -->
@endforeach
