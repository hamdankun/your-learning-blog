<h3>General Meta</h3>

<div class="form-group">
  <label class="control-label col-sm-2">Description</label>
  <div class="col-sm-9">
    <textarea class="form-control description" name="seo[content][]" placeholder="Description"></textarea>
  </div>
  <div class="invisible-area">
    {!! create_input_hidden_meta('name', 'description', '') !!}
  </div>
</div>

<div class="form-group">
  <label class="control-label col-sm-2">Keyword</label>
  <div class="col-sm-9">
    <input class="form-control keyword" name="seo[content][]" placeholder="eg: You, And, Me" />
  </div>
  <div class="invisible-area">
    {!! create_input_hidden_meta('name', 'keywords', '') !!}
  </div>
</div>

<h3>Google+ Meta</h3>

@foreach(['name' => 'Name', 'description' => 'Description'] as $key => $value)
  <div class="form-group {{ $loop->first ? 'google-base-form-meta' : '' }}">
    <label class="control-label col-sm-2">{{ $value }}</label>
    <div class="input-group col-sm-9 f-left">
      <span class="input-group-addon" id="basic-addon1">itemprop</span>
      <textarea name="seo[content][]" class="form-control google-{{$key}}" maxlength="200" placeholder="{{ $value }}" aria-describedby="basic-addon1"></textarea>
    </div>
    @if($loop->first)
      <div class="col-sm-1 btn-area">
        <button type="button" class="btn btn-primary append" data-type="google">
          <i class="fa fa-plus-circle"></i>
        </button>
      </div>
    @endif
    <div class="invisible-area">
      {!! create_input_hidden_meta('itemprop', $key, '') !!}
    </div>
  </div>
@endforeach

<div class="google-meta-content">

</div>

<h3>Open Graph(Facebook) Meta</h3>

@foreach(['title' => 'Title', 'type' =>'type', 'description' => 'Description', 'site_name' => 'Site Name'] as $key => $value)
  <div class="form-group {{ $loop->first ? 'og-base-form-meta' : '' }}">
    <label class="control-label col-sm-2">{{ $value }}</label>
    <div class="input-group col-sm-9 f-left">
      <span class="input-group-addon" id="basic-addon1">og</span>
      <textarea type="text" name="seo[content][]" class="form-control og-{{$key}}" maxlength="200" placeholder="{{ $value }}" aria-describedby="basic-addon1"></textarea>
    </div>
    @if($loop->first)
      <div class="col-sm-1 btn-area">
        <button type="button" class="btn btn-primary append" data-type="og">
          <i class="fa fa-plus-circle"></i>
        </button>
      </div>
    @endif
    <div class="invisible-area">
      {!! create_input_hidden_meta('property', $key, 'og') !!}
    </div>
  </div>
@endforeach

<div class="og-meta-content">

</div>

<h3>Twitter Meta</h3>
@foreach([
  'card' => 'Card',
  'site' => 'Site',
  'title' => 'Title',
  'description' => 'Description',
  'creator' => 'Creator',
] as $key => $value)
  <div class="form-group {{ $loop->first ? 'twitter-base-form-meta' : '' }}">
    <label class="control-label col-sm-2">{{ $value }}</label>
    <div class="input-group col-sm-9 f-left">
      <span class="input-group-addon" id="basic-addon1">twitter</span>
      <textarea type="text" name="seo[content][]" class="form-control twitter-{{$key}}" maxlength="200" placeholder="{{ $value }}" aria-describedby="basic-addon1"></textarea>
    </div>
    @if($loop->first)
      <div class="col-sm-1 btn-area">
        <button type="button" class="btn btn-primary append" data-type="twitter">
          <i class="fa fa-plus-circle"></i>
        </button>
      </div>
    @endif
    <div class="invisible-area">
      {!! create_input_hidden_meta('name', $key, 'twitter') !!}
    </div>
  </div>
@endforeach

<div class="twitter-meta-content">

</div>

<h3>Article Meta</h3>
@foreach([
  'section' => 'Section'
] as $key => $value)
  <div class="form-group {{ $loop->first ? 'article-base-form-meta' : '' }}">
    <label class="control-label col-sm-2">{{ $value }}</label>
    <div class="input-group col-sm-9 f-left">
      <span class="input-group-addon" id="basic-addon1">article</span>
      <textarea type="text" name="seo[content][]" class="form-control twitter-{{$key}}" maxlength="200" placeholder="{{ $value }}" aria-describedby="basic-addon1"></textarea>
    </div>
    @if($loop->first)
      <div class="col-sm-1 btn-area">
        <button type="button" class="btn btn-primary append" data-type="article">
          <i class="fa fa-plus-circle"></i>
        </button>
      </div>
    @endif
    <div class="invisible-area">
      {!! create_input_hidden_meta('property', $key, 'article') !!}
    </div>
  </div>
@endforeach

<div class="article-meta-content">

</div>