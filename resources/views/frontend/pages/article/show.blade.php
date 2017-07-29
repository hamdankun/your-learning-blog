@extends('frontend.layouts.main')

@section('styles')
    <link rel="stylesheet" type="text/css" href="/css/plugins/prism.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/css/plugins/materialize-social.css">
@endsection

@section('content')
    <div class="section no-pad-bot margin-top-medium">
        <div class="container">
            <div class="row">
                <div class="col s12 m12">
                    <nav>
                        <div class="nav-wrapper">
                            <div class="col s12 custom-breadcrumb">
                                <a href="{{ route('frontend.root') }}" class="breadcrumb">Home</a>
                                <a href="#!" class="breadcrumb">{{ $article->category->name }}</a>
                                <a href="#!" class="breadcrumb">{{ $article->title }}</a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="section">
            <div class="row">
                <div class="col s8 m8">
                    <div class="card">
                        <div class="card-image">
                            <img data-origin="{{ env('BASE_PATH_STORAGE') }}/article-images/640x480/{{ $article->image }}" class="lazy">
                            <span class="card-title custom-orange-color custom-cart-title">
                                <h5>{{ $article->title }}</h5>
                            </span>
                        </div>
                        <div class="card-content">
                            {!! $article->content !!}
                        </div>
                        <div class="card-action">
                            <div class="row">
                                <div class="col s12 m1">
                                    Tags
                                </div>
                                <div class="col s12 m11">
                                   {!! build_label($article->label, true, '<div class="chip">:name</div>') !!}
                                </div>
                                <div class="col s12 m12 margin-small">
                                    <div class="divider"></div>
                                </div>
                                <div class="col s12 m1">
                                    Author
                                </div>
                                <div class="col s12 m11">
                                    : {{ $article->user ? $article->user->name : 'admin' }}
                                </div>
                                <div class="col s12 m12 margin-small">
                                    <div class="divider"></div>
                                </div>
                                <div class="col s12 m1 valign-wrapper sharer-label">
                                    Share
                                </div>
                                <div class="col s12 m11">
                                    <a class="waves-effect waves-light btn-floating social google">
                                    <i class="fa fa-google"></i></a>


                                    <a class="fb-xfbml-parse-ignore waves-effect waves-light btn-floating social facebook" target="_blank" href="https://developers.facebook.com/docs/sharing/reference/share-dialog"><i class="fa fa-facebook"></i></a>

                                    <a class="waves-effect waves-light btn-floating social twitter">
                                    <i class="fa fa-twitter"></i></a>
                                </div>
                            </div>
                            <!-- share to link here -->
                        </div>
                    </div>
                </div>
                <div class="col s4 m4">
                    <div class="card">
                        <div class="card-image">
                            <img src="/storage/article-images/sample-image-thumbnail.png">
                            <span class="card-title custom-orange-color custom-cart-title">{{ build_label($article->label) }}</span>
                        </div>
                        <div class="card-content custom-card-content">
                            <h6>{{ $article->title }}</h6>
                            <p>
                                {{ str_limit(strip_tags($article->content), 120) }}
                            </p>
                        </div>
                        <div class="card-action">
                            <a href="{{ route('frontend.article.show', [$active_category, $article->slug]) }}" class="custom-orange-text">Learn More..</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
    </div>
@endsection

@section('scripts')
    <script src="/js/prism.js"></script>
    <script src="/js/jquery-lazyload/jquery.lazyload.min.js"></script>
    <script src="/js/jquery-lazyload/jquery.scrollstop.min.js"></script>
    <script>
        (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.10&appId=1218744614805599";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <script>
        $('.fb-xfbml-parse-ignore').click(function() {
            FB.ui({
              method: 'share',
              display: 'popup',
              href: '{{ url()->current() }}',
            }, function(response){});
        })
    </script>

    <script type="text/javascript">
        _Image.lazy();
    </script>
@endsection