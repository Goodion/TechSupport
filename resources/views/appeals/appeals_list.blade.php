@foreach ($appeals as $appeal)
    <div class="blog-post">
        <h2 class="blog-post-title"><a href="/appeals/{{ $appeal->id }}" class="text-dark text-decoration-none">{{ $appeal->title }}</a></h2>
        <p class="blog-post-meta">{{ $appeal->created_at->toFormattedDateString() }}, автор {{ $appeal->author->name }}</p>
    </div><!-- /.blog-post -->
@endforeach
