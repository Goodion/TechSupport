@component('mail::message')
# Получен ответ по заявке: {{ $appeal->title }}
Автор - {{ $feedback->author->name }}

Заголовок: <br>
{{ $feedback->title }}<br>
Текст ответа:<br>
{{ $feedback->body }}<br>

@component('mail::button', ['url' => 'http://techsupport.site/appeals/'. $appeal->id])
    Перейти к заявке
@endcomponent

Спасибо,<br>
{{ config('app.name') }}
@endcomponent
