<h3>General Meta</h3>
@if(!empty($seo) && $seo->where('category', 'general')->count() > 0)
  @foreach($seo->where('category', 'general')->all() as $key => $general)
    <div class="form-group">
      <label class="control-label col-sm-2">{{ ucwords(preg_replace('/[^A-Za-z0-9\-]/', '', $general->attribute_value)) }}</label>
      <div class="col-sm-9">
        @if($general->input_type === 'textarea')
          <textarea class="form-control description" name="seo[content][]" placeholder="{{ $general->placeholder }}">{{ $general->content }}</textarea>
          {!! create_input_hidden('seo[input_type][]', $general->input_type) !!}
          {!! create_input_hidden('seo[placeholder][]', $general->placeholder) !!}
        @else
          <{{ $general->input_type }} name="seo[content][]" value="{{ $general->content }}" placeholder="{{ $general->placeholder }}" class="form-control" /> 
          {!! create_input_hidden('seo[input_type][]', 'input') !!}          
          {!! create_input_hidden('seo[placeholder][]', $general->placeholder) !!}
        @endif
      </div>
      <div class="invisible-area">
        {!! create_input_hidden_meta($general->attribute_key, $general->attribute_value, '') !!}
        {!! create_input_hidden('seo[category][]', 'general') !!}
      </div>
    </div>
  @endforeach
@else
  <div class="form-group">
    <label class="control-label col-sm-2">Description</label>
    <div class="col-sm-9">
      <textarea class="form-control description" name="seo[content][]" placeholder="Description"></textarea>
    </div>
    <div class="invisible-area">
      {!! create_input_hidden_meta('name', 'description', '') !!}
      {!! create_input_hidden('seo[category][]', 'general') !!}
      {!! create_input_hidden('seo[input_type][]', 'textarea') !!}
      {!! create_input_hidden('seo[placeholder][]', 'Description') !!}
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2">Keyword</label>
    <div class="col-sm-9">
      <input class="form-control keyword" name="seo[content][]" placeholder="eg: You, And, Me" />
    </div>
    <div class="invisible-area">
      {!! create_input_hidden_meta('name', 'keywords', '') !!}
      {!! create_input_hidden('seo[category][]', 'general') !!}
      {!! create_input_hidden('seo[input_type][]', 'input') !!}
      {!! create_input_hidden('seo[placeholder][]', 'eg: You, And, Me') !!}
    </div>
  </div>
@endif

<h3>Google+ Meta</h3>
@if(!empty($seo) && $seo->where('category', 'google')->count() > 0)
  @foreach($seo->where('category', 'google')->all() as $key => $google)
    <div class="form-group {{ $loop->first ? 'google-base-form-meta' : '' }}">
      <label class="control-label col-sm-2">{{ ucwords(preg_replace('/[^A-Za-z0-9\-]/', '', $google->attribute_value)) }}</label>
      <div class="input-group col-sm-9 f-left">
        <span class="input-group-addon" id="basic-addon1">itemprop</span>
        <textarea name="seo[content][]" class="form-control google-{{$key}}" maxlength="200" placeholder="{{ $google->placeholder }}" aria-describedby="basic-addon1">{{ $google->content }}</textarea>
      </div>
      <div class="col-sm-1 btn-area">      
      @if($loop->first)
          <button type="button" class="btn btn-primary append" data-type="google">
            <i class="fa fa-plus-circle"></i>
          </button>
      @else
        <button type="button" class="btn btn-danger remove" data-type="article">
          <i class="fa fa-trash"></i>
        </button>
      @endif
      </div>
      <div class="invisible-area">
        {!! create_input_hidden_meta($google->attribute_key, $google->attribute_value, '') !!}
        {!! create_input_hidden('seo[category][]', $google->category) !!}
        {!! create_input_hidden('seo[input_type][]', $google->input_type) !!}
        {!! create_input_hidden('seo[placeholder][]', $google->placeholder) !!}
      </div>
    </div>
  @endforeach
@else
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
        {!! create_input_hidden('seo[category][]', 'google') !!}
        {!! create_input_hidden('seo[input_type][]', 'textarea') !!}
        {!! create_input_hidden('seo[placeholder][]', $value) !!}
      </div>
    </div>
   @endforeach 
@endif

<div class="google-meta-content">

</div>

<h3>Open Graph(Facebook) Meta</h3>

