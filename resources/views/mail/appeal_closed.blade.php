@component('mail::message')
# Закрыта заявка: {{ $appeal->title }}

@component('mail::button', ['url' => 'http://techsupport.site/appeals/'. $appeal->id])
    Перейти к заявке
@endcomponent

Спасибо,<br>
{{ config('app.name') }}
@endcomponent
