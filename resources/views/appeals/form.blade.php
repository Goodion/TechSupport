@include('layouts.errors')

<div class="form-group">
    <label for="title">Заголовок заявки</label>
    <input class="form-control" id="title" name="title" value="{{ old('title', $appeal->title ?? '') }}">
</div>
<div class="form-group">
    <label for="appeal_body">Текст</label>
    <textarea class="form-control" id="appeal_body" name="body">{{ old('body', $appeal->body ?? '') }}</textarea>
</div>
<div class="form-group">
    <label for="exampleFormControlFile1">Прикрепите файл</label>
    <input type="file" class="form-control-file" id="exampleFormControlFile1">
</div>
<hr>
<button type="submit" class="btn btn-primary">Сохранить</button>
