@include('layouts.errors')

<div class="form-group">
    <label for="title">Заголовок заявки</label>
    <input class="form-control" id="title" name="title" value="{{ old('title') }}">
</div>
<div class="form-group">
    <label for="appeal_body">Текст</label>
    <textarea class="form-control" id="appeal_body" name="body">{{ old('body') }}</textarea>
</div>
<div class="form-group">
    <label for="fileUpload">Прикрепите файл</label>
    <input type="file" class="form-control-file" id="fileUpload" name="file">
</div>
<hr>
<button type="submit" class="btn btn-primary">Сохранить</button>
