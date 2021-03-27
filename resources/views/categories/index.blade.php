<div class="form-group row">
    <p class="col-sm-4 col-form-label">選択（複数選択可）</p>
    <div class="col-sm-8">
        @foreach ($categoris as $key => $category)
            <label>{{ Form::checkbox('category[]', $key) }}{{ $ }}</label>
        @endforeach
    </div>
</div>