@if(!empty($seo) && $seo->where('category', 'facebook')->count() > 0)
  @foreach($seo->where('category', 'facebook')->all() as $key => $facebook)
    <div class="form-group {{ $loop->first ? 'og-base-form-meta' : '' }}">
      <label class="control-label col-sm-2">{{ ucwords($facebook->placeholder) }}</label>
      <div class="input-group col-sm-9 f-left">
        <span class="input-group-addon" id="basic-addon1">{{ $facebook->prefix }}</span>
        <textarea type="text" name="seo[content][]" class="form-control og-{{$key}}" maxlength="200" placeholder="{{ $facebook->placeholder }}" aria-describedby="basic-addon1">{{ $facebook->content }}</textarea>
      </div>
      <div class="col-sm-1 btn-area">      
        @if($loop->first)
            <button type="button" class="btn btn-primary append" data-type="og">
              <i class="fa fa-plus-circle"></i>
            </button>
        @else
          <button type="button" class="btn btn-danger remove" data-type="article">
            <i class="fa fa-trash"></i>
          </button>
        @endif
      </div>
      <div class="invisible-area">
        {!! create_input_hidden_meta($facebook->attribute_key, $facebook->attribute_value, $facebook->prefix) !!}
        {!! create_input_hidden('seo[category][]', $facebook->category) !!}
        {!! create_input_hidden('seo[input_type][]', 'textarea') !!}
        {!! create_input_hidden('seo[placeholder][]', $facebook->placeholder) !!}
      </div>
    </div>
  @endforeach
@else
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
        {!! create_input_hidden('seo[category][]', 'facebook') !!}
        {!! create_input_hidden('seo[input_type][]', 'textarea') !!}
        {!! create_input_hidden('seo[placeholder][]', $value) !!}
      </div>
    </div>
  @endforeach
@endif
<div class="og-meta-content">

</div>
<h3>Twitter Meta</h3>
@if(!empty($seo) && $seo->where('category', 'twitter')->count() > 0)
  @foreach($seo->where('category', 'twitter')->all() as $key => $twitter)
    <div class="form-group {{ $loop->first ? 'twitter-base-form-meta' : '' }}">
      <label class="control-label col-sm-2">{{ ucwords($twitter->placeholder) }}</label>
      <div class="input-group col-sm-9 f-left">
        <span class="input-group-addon" id="basic-addon1">{{ $twitter->prefix }}</span>
        <textarea type="text" name="seo[content][]" class="form-control twitter-{{$key}}" maxlength="200" placeholder="{{ $twitter->placeholder }}" aria-describedby="basic-addon1">{{ $twitter->content }}</textarea>
      </div>
      @if($loop->first)
        <div class="col-sm-1 btn-area">
          <button type="button" class="btn btn-primary append" data-type="twitter">
            <i class="fa fa-plus-circle"></i>
          </button>
        </div>
      @endif
      <div class="invisible-area">
        {!! create_input_hidden_meta($twitter->attribute_key, $twitter->attribute_value, $twitter->prefix) !!}
        {!! create_input_hidden('seo[category][]', $twitter->category) !!}
        {!! create_input_hidden('seo[input_type][]', $twitter->input_type) !!}
        {!! create_input_hidden('seo[placeholder][]', $twitter->placeholder) !!}
      </div>
    </div>
  @endforeach
@else
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
        {!! create_input_hidden('seo[category][]', 'twitter') !!}
        {!! create_input_hidden('seo[input_type][]', 'textarea') !!}
        {!! create_input_hidden('seo[placeholder][]', $value) !!}
      </div>
    </div>
  @endforeach
@endif
<div class="twitter-meta-content">

</div>

<h3>Article Meta</h3>
@if(!empty($seo) && $seo->where('category', 'article')->count() > 0)
  @foreach($seo->where('category', 'article')->all() as $key => $article)
    <div class="form-group {{ $loop->first ? 'article-base-form-meta' : '' }}">
      <label class="control-label col-sm-2">{{ $article->placeholder }}</label>
      <div class="input-group col-sm-9 f-left">
        <span class="input-group-addon" id="basic-addon1">{{ $article->prefix }}</span>
        <textarea type="text" name="seo[content][]" class="form-control twitter-{{$key}}" maxlength="200" placeholder="{{ $article->placeholder }}" aria-describedby="basic-addon1">{{ $article->content }}</textarea>
      </div>
      <div class="col-sm-1 btn-area">      
        @if($loop->first)
          <button type="button" class="btn btn-primary append" data-type="article">
            <i class="fa fa-plus-circle"></i>
          </button>
        @else
          <button type="button" class="btn btn-danger remove" data-type="article">
            <i class="fa fa-trash"></i>
          </button>
        @endif
      </div>      
      <div class="invisible-area">
        {!! create_input_hidden_meta($article->attribute_key, $article->attribute_value, $article->prefix) !!}
        {!! create_input_hidden('seo[category][]', $article->category) !!}
        {!! create_input_hidden('seo[input_type][]', $article->input_type) !!}
        {!! create_input_hidden('seo[placeholder][]', $article->placeholder) !!}
      </div>
    </div>
  @endforeach
@else
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
        {!! create_input_hidden('seo[category][]', 'article') !!}
        {!! create_input_hidden('seo[input_type][]', 'textarea') !!}
        {!! create_input_hidden('seo[placeholder][]', $value) !!}
      </div>
    </div>
  @endforeach
@endif

<div class="article-meta-content">

</div>