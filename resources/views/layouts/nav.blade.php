<div class="container">
    <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between">
            <a class="p-2 text-muted" href="/">Главная</a>
            <a class="p-2 text-muted" href="/appeals/create">Создать заявку</a>
            @if(Gate::allows('managerPanel'))
                <a class="p-2 text-muted" href="/manager">Раздел менеджера</a>
            @endif
        </nav>
    </div>
</div>
