{{ csrf_field() }}
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="control-label col-sm-2">Name</label>
    <div class="col-sm-8">
        <input type="text" name="name" value="{{ isset($category) ? $category->name : old('name') }}" class="form-control" autocomplete="off">
        {!! $errors->has('name') ? $errors->first('name', '<span class="help-block">:message</span>') : '' !!}
    </div>
</div>
<div class="form-group">
    <div class="col-sm-8 col-sm-offset-2">
        <button class="btn btn-primary">Save</button>
        <button type="reset" class="btn btn-danger">Reset</button>
    </div>
</div>