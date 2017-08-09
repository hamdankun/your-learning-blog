{{ csrf_field() }}
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="control-label col-sm-2">Title</label>
    <div class="col-sm-10">
        <input type="text" name="title" value="{{ !empty($article) ? $article->title : old('title') }}" class="form-control" autocomplete="off">
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
                <option value="{{ $value }}" {{ selected_label($value, !empty($article) ? $article->label : []) }}>{{ $value }}</option>
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
    <textarea name="content" id="content-article">{{ !empty($article) ? $article->content : old('content') }}</textarea>
    {!! $errors->has('content') ? $errors->first('content', '<span class="help-block">:message</span>') : '' !!}
</div>
<div class="form-group">
    <div class="col-sm-8 col-sm-offset-2">
        <button class="btn btn-primary">Save</button>
        <button type="reset" class="btn btn-danger">Reset</button>
    </div>
</div>

<!-- Modal -->
<div class="modal fade absolute-modal" id="modalGallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                <div class="row image-gallery">
                    <div class="col-sm-2 col-xs-12">
                        <img src="/storage/article-images/100x100/75b6eecb-bcb7-33cc-99dc-6257e5132d0a.jpeg" alt="Article Image" class="img-responsive">
                    </div>
                </div>
                <div class="row center">
                    <div class="form-upload mt-20 col-sm-6 col-sm-offset-3 col-xs-10">
                        <div class="form-group">
                            <input type="file" name="upload_gallery[]" multiple class="form-group" id="upload-gallery">
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6 col-xs-12 col-sm-offset-3">
                                <button type="button" class="btn btn-primary upload-gallery disabled-when-submit">Upload</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary choose-image">Choose</button>
            </div>
        </div>
    </div>
</div>
