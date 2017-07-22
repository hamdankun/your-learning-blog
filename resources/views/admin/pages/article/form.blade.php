{{ csrf_field() }}
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="control-label col-sm-2">Title</label>
    <div class="col-sm-10">
        <input type="text" name="title" value="{{ isset($article) ? $article->title : old('title') }}" class="form-control" autocomplete="off">
        {!! $errors->has('title') ? $errors->first('title', '<span class="help-block">:message</span>') : '' !!}
    </div>
</div>
<div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
    <label for="name" class="control-label col-sm-2">Category</label>
    <div class="col-sm-10">
        <select name="category_id" class="form-control" id="category">
                <option value="">Choose Category</option>
            @foreach($categories as $key => $value)
                <option value="{{ $key }}" {{ selected_category($key, !empty($article) ? $article->category_id : '') }}>{{ $value }}</option>
            @endforeach
        </select>
        {!! $errors->has('category_id') ? $errors->first('category_id', '<span class="help-block">:message</span>') : '' !!}
    </div>
</div>
<div class="form-group {{ $errors->has('label') ? 'has-error' : '' }}">
    <label for="label" class="control-label col-sm-2">Label/Keyword</label>
    <div class="col-sm-10">
        <select name="label[]" multiple="multiple" class="form-control" id="label">
             <option value="">Choose Labels</option>
            @foreach($labels as $key => $value)
                <option value="{{ $value }}" {{ selected_label($value, $article->label) }}>{{ $value }}</option>
            @endforeach 
        </select>
        {!! $errors->has('label') ? $errors->first('label', '<span class="help-block">:message</span>') : '' !!}
    </div>
</div>
<div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
    <label for="label" class="control-label col-sm-2">Image</label>
    <div class="col-sm-10">
        <input type="file" name="image" class="form-control" id="upload-image">
    </div>
</div>
<br />
<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
    <textarea name="content" id="content-article">{{ isset($article) ? $article->content : old('content') }}</textarea>
    {!! $errors->has('content') ? $errors->first('content', '<span class="help-block">:message</span>') : '' !!}
</div>
<div class="form-group">
    <div class="col-sm-8 col-sm-offset-2">
        <button class="btn btn-primary">Save</button>
        <button type="reset" class="btn btn-danger">Reset</button>
    </div>
</div>
