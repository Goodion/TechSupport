<div class="container">
    <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between">
            <a class="p-2 text-muted" href="/">Главная</a>
            @can('store', \App\Appeal::class)
                <a class="p-2 text-muted" href="/appeals/create">Создать заявку</a>
            @else
                <a class="btn disabled">Создать заявку (не чаще раза в сутки!)</a>
            @endcan
        </nav>
    </div>
</div>
