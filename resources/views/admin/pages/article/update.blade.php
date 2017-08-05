@extends('admin.layouts.main')

@section('styles')
    <link href="/js/selectize/dist/css/selectize.bootstrap3.css" rel="stylesheet">
    <link href="/js/kartik-v-bootstrap-fileinput/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="/css/plugins/prism.css">
@endsection

@section('content')
    <div id="page-wrapper">
        <div>
          <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Artile Update</h1>
            </div>
          </div>
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#content" aria-controls="content" role="tab" data-toggle="tab">Content</a></li>
            <li role="presentation"><a href="#seo-config" aria-controls="seo-config" role="tab" data-toggle="tab">Seo Config</a></li>
          </ul>

          <!-- Tab panes -->
            <form action="{{ route('admin.article.update', $article->id) }}" method="POST" class="form-horizontal disabled-when-submit" enctype="multipart/form-data">
              {{ method_field('PUT') }}
              <input type="hidden" name="mode" value="update">
              <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active padding-small" id="content">
                        <div class="row">
                            <div class="col-lg-12 col-xs-12 col-md-12">
                                @if($article)
                                    @include('admin.pages.article.form')
                                @endif
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade padding-small" id="seo-config">
                      <div class="row">
                            @include('admin.pages.article.form-seo')
                        </div>
                    </div>
              </div>
            </form>

        </div>
    </div>
@endsection

@section('js-var')
    var mode = 'update';
    var images = [];
    @if ($article->image)
      var basePathImage = '{{ env('BASE_IMG_UPLOAD_PATH') }}';
      var image = basePathImage+'/'+'{{ $article->image }}';
      images.push(image);
    @endif
@endsection

@section('scripts')
    <script src="/js/tinymce/js/tinymce/tinymce.min.js"></script>
    <script src="/js/selectize/dist/js/standalone/selectize.min.js"></script>
    <script src="/js/kartik-v-bootstrap-fileinput/js/plugins/piexif.min.js" type="text/javascript"></script>
    <script src="/js/kartik-v-bootstrap-fileinput/js/plugins/sortable.min.js" type="text/javascript"></script>
    <script src="/js/kartik-v-bootstrap-fileinput/js/plugins/purify.min.js" type="text/javascript"></script>
    <script src="/js/kartik-v-bootstrap-fileinput/js/fileinput.min.js"></script>
    <script src="/js/kartik-v-bootstrap-fileinput/themes/fa/theme.js"></script>
    <script src="/js/kartik-v-bootstrap-fileinput/js/locales/LANG.js"></script>
    <script src="/js/prism.js"></script>
    <script src="/dist/js/sb-admin-2.js"></script>
    <script src="{{ mix('/js/artickle.js') }}"></script>
@endsection