@component('mail::message')
# Создана новая заявка: {{ $appeal->title }}
Автор - {{ $appeal->author->name }}

{{ $appeal->body }}

@component('mail::button', ['url' => 'http://techsupport.site/appeals/'. $appeal->id])
Перейти к заявке
@endcomponent

Спасибо,<br>
{{ config('app.name') }}
@endcomponent